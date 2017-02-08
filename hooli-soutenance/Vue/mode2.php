<?php
    session_start();
	ini_set('display_errors',1);
	try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=hooli;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }


	$req = $bdd->prepare('SELECT * FROM pieces WHERE id_utilisateurs = ?');
	$req->execute(array($_SESSION['id']));
    $pieces=$req->fetch();



    $nom=$_POST['nom'];
    $temp=$_POST['temperature'];
    $lum=$_POST['lumiere'];

        if($lum='on')
    {
        $lumiere=1;
    }
    else
    {
        $lumiere=0;
    }

    $o=0;


    $req2 = $bdd->prepare('INSERT INTO modes (id_utilisateurs, nom, id_piece_1, id_piece_2, id_piece_3, id_piece_4, id_piece_5, temperature, lumiere) VALUES ( :id_utilisateurs, :nom, :id_piece_1, :id_piece_2, :id_piece_3, :id_piece_4, :id_piece_5, :temperature, :lumiere)');
    $req2->bindParam(':id_utilisateurs',$_SESSION['id']);
    $req2->bindParam(':nom',$nom);
    $req2->bindParam(':id_piece_1',$o);
    $req2->bindParam(':id_piece_2',$o);
    $req2->bindParam(':id_piece_3',$o);
    $req2->bindParam(':id_piece_4',$o);
    $req2->bindParam(':id_piece_5',$o);
    $req2->bindParam(':lumiere',$lum);
    $req2->bindParam(':temperature',$temp);

    $req2->execute();
    header('Location: mode1.php');
?>
