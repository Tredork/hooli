<!DOCTYPE html>
<html>
<head>
<?php ob_start();
?>
	<title>Hooli.Accueil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="..\style\app.css">





<!-- fin du code de Y -->
</head>

<body>
</br>
</br>

<header>
	<h1>Qui sommes-nous?</h1>
</header>



<div class="page">
	<!-- image a ajouter -->
	<div class="Accueilimg">
		<img src="..\Image\domotique.png" alt="domotique.com" weidth="350" height="360">
	</div>

	<div class="Presentation">
<br/>
<br/>
<br/>
		<div class="Headpresentation">
			<table>
				<thead>
					<tr>
						<td class="ConfortEconomie"><pre><b>Confort</b></pre><br>Surveiller votre maison à distance depuis un seul et même site</td>
						<td class="Sécurité"><pre><b>Sécurité</b></pre><br>Alarme connectée, vidéosurveillance, protéger vos biens et votre famille</td>
						<td class="ConfortEconomie"><pre><b>Economie</b></pre><br>Créer vos modes et automatiser les tâches quotidienes</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Texte de présentation à ajouter -->
		<p class="Accueil">Bienvenue sur le site de Hooli, nous vous proposons de suivre l'état de votre maison grâce aux capteurs.
		</p>
	</div>


</div>
<!-- Code de Y-->


     </center>
    </table>





</p>


</div>



</body>
<footer>
	<?php include "footer.php"; ?>
</footer>
<?php $acceuil = ob_get_clean(); ?>
</html>
