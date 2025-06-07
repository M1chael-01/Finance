<?php
// Include necessary files (for DB connection, etc.)
// require_once 'db_connection.php';

class Delete {
    public static function deleteUser() {
        // Replace with your actual query to delete a user
        // For now, we simulate deletion by returning a success message.
        // Assuming the deletion process is successful:
        return ['success' => true, 'message' => 'User account deleted successfully.'];
        
        // If there's an error during deletion, you can return an error response
        // return ['success' => false, 'message' => 'Error deleting user account.'];
    }

    public static function deleteAdmin() {
        // Replace with your actual query to delete an admin
        // Simulating deletion for now:
        return ['success' => true, 'message' => 'Admin account deleted successfully.'];

        // If there's an error during deletion, you can return an error response
        // return ['success' => false, 'message' => 'Error deleting admin account.'];
    }
}

// Check if the request is coming from an AJAX call and process it
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteUser'])) {
        $response = Delete::deleteUser();
    } elseif (isset($_POST['deleteAdmin'])) {
        $response = Delete::deleteAdmin();
    }

    // Send JSON response back to the front end
    echo json_encode($response);
}
?>
