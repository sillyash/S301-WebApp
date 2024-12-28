<?php

class Connexion
{
	static private $hostname = 'localhost';
	static private $database = 'prj-mmorich';
	static private $login = 'prj-mmorich';
	static private $password = 'vZnmFpECUAvJTwCf';

	static private $tabUTF8 = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

	static private $pdo;
	static public function pdo() { return self::$pdo; }

	static public function connect() {
		$h = self::$hostname;
		$d = self::$database;
		$l = self::$login;
		$p = self::$password;
		$t = self::$tabUTF8;

		try {
			self::$pdo = new PDO("mysql:host=$h;dbname=$d",$l,$p,$t);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Erreur de connexion : ".$e.getMessage()."<br>";
		}
	}
}

?>