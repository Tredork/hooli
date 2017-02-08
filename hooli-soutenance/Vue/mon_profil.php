
<?php
session_start();
include "../controleur/Utilisateur.php";
include "../controleur/UtilisateurManager.php";
include "../controleur/connectionbase.php";

include 'header.php';


echo $header ;
echo $footer ;
$reponse = $bdd->query('SELECT * FROM utilisateur WHERE mail = "'.$_SESSION['mail'].'" ');

$donnees = $reponse->fetch();
$_SESSION['id']=$donnees['id'];

  try {
    $_debug=false;

    $id=$_SESSION['id'];
    if($_debug)print("Bonjour <br>");
    $myBdManager = new UtilisateurManager($bdd);
    if($_debug)print("myBdManager créé... <br>");

    $current_user = $myBdManager->get($id);

    if ($current_user == false )
    {
      print("<div class='NotificationErreur'><br>Utilisateur introuvable !</div>");
      return ;
    }
    if (isset($_POST['Enregistrer1']))
    {
      if($_debug)print ("Enregistrer1 <br>");
      $donnees = array('id'=>$_POST['id'],'pseudo'=>$_POST['pseudo'],'nom'=> $_POST['nom'], 'prenom'=>$_POST['prenom'], 'date_naissance'=>$_POST['date_naissance'] ,'rue'=>$_POST['rue'], 'numero_rue'=>$_POST['numero_rue'], 'ville'=>$_POST['ville'], 'code_postal'=> $_POST['code_postal'], 'telephone'=>$_POST['telephone'], 'mail'=>$_POST['mail']);
      $user1 = new Utilisateur($donnees);
      if($_debug)$user1->affiche();
      try{
          if($myBdManager->update($user1) == false)
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
        //Récupération des dernières caractéristiques de l'utilisateur
    $current_user = $myBdManager->get($id);
    }



    if (isset($_POST['modifier_password']))
    {

      if($_debug)print ("Modification Mot de passe <br>");
      $current_password = md5($_POST['current_password']);
      $new_password1=$_POST['new_password1'];
      $new_password2=$_POST['new_password2'];
      if($_debug)print ("...current=" .$current_password. " new password 1=".$new_password1." new password 2=".$new_password2." <br>");
      if ($myBdManager->updatePassword($current_user->id(), $current_password, $new_password1, $new_password2) == false)
      {
          print ("<div class='NotificationErreur'><br>Erreur de modification du mot de passe</div>");
      }
      else
      {
        print ("<div class='NotificationSucces'><br>Modification du mot de passe effectuée avec succès</div>");
      }
      //Récupération des dernières caractéristiques de l'utilisateur

      $current_user = $myBdManager->get($id);
    }
  }
  catch(Exception $e)
  {
    die('erreur:'.$e->getMessage());
  }
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="..\style\app.css">
   <title>Hooly/MonProfil</title>
  </head>

  <body>
    <header>
      <!--<h1>Mon Profil</h1>-->
    </header>
    </br>
    </br>
  <table>
      <tr>
          <td>
          <fieldset>
          <legend align="left"><h3>Vos coordonnees</h3></legend>
          <form method="post" action="">
            <div align=center>
              <table>
                <tr>
                 <br/>
                  <br/>
                  <td align="left"><label></label></td>

                  <td align="right"><input type="hidden" name="id" placeholder="Votre identifiant" value="<?php echo $current_user->id(); ?>" readonly/></td>
                </tr>

                <tr>
                  <td align="left"><label>Pseudo :</label></td>
                  <td align="right"><input type="text" name="pseudo" placeholder="Votre Pseudo" value="<?php echo $current_user->pseudo(); ?>" /></td>
                </tr>

                <tr>
                  <td align="left"><label>Nom :</label></td>
                  <td align="right"><input type="text" name="nom" placeholder="Votre Nom" value="<?php echo $current_user->nom(); ?>"/></td>
                </tr>

                <tr>
                  <td align="left"><label>Prenom :</label></td>
                  <td align="right"><input type="text" name="prenom" placeholder="Votre Prenom" value="<?php echo $current_user->prenom(); ?>"/></td>
                </tr>

                <tr>
                  <td align="left"><label>Date de naissance :</label></td>
                  <td align="right"><input type="text" name="date_naissance" placeholder="annee-mm-jj" value="<?php echo $current_user->date_naissance(); ?>"/></td>
                </tr>

                <tr>
                  <td align="left"><label>Rue :</label></td>
                  <td align="right"><input type="text" name="rue" placeholder="Votre rue" value="<?php echo $current_user->rue(); ?>"/></td>
                </tr>

                <tr>
                  <td align="left"><label>Numero de rue :</label></td>
                  <td align="right"><input type="text" name="numero_rue" placeholder="Votre numéro de rue" value="<?php echo $current_user->numero_rue(); ?>" /></td>
                </tr>
                <tr>
                  <td align="left"><label>Ville :</label></td>
                  <td align="right"><input type="text" name="ville" placeholder="Votre ville" value="<?php echo $current_user->ville(); ?>" /></td>
                </tr>

                <tr>
                  <td align="left"><label>Code Postal :</label></td>
                  <td align="right"><input type="text" name="code_postal" placeholder="Votre code postal" value="<?php echo $current_user->code_postal(); ?>"/></td>
                </tr>

                <tr>
                  <td align="left"><label>Email :</label></td>
                  <td align="right"><input type="email" name="mail" placeholder="Votre adresse email" value="<?php echo $current_user->mail(); ?>"/></td>
                </tr>

                <tr>
                  <td align="left"><label>Telephone Portable :</label></td>
                  <td align="right"><input type="tel" name="telephone" placeholder="Numero de telephone" value="<?php echo $current_user->telephone(); ?>"/></td>
                </tr>
                <tr>
              </table>
              <div align="center">
              <br>
                  <input type="submit" name="Enregistrer1" value="Enregistrer" />
              </div>
            </div>
          </fieldset>
          </form>
        </td>
        <td>
          <fieldset>
          <legend align="left"><h3>Changer votre mot de passe</h3></legend>
          <form method="post" action="">
            <div align="center">
              <table>
                <tr>
                <br/>
                 <br/>
                  <td align="left"><label>Ancien mot de passe :</label></td>
                  <td align="right"><input type="password" name="current_password" id="current_password" placeholder="ex: %Toto1999" /></td>
                </tr>
                <tr>
                  <td align="left"><label>Nouveau mot de passe :</label></td>
                  <td align="right"><input type="password" name="new_password1" id="new_password1" placeholder="ex: %Toto1999" /></td>
                </tr>
                <tr>
                  <td align="left"><label>Nouveau mot de passe :</label></td>
                  <td align="right"><input type="password" name="new_password2" id="new_password2" placeholder="ex: %Toto1999" /></td>
                </tr>
              </table>
               <div align="center">
               <br>
                  <input type="submit" name="modifier_password" value="Modifier" />
              </div>
            </div>
            </fieldset>
            </div>
          </form>
        </td>
      </tr>
 </table>
</body>
<footer>
  <?php include 'footer.php';  ?>
</footer>
</html>
