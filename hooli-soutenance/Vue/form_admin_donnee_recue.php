<!-- fonction permettant de déverser tous les capteurs du site dans un tableau afin de les lister -->
<?php

//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================

include "../controleur/Donnee_recue.php";
include "../controleur/Donnee_recueManager.php";
include "../controleur/connectionbase.php";
include "header_back_office.php";



$_debug=false;

?>
<!DOCTYPE html>

<html>
<header>
    <p><p>
</header>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../style/app.css">
   <title>form_admin_capteurs</title>
  </head>

  <body>
<fieldset>
<legend align="center"><h3>Affichage des donnees reçues</h3></legend>
<form method="post" action="">
<input type="submit" name="button_importer" class="btn" value ="importer depuis http://projets-tomcat.isep.fr:8080/">
</form>

<table>
    <!-- Entete du tableau -->
	<tr>
		<td>Date de reception</td><td>Nom</td><td>Valeur</td><td>Unite</td>
	</tr>
    <?php

        // Gestion de l'appui éventuel sur les boutons update, delete, create
        // la gestion des exceptions permet d'afficher l'erreur d'accès à la base

        try {
            if (isset($_POST['button_update']))
            {
                if($_debug)print ("update <br>");
                $donnees = array('id'=>$_POST['id'],'date_recep'=>$_POST['date_recep'],'valeur'=> $_POST['valeur'],'type_capteur'=>$_POST['type_capteur'],);
                $capteur1_donnee_recue = new Donnee_recue($donnees);
                if($_debug)$capteur1_donnee_recue->affiche();

                $myBdManager = new Donnee_recueManager($bdd);


                 try
                {
                    if($myBdManager->update($capteur1_donnee_recue) == false)
                    {
                        print("<div class='NotificationErreur'><br>Erreur champ(s) manquant...</div>");
                    }
                    else
                    {
                        print ("<div class='NotificationSucces'><br>Modification effectuée avec succès</div>");
                    }
                }
                catch(Exception $e)
                {
                    print('erreur:'.$e->getMessage());
                }

            }

            if (isset($_POST['button_importer']))
            {
                $myBdManager = new Donnee_recueManager($bdd);
                $page = file_get_contents( 'http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=9999' );
                for ($p=0;$p<strlen($page);$p=$p+33)
                {
        
                    if($_debug)echo "<br>".$page[$p+0].$page[$p+1].$page[$p+2].$page[$p+3].$page[$p+4].$page[$p+5].$page[$p+6].$page[$p+7].$page[$p+8].$page[$p+9].$page[$p+10].$page[$p+11].$page[$p+12].$page[$p+13].$page[$p+14].$page[$p+15].$page[$p+16].$page[$p+17].$page[$p+18].$page[$p+19].$page[$p+20].$page[$p+21].$page[$p+22].$page[$p+23].$page[$p+24].$page[$p+25].$page[$p+26].$page[$p+27].$page[$p+28].$page[$p+29].$page[$p+30].$page[$p+31].$page[$p+32];
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
            
                        // Verifier que l'objet n'existe pas en BDD
                        $bdd_donnee_recues = [];
                        $bdd_donnee_recues = $myBdManager->getListByTypeNumeroDate($type_capteur,$numero_capteur,$date_recep);
                        if($bdd_donnee_recues == false) 
                        {
                            if($_debug)print("<br>...===================================");
                            if($_debug)print("<br>...Insertion possible car objet inexistant en BDD...");
                            //Insertion des données de la trame dans la base 
                            $donnees = array('id'=>"1",'trame'=>$trame,'objet'=>$objet,'requete'=>$requete,'type_capteur'=>$type_capteur,'numero_capteur'=>$numero_capteur,'valeur'=>$valeur,'tim'=>$tim,'chk'=>$chk,'date_recep'=>$date_recep);
                            $donnee_capteur = new Donnee_recue($donnees);
                            if($_debug)$donnee_capteur->affiche();
                            $myBdManager->create($donnee_capteur);
                            if($_debug)print("<br>objet cree... <br>");
                            if($_debug)print("<br>...===================================");

                        } 
                        else {
                            if($_debug)print("<br>...Objet deja existant pas d'insertion en BDD ");
                              
                        } 
                    }         
                }   
                print("<font color=red><b><big>Donnee à jour!!!</big></b></font>"); 
            }


            

            if($_debug)print("Bonjour <br>");
            $myBdManager = new Donnee_recueManager($bdd);
            if($_debug)print("myBdManager créé... <br>");

            $bdd_recue = [];
            $bdd_recue = $myBdManager->getDateNomValeurUnite();
        }
        catch(Exception $e)
        {
            die('erreur:'.$e->getMessage());
        }
        if($_debug)print("count=" . count($bdd_recue) ."<br>");
        // parcours de la liste des capteurs trouvés en base
        for($i=0; $i<count($bdd_recue); $i=$i+1)
        {
            ?>
            <!-- Un attribut par case du tableau -->
            <tr>

                <form method="post" action="">
                    <td> <input type="text" name="date_recep" placeholder="date" value="<?php echo $bdd_recue[$i][date_recep]; ?>" readonly /> </td>
                    <td> <input type="text" name="nom" placeholder="nom" value="<?php echo $bdd_recue[$i][nom]; ?>" readonly /> </td>
                    <td> <input type="text" name="valeur" placeholder="valeur" value="<?php echo $bdd_recue[$i][valeur]; ?>" readonly/></td>
                    <td> <input type="text" name="unite" placeholder="inconnue" value="<?php echo $bdd_recue[$i][unite]; ?>" readonly/> </td>      
                </form>
            </tr>
            <?php
        }
    ?>

</table>
</p>
</fieldset>



    <fieldset>
    <legend align="center"><h3>Liste des valeurs par capteurs</h3></legend>
        <table>
            <tr>
                <form method="post" action="">
                    <td> <input type="text" name="nom" placeholder="Nom du capteur" value=""/> </td>
                    <td> <input type="submit" name="button_refresh" class="btn" value ="Raffraichir"> </td>
                </form>
            </tr>

        </table>
        <table>
    <tr>
        <td>Date de reception</td><td>Nom</td><td>Valeur</td><td>Unite</td>
    </tr>


    <?php
        try
        {
            $myIdCapteur= $_POST['nom'];
            $bdd_recue = [];
            if (isset($_POST['button_refresh']))
            {
                if($_debug)print ("refresh <br>");
                $myBdManager = new Donnee_recueManager($bdd);
                if($_debug)print("myBdManager créé... <br>");
                if($myIdCapteur!="") 
                {
                    $bdd_recue = $myBdManager->getDateNomValeurUniteListbyNom($myIdCapteur);
                }
            }
        }
        catch(Exception $e)
        {
            if($_debug)die('erreur:'.$e->getMessage());
        }
        if($_debug)print("count=" . count($bdd_recue) ."<br>");
        // parcours de la liste des capteurs trouvés en base
        for($i=0; $i<count($bdd_recue); $i=$i+1)
        {
    ?>

            <tr>
                <form method="post" action="">
                    <td> <input type="text" name="date_recep" placeholder="date" value="<?php echo $bdd_recue[$i][date_recep]; ?>" readonly /> </td>
                    <td> <input type="text" name="nom" placeholder="nom" value="<?php echo $bdd_recue[$i][nom]; ?>" readonly /> </td>
                    <td> <input type="text" name="valeur" placeholder="valeur" value="<?php echo $bdd_recue[$i][valeur]; ?>" readonly/></td>
                    <td> <input type="text" name="unite" placeholder="inconnue" value="<?php echo $bdd_recue[$i][unite]; ?>" readonly/> </td>
                </form>
            </tr>
        
    <?php
        }
    ?>
    </table>
    </fieldset>
</body>
</html>
