<?php
    session_start();
    $_SESSION = array();
    header('Location: /account/login.php', true, 302);
    exit();
?>