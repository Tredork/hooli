<?php
//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================
include "../controleur/Capteur.php";
include "../controleur/CapteurManager.php";
include "../controleur/connectionbase.php";


try
   {
		print("<br>Début des test automatiques des fonctions CapteurManager");
		print("<br> Creation de l'objet myBdManager...");
			$myBdManager = new CapteurManager($bdd);
			
		print("<br>Recupereation de la liste des Capteurs...");
			$bdd_capteurs = [];
			$bdd_capteurs = $myBdManager->getList();
		if($bdd_capteurs != false) 
		{
	
		print("<br>...nombre de capteurs =" . count($bdd_capteurs) );
		print("<br>...Liste = <br>" );
			for($i=0; $i<count($bdd_capteurs); $i=$i+1) {
				$bdd_capteurs[$i]->affiche();
			}
			// Definition des variables utilisées pour les tests
			$ID=$bdd_capteurs[0]->id();
			$typeOK=$bdd_capteurs[0]->type();
			$nomOK=$bdd_capteurs[0]->nom();

			$nomKO 	= $nomOK . "bidon";
			$typeKO = $typeOK . "bidon";

		print("<br>Recuperation du premier capteur existant...");	
			$capteurXX=$myBdManager->get($ID);
			if($capteurXX != false) {
				$capteurXX->affiche();
				print ("modification du nom du capteur XX");
				$capteurXX->setNom("papa");
				$capteurXX->affiche();
				try{
					$myBdManager->update($capteurXX);
				}
				catch(Exception $e)
			    {
			       print('erreur:'.$e->getMessage());
			    }

				print("verification capteur XX...<br>");
				$capteurXX=$myBdManager->get($ID);
				if ($capteurXX->nom() != "papa")
				{
					print("<br>...erreur de modification du nom");
				}
				else
				{
					print("<br>...modification du nom OK");
				}
				$capteurXX->affiche();
				print ("modification du type du capteur XX");
				$capteurXX->setType("Temperature");
				$capteurXX->affiche();
				try{
					$myBdManager->update($capteurXX);
				}
				catch(Exception $e)
			    {
			       print('erreur:'.$e->getMessage());
			    }

				print("verification du type du capteur XX...<br>");
				$capteurXX=$myBdManager->get($ID);
				if ($capteurXX->type() != "Temperature")
				{
					print("<br>...erreur de modification du type");
				}
				else
				{
					print("<br>...modification du type OK");
				}

				// clone du capteur XX
				print("copy capteur XX...<br>");
				$capteurXX->setNom($capteurXX->nom().rand());
				$myBdManager->create($capteurXX);
				$capteurXX->affiche();
			} else print ("CapteurXX non trouvé");
		} else print ("Liste de Capteurs XX non trouvé");
	 

		print("<br>Dump capteurs... pour pouvoir vérifier le clonage<br>");
			$bdd_capteurs = [];
			$bdd_capteurs = $myBdManager->getList();
			print("count=" . count($bdd_capteurs) ."<br>");
			// parcours de la liste des capteurs trouvés en base
			for($i=0; $i<count($bdd_capteurs); $i=$i+1) {
				$bdd_capteurs[$i]->affiche();
			}

		// L'capteur de référence est le premier de la base
		print('<br> test fonction getByNom');
			$capteurXX= $myBdManager->getByNom($nomOK);
			if ($capteurXX != false)
			{
				print("<br>Capteur trouvé : ");
				$capteurXX->affiche();
				print("<br>");
			}
			else 
			{
				print("Capteur non trouvé !!! Probleme <br>");
			}

		
		print('<br> test fonction getByNom avec nom inconnu=' . $nomKO);
			$capteurXX= $myBdManager->getByNom($nomKO);
			if ($capteurXX == false)
			{
				print("... OK <br>");
			}
			else 
			{
				print("... KO !!! problème !!! <br>");
			}

		print("<br> test de la fonction getListByType<br>");
			$bdd_capteurs = [];
			$bdd_capteurs = $myBdManager->getListByType($typeOK);
			if ($bdd_capteurs != false )
			{
				print("count=" . count($bdd_capteurs) ."<br>");
			// parcours de la liste des capteurs par type trouvés en base
				for($i=0; $i<count($bdd_capteurs); $i=$i+1) 
				{
					$bdd_capteurs[$i]->affiche();
				}
			}
			else
			{
				print("..Erreur getByType !!!");
			}
			
			
		print("<br> test de la fonction getListByType avec type bidon<br>");
			$bdd_capteurs = [];
			$bdd_capteurs = $myBdManager->getListByType($typeKO);
			if ($bdd_capteurs != false )
			{
				print("...Probleme !");	
			}
			else
			{
				print("...test OK ");
			}		
		print("<br> Fin des tests");
   } catch(Exception $e)
   {
         die('erreur:'.$e->getMessage());
   }

?>