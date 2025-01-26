<?php

define("WORKDIR", __DIR__);
require_once(WORKDIR . '/config/params.php');

include_once(VUE . "/debut.html");

echo "<ul>";
echo "<li>Workdir : " . WORKDIR . "</li>";
echo "<li>Config : " .  CONFIG . "</li>";
echo "<li>Vue : " .     VUE . "</li>";
echo "<li>Modele : " .  MODELE . "</li>";
echo "<li>Controleur : ".CONTROLEUR . "</li>";
echo "<li>CSS : " .     CSS . "</li>";
echo "<li>Assets : " .  ASSETS . "</li>";
echo "</ul>";

include_once(VUE . "/fin.html");

?>
