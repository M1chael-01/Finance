

<?php require "./frontend/pages/header.php"; ?>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./frontend/styles/app/transaction.css">
</head>
<body>

<?php

// require "./backend/"

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "./backend/databases/users.php";

$con = users();

$GLOBALS["count"] = 0;

function getID() {
    global $con;

    if (isset($_SESSION["jmeno"])) {
        $sql = "SELECT `group_id`, jmeno FROM uzivatel";
        if ($stmt = mysqli_prepare($con, $sql)) {
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($_SESSION["jmeno"] == AES::decryption($row["jmeno"])) {
                        return $row["group_id"];
                    }
                }
            } else {
                echo "Error executing query in getID: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing query in getID: " . mysqli_error($con);
        }
    }

    return null;
}
$founded = getID();

// require "../"

if (!isset($_SESSION["jmeno"]) && !isset($_SESSION["log"]))  {
    echo "<script>location.href = '?uvod'</script>";
}


?>

<section>
    <div class="container">
        <h2>Vytvořte novou transakci</h2>
        <form id="transactionForm">
            <div class="form-group">
                <input type="date" id="transactionDate" placeholder="Datum" required>
                <select id="transactionType" required>
                    <option value="">Typ transakce</option>
                    <option value="Příjem">Příjem</option>
                    <option value="Výdaj">Výdaj</option>
                </select>
            </div>
            <div class="form-group">
                <input type="number" id="amount" placeholder="Částka" required>
                <select id="person" required>
                    <option value="" disabled selected>Vyberte osobu</option>
                    <?php
                    $sql = "SELECT id, jmeno, prijmeni FROM uzivatel WHERE (role = 'user' OR role = 'admin') AND `group_id` = '$founded'";

                    if ($stmt = mysqli_prepare($con, $sql)) {
                        if (mysqli_stmt_execute($stmt)) {
                            $result = mysqli_stmt_get_result($stmt);
                            while ($row = mysqli_fetch_assoc($result)) {
                                if(AES::decryption($row["jmeno"]) != $_SESSION["jmeno"]) {
                                    $GLOBALS["count"]++;
                                $decryptedName = AES::decryption($row['jmeno']) . ' ' . AES::decryption($row['prijmeni']);
                                echo "<option value='" . $decryptedName . "'>" . $decryptedName . "</option>";
                                }
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($con);
                    ?>
                </select>
            </div>
            <div class="form-group">
                <textarea id="description" placeholder="Popis transakce" required></textarea>
            </div>
            <button type="submit">Přidat transakci</button>
        </form>
    </div>
</section>
<?php require "./frontend/pages/information.php"; ?>
<?php
if($GLOBALS["count"] == 0) {
    echo "<script>location.href = '?zadny-uzivatele'</script>";
}
?>
<script src="./frontend/js/operation.js"></script>
<?php require "./frontend/pages/footer.php"; ?>

</body>
</html>
