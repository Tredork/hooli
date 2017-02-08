<?php
//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================
include "../controleur/Utilisateur.php";
print("<br><br>T E S T Utilisateur <br>");

$donnees = array('id'=>"100",'pseudo'=>"Baroudeur48",'nom'=>"Puch", 'prenom'=>"alexis", 'date_naissance'=>"02/05/1996" ,'rue'=>"Friant", 'numero_rue'=>"24", 'ville'=>"Paris", 'code_postal'=>"75014", 'telephone'=>"0620141961", 'mail'=>"abaroudeur48@gmail.com", 'password'=> "Root");
$user1 = new Utilisateur($donnees);

print("Utilisateur créé ! <br>");
$user1->affiche();

print("Vérification de l'Utilisateur créé ... <br>");

if ($user1->id() != "100") print("   Erreur sur l'id... <br>");
else print("   ...id OK !<br>");

if ($user1->pseudo() != "Baroudeur48") print("   Erreur sur le pseudo... <br>");
else print("   ...pseudo OK !<br>");

if ($user1->nom() != "Puch") print("   Erreur sur le nom... <br>");
else print("   ...nom OK !<br>");

if ($user1->prenom() != "alexis") print("   Erreur sur le prenom... <br>");
else print("   ...prenom OK !<br>");

if ($user1->date_naissance() != "02/05/1996") print("   Erreur sur la date de naissance... <br>");
else print("   ...date naissance OK !<br>");

if ($user1->rue() != "Friant") print("   Erreur sur la rue... <br>");
else print("   ...rue OK !<br>");

if ($user1->numero_rue() != "24") print("   Erreur sur le numero de rue... <br>");
else print("   ...numero rue OK !<br>");

if ($user1->ville() != "Paris") print("   Erreur sur la ville... <br>");
else print("   ...ville OK !<br>");

if ($user1->code_postal() != "75014") print("   Erreur sur le code postal... <br>");
else print("   ...code postal OK !<br>");

if ($user1->telephone() != "0620141961") print("   Erreur sur la num de tel... <br>");
else print("   ...tel OK !<br>");

if ($user1->mail() != "abaroudeur48@gmail.com") print("   Erreur sur le mail... <br>");
else print("   ...mail OK !<br>");

if ($user1->password() != "Root") print("   Erreur sur le password... <br>");
else print("   ...password OK !<br>");

print("<br> Fin des tests");

?>