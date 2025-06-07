<?php

class UserExist {
    public static function userExist($conn, $fName, $lName, $email) {
        $sql = "SELECT * FROM uzivatel";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                if (AES::decryption($row["jmeno"]) == $fName || AES::decryption($row["prijmeni"]) == $lName) {
                    echo "names";
                    return true;  
                }
                if (AES::decryption($row["email"]) == $email) {
                    echo "email";
                    return true;  // Email already exists
                }

               
            }
        }

        return false;
    }
}
?>
