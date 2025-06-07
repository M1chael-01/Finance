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

                        $transactionID = self::getTransaktionID($userId);

                        echo     $transactionID;

                        $stmt->bind_param("sssi", $newFName, $newLName, $newEmail, $userId);

                        if ($stmt->execute()) {
                            echo json_encode(["status" => "success", "message" => "Profile updated successfully."]);
                            $_SESSION["jmeno"] = $fName;

                            // Update user's name in transakce
                            if ($transactionID) {
                                $updateTrans = "UPDATE transakce SET osoba = ? WHERE id = ?";
                                $stmtUpdate = $data->prepare($updateTrans);

                                if ($stmtUpdate) {
                                    $newName = $fName . " " . $lName;
                                    $stmtUpdate->bind_param("si", $newName, $transactionID);
                                    $stmtUpdate->execute();
                                    $stmtUpdate->close();
                                }
                            }
                        } else {
                            echo json_encode(["status" => "error", "message" => "Failed to update profile."]);
                        }

                        $stmt->close();
                    } else {
                        echo json_encode(["status" => "error", "message" => "SQL preparation failed."]);
                    }
                    return;
                }
            }
        } else {
            echo json_encode(["status" => "error", "message" => "No user found in the database."]);
        }
    }

    private static function getTransaktionID($id) {
        global $connection;

        $sql = "SELECT jmeno, prijmeni FROM uzivatel WHERE id = ?";
        $stmt = $connection->prepare($sql);

        if (!$stmt) return null;

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($firstName, $lastName);
        $stmt->fetch();
        $stmt->close();

        if (!$firstName || !$lastName) return null;

        $fName = AES::decryption($firstName);
        $lName = AES::decryption($lastName);
        $fullName = trim($fName . " " . $lName);

        $sql2 = "SELECT osoba, id FROM transakce";
        $stmt2 = $connection->prepare($sql2);

        if (!$stmt2) return null;

        $stmt2->execute();
        $result = $stmt2->get_result();

        while ($row = $result->fetch_assoc()) {
            if (trim($row['osoba']) === $fullName) {
                $stmt2->close();
                return $row['id'];
            }
        }

        $stmt2->close();
        return 6;
    }
    
    
    public static function checkUserExist($conn, $fName, $lName, $email, $id) {

        // fix this fx
        // Select all users except the one with the given ID
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
