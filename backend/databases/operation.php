<?php
function operation(){
    $db_host = "127.0.0.1"; 
    $db_user = "root"; 
    $db_password = "";
    $db_name = "finance_transakce";
    $connection = mysqli_connect($db_host , $db_user , $db_password , $db_name);
    if(mysqli_connect_error()){
        $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off" ? "https" : "http";
        $url = "{$protocol}://{$_SERVER['HTTP_HOST']}/finance/error/error";
        header("Location: $url");
        exit;
    }
    return $connection;
}