<?php
	$dbname= "hooli";
	$host= "localhost";
	$user= "root";
	$pass= "root";

   try
   {
   	$bdd =new PDO("mysql:host=$host; dbname=$dbname","$user","$pass");
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(Exception $e)
   {
         die('erreur:'.$e->getMessage());
   }

?>