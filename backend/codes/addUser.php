<?php
require "./userExist.php";  
require "../databases/users.php";
require "./AES.php";  
require "./getGroupId.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class AddUser {
    public static function addUser($fName, $lName, $email, $password, $role) {
        $conn = users();

            $groupId = GetGroupID::GetGroupID();

          
            if(!UserExist::userExist($conn,$fName,$lName,$email,$email)) {

          

         
            $encryptedFName = AES::encryption($fName);
            $encryptedLName = AES::encryption($lName);
            $encryptedEmail = AES::encryption($email);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $date = date("m-d-Y");  

     
            $sql = "INSERT INTO uzivatel (jmeno, prijmeni, heslo, email, datum, role, `group_id`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
   

            if ($stmt = mysqli_prepare($conn, $sql)) {
               
                mysqli_stmt_bind_param($stmt, "ssssssi", $encryptedFName, $encryptedLName, $hashedPassword, $encryptedEmail, $date, $role, $groupId);


                // Execute the query
                if (mysqli_stmt_execute($stmt)) {
                    echo "User added successfully.";

                    
                   

                } else {
                    echo "Error executing the query: " . mysqli_stmt_error($stmt);
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                // Error preparing the query
                echo "Error preparing the query: " . mysqli_error($conn);
            }
        

        // Close the connection
        mysqli_close($conn);
    }

    else{
        echo "User already exists.";
    }
}


}

if (isset($_POST['add'])) {
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $role = "user";  


    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        echo "Please fill in all fields.";
        exit;
    }
   
    AddUser::addUser($firstName, $lastName, $email, $password, $role);
}
?>
