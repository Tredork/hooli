<?php
//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================
include "../controleur/Capteur.php";
print("<br><br>T E S T Capteur <br>");

$donnees = array('id'=>"100",'type'=>"Pression",'nom'=>"Pression_atmospherique");
$capteur1 = new Capteur($donnees);

print("Capteur créé ! <br>");
$capteur1->affiche();

print("Vérification du Capteur créé ... <br>");

if ($capteur1->id() != "100") print("   Erreur sur l'id... <br>");
else print("   ...id OK !<br>");

if ($capteur1->type() != "Pression") print("   Erreur sur le type... <br>");
else print("   ...type OK !<br>");

if ($capteur1->nom() != "Pression_atmospherique") print("   Erreur sur le nom... <br>");
else print("   ...nom OK !<br>");

print("<br>Fin test de l'objet capteur");


?>