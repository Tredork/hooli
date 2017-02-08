<!DOCTYPE html>
<html>
	<head>
		<meta charset="{CHARSET}">
		<title></title>
 		<link href="..\style\capteur.css" rel="stylesheet"/>
	</head>

<body>

<?php
include("header.php");
$dbname= "hooli";
$host= "localhost";
$user= "root";
$pass= "root";

	 try
	 {
		$bdd =new PDO("mysql:host=$host; dbname=$dbname","$user","$pass");

	 }
	 catch(Exception $e)
	 {
	 die('erreur:'.$e->getMessage());
	 }
	 $reponse1 = $bdd->query('SELECT valeur FROM donnee_recue where type_capteur=3 ORDER BY date_recep Desc LIMIT 0,1 ');

	 $reponse2 = $bdd->query('SELECT valeur FROM donnee_recue where type_capteur=4 ORDER BY date_recep Desc LIMIT 0,1 ');

	 $reponse3 = $bdd->query('SELECT valeur FROM donnee_recue where type_capteur=5 ORDER BY date_recep Desc LIMIT 0,1 ');

	 $reponse4 = $bdd->query('SELECT date_recep FROM donnee_recue where type_capteur=3 ORDER BY date_recep Desc LIMIT 0,1 ');

   $reponse5 = $bdd->query('SELECT date_recep FROM donnee_recue where type_capteur=	4 ORDER BY date_recep Desc LIMIT 0,1 ');

	 $reponse6 = $bdd->query('SELECT date_recep FROM donnee_recue where type_capteur=5  ORDER BY date_recep Desc LIMIT 0,1 ');
?>

</br>
</br>
<div id="tableau2">
<table class="table1">
	<tr>
		<td><input type="button"  value="ALL" class="btn1";onclick = "" style="background-color: #00A2CA;" /></td>
	</tr>
	<tr>
    	<td> <input type="button"  value="Salon" class="btn1";onclick = ""/> </td>
	</tr>
	<tr>
	   <td> <input type="button"  value="Cuisine" class="btn1" ;onclick = ""/> </td>
	</tr>
	<tr>
		<td> <input type="button"  value="Chambre1" class="btn1" ;onclick = ""/> </td>
	</tr>
	<tr>
		<td> <input type="button"  value="Chambre2" class="btn1" ;onclick = ""/> </td>
	</tr>





	<table class="div1">
		<thead>
			<tr>
				<th class="th1"><img src="..\Image\Temperature.png" class="img1"></th>
				<th class="th1"><img src="..\Image\iconeLumiere.png" class="img1"></th>
				<th class="th1"><img src="..\Image\humidity.png" class="img1"></th>
				<th class="th1"><img src="..\Image\surveillance.png" class="img1"></th>
			</tr>
			<tr>
				<th class="th1">Température</th>
				<th class="th1">Lumière</th>
				<th class="th1">Humidité</th>
				<th class="th1">Surveillance</th>
			</tr>
			<tr>
				<td class="td1"><input type="text1" value="<?php while ($donnees4 = $reponse4->fetch())
				{
					echo $donnees4['date_recep'];
				}?>"></td>
				<td class="td1"><input type="text1" value="<?php while ($donnees6 = $reponse6->fetch())
				{
					echo $donnees6['date_recep'];
				}?>"></td>
				<td class="td1"><input type="text1" value="<?php while ($donnees5 = $reponse5->fetch())
				{
					echo $donnees5['date_recep'];
				}?>"></td>
				<td class="td1">date/heure</td>
			</tr>
			<tr>
				<td class="td1">valeure : <input type="text" value="<?php while ($donnees1 = $reponse1->fetch())
				{
					echo $donnees1['valeur']/10;
				}?>°C" name=""></td>
				<td class="td1">état :<?php if ($donnees3['valeur']<<1111) {
	        echo '<button style=color:red class="onoff" onclick="onoff(this)"><div>off</div></button>';
	      }
	      else{
	        echo '<button style=color:green class="onoff" onclick="onoff(this)"><div>on</div></button>';
	      }?></td>
				<td class="td1">valeure : <input type="text" value=" <?php while ($donnees2= $reponse2 ->fetch())
				 {
					echo number_format ($donnees2['valeur'],2);
				}?>%" name=""></td>
				<td class="td1">état</td>
			</tr>
		</thead>
	</table>
	<!-- <img src = '..\Image\iconeTemperature.png' class="img1">
	<img src = '..\Image\iconeLumiere.png' class="img1">
	<img src = '..\Image\iconeAire.png' class="img1">
	<img src = '..\Image\fenetre.png' class="img1"> -->






<div class="div1" style="display: none;" >Luminosite...
	<img src = '..\Image\iconeLumiere.png' class="img1">
	<input type="button" id="ajouter" value="ajouter" class="ajouter"/>
	<input type="button" id="supprimer" value="supprimer" class="supprimer"/>
</div>


<div class="div1" style="display: none;">Temperature.....
	<img src = '..\Image\Temperature.png' class="img1">
	<input type="button" id="ajouter" value="ajouter" class="ajouter";onclick = ""/>
	<input type="button" id="supprimer" value="supprimer" class="supprimer";onclick = ""/>
</div>


<div class="div1" style="display: none;">Securite....
	<img src = '..\Image\securite.png' class="img1">
	<input type="button" id="ajouter" value="ajouter" class="ajouter";onclick = ""/>
	<input type="button" id="supprimer" value="supprimer" class="supprimer";onclick = ""/>
</div>


<div class="div1" style="display: none;">Fenetre
	<img src = '..\Image\fenetre.png' class="img1">
	<input type="button" id="ajouter" value="ajouter" class="ajouter";onclick = ""/>
	<input type="button" id="supprimer" value="supprimer" class="supprimer";onclick = ""/>
</div>

</div>
</body>


<footer>
<?php include 'footer.php';  ?>
</footer>



<script>

		window.onload=function(){
		var inputs = document.querySelectorAll('.btn1');
		var divs = document.querySelectorAll('.div1');
		// var tableau = document.getElementById("tableAll");


		console.dir(inputs);
		console.dir(divs);



		for(var i=0;i<inputs.length;i++)
		{
		 inputs[i].index=i;

		 inputs[i].onclick=function(){

		  for(var i = 0;i<inputs.length;i++){
		  inputs[i].style.background='';
		  divs[i].style.display='none';
		 };

		 this.style.background='#00A2CA';
		 divs[this.index].style.display='block';

		};

		};
		};

</script>

</html>
