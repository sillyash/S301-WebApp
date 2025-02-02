<?php
$_SESSION = [];
session_destroy();
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}
header("Location: login.php");
exit;
?>