Quelques explications :

->Convention : les objets sont définis dans des classes qui sont nommées en commençant par une majuscule, et sont définis dans des fichiers php du même nom

Utilisateur fait donc référence à la classe des utilisateurs.

La classe Utilisateur permet de gérer de manière centralisée tous les attributs d'un utilisateur, tels qu'ils ont été définis en conception.
Traditionnellement, cette classe contient des attributs privés qu'elle expose à travers de fonctions permettant de les lire.
En outre, elle fournie des méthodes "set" qui permettent de régler chaque attribut.
A noter qu'un constructeur permet d'initialier un utilisateur à partir d'un tableau de données, et qu'une petite fonction d'affichage est également proposée.
Enfin, une variable _debug permet d'activer/inhiber le debuggage : bien utile lors de la mise au point... :)

UtilisateurManager fait donc référence à la classe du manager d'utilisateurs.
Le "manager" permet de gérer les dits utilisateurs en Base de doonnées.
Cette classe donne les fonctions permettant de trouver un utilisateur (get), de le modifier (update), d'en créer un nouveau (create), ou d'en effacer un (delete).
Le contructeur de cette classe prend en paramètre un lien vers la BD préalablement ouverte.

Pour la mise au point, des programmes de tests ont été faits :
	testUtilisteur : permet de valider le bon fonctionnement de la classe Utilisateur (à terminer)
	testUtilisateurManager : permet de valider l'association à la base de données (à terminer)

Enfin, un formulaire unique (form_admin_utilisateur.php) montre l'utilisation qui peut-être faite de ces deux classes associées.
Ce formulaire valide le bon fonctionnement de l'ensemble, il sera plutôt réservé à un administrateur par la suite, s'il est retenu.

====================================================================================================================================
Utilisation de git : (notes personnelles / à déplacer dans un fichier git.md ?)
-------------------------------------------------------------------------------
-cloner le dossier git
	git clone "https://github.com/Tredork/app.git"
-recuperer la branche MVC pour travailler dessus
	git checkout MVC

-creer une branche TOTO
	git checkout -b TOTO

-ajouter un fichier dans l'arbo git
	git add fichier
-effacer un fichier dans l'arbo git
 	git rm fichier
-enregistrer les modifications dans git
	git commit -m 'commentaire'
-enregistrer une étiquette V1.0
	git tag -a V1.0 -m 'commentaire'

-publier les modifications sur le serveur (ici MVC est le nom de la branche à publier)
	git push origin MVC

-Récupérer un fichier malencontreusement cassé... et dont le dernier commit est correct (ici formulaire form_admin_capteur.php) :
	git rev-list -n 1 HEAD -- .\form_admin_capteurs.php
33e2d8aa1e1b71d1eb791a2067db1ebb7a9f8758
	git checkout 33e2d8aa1e1b71d1eb791a2067db1ebb7a9f8758 .\form_admin_capteurs.php	
	

====================================================================================================================================
