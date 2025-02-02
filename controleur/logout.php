<?php
$_SESSION = [];
session_destroy();
$_SESSION["logged"] = false;
header("Location: login.php");
exit;
?>