<?php
//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================
include "../controleur/Donnee_recue.php";
print("Bonjour <br>");

$donnees = array('id'=>"100",'trame'=>"1",'objet'=>"2",'requete'=>"1",'type_capteur'=>"1",'numero_capteur'=>"3",'valeur'=>"123",'tim'=>"0000",'chk'=>"00",'date_recep'=>"1996-02-05 18:02:08");
$donnee_capteur1 = new Donnee_recue($donnees);

print("Objet créé ! <br>");
$donnee_capteur1->affiche();

print("Vérification de l'objet créé ... <br>");

if ($donnee_capteur1->id() != "100") print("   Erreur sur l'id... <br>");
else print("<li>id OK !<br>");

if ($donnee_capteur1->trame() != "1") print("   Erreur sur la trame... <br>");
else print("<li>id trame OK !<br>");

if ($donnee_capteur1->objet() != "2") print("   Erreur sur objet ... <br>");
else print("<li>objet OK !<br>");

if ($donnee_capteur1->requete() != "1") print("   Erreur sur requete... <br>");
else print("<li>requete OK !<br>");

if ($donnee_capteur1->type_capteur() != "1") print("   Erreur sur le type... <br>");
else print("<li>type OK !<br>");

if ($donnee_capteur1->numero_capteur() != "3") print("   Erreur sur numero capteur ... <br>");
else print("<li>numero capteur OK !<br>");

if ($donnee_capteur1->valeur() != "123") print("   Erreur sur la valeur... <br>");
else print("<li>valeur OK !<br>");

if ($donnee_capteur1->tim() != "0000") print("   Erreur sur tim ... <br>");
else print("<li>tim OK !<br>");

if ($donnee_capteur1->chk() != "00") print("   Erreur sur chk... <br>");
else print("<li>chk OK !<br>");

if ($donnee_capteur1->date_recep() != "1996-02-05 18:02:08") print("   Erreur sur la reception date... <br>");
else print("<li>reception date OK !<br>");






print("<br>Fin test de l'objet");


?>