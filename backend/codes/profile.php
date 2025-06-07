<?php
require "../databases/users.php"; 
require "../databases/operation.php";
require "./AES.php"; 
// require "./userExist.php";

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

$connection = users(); 
$data = operation();

class Profile {

    public static function update($fName, $lName, $email) {
        global $connection, $data;

        if (!isset($_SESSION["jmeno"])) {
            echo json_encode(["status" => "error", "message" => "Session data is missing. Please log in again."]);
            return;
        }

        if (self::checkUserExist($connection, $fName, $lName, $email, $_SESSION["id"])) {
            echo json_encode(["status" => "error", "message" => "User already exists with the same name and email."]);
            return;
        }

        $select = "SELECT * FROM uzivatel";
        $result = $connection->query($select);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (AES::decryption($row["jmeno"]) === $_SESSION["jmeno"]) {


                    $update = "UPDATE uzivatel SET jmeno = ?, prijmeni = ?, email = ? WHERE id = ?";


                    if ($stmt = $connection->prepare($update)) {
                        $newFName = AES::encryption($fName);
                        $newLName = AES::encryption($lName);
                        $newEmail = AES::encryption($email);
                        $userId = $row['id'];

                        $stmt->bind_param("sssi", $newFName, $newLName, $newEmail, $userId);

                        if ($stmt->execute()) {
                            echo json_encode(["status" => "success", "message" => "Profile updated successfully."]);
                            $_SESSION["jmeno"] = $fName;
                            }
                         else {
                            echo json_encode(["status" => "error", "message" => "Failed to update profile."]);
                        }

                        $stmt->close();
                    }
                    return;
                }
            }
        } else {
            echo json_encode(["status" => "error", "message" => "No user found in the database."]);
        }
    }

    
    
    public static function checkUserExist($conn, $fName, $lName, $email, $id) {

        $sql = "SELECT id, jmeno, prijmeni, email FROM uzivatel WHERE id != ?";

        $stmt = mysqli_prepare($conn, $sql);
    
        if (!$stmt) {
            return false;
        }
    
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        while ($row = mysqli_fetch_assoc($result)) {
            // Assuming you have a decrypt function like decrypt($data)
            $dbFName =  AES::decryption($row['jmeno']);
            $dbLName = AES::decryption($row['prijmeni']);
            $dbEmail = AES::decryption($row['email']);
    
            if ($dbFName === $fName || $dbLName === $lName || $dbEmail === $email) {
                // Found a match
                return true;
            }

            var_dump($dbLName);
            var_dump($dbFName);
            var_dump($dbEmail);
        }
    
        // No match found
        return false;
    }
    

    public static function deleteAdmin($id) {
        global $connection,$data;
        $sql = "DELETE FROM uzivatel WHERE group_id = ?";
        

        $stmt = $connection->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $connection->error);
        }
    
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        //delete a tranactions
        $sql = "DELETE FROM transakce WHERE group_id = ?";
        $stmt = $data->prepare($sql);
        if ($stmt === false) return;
        $stmt->bind_param("i", $id);
        $stmt->execute();
        session_destroy();
        echo "deleted";
       
    }
    
    public static function deleteUser($id) {
        global $connection;
        $sql = "DELETE FROM uzivatel WHERE id = ?";
      

        $stmt = $connection->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $connection->error);
        }
    
        $stmt->bind_param("i", $id);    
        $stmt->execute();
        $stmt->close();
        session_destroy();
        echo "deleted";
    }
    
  
    
    //select user role first and if user is admin show him your account and account 
    // you manage willl be down

    // ele just delete it 
}

if (isset($_POST["changes"])) {
    $fName = $_POST["name"];
    $lName = $_POST["surname"];
    $email = $_POST["email"];

    // Call the update function to update the profile
    Profile::update($fName, $lName, $email);
}

// if(isset($_SESSION["id"])) {
if(isset($_POST["delete"]) && isset($_POST["role"])) {
    if($_POST["role"] == "user") {
        Profile::deleteUser($_SESSION["id"]);
       
    }
    else{

        Profile::deleteAdmin($_SESSION["id"]);
    }
}
// }
