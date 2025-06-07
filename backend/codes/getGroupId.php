<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



class GetGroupID {

    public static function GetGroupID() {
        if (isset($_SESSION["jmeno"])) {
            $conn = users();

            if ($conn) {
                $sql = "SELECT * FROM uzivatel";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        if (AES::decryption($row["jmeno"]) == $_SESSION["jmeno"]) {

                            return $row["group_id"];
                        }
                    }
                } else {

                    echo "No users found.";
                }
            } else {

                echo "Failed to connect to the database.";
            }
        } else {
            // No session found
            echo "User is not logged in.";
        }


        return null;
    }
}
?>
