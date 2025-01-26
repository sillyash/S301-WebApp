<?php
define("WORKDIR", __DIR__);
require_once(WORKDIR . '/config/params.php');
session_start();

include_once(VUE . "/debut.html");

echo "<h1 class='text-white text-xl'>Hello, user !</h1>";

echo "<h2 class='text-white text-lg'>Configuration</h1>";
echo "<ul class='text-white'>";
echo "<li>Workdir : " . WORKDIR . "</li>";
echo "<li>Config : " .  CONFIG . "</li>";
echo "<li>Vue : " .     VUE . "</li>";
echo "<li>Modele : " .  MODELE . "</li>";
echo "<li>Controleur : ".CONTROLEUR . "</li>";
echo "<li>CSS : " .     CSS . "</li>";
echo "<li>Assets : " .  ASSETS . "</li>";
echo "</ul>";

echo "<h2 class='text-white text-lg'>Session</h1>";
echo "<ul class='text-white'>";
echo "<li>Session ID : " . session_id() . "</li>";
foreach ($_SESSION as $key => $value) {
    echo "<li>$key : $value</li>";
}
echo "</ul>";

include_once(VUE . "/fin.html");

?>
