<!-- fonction permettant de déverser tous les capteurs du site dans un tableau afin de les lister -->
<?php
//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================
include "../controleur/Capteur.php";
include "../controleur/CapteurManager.php";
include "../controleur/connectionbase.php";
include "header_back_office.php";
//echo $header ;
//echo $footer ;
    $_debug=false;
?>
<!DOCTYPE html>

<html>
<header>
  <p> </p>
</header>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../style/app.css">
   <title>form_admin_capteurs</title>
  </head>

  <body>
<fieldset>
<legend align="center"><h3>Affichage de la table des capteurs</h3></legend>

<table>
    <!-- Entete du tableau -->
	<tr>
		<td></td><td>numero</td><td>type</td><td>nom</td><td>unite</td>
	</tr>

    <?php
        // Gestion de l'appui éventuel sur les boutons update, delete, create
        // la gestion des exceptions permet d'afficher l'erreur d'accès à la base
        try {
            if (isset($_POST['button_update']))
            {
                if($_debug)print ("update <br>");
                $donnees = array('id'=>$_POST['id'],'type'=>$_POST['type'],'nom'=> $_POST['nom'],'numero'=> $_POST['numero'],'unite'=>$_POST['unite']);
                $capteur1 = new Capteur($donnees);
                if($_debug)$capteur1->affiche();
                $myBdManager = new CapteurManager($bdd);
                try
                {
                    if($myBdManager->update($capteur1) == false)
                    {
                        print("<div class='NotificationErreur'><br>Contrainte d'intégrité non respectée...</div>");
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
            if (isset($_POST['button_delete']))
            {
                if($_debug)print ("delete <br>");
                $donnees = array('id'=>$_POST['id'],'type'=>$_POST['type'],'nom'=> $_POST['nom'],'numero'=> $_POST['numero'],'unite'=>$_POST['unite']);
                $capteur1 = new Capteur($donnees);
                if($_debug)$capteur1->affiche();
                $myBdManager = new CapteurManager($bdd);
                try
                {
                    if($myBdManager->delete($capteur1) == false)
                    {
                        print("<div class='NotificationErreur'><br>Erreur delete...</div>");
                    }
                    else
                    {
                        print ("<div class='NotificationSucces'><br>Effacemment effectué avec succès</div>");
                    }
                }
                catch(Exception $e)
                {
                    print('erreur:'.$e->getMessage());
                }
            }
            if (isset($_POST['button_create']))
            {
                if($_debug)print ("create <br>");
                $donnees = array('id'=>$_POST['id'],'type'=>$_POST['type'],'nom'=> $_POST['nom'],'numero'=> $_POST['numero'],'unite'=>$_POST['unite']);
                $capteur1 = new Capteur($donnees);
                if($_debug)$capteur1->affiche();
                $myBdManager = new CapteurManager($bdd);
                 try
                {
                    if($myBdManager->create($capteur1) == false)
                    {
                        print("<div class='NotificationErreur'><br>Contrainte d'intégrité non respectée...</div>");
                    }
                    else
                    {
                        print ("<div class='NotificationSucces'><br>Creation effectuée avec succès</div>");
                    }
                }
                catch(Exception $e)
                {
                    print('erreur:'.$e->getMessage());
                }
            }
            if($_debug)print("Bonjour <br>");
            $myBdManager = new CapteurManager($bdd);
            if($_debug)print("myBdManager créé... <br>");
            $bdd_users = [];
            $bdd_users = $myBdManager->getList();
        }
        catch(Exception $e)
        {
            die('erreur:'.$e->getMessage());
        }
        if($_debug)print("count=" . count($bdd_users) ."<br>");
        // parcours de la liste des capteurs trouvés en base
        for($i=0; $i<count($bdd_users); $i=$i+1)
        {
            ?>
            <!-- Un attribut par case du tableau -->
            <tr>
                <form method="post" action="">
                    <td> <input type="hidden" name="id" placeholder="" value="<?php echo $bdd_users[$i]->id(); ?>"/></td>
                    <td> <input type="text" name="numero" placeholder="numero" value="<?php echo $bdd_users[$i]->numero(); ?>"/> </td>
                    <td> <input type="text" name="type" placeholder="type capteur" value="<?php echo $bdd_users[$i]->type(); ?>"/> </td>
                    <td> <input type="text" name="nom" placeholder="Nom du capteur" value="<?php echo $bdd_users[$i]->nom(); ?>"/></td>
                    <td> <input type="text" name="unite" placeholder="Unite" value="<?php echo $bdd_users[$i]->unite(); ?>"/></td>
                    <td> <input type="submit" name="button_update" class="btn" value ="update"> </td>
                    <td> <input type="submit" name="button_delete" class="btn" value ="delete"> </td>
                </form>
            </tr>
            <?php
        }
    ?>
<!-- Ici on ajoute une derniere ligne vide pour créer une nouvelle enntrée -->
    <tr>
    	<form method="post" action="">
            <td> <input type="hidden" name="type" placeholder="--" value="" readonly/> </td>
            <td> <input type="text" name="numero" placeholder="Numero" value=""/> </td>
    		<td> <input type="text" name="type" placeholder="Type capteur" value=""/> </td>
    		<td> <input type="text" name="nom" placeholder="Nom du capteur" value=""/></td>
            <td> <input type="text" name="unite" placeholder="Unite" value=""/></td>
    		<td> <input type="submit" name="button_create" class="btn" value ="create"> </td>
    	</form>
   </tr>
</table>
</p>
</div>
</fieldset>
</body>
</html>
