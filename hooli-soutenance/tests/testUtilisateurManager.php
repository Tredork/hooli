<?php
//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================
include "../controleur/Utilisateur.php";
include "../controleur/UtilisateurManager.php";
include "../controleur/connectionbase.php";

try
   {
		print("<br>Début des test automatiques des fonctions UtilisateurManager");
		print("<br> Creation de l'objet myBdManager...");
			$myBdManager = new UtilisateurManager($bdd);
			
		print("<br>Recupereation de la liste des Utilisateurs...");
			$bdd_users = [];
			$bdd_users = $myBdManager->getList();
			
		print("<br>...nombre d'utilisateurs =" . count($bdd_users) );
		print("<br>...Liste = <br>" );
			for($i=0; $i<count($bdd_users); $i=$i+1) {
				$bdd_users[$i]->affiche();
			}
		
			// Definition des variables utilisées pour les tests
			$ID=$bdd_users[0]->id();
			$passwordOK=$bdd_users[0]->password();
			$mailOK=$bdd_users[0]->mail();
			$pseudoOK= $bdd_users[0]->pseudo();

			$mailKO 	= $mailOK . "bidon";
			$passwordKO = $passwordOK."bidon";
			$pseudoKO   = $pseudoOK. "bidon";

		print("<br>Recuperation du premier utilisateur existant...");	
			$userXX=$myBdManager->get($ID);
			if($userXX != false) {
				$userXX->affiche();
				print ("modification de l'utilisateur XX");
				$userXX->setNom("papa");
				$userXX->affiche();
				try{
					$myBdManager->update($userXX);
				}
				catch(Exception $e)
			    {
			       print('erreur:'.$e->getMessage());
			    }

				print("verification utilisateur XX...<br>");
				$userXX=$myBdManager->get($ID);
				$userXX->affiche();

				// clone de l'utilisateur XX
				print("copy utilisateur XX...<br>");
				$userXX->setPseudo($userXX->pseudo().rand());
				//Création d'un nouvel utilisateur en BDD (nouvel id)
				if ($myBdManager->createNewUser($userXX->pseudo(),$userXX->mail(),$userXX->password()) == false)
				{
					print ("<br>..Erreur creation de l'utilisateur XX");
				}
				else
				{
					print ("<br>..create New User OK");
					//recuperation du nouvel id dans $user_temporaire
					$user_temporaire=$myBdManager->getByPseudo($userXX->pseudo());
					if ( $user_temporaire == false)
					{
						print ("<br>..Erreur de getByPseudo");
					}
					else
					{
						//Mise à jour de l'id dans l'userXX
						print ("<br>..getByPseudo OK");
						$user_temporaire->affiche();
						$userXX->setId($user_temporaire->id());
						$userXX->affiche();
						//Mise à jour de l'ensemble des champs
						if ($myBdManager->update($userXX) == false)
						{
							print ("<br>..Erreur update");	
						}
						else
						{
							print ("<br>..copy effectuée avec succès");
						}
					}	
				}
			} else print ("Utilisateur XX non trouvé");
	 

		print("<br>Dump utilisateurs... pour pouvoir vérifier le clonage<br>");
			$bdd_users = [];
			$bdd_users = $myBdManager->getList();
			print("count=" . count($bdd_users) ."<br>");
			// parcours de la liste des utilisateurs trouvés en base
			for($i=0; $i<count($bdd_users); $i=$i+1) {
				$bdd_users[$i]->affiche();
			}

			print("<br> test de la fonction getListByPseudo<br>");
			$bdd_users = [];
			$bdd_users = $myBdManager->getListByPseudo($pseudoOK);
			if ($bdd_users != false )
			{
				print("count=" . count($bdd_users) ."<br>");
			// parcours de la liste des utilisateurs par pseudo trouvés en base
				for($i=0; $i<count($bdd_users); $i=$i+1) 
				{
					$bdd_users[$i]->affiche();
				}
			}
			else
			{
				print("..Erreur getByPseudo !!!");
			}

		// L'utilisateur de référence est le premier de la base
		print('<br> test fonction getByMail');
			$userXX= $myBdManager->getByMail($mailOK);
			if ($userXX != false)
			{
				print("<br>Utilisateur trouvé : ");
				$userXX->affiche();
				print("<br>");
			}
			else 
			{
				print("Utilisateur non trouvé !!! Probleme <br>");
			}

		
		print('<br> test fonction getByMail avec mail inconnu=' . $mailKO);
			$userXX= $myBdManager->getByMail($mailKO);
			if ($userXX == false)
			{
				print("... OK <br>");
			}
			else 
			{
				print("... KO !!! problème !!! <br>");
			}


		print('<br> test fonction getUserByMailPassword avec mail OK et mot de passe KO');
			$userXX= $myBdManager->getUserByMailPassword($mailOK, $passwordKO);
			if ($userXX == false)
			{
				print("... OK <br>");
			}
			else 
			{
				print("... KO !!! problème !!! <br>");
			}

	  	print('<br> test fonction getUserByMailPassword avec mail KO et mot de passe KO');
			$userXX= $myBdManager->getUserByMailPassword($mailKO, $passwordKO);
			if ($userXX == false)
			{
				print("... OK <br>");
			}
			else 
			{
				print("... KO !!! problème !!! <br>");
			}

		print('<br> test fonction getUserByMailPassword avec mail et mot de passe connus');
			$userXX= $myBdManager->getUserByMailPassword($mailOK, $passwordOK);
			if ($userXX == false)
			{
				print("... KO !!! problème !!! <br>");
				
			}
			else 
			{
				print("... OK <br>");
				$userXX->affiche();
			}

		print("<br> test fonction getByPseudo");
			$userXX= $myBdManager->getByPseudo($pseudoOK);
			if ($userXX != false)
			{
				print("<br>Pseudo trouvé : ");
				$userXX->affiche();
				print("<br>");
			}
			else 
			{
				print("Pseudo non trouvé !!! Probleme <br>");
			}

		
		print('<br>test fonction getByPseudo avec pseudo inconnu=' . $pseudoKO);
			$userXX= $myBdManager->getByPseudo($pseudoKO);
			if ($userXX == false)
			{
				print("... OK <br>");
			}
			else 
			{
				print("... KO !!! problème !!! <br>");
			}


		print('<br> test fonction getUserByPseudoPassword avec pseudo OK et mot de passe KO');
			$userXX= $myBdManager->getUserByPseudoPassword($pseudoOK, $passwordKO);
			if ($userXX == false)
			{
				print("... OK <br>");
			}
			else 
			{
				print("... KO !!! problème !!! <br>");
			}

	  	print('<br>test fonction getUserByPseudoPassword avec pseudo KO et mot de passe KO');
			$userXX= $myBdManager->getUserByPseudoPassword($pseudoKO, $passwordKO);
			if ($userXX == false)
			{
				print("... OK <br>");
			}
			else 
			{
				print("... KO !!! problème !!! <br>");
			}

		print('<br> test fonction getUserByPseudoPassword avec pseudo et mot de passe connus');
			$userXX= $myBdManager->getUserByPseudoPassword($pseudoOK, $passwordOK);
			if ($userXX == false)
			{
				print("... KO !!! problème !!! <br>");
				
			}
			else 
			{
				print("... OK <br>");
				$userXX->affiche();
			}
		print("<br>Fin des tests<br>");

   } catch(Exception $e)
   {
         die('erreur:'.$e->getMessage());
   }


?>