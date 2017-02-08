<?php
   try
   {
      require("connectionbase.php");
   }
   catch(Exception $e)
   {
         die('erreur:'.$e->getMessage());
   }

     $login = htmlspecialchars($_POST['login']);
     $password = sha1($_POST['password']);

     $sql= "SELECT * FROM donnee_recue"
   ?>
