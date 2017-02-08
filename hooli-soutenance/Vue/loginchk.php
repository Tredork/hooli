<?php
session_start();
//ob_start()；


$_SESSION['mail']=$_POST['mail'];
$_SESSION['password']=$_POST['password'];


try

{

$bdd = new PDO('mysql:host=localhost;dbname=hooli;charset=utf8', 'root', 'root');

}



catch (Exception $e)

{

                die('erreur : '.$e->getMessage());

}





$reponse = $bdd->query('SELECT*FROM utilisateur WHERE mail = "'.$_SESSION['mail'].'" ');

$donnees = $reponse->fetch();



if ($donnees == 0)
    {
         echo "<script>alert('VOULEZ VOUS REESSAYER?'); history.back();</script>";
         exit();

    }
elseif (md5($_SESSION['password'])==$donnees['password'])
    {
        if ($donnees['typecompte']=='admin')
        {
            header('Location: form_admin_utilisateurs.php');
            // include("form_admin_utilisateurs.php");
        }

        elseif ($donnees['typecompte']=='membre' )
        {
          header('Location: mon_profil.php');
          //  include("mon_profil.php");

        }
    }
else
    {
       echo "<script>alert('MOT DE PASSE UNCORRECT'); history.back();</script>";
    }



?>
