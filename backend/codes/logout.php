<?php

function logout() {
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }


    unset($_SESSION["jmeno"]);
    unset($_SESSION["log"]);

 
    session_destroy();

    // Optionally, regenerate session ID to prevent session fixation
    session_regenerate_id(true);

}

if(isset($_POST["logout"])) {
    logout();
}