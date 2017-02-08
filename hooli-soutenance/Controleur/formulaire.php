<?php
   try
   {
      require("connexion.php");
   }
   catch(Exception $e)
   {
         die('erreur:'.$e->getMessage());
   }
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $password = sha1($_POST['password']);
   $req=$bdd->prepare('INSERT INTO utilisateur(pseudo,mail,password) VALUES (?, ?, ?)');
   
   $req->execute(array($pseudo, $mail, $password));
   echo 'les infos sont bien stockés !';
   $req->CloseCursor();
   ?>