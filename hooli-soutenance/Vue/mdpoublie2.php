<?php
include "../controleur/SecuriteBDD.php";
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=hooli;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

$mail = $_POST['mail'];
$req = $bdd->prepare('SELECT id FROM utilisateur WHERE mail = ?');
$req->execute(array($mail));
$donnees = $req->fetch();
$i = $donnees['id'];
$mdp = 0;
if(isset($i))
{
	//création mot de passe aléatoire
	$characts    = 'abcdefghijklmnopqrstuvwxyz';
	$characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$characts   .= '1234567890';
	$code_aleatoire = '';
	for($k=0;$k < 10;$k++)    //10 est le nombre de caractères
	{
		$code_aleatoire .= substr($characts,rand()%(strlen($characts)),1);
	}
	//envoi du mail
	$objet = "Réinitialisation du mot de passe";
	$message = "Bonjour, /n Suite à votre demande, votre mot de passe a été réinitialisé. Votre nouveau mot de passe provisoire est $code_aleatoire. /n Merci de changer ce mot de passe dès votre prochaine connexion. /n Cordialement, /n L'équipe Hooli.";
	mail($mail, $objet, $message);
	//enregistrement du nouveau mot de passe dans la base de données
	$code_aleatoire = md5($code_aleatoire);
	$req2 = $bdd->prepare('UPDATE utilisateur SET password = ? WHERE id = ?');
	$req2->execute(array($code_aleatoire, $i));
}
else
{
	echo "Votre mail n'est pas enregistré";
}
?>
