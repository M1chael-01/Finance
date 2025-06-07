<?php

require "./userExist.php";
require "./AES.php";
require "../databases/users.php"; 

class Login {
    public static function login($username, $password) {
        $conn = users();

    
        $sql = "SELECT id, jmeno, heslo FROM uzivatel"; 

   
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                if (AES::decryption($row["jmeno"]) == $username) {
                    echo AES::decryption($row["jmeno"]);
                    // Now check the password
                    if (password_verify($password, $row["heslo"])) { 
                        echo "User found and logged in.";
                        session_start();
                        $_SESSION["log"] = true;
                        $_SESSION["jmeno"] = $username;
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["group"] = $row["group_id"];
                     
                    } else {
                        echo $password;
                        echo "Incorrect password.";
                    }
                    return; // Exit after finding a match
                }
            }
            echo "No user found.";
        } else {
            echo "No data found.";
        }
    }
}

// Handling the form submission
if (isset($_POST["login"])) {
    $username = $_POST["name"];
    $password = $_POST["password"];

   
    Login::login($username, $password);
}


// CHECK IF USER AINT EXIST BEFORE 


// RULES REDIREC BY SESSION 

?>

