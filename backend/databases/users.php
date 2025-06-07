<?php
if (!function_exists('users')) {
    function users(){
        $db_host = "127.0.0.1"; // localhost
        $db_user = "root"; 
        $db_password = "";
        $db_name = "finance_uzivatele";
        $connection = mysqli_connect($db_host , $db_user , $db_password , $db_name);
        if(mysqli_connect_error()){
            $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off" ? "https" : "http";
            // Construct the URL for the error page
            $url = "{$protocol}://{$_SERVER['HTTP_HOST']}/Web/error/error";
            // Redirect to the error page
            header("Location: $url");
            exit;
        }
        return $connection;
    }
}
?>
