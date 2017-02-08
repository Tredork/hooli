<?php
//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================
$dbname ="hooli";
$host = "localhost";
$user='root';
$pass='root';
$bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$bdd->query("SET NAMES UTF8");
$page = file_get_contents( 'http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=0000' );
echo $page;

$trame = 1;
$objet = 0003;
$requete = 1;
$type_capteur = 3;
$numero_capteur = 11;
$valeur = 0101;
$tim = 0000;
$chk = 00;
$annee = 1996;
$mois = 11;
$jour = 20;
$heure = 21;
$min = 22;
$sec = 31;
$date_recep = ''.$annee.'-'.$mois.'-'.$jour.' '.$heure.':'.$min.':'.$sec.'';

	$req=$bdd->prepare("INSERT INTO  donnee_recue(trame,objet,requete,type_capteur,numero_capteur,valeur,tim,chk,annee,mois,jour,min,sec,date_recep) values (,:trame,:objet,:requete,:type_capteur,:numero_capteur,:valeur,:tim,:chk,:annee,:mois,:jour,:min,:sec,:date_recep)");
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
			print("<br>type de trame=" .$trame. " val objet=" .$objet." requete=" .$requete. " type de capteurs=".$type_capteur. " numero du capteur=" .$numero_capteur. " valeur capteur=" .$valeur. " TIM=".$tim. " chk=".$chk." date_recep=" .$date_recep. "\n")



?>