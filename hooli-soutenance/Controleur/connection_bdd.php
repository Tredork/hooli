<?php

$dbname ="hooli";
$host = "localhost";
$user='root';
$pass='root';
$bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$bdd->query("SET NAMES UTF8");
?>
