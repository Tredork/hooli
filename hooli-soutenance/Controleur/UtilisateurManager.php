<?php
session_start();

class UtilisateurManager
{
	private $_debug=false;
	private $_db;

	public function __construct($db)
	{
    	if($this->_debug){print("<br> Constructeur: UtilisateurManager...");}
		$this->setDb($db);
	}

	public function update(Utilisateur $user)
	{
		if($this->_debug)print ("<br>update");

		//Premiere version avant implémentation des contraintes en bd

		if (!$user->is_integre())
		{
			return false;
		}
		//Preparation de la requete d'insertion
		//A noter mise à jour de tous les attributs sauf les mots de passes.
		$q=$this->_db->prepare('UPDATE utilisateur SET pseudo=:pseudo, nom=:nom, prenom=:prenom, date_naissance=:date_naissance, rue=:rue, numero_rue=:numero_rue, ville=:ville, code_postal=:code_postal, telephone=:telephone, mail=:mail WHERE id=:id');
		//Assignation des valeurs
		$q->bindValue(':id',$user->id());
		$q->bindValue(':pseudo',$user->pseudo());
		$q->bindValue(':nom',$user->nom());
		$q->bindValue(':prenom',$user->prenom());
		$q->bindValue(':date_naissance',$user->date_naissance());
		$q->bindValue(':rue',$user->rue());
		$q->bindValue(':numero_rue',$user->numero_rue());
		$q->bindValue(':ville',$user->ville());
		$q->bindValue(':code_postal',$user->code_postal());
		$q->bindValue(':telephone',$user->telephone());
		$q->bindValue(':mail',$user->mail());
		//Excecution de la requete
		$q->execute();
		return true;
	}


	public function updatePassword($id, $current_password, $new_password1, $new_password2)
	{
		if($this->_debug)print ("<br>updatePassword");
		if($this->_debug)print ("<br>...id=".$id. "current=" .$current_password. " new password 1=".$new_password1." new password 2=".$new_password2 );
		// On récupere les caratéristiques de l'utilisateur à modifier dans $current_user
		$current_user = $this->get($id);
  		 // Oncommence commence à vérifier que le mot de passe courant est le bon
      	if ($current_password == md5($_SESSION['password']))
     	{
     		if($this->_debug)print ("<br>...Mot de passe courant OK");

        	//Puis on vérifie que les mots de passes 1 et 2 sont identiques
        	if ($new_password1 == $new_password2)
        	{
        		if($this->_debug)print ("<br>...Mot de passe 1 et 2 OK");
        		if ($new_password1 == "")
        		{
        			if($this->_debug)print ("<br>...Erreur nouveau mot de passse vide!");
        			return false;
        		}

          		//On met à jour le nouveau password
          		$current_user->setPassword($new_password1);
          		// Puis on le met en BDD
				//Preparation de la requete d'insertion
				$q=$this->_db->prepare('UPDATE utilisateur SET password=:password WHERE id=:id');
				//Assignation des valeurs
				$q->bindValue(':id',$current_user->id());
				$q->bindValue(':password',$current_user->password());
				//Excecution de la requete
				$q->execute();

        	}
        	else
        	{
        		return false;
        	}
      	}
      	else
      	{
      		return false;
      	}
       	return true;
	}

	public function createNewUser($pseudo, $mail, $password)
	//preparation de la requete d'insertion
	//Assignation des valeurs
	//excecution de la requete
	{
		if($this->_debug)print ("<br>createNewUser");

		if (empty($pseudo) OR empty($mail) OR empty($password)  )
		{
			if($this->_debug)print ("<br>..Au moins un attribut est vide erreur!");
			return false;
		}
		$q=$this->_db->prepare('INSERT INTO utilisateur(pseudo,mail,password) VALUES (:pseudo,:mail,:password) ');
		$q->bindValue(':pseudo', $pseudo);
		$q->bindValue(':mail', $mail);
		$q->bindValue(':password', $password);
		return $q->execute();

		// Mise à jour de l'id
		//$user->hydrate([
	    //  'id' => $this->_db->lastInsertId()
	    //]);
	}

	public function delete(Utilisateur $user)
	//execute une requete de type delete
	{
		return $this->_db->exec('DELETE FROM utilisateur WHERE id='.$user->id());
	}

	public function get($id)
	// execute une requete de type select avec une clause WHERE et retourne un objet utilisateur.
	{
		$id=(int)$id;
		$q=$this->_db->query('SELECT id,pseudo,nom,prenom,date_naissance,rue,numero_rue,ville,code_postal,telephone,mail,password FROM utilisateur WHERE id= '.$id);
		$donnees=$q->fetch(PDO::FETCH_ASSOC);
		if ($donnees!= false)
		{
			return new Utilisateur($donnees);
		}
		else
		{
			return false;
		}
	}

	public function getList()
	//retourne la liste de tous les utilisateurs
	{
      	if($this->_debug){print("...UtilisateurManager.getList()...<br>");}
		$users = [];

    	$q = $this->_db->prepare('SELECT id,pseudo,nom,prenom,date_naissance,rue,numero_rue,ville,code_postal,telephone,mail,password FROM utilisateur');
    	$q->execute();

    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$users[] = new Utilisateur($donnees);
	      	if($this->_debug){print("...UtilisateurManager.getList(). utilisateur trouvé...<br>");}
    	}

    	return $users;
	}

	public function getListByPseudo($pseudo)
	//retourne la liste de tous les capteurs par type
	{
      	if($this->_debug){print("...UtilisateurManager.getListByPseudo()...<br>");}
		$capteurs = [];

    	$q = $this->_db->prepare('SELECT id,pseudo,nom,prenom,date_naissance,rue,numero_rue,ville,code_postal,telephone,mail,password FROM utilisateur WHERE pseudo=\''.$pseudo.'\'');
    	$q->execute();

    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$utilisateur[] = new Utilisateur($donnees);
	      	if($this->_debug){print("...UtilisateurManager.getListByType(). utilisateur trouvé...<br>");}
    	}

    	return $utilisateur;
	}

	public function getByMail($mail)
	{
		if ($this->_debug) {print("<br>getByMail mail=".$mail );}


		$q=$this->_db->query('SELECT id,pseudo,nom,prenom,date_naissance,rue,numero_rue,ville,code_postal,telephone,mail,password FROM utilisateur WHERE mail=\''.$mail.'\'');
		$donnees=$q->fetch(PDO::FETCH_ASSOC);
		if ($donnees!= false)
		{
			return new Utilisateur($donnees);
		}
		else
		{
			return false;
		}
	}

	public function getByPseudo($pseudo)
	{
		if ($this->_debug) print("<br>getByPseudo pseudo=".$pseudo );

		$q=$this->_db->query('SELECT id,pseudo,nom,prenom,date_naissance,rue,numero_rue,ville,code_postal,telephone,mail,password FROM utilisateur WHERE pseudo=\''.$pseudo.'\'');
		$donnees=$q->fetch(PDO::FETCH_ASSOC);
		if ($donnees!= false)
		{
			return new Utilisateur($donnees);
		}
		else
		{
			return false;
		}

	}


	public function getUserByMailPassword($mail, $password)
	{
		if ($this->_debug) print ("<br> getUserByMailPassword");

		$user=$this->getByMail($mail);
		if ($user != false) {
			if ($user->password() == $password) {
				if ($this->_debug) print ("<br>...Login OK");
				return $user;
			} else {
				if ($this->_debug) print ("<br>...Mot de passe incorrect");
				return false;
			}
		} else {
			if ($this->_debug) print ("<br>...Utilisateur non trouvé");
			return false;
		}
	}

		public function getUserByPseudoPassword($pseudo, $password)
	{
		if ($this->_debug) print ("<br>getUserByPseudoPassword");

		$user=$this->getByPseudo($pseudo);
		if ($user != false) {
			if ($user->password() == $password) {
				if ($this->_debug) print ("<br>...Login OK");
				return $user;
			} else {
				if ($this->_debug) print ("<br>...Mot de passe incorrect");
				return false;
			}
		} else {
			if ($this->_debug) print ("<br>...Pseudo non trouvé");
			return false;
		}
	}



	public function setDb(PDO $db)
	{
		$this->_db=$db;
	}
}
?>
