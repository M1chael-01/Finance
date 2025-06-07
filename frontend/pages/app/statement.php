<link rel="stylesheet" href="./frontend/styles/app/statement.css">
<style>
    .no-results-message {
        font-size: 18px;
        color: #e74c3c;  /* Red color for no results */
        text-align: center;
        margin-top: 20px;
        font-weight: bold;
    }
</style>
<?php
session_start(); 


if(!isset($_SESSION["id"]) && !isset($_SESSION["log"]) && !isset($_SESSION["jmeno"])) {
    echo "<script> location.href='?uvod';</script>";
}



require "./backend/databases/operation.php";
require "./frontend/pages/header.php"; 
require "./backend/codes/createUser.php";


$con = users();
$operations = operation();


function getRecords($id) {
    global $operations;  
    $sql = "SELECT * FROM transakce WHERE `group_id` = ?";

    if ($stmt = mysqli_prepare($operations, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            
            $result = mysqli_stmt_get_result($stmt);
            $transactions = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $transactions[] = $row;
            }
            return $transactions;
        } else {
            echo "Error executing query: " . mysqli_stmt_error($stmt);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($operations);
    }
    return [];
}

$groupId = GetGroupID::GetGroupID();

if ($groupId === null) {
    echo "User not found or not logged in!";
    exit;
}

$records = getRecords($groupId);


$date = isset($_POST['date']) ? $_POST['date'] : '';
$userId = isset($_POST['user']) ? $_POST['user'] : '';

$filteredTransactions = array_filter($records, function($transaction) use ($date, $userId) {
    $isValid = true;

    // Convert the date to a standard format (YYYY-MM-DD)
    if ($date) {
        // Normalize input date format (make sure it's in YYYY-MM-DD format)
        $transactionDate = date('Y-m-d', strtotime(trim($transaction['datum'])));

        // Normalize user input date to the same format (YYYY-MM-DD)
        $inputDate = date('Y-m-d', strtotime($date));

        // Check if transaction date matches the input date
        if ($transactionDate !== $inputDate) {
            $isValid = false;
        }
    }

    // User filtering
    if ($userId && ($transaction['osoba']) !== $userId) {
        $isValid = false;
    }

    return $isValid;
});

function getState($date, $sent) {
    // Convert the dates to arrays
    $dateArray = explode("-", $date);
    $sentArray = explode("-", $sent);

    // Extract year, month, and day from the date and sent arrays
    $dateY = $dateArray[0];
    $dateM = $dateArray[1];
    $dateD = $dateArray[2];

    $sentY = $sentArray[0];
    $sentM = $sentArray[1];
    $sentD = $sentArray[2];


    if ($dateY > $sentY) {
        return true;  // Date is after sent
    } elseif ($dateY < $sentY) {
        return false;  // Date is before sent
    }


    if ($dateM > $sentM) {
        return true;  // Date is after sent
    } elseif ($dateM < $sentM) {
        return false;  // Date is before sent
    }

    if ($dateD > $sentD) {
        return true;  // Date is after sent
    } elseif ($dateD < $sentD) {
        return false;  // Date is before sent
    }

    // If all are equal, the dates are the same
    return null;  // Dates are the same
}

if (isset($_GET['reset'])) {
    $date = null;  // Reset the date value
    $userId = null; // You may also want to reset the user filter if needed
    
}

function formatDate($date) {
    // Split the date string by the dash (-)
    $splitted = explode("-", $date);

    // Assign year, month, and day
    $y = $splitted[0];
    $m = $splitted[1];  // Corrected to use index 1 for the month
    $d = $splitted[2];  // Corrected to use index 2 for the day

    // Return the formatted date in DD-MM-YYYY format
    return $d . "-" . $m . "-" . $y;
}


?>

<section>
    <div class="container">
        <h2>Zde naleznete výpisy</h2>
        <form method="POST" action="">
            <div class="filter-form">
                <div class="form-group">
                    <label for="date">Vyberte datum</label>
                    <input type="date" name="date" id="date" value="<?= htmlspecialchars($date) ?>">
                </div>

                <div class="form-group">
                    <label for="user">Vyberte uživatele</label>
                    <select name="user" id="user">
                        <option value="" disabled selected>Vyberte osobu</option>
                        <?php
                        // Query to get users based on groupId
                        $sql = "SELECT id, jmeno, prijmeni FROM uzivatel WHERE `group_id` = ?";
                        if ($stmt = mysqli_prepare($con, $sql)) {
                            mysqli_stmt_bind_param($stmt, 'i', $groupId);

                            if (mysqli_stmt_execute($stmt)) {
                                $result = mysqli_stmt_get_result($stmt);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Decrypt name and display in dropdown
                                    $decryptedName = AES::decryption($row['jmeno']) . ' ' . AES::decryption($row['prijmeni']);
                                    echo "<option value='" . htmlspecialchars($decryptedName) . "'>" . htmlspecialchars($decryptedName) . "</option>";
                                }
                            }
                            mysqli_stmt_close($stmt);
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="filter-btn">Filtrovat</button>
                <button id="exportBtn" class="export-btn">Export dat</button>
                <button name="date">Resetovat</button>
            </div>
        </form>

        <div class="transaction-table">
            <?php if (empty($filteredTransactions)): ?>
                <p class="no-results-message">Žádné transakce nenalezeny.</p>
            <?php else: ?>
                <table id="transactionTable">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Odesláno</th>
                            <th>Typ a Částka</th>
                            <th>Uživatel</th>
                            <th>Popis</th>
                        <!-- New column for time difference -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($filteredTransactions as $row) {
                            $decryptedUser = ($row["osoba"]);
                            $result = getState($row["datum"], $row["aktivita"]);

                            // Set the state based on the result of getState
                            $state = $result === true ? "Probíhá...." : "Přijato";

                            // Reformat the date (from YYYY-MM-DD to MM/DD/YYYY)
                            $dateSplitted = explode("-", $row["datum"]);
                            $newDate = $dateSplitted[2] . "/" . $dateSplitted[1] . "/" . $dateSplitted[0];

                            $aktivita = $row["aktivita"];
                            $datum = $row["datum"];
        
                            // $timeLeft = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);

                            // Display the transaction data
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($newDate) . " / " . $state . "</td>";
                            echo "<td>" . formatDate($row["aktivita"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row['typ']) . " / " . htmlspecialchars($row['castka']) . "</td>";
                            echo "<td>" . htmlspecialchars($decryptedUser) . "</td>";  
                            echo "<td>" . htmlspecialchars($row['popis']) . "</td>";
                          
    
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</section>




<?php require "./frontend/pages/footer.php"; ?> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

<script>

document.getElementById('exportBtn').addEventListener('click', function(event) {
    event.preventDefault();
    let table = document.getElementById('transactionTable');
    
    // Convert the table to a worksheet
    let ws = XLSX.utils.table_to_sheet(table);

    // Apply styles to the header row
    let headerStyle = {
        font: { bold: true, color: { rgb: "FFFFFF" } },
        fill: { fgColor: { rgb: "4F81BD" } }, // Blue background
        alignment: { horizontal: "center", vertical: "center" },
        border: {
            top: { style: 'thin', color: { rgb: '000000' } },
            left: { style: 'thin', color: { rgb: '000000' } },
            bottom: { style: 'thin', color: { rgb: '000000' } },
            right: { style: 'thin', color: { rgb: '000000' } }
        }
    };

    // Style the header row (first row)
    for (let col = 0; col < table.rows[0].cells.length; col++) {
        let cellAddress = { r: 0, c: col }; // Row 0, Column 'col'
        if (!ws[cellAddress]) ws[cellAddress] = {};
        ws[cellAddress].s = headerStyle;
    }

    // Set the width of columns to make the table look cleaner
    let colWidths = [{ wpx: 100 }, { wpx: 150 }, { wpx: 100 }, { wpx: 200 }, { wpx: 250 }];
    ws['!cols'] = colWidths;

    // Create the workbook and trigger the download
    let wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Transactions");

    // Trigger the Excel file download
    XLSX.writeFile(wb, 'export.xlsx');

});
</script>






