<?php

// Require necessary files
require "../../backend/databases/users.php";
require "./AES.php";

class CreateUser {

    public static function createUser($firstN, $lastN, $email, $date, $password) {
        // Get database connection (mysqli)
        $conn = users();  // This function will return the mysqli connection
        
        // Insert user data into the database


        $sql = "INSERT INTO uzivatel (jmeno, prijmeni, email, datum, role, password) 
                VALUES (?, ?, ?, ?, 'user', ?)"; 



        // Prepare the query
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind parameters to the statement
            mysqli_stmt_bind_param($stmt, "sssss", $firstN, $lastN, $email, $date, $password);

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                // Get the last inserted ID (this will be the group_id)
                $groupId = mysqli_insert_id($conn);

                // Now update the 'group_id' field with the inserted ID
                $updateSql = "UPDATE uzivatel SET group_id = ? WHERE id = ?";
                if ($updateStmt = mysqli_prepare($conn, $updateSql)) {
                    // Bind the parameters for the update query
                    mysqli_stmt_bind_param($updateStmt, "ii", $groupId, $groupId);
                    // Execute the update query
                    mysqli_stmt_execute($updateStmt);
                    mysqli_stmt_close($updateStmt);

                    return true;  // Indicate success
                } else {
                    return false;  // Failed to update group_id
                }
            } else {
                return false;  // Failed to insert user
            }
        } else {
            return false;  // Failed to prepare the insert query
        }
    }
}

if (isset($_POST["createAcc"])) {
    // Encrypt the user data
    $fName = AES::encryption($_POST["first_name"]);
    $lName = AES::encryption($_POST["last_name"]);
    $date = $_POST["date_of_birth"];  // Assuming this is in a valid format
    $email = AES::encryption($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);  // Hash password

    // Call the method to create the user
    $isCreated = CreateUser::createUser($fName, $lName, $email, $date, $password);

    if ($isCreated) {
        echo "User account created successfully.";
    } else {
        echo "Error creating user account.";
    }
}
