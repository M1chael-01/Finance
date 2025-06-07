<?php




if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["jmeno"]))   {

    require "../databases/users.php";
    
    require "./userExist.php";
    require "./getGroupId.php";
    require "./AES.php";
    
    }
    else{
        require "./backend/codes/userExist.php";
        require "./backend/codes/getGroupId.php";
        // require "./backend/codes/AES.php";
    }
    




if (isset($_POST["createAcc"])) {

    $fName = htmlspecialchars(trim($_POST["first_name"]));
    $lName = htmlspecialchars(trim($_POST["last_name"]));
    $date = $_POST["date_of_birth"];  // Assuming this is in a valid format
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];


    if (empty($fName) || empty($lName) || empty($date) || empty($email) || empty($password)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $fName = AES::encryption($fName);
    $lName = AES::encryption($lName);
    $email = AES::encryption($email);
    $password = password_hash($password, PASSWORD_DEFAULT);  

    $role = "admin";  
    $conn = users();


    if (!UserExist::userExist($conn, $_POST["first_name"], $_POST["last_name"], $_POST["email"])) {

        $sql = "INSERT INTO uzivatel (jmeno, prijmeni, heslo, email, datum, role) 
                VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare and bind the query
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssss", $fName, $lName, $password, $email, $date, $role);

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                // Successfully inserted the user
                $userId = mysqli_insert_id($conn); // Get the ID of the newly inserted user
                
                // Fetch dynamic group_id based on some logic (e.g., email domain, user role)
                $groupId =$userId; // Function that determines the group_id
                
                // Update the `group_id` field in the database for the newly created user
                $updateSql = "UPDATE uzivatel SET `group_id` = ? WHERE id = ?";
                if ($updateStmt = mysqli_prepare($conn, $updateSql)) {
                    $groupId = $userId;
                    mysqli_stmt_bind_param($updateStmt, "ii", $groupId, $userId);  // Bind the group_id and user-id
                    if (mysqli_stmt_execute($updateStmt)) {
                        echo "User account created and group_id updated successfully.";

                    } else {
                        // Error executing the update query
                        echo "Error updating the group_id: " . mysqli_stmt_error($updateStmt);
                    }

                    // Close the update prepared statement
                    mysqli_stmt_close($updateStmt);
                } else {
                    // Error preparing the update query
                    echo "Error preparing the update query: " . mysqli_error($conn);
                }

            } else {
                // Error executing the insert query
                echo "Error executing the insert query: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            // Error preparing the insert query
            echo "Error preparing the insert query: " . mysqli_error($conn);
        }

    } 

    mysqli_close($conn);
}

