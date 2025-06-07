<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class CheckRole {
    public static function checkRole() {
        if (isset($_SESSION["jmeno"]) && isset($_SESSION["log"])) {
            $con = users();  

            $sql = "SELECT * FROM uzivatel"; // No WHERE clause, fetching all users

            if ($stmt = mysqli_prepare($con, $sql)) {
                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (AES::decryption($row["jmeno"]) == $_SESSION["jmeno"]) {
                            return $row["role"]; 
                        }
                    }
                    return null; 
                } else {
                    echo "Error executing query: " . mysqli_stmt_error($stmt);
                    return 'error';  
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing query: " . mysqli_error($con);
                return 'error';  // Return error if the query fails to prepare
            }
            mysqli_close($con);
        } else {
            return null; 
        }
    }

}
?>


