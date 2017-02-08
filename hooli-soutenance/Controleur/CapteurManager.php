<?php

class CapteurManager
{
	private $_debug=false;
	private $_db;

	public function __construct($db)
	{
    	if($this->_debug){print("<br> Constructeur: CapteurManager...");}
		$this->setDb($db);
	}

	public function update(Capteur $capteur)
	{

		if($this->_debug)print ("<br>update");

		//Premiere version avant implémentation des contraintes en bd
		// Resumé des verifications des contraintes d'intégrités
		// - aucun champ ne doit être vide
		if (!$capteur->is_integre())
		{
			return false;
		}
		//Preparation de la requete d'insertion
		//A noter mise à jour de tous les attributs sauf les mots de passes.
		$q=$this->_db->prepare('UPDATE capteur SET type=:type, nom=:nom, numero=:numero, unite=:unite WHERE id=:id');
		//Assignation des valeurs
		$q->bindValue(':id',$capteur->id());
		$q->bindValue(':type',$capteur->type());
		$q->bindValue(':nom',$capteur->nom());
		$q->bindValue(':numero',$capteur->numero());
		$q->bindValue(':unite',$capteur->unite());
		//Excecution de la requete
		$q->execute();
		return true;
	}

	public function create(Capteur $capteur)
	//preparation de la requete d'insertion
	//Assignation des valeurs
	//excecution de la requete
	{
		$q=$this->_db->prepare('INSERT INTO capteur(type,nom,numero,unite) VALUES (:type,:nom,:numero,:unite) ');
		$q->bindValue(':type',$capteur->type());
		$q->bindValue(':nom',$capteur->nom());
		$q->bindValue(':numero',$capteur->numero());
		$q->bindValue(':unite',$capteur->unite());
		return $q->execute();

		// Mise à jour de l'id
		//$capteur->hydrate([
	    //  'id' => $this->_db->lastInsertId()
	    //]);
	}

	public function delete(Capteur $capteur)
	//execute une requete de type delete
	{
		return $this->_db->exec('DELETE FROM capteur WHERE id='.$capteur->id());
	}

	public function get($id)
	// execute une requete de type select avec une clause WHERE et retourne un objet capteur.
	{
		$id=(int)$id;
		$q=$this->_db->query('SELECT id,type,nom,numero,unite FROM capteur WHERE id= '.$id);
		$donnees=$q->fetch(PDO::FETCH_ASSOC);
		if ($donnees!= false)
		{
			return new Capteur($donnees);
		}
		else
		{
			return false;
		}
	}

	public function getList()
	//retourne la liste de tous les capteurs
	{
      	if($this->_debug){print("...CapteurManager.getList()...<br>");}
		$capteurs = [];

    	$q = $this->_db->prepare('SELECT id,type,nom,numero,unite FROM capteur');
    	$q->execute();

    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$capteurs[] = new Capteur($donnees);
	      	if($this->_debug){print("...CapteurManager.getList(). capteur trouvé...<br>");}
    	}

    	return $capteurs;
	}

	public function getListByType($type)
	//retourne la liste de tous les capteurs par type
	{
      	if($this->_debug){print("...CapteurManager.getListByType()...<br>");}
		$capteurs = [];

    	$q = $this->_db->prepare('SELECT id,type,nom,numero,unite FROM capteur WHERE type=\''.$type.'\'');
    	$q->execute();

    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$capteurs[] = new Capteur($donnees);
	      	if($this->_debug){print("...CapteurManager.getListByType(). capteur trouvé...<br>");}
    	}

    	return $capteurs;
	}

	public function getByNom($nom)
	{
		if ($this->_debug) {print("<br>getByNom nom=".$nom );}


		$q=$this->_db->query('SELECT id,type,nom,numero,unite FROM capteur WHERE nom=\''.$nom.'\'');
		$donnees=$q->fetch(PDO::FETCH_ASSOC);
		if ($donnees!= false)
		{
			return new Capteur($donnees);
		}
		else
		{
			return false;
		}
	}

	public function setDb(PDO $db)
	{
		$this->_db=$db;
	}

}
?>
