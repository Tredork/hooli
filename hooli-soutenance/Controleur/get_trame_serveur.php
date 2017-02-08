<?php



require ('connection_bdd.php');

//récupération des données
$page = file_get_contents( 'http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=9999' );
echo $page;

	for ($p=0;$p<strlen($page);$p=$p+33)
	{

		echo "<br>".$page[$p+0].$page[$p+1].$page[$p+2].$page[$p+3].$page[$p+4].$page[$p+5].$page[$p+6].$page[$p+7].$page[$p+8].$page[$p+9].$page[$p+10].$page[$p+11].$page[$p+12].$page[$p+13].$page[$p+14].$page[$p+15].$page[$p+16].$page[$p+17].$page[$p+18].$page[$p+19].$page[$p+20].$page[$p+21].$page[$p+22].$page[$p+23].$page[$p+24].$page[$p+25].$page[$p+26].$page[$p+27].$page[$p+28].$page[$p+29].$page[$p+30].$page[$p+31].$page[$p+32];
		// Seul le type de trame 1 a été traité comme demandé
		if ($page[$p]==1)
		{
			//Decomposition de la trame
			$trame = $page[$p+0];
			$objet = $page[$p+1].$page[$p+2].$page[$p+3].$page[$p+4];
			$requete = $page[$p+5];
			$type_capteur = $page[$p+6];
			$numero_capteur = $page[$p+7].$page[$p+8];
			$valeur = $page[$p+9].$page[$p+10].$page[$p+11].$page[$p+12];
			$tim = $page[$p+13].$page[$p+14].$page[$p+15].$page[$p+16];
			$chk = $page[$p+17].$page[$p+18];
			$annee = $page[$p+19].$page[$p+20].$page[$p+21].$page[$p+22];
			$mois = $page[$p+23].$page[$p+24];
			$jour = $page[$p+25].$page[$p+26];
			$heure = $page[$p+27].$page[$p+28];
			$min = $page[$p+29].$page[$p+30];
			$sec = $page[$p+31].$page[$p+32];
			//format du DATETIME
			$date_recep = ''.$annee.'-'.$mois.'-'.$jour.' '.$heure.':'.$min.':'.$sec.'';

			//Insertion des données de la trame dans la base
			$req=$bdd->prepare("INSERT INTO  donnee_recue(trame,objet,requete,type_capteur,numero_capteur,valeur,tim,chk,date_recep) values (:trame,:objet,:requete,:type_capteur,:numero_capteur,:valeur,:tim,:chk,:date_recep)");
			$req->bindParam(':trame',$trame);
			$req->bindParam(':objet',$objet);
			$req->bindParam(':requete',$requete);
			$req->bindParam(':type_capteur',$type_capteur);
			$req->bindParam(':numero_capteur',$numero_capteur);
			$req->bindParam(':valeur',$valeur);
			$req->bindParam(':tim',$tim);
			$req->bindParam(':chk',$chk);
			$req->bindParam(':date_recep',$date_recep);
			$req->execute();
			echo "Opération effectuée";

			print("<br>type de trame=" .$trame. " val objet=" .$objet." requete=" .$requete. " type de capteurs=".$type_capteur. " numero du capteur=" .$numero_capteur. " valeur capteur=" .$valeur. " TIM=".$tim. " chk=".$chk." date_recep=" .$date_recep. "\n");
		}

	}

?>
