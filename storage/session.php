<?php

if (!isset($_SESSION)) { 
    session_start(); 
}

if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 60*60) {
    session_destroy();
    $_SESSION['CREATED'] = time();
}

function getSessionData() {
    if (!isset($_SESSION)) { 
        session_start(); 
    }

    if (isset($_SESSION["sessionData"])) {
        return $_SESSION["sessionData"];
    }

    return null;
}


function setSessionData($sessionData) {
    if (!isset($_SESSION)) { 
        session_start(); 
    }
    $_SESSION["sessionData"] = $sessionData;
}

?>