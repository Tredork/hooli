<?php
$somme = 0;
$fichiers = array('testCapteur.php',
		'testCapteurManager.php',
		'testDonne_recueManager.php',
		'testDonnee_recue.php',
		'testUtilisateur.php',
		'testUtilisateurManager.php',
		'../controleur/Capteur.php',
		'../controleur/CapteurManager.php',
		'../controleur/Donnee_recue.php',
		'../controleur/Donnee_recueManager.php',
		'../controleur/Utilisateur.php',
		'../controleur/UtilisateurManager.php',
		'../controleur/connectionbase.php',
		'../vue/form_admin_capteurs.php',
		'../vue/form_admin_donnee_recue.php',
		'../vue/form_admin_utilisateurs.php',
		'../vue/mon_profil.php',
		'../vue/App.css'

	);

for ($i=0; $i<count($fichiers);$i++)
{
	$contenu_fichier = file_get_contents($fichiers[$i]);
	$nbligne = substr_count($contenu_fichier, "\n") ;
	$somme = $somme+ $nbligne;

	print("<br>fichier =" .$fichiers[$i]. " lignes =" .$nbligne. " total =".$somme. " lignes de code");
}



?>