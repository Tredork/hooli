<!-- fonction permettant de déverser tous les utilisateurs du site dans un tableau afin de les lister -->
<?php
//=========================================================================
// Dévellopé par PUCH Alexis
//=========================================================================
include "../controleur/Utilisateur.php";
include "../controleur/UtilisateurManager.php";
include "../controleur/connectionbase.php";
include "header_back_office.php";


//echo $header ;
//echo $footer ;


$_debug=false;

?>
<!DOCTYPE html>

<style type="text/css">
table {
  table-layout: fixed;
  width: 100%;
}
td, th {
  width: 129px;
  padding:0px 5px;
}
.fix {
  position: absolute;
  *position: relative; /*ie7*/
  width: 100%;
}
.outer {
  position: relative;
}
.inner {
  overflow-x: scroll;
  overflow-y: visible;
  width: 100%;
}
</style>

<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../style/app.css">
    <title>form_admin_utilisateurs</title>
  </head>

  <body>


  <div class="outer">
    <div class="inner">
      <fieldset>
        <legend align="center"><h3>Affichage de la table des utilisateurs</h3></legend>

        <table style="padding: 11px;">
          <!-- Entete du tableau -->
          <tr>
            <!-- <td></td> -->
            <th></th><th>pseudo</th><th>nom</th> <th>prenom</th><th>date_naissance</th><th>rue</th><th>numero_ville</th><th>ville</th><th>code_postal</th><th>telephone</th><th>mail</th><th>password</th><th> Update</th><th>delete</th>
          </tr>

          <?php
          // Gestion de l'appui éventuel sur les boutons update, delete, create
          // la gestion des exceptions permet d'afficher l'erreur d'accès à la base
          try {
            if (isset($_POST['button_update']))
            {
              if($_debug)print ("update <br>");
              $donnees = array('id'=>$_POST['id'],'pseudo'=>$_POST['pseudo'],'nom'=> $_POST['nom'], 'prenom'=>$_POST['prenom'], 'date_naissance'=>$_POST['date_naissance'] ,'rue'=>$_POST['rue'], 'numero_rue'=>$_POST['numero_rue'], 'ville'=>$_POST['ville'], 'code_postal'=> $_POST['code_postal'], 'telephone'=>$_POST['telephone'], 'mail'=>$_POST['mail'], 'password'=> $_POST['password']);

              $user1 = new Utilisateur($donnees);
              if($_debug)$user1->affiche();

              $myBdManager = new UtilisateurManager($bdd);
              try
              {
                if($myBdManager->update($user1) == false)
                {
                  print("<div class='NotificationErreur'><br>Erreur champ(s) non rempli(s)...</div>");
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
              $donnees = array('id'=>$_POST['id'],'pseudo'=>$_POST['pseudo'],'nom'=> $_POST['nom'], 'prenom'=>$_POST['prenom'], 'date_naissance'=>$_POST['date_naissance'] ,'rue'=>$_POST['rue'], 'numero_rue'=>$_POST['numero_rue'], 'ville'=>$_POST['ville'], 'code_postal'=> $_POST['code_postal'], 'telephone'=>$_POST['telephone'], 'mail'=>$_POST['mail'], 'password'=> $_POST['password']);
              $user1 = new Utilisateur($donnees);
              if($_debug)$user1->affiche();
              $myBdManager = new UtilisateurManager($bdd);
              try
              {
                if($myBdManager->delete($user1) == false)
                {
                  print("<div class='NotificationErreur'><br>Probleme effacement !!!...</div>");
                }
                else
                {
                  print ("<div class='NotificationSucces'><br>Supression effectuée avec succès</div>");
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
              $myBdManager = new UtilisateurManager($bdd);
              try
              {
                if($myBdManager->createNewUser($_POST['pseudo'],$_POST['mail'],$_POST['password']) == false)
                {
                  print("<div class='NotificationErreur'><br>Erreur champ(s) non rempli(s)...</div>");
                }
                else
                {
                  print ("<div class='NotificationSucces'><br>Creation effectuée avec succès</div>");
                }
              }
              catch(Exception $e)
              {
                print("<div class='NotificationErreur'><br>Erreur:".$e->getMessage()."</div>");
              }
            }

            if (isset($_POST['button_refresh']))
            {
                if($_debug)print ("refresh <br>");
                $pseudo = $_POST['pseudo'];
            }


            if($_debug)print("Bonjour <br>");
            $myBdManager = new UtilisateurManager($bdd);
            if($_debug)print("myBdManager créé... <br>");

            $bdd_users = [];
            $bdd_users = $myBdManager->getList();
          }
          catch(Exception $e)
          {
            die('erreur:'.$e->getMessage());
          }
          if($_debug)print("count=" . count($bdd_users) ."<br>");
          // parcours de la liste des utilisateurs trouvés en base
          for($i=0; $i<count($bdd_users); $i=$i+1)
          {
            ?>
            <!-- Un attribut par case du tableau -->
            <tr>
              <form method="post" action="">
                <td>
                  <input type="hidden" name="id"  value="<?php echo $bdd_users[$i]->id(); ?>"/>
                </td>
                <td> <input type="text" name="pseudo" placeholder="Votre pseudo" value="<?php echo $bdd_users[$i]->pseudo(); ?>"/> </td>
                <td> <input type="text" name="nom" placeholder="Votre nom" value="<?php echo $bdd_users[$i]->nom(); ?>"/></td>
                <td> <input type="text" name="prenom" placeholder="Votre prenom" value="<?php echo $bdd_users[$i]->prenom(); ?>"/></td>
                <td> <input type="text" name="date_naissance" placeholder="Votre date de naissance" value="<?php echo $bdd_users[$i]->date_naissance(); ?>"/> </td>
                <td> <input type="text" name="rue" placeholder="Votre rue" value="<?php echo $bdd_users[$i]->rue(); ?>"/></td>
                <td> <input type="text" name="numero_rue" placeholder="Votre numero de rue" value="<?php echo $bdd_users[$i]->numero_rue(); ?>"/></td>
                <td> <input type="text" name="ville" placeholder="Votre ville" value="<?php echo $bdd_users[$i]->ville(); ?>"/></td>
                <td> <input type="text" name="code_postal" placeholder="Votre code postal" value="<?php echo $bdd_users[$i]->code_postal(); ?>"/></td>
                <td> <input type="text" name="telephone" placeholder="Votre numero de telephone" value="<?php echo $bdd_users[$i]->telephone(); ?>"/></td>
                <td> <input type="text" name="mail" placeholder="Votre mail" value="<?php echo $bdd_users[$i]->mail(); ?>"/></td>
                <td> <input type="text" name="password" placeholder="Votre mot de passe" value="<?php echo $bdd_users[$i]->password(); ?>" readonly/></td>
                <td> <input type="submit" name="button_update" value ="update"> </td>
                <td> <input type="submit" name="button_delete" value ="delete"> </td>
              </form>
            </tr>
            <?php
          }
          ?>
          <!-- Ici on ajoute une derniere ligne vide pour créer une nouvelle enntrée -->
          <tr>
            <form method="post" action="">
              <td>
                <input type="hidden" name="id" placeholder="" value="" readonly/>
              </td>
              <td> <input type="text" name="pseudo" placeholder="Votre pseudo" value=""/> </td>
              <td> <input type="text" name="nom" placeholder="" value="" readonly/></td>
              <td> <input type="text" name="prenom" placeholder="" value="" readonly/></td>
              <td> <input type="text" name="date_naissance" placeholder="" value="" readonly/> </td>
              <td> <input type="text" name="rue" placeholder="" value="" readonly/></td>
              <td> <input type="text" name="numero_rue" placeholder="" value="" readonly/></td>
              <td> <input type="text" name="ville" placeholder="" value="" readonly/></td>
              <td> <input type="text" name="code_postal" placeholder="" value="" readonly/></td>
              <td> <input type="text" name="telephone" placeholder="" value="" readonly/></td>
              <td> <input type="text" name="mail" placeholder="Votre mail" value=""/></td>
              <td> <input type="text" name="password" placeholder="Votre mot de passe" value=""/></td> <!-- Permet la saisi du mot de passe initial -->
              <td> <input type="submit" name="button_create" value ="create"> </td>
            </form>
          </tr>
        </table>

      </p>
    </fieldset>

    <fieldset>
    <legend align="center"><h3>Liste des utilisateurs par pseudo </h3></legend>
        <table>
            <tr>
                <form method="post" action="">
                    <td> <input type="text" name="pseudo" placeholder="Pseudo de l'utilisateur" value=""/> </td>
                    <td> <input type="submit" name="button_refresh" class="btn" value ="Raffraichir"> </td>
                </form>
            </tr>
        </table>

    <?php
        try
        {

            $myBdManager = new UtilisateurManager($bdd);
            if($_debug)print("myBdManager créé... <br>");

            $bdd_users = [];
            $bdd_users = $myBdManager->getListByPseudo($pseudo);
        }
        catch(Exception $e)
        {
            if($_debug)die('erreur:'.$e->getMessage());
        }
        if($_debug)print("count=" . count($bdd_users) ."<br>");
        // parcours de la liste des capteurs trouvés en base
        for($i=0; $i<count($bdd_users); $i=$i+1)
        {
    ?>
        <table>   <!-- Un attribut par case du tableau -->
            <tr>
                <th></th><th>pseudo</th><th>nom</th> <th>prenom</th><th>date_naissance</th><th>rue</th><th>numero_ville</th><th>ville</th><th>code_postal</th><th>telephone</th><th>mail</th><th>password</th><th> Update</th><th>delete</th>
            </tr>
            <tr>
                <form method="post" action="">
                    <td> <input type="hidden" name="id" value="<?php echo $bdd_users[$i]->id(); ?>" readonly/> </td>
                    <td> <input type="text" name="pseudo" placeholder="Votre pseudo" value="<?php echo $bdd_users[$i]->pseudo(); ?>"/> </td>
                    <td> <input type="text" name="nom" placeholder="Votre nom" value="<?php echo $bdd_users[$i]->nom(); ?>"/></td>
                    <td> <input type="text" name="prenom" placeholder="Votre prenom" value="<?php echo $bdd_users[$i]->prenom(); ?>"/></td>
                    <td> <input type="text" name="date_naissance" placeholder="Votre date de naissance" value="<?php echo $bdd_users[$i]->date_naissance(); ?>"/> </td>
                    <td> <input type="text" name="rue" placeholder="Votre rue" value="<?php echo $bdd_users[$i]->rue(); ?>"/></td>
                    <td> <input type="text" name="numero_rue" placeholder="Votre numero de rue" value="<?php echo $bdd_users[$i]->numero_rue(); ?>"/></td>
                    <td> <input type="text" name="ville" placeholder="Votre ville" value="<?php echo $bdd_users[$i]->ville(); ?>"/></td>
                    <td> <input type="text" name="code_postal" placeholder="Votre code postal" value="<?php echo $bdd_users[$i]->code_postal(); ?>"/></td>
                    <td> <input type="text" name="telephone" placeholder="Votre numero de telephone" value="<?php echo $bdd_users[$i]->telephone(); ?>"/></td>
                    <td> <input type="text" name="mail" placeholder="Votre mail" value="<?php echo $bdd_users[$i]->mail(); ?>"/></td>
                    <td> <input type="text" name="password" placeholder="Votre mot de passe" value="<?php echo $bdd_users[$i]->password(); ?>" readonly/></td>
                    <td> <input type="submit" name="button_update" value ="update"> </td>
                    <td> <input type="submit" name="button_delete" value ="delete"> </td>
                </form>
            </tr>
        </table>
    <?php
        }
    ?>
    </fieldset>
  </div>
</div>

</body>

</html>
