<!DOCTYPE html>
<html>

<head>
	<title>Hooli.SAV/Contact</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="..\style\app.css">

<!-- code Y -->
<?php include 'header.php'; ?>

<!-- fin du code de Y -->
</head>


<body>
</br>
</br>

<div class="forme" >
<section>
<br/>
<h2>Hooli</h2>
	 <br/>
	  <br/>
	 <p><b>Adresse</b> : 28 rue Notre Dame des Champs <br> 75006 <br><br>
	 <b>Tél</b> : +33 00 00 00 00 <br> <b>Fax</b> : +33 00 00 00 00 <br><br> <b>Email</b> : contact@hooli.com <br>Hérvé Feller</p>

</section>

<aside>
   <br/>
	<h2> Contacter le Service Après Vente (SAV)</h2>
	<form action="" method="post" id="formsav">
	 <br/>
	  <br/>
			<label><input type="text" value="Nom" id="name"></label>
			<label><input type="text" value="Prénom" id="name"></label> <br><br>
			<label><input type="text" value="Email" id="mail"></label>
			<select name="Problème" title="Problème">
				<option value="">Problème capteur</option>
				<option value="">Problème compte</option>
				<option value="">Autre</option>
			</select> <br><br>
			<label for="Message"> Message : <br><textarea name="Message" id="message"></textarea> <br></label>
			<label>
			<input type="submit" value="Envoyer"></label>
	</form>
</aside>


</div>
</body>
<footer>
<?php include 'footer.php'; ?>
</footer>

<!-- Code/Footer de Y-->

</html>
