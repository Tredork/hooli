<?php
//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================

include "../controleur/Donnee_recue.php";
include "../controleur/Donnee_recueManager.php";
include "../controleur/connectionbase.php";


try
   {	
   		print("<br><br>T E S T Donnee_recueManager");
		print("<br>Début des test automatiques des fonctions Donnee_recueManager");
		print("<br> Creation de l'objet myBdManager...");
		$myBdManager = new Donnee_recueManager($bdd);

		print("<br>Recupereation de la liste des Donnee_recues...");
			$bdd_donnee_recues = [];
			$bdd_donnee_recues = $myBdManager->getList();
		if($bdd_donnee_recues != false) 
		{

		print("<br>...nombre de donnee_recues =" . count($bdd_donnee_recues) );
		print("<br>...Liste = <br>" );
			for($i=0; $i<count($bdd_donnee_recues); $i=$i+1) {
				$bdd_donnee_recues[$i]->affiche();
			}
			// Definition des variables utilisées pour les tests
		$ID=$bdd_donnee_recues[0]->id();
		print("<br>Recuperation du premier donnee_recue existant...");	
			$donnee_recueXX=$myBdManager->get($ID);

			if($donnee_recueXX != false) 
			{
				$donnee_recueXX->affiche();
				$donnee_recueXX->setTrame("1");
				$donnee_recueXX->setObjet("2");
				$donnee_recueXX->setRequete("1");
				$donnee_recueXX->setType_capteur("1");
				$donnee_recueXX->setNumero_capteur("3");
				$donnee_recueXX->setValeur("123");
				$donnee_recueXX->setTim("0000");
				$donnee_recueXX->setChk("00");
				$donnee_recueXX->setDate_recep("1996-02-05 18:02:08");
				
				print ("modification du nom du donnee_recue XX");
				$donnee_recueXX->affiche();
				try{
					$myBdManager->update($donnee_recueXX);
					if($_debug)print ("update <br>");
				}
				catch(Exception $e)
			    {
			       print('erreur:'.$e->getMessage());
			    }

				print("verification donnee_recue XX...<br>");
				$donnee_recueXX=$myBdManager->get($ID);
				if ($donnee_recueXX->trame() != "1")
				{
					print("<br><li>erreur de modification trame");
				}
				else
				{
					print("<br><li>modification trame OK");
				}

				if ($donnee_recueXX->objet() != "2")
				{
					print("<br><li>erreur de modification objet");
				}
				else
				{
					print("<br><li>modification objet OK");
				}

				if ($donnee_recueXX->requete() != "1")
				{
					print("<br><li>erreur de modification requete");
				}
				else
				{
					print("<br><li>modification requete OK");
				}

				if ($donnee_recueXX->type_capteur() != "1")
				{
					print("<br><li>erreur de modification type capteur");
				}
				else
				{
					print("<br><li>modification type capteur OK");
				}

				if ($donnee_recueXX->numero_capteur() != "3")
				{
					print("<br><li>erreur de modification numero_capteur");
				}
				else
				{
					print("<br><li>modification numero_capteur OK");
				}
				if ($donnee_recueXX->valeur() != "123")
				{
					print("<br><li>erreur de modification valeur");
				}
				else
				{
					print("<br><li>modification valeur OK");
				}
				if ($donnee_recueXX->tim() != "0000")
				{
					print("<br><li>erreur de modification tim");
				}
				else
				{
					print("<br><li>modification tim OK");
				}
				if ($donnee_recueXX->chk() != "00")
				{
					print("<br><li>erreur de modification chk");
				}
				else
				{
					print("<br><li>modification chk OK");
				}

				if ($donnee_recueXX->date_recep() != "1996-02-05 18:02:08")
				{
					print("<br><li>erreur de modification du date_recep");
				}
				else
				{
					print("<br><li>modification date_recep OK");
				}


				$donnee_recueXX->affiche();
				
				try{
					$myBdManager->update($donnee_recueXX);
				}
				catch(Exception $e)
			    {
			       print('erreur:'.$e->getMessage());
			    }
			}
			else
			{
				print("<br>erreur get");
			}
		print("<br> getListByCapteur");
		print("<br>Recuperation de la liste des Donnee_recues du capteur 2...");
			$bdd_donnee_recues = [];
			$bdd_donnee_recues = $myBdManager->getListByCapteur("3");
			if($bdd_donnee_recues != false) 
			{

			print("<br>...nombre de donnee_recues =" . count($bdd_donnee_recues) );
			print("<br>...Liste = <br>" );
				for($i=0; $i<count($bdd_donnee_recues); $i=$i+1) {
					$bdd_donnee_recues[$i]->affiche();
				}
			}

		print("<br> getListByTypeNumeroDate");
		print("<br>Recuperation de la liste des Donnee_recues du capteur type 2 Numero 3 date XXXX...");
			$bdd_donnee_recues = [];
			$bdd_donnee_recues = $myBdManager->getListByTypeNumeroDate("4","1","2017-01-12 12:34:56");
			if($bdd_donnee_recues != false) 
			{
				print("<br>...nombre de donnee_recues =" . count($bdd_donnee_recues) );
				print("<br>...Liste = <br>" );
					for($i=0; $i<count($bdd_donnee_recues); $i=$i+1) {
						$bdd_donnee_recues[$i]->affiche();
					}
			} else {
				print("<br>...Donne pas en base ");

			}



		
		print("<br> getDateNomValeurUnite");
		print("<br>Recuperation de la liste...");
			$bdd_donnee_recues = [];
			$bdd_donnee_recues = $myBdManager->getDateNomValeurUnite();
			if($bdd_donnee_recues != false) 
			{
				print("<br>...nombre de donnee_recues =" . count($bdd_donnee_recues) );
				print("<br>...Liste = <br>" );
					for($i=0; $i<count($bdd_donnee_recues); $i=$i+1) {
						print("<br>date=" .$bdd_donnee_recues[$i][date_recep] ." Nomcapteur=".$bdd_donnee_recues[$i][nom] ." Valeur=".$bdd_donnee_recues[$i][valeur] ." Unite=".$bdd_donnee_recues[$i][unite]);
					}
			} else {
				print("<br>...Donnee pas en base ");

			}


		print("<br> Fin des tests");
		}
	
    }catch(Exception $e)
   {
         die('erreur:'.$e->getMessage());
   }

?>