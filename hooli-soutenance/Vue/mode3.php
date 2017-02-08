<?php
    session_start();
	try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=hooli;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $mode=$_POST['mode'];

    $req = $bdd->prepare('SELECT * FROM modes WHERE nom = ?');
    $req->execute(array($mode));

    $donnees = $req->fetch();

    $req2=$bdd->prepare('UPDATE actionneurs SET valeur_voulue = ? WHERE type = temperature AND id_pieces = ?');
    $req2->execute(array($donnees['temperature'], $donnees['id_piece_1']));
    header('Location: mode1.php');
?>
