<?php

require "../databases/operation.php";
require "../databases/users.php";
require "./AES.php";
require "./getGroupId.php";
$conn = operation(); 


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$data = json_decode(file_get_contents("php://input"), true);


$person = $data['person'];
$type = $data['type'];
$date = $data['date'];
$amount = $data['amount'];
$description = $data['description'];

$activity = date("Y/m/d");  // send it by js intead 


$groupId = GetGroupID::GetGroupID();

// Ensure all required fields are present
if ($person && $type && $date && $amount && $description && $groupId) {
    $sql = "INSERT INTO transakce (datum, aktivita, typ, castka, osoba, popis, `group_id`) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {

        mysqli_stmt_bind_param($stmt, "sssissi", $date, $activity, $type, $amount, $person, $description, $groupId);
        
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "message" => "Transaction created successfully!"]);
        } else {
            // Handle query execution error
            echo json_encode(["status" => "error", "message" => "Error executing query: " . mysqli_stmt_error($stmt)]);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);

    } else {
        // Handle error preparing the query
        echo json_encode(["status" => "error", "message" => "Error preparing query: " . mysqli_error($conn)]);
    }
} else {
    // Handle missing data
    echo json_encode(["status" => "error", "message" => "Missing required transaction data or invalid user."]);
}

// Close the database connection
mysqli_close($conn);

?>
