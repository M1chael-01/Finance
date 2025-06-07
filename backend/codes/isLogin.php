<?php
class IsLogin {
    public static function isLogin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["jmeno"]) && isset($_SESSION["log"])) {
            return true; // User is logged in
        } else {
            return false; // User is not logged in
        }
    }
}
