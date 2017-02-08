<!DOCTYPE html>
<html>

<head>
	<title>Modes</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="..\style\mode.css">
		        <script>
            function showUser(str)
            {
                if (str == "")
                {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                }
                if (window.XMLHttpRequest) {
                    xmlhttp= new XMLHttpRequest();
                } else {
                    if (window.ActiveXObject)
                        try {
                            xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            try {
                                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                            } catch (e) {
                                return NULL;
                            }
                        }
                }

                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "modeafficher.php?q=" + str, true);
                xmlhttp.send();
            }
        </script>




</head>



<body>

<?php
include 'header.php';
include "../controleur/connectionbase.php";

?>

</br>
</br>


<div class="div1">

<div class="div2">
<section>

<br/>
 <form method="post" action="mode2.php">
<h2>Création de mode</h2>
	 <br/>
	<td>
	<tr><b> Nom du mode:</b> <input type="text" name="nom" id="nom"></tr>
	</td>
	<br/>
	<br/>
    <?php
        session_start();
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=hooli;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

        $req = $bdd->prepare('SELECT nom FROM pieces WHERE id_utilisateurs = ?');
        $req->execute(array($_SESSION['id']));
        echo "Choisissez vos pièces : ";
        ?> <br></br> <?php
        while($pieces=$req->fetch())
        {
            echo $pieces['nom'];
            ?>
            <input type='checkbox' name='<?php echo $pieces['nom']; ?>' >
            <?php
        }
    ?>
	<h4>Valeurs des actionneurs : </h4>
     Temperature : <input type="text" id="temperature" name="temperature">
	<br/>
    	<br/>
     Lumière : On <input type="radio" name="lumiere" id="lumiere" value="on">
     Off <input type="radio" name="lumiere" id="lumiere" value="off">
</br>
 </br>
 <input type="submit" value="création" class="btn1"/>

 </form>
</section>
</div>


<div class="box">
</br>
</br>
 <form method="post" action="mode3.php">
Mode désiré : <select name="mode" id="mode" onchange="showUser(this.value)">
    <?php
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=hooli;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        session_start();
        $req = $bdd->prepare('SELECT nom FROM modes WHERE id_utilisateurs = ?');
        $req->execute(array($_SESSION['id']));
        ?> <br></br> <?php
        while($modes=$req->fetch())
        {

            ?>
            <option value="<?php echo $modes['nom']; ?>"> <?php echo $modes['nom']; ?> </option>
            <?php
        }
    ?>

</select>
</br>
</br>


</body>

 <br />
 <br/>

        <div id="txtHint"><b>mode info will be listed here.</b></div>
        <br/>
         <!-- <br/>
          <br/>
           <br/>
             <br/>
             <br/>
             <br/> -->

        <input type="submit" name="envoyer" value="send" class="btn1"/>

</form>
</div>
</div>
<footer>
<?php include 'footer.php'; ?>
</footer>

<!-- Code/Footer de Y-->

</html>
