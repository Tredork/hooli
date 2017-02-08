<?php

class Donnee_recueManager
{
	private $_debug=false;
	private $_db;

	public function __construct($db)
	{
    	if($this->_debug){print("<br> Constructeur: Donnee_recueManager...");}
		$this->setDb($db);
	}

	public function update(Donnee_recue $donnee_recue)
	{
		if($this->_debug)print ("<br>update");

		//Premiere version avant implémentation des contraintes en bd
		// Resumé des verifications des contraintes d'intégrités
		// - aucun champ ne doit être vide

		if (!$donnee_recue->is_integre())
		{
			return false;
		}

		//Preparation de la requete d'insertion
		//A noter mise à jour de tous les attributs sauf les mots de passes.
		$q=$this->_db->prepare('UPDATE donnee_recue SET trame=:trame,objet=:objet,requete=:requete,type_capteur=:type_capteur,numero_capteur=:numero_capteur,valeur=:valeur,tim=:tim,chk=:chk,date_recep=:date_recep  WHERE id=:id');
		//Assignation des valeurs


		$q->bindValue(':id',$donnee_recue->id());
		$q->bindValue(':trame',$donnee_recue->trame());
		$q->bindValue(':objet',$donnee_recue->objet());
		$q->bindValue(':requete',$donnee_recue->requete());
		$q->bindValue(':type_capteur',$donnee_recue->type_capteur());
		$q->bindValue(':numero_capteur',$donnee_recue->numero_capteur());
		$q->bindValue(':valeur',$donnee_recue->valeur());
		$q->bindValue(':tim',$donnee_recue->tim());
		$q->bindValue(':chk',$donnee_recue->chk());
		$q->bindValue(':date_recep',$donnee_recue->date_recep());
		//Excecution de la requete
		return $q->execute();
	}

	public function create(Donnee_recue $donnee_recue)
	//preparation de la requete d'insertion
	//Assignation des valeurs
	//excecution de la requete
	{
		if (!$donnee_recue->is_integre())
		{
			return false;
		}
		$q=$this->_db->prepare('INSERT INTO donnee_recue(trame,objet,requete,type_capteur,numero_capteur,valeur,tim,chk,date_recep) VALUES (:trame,:objet,:requete,:type_capteur,:numero_capteur,:valeur,:tim,:chk,:date_recep) ');

		$q->bindValue(':trame',$donnee_recue->trame());
		$q->bindValue(':objet',$donnee_recue->objet());
		$q->bindValue(':requete',$donnee_recue->requete());
		$q->bindValue(':type_capteur',$donnee_recue->type_capteur());
		$q->bindValue(':numero_capteur',$donnee_recue->numero_capteur());
		$q->bindValue(':valeur',$donnee_recue->valeur());
		$q->bindValue(':tim',$donnee_recue->tim());
		$q->bindValue(':chk',$donnee_recue->chk());
		$q->bindValue(':date_recep',$donnee_recue->date_recep());

		return $q->execute();

	}

	public function delete(Donnee_recue $donnee_recue)
	//execute une requete de type_capteur delete
	{
		return $this->_db->exec('DELETE FROM donnee_recue WHERE id='.$donnee_recue->id());

	}

	public function get($id)
	// execute une requete de type_capteur select avec une clause WHERE et retourne un objet donnee_recue.
	{
		$id=(int)$id;
		$q=$this->_db->query('SELECT id,trame,objet,requete,type_capteur,numero_capteur,valeur,tim,chk,date_recep FROM donnee_recue WHERE id= '.$id);
		$donnees=$q->fetch(PDO::FETCH_ASSOC);
		if ($donnees!= false)
		{
			return new Donnee_recue($donnees);
		}
		else
		{
			return false;
		}
	}

	public function getList()
	//retourne la liste de tous les donnee_recues
	{
      	if($this->_debug){print("...Donnee_recueManager.getList()...<br>");}
		$donnee_recues = [];

    	$q = $this->_db->prepare('SELECT id,trame,objet,requete,type_capteur,numero_capteur,valeur,tim,chk,date_recep FROM donnee_recue');
    	$q->execute();

    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$donnee_recues[] = new Donnee_recue($donnees);
	      	if($this->_debug){print("...Donnee_recueManager.getList(). donnee_recue trouvé...<br>");}
    	}

    	return $donnee_recues;
	}

	public function getListByCapteur($type_capteur)
	//retourne la liste de tous les donnee_recues
	{
      	if($this->_debug){print("...Donnee_recueManager.getListByCapteur()...<br>");}
		$donnee_recues = [];

    	$q = $this->_db->prepare('SELECT id,date_recep,type_capteur,valeur FROM donnee_recue WHERE type_capteur='.$type_capteur);
    	$q->execute();

    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$donnee_recues[] = new Donnee_recue($donnees);
	      	if($this->_debug){print("...Donnee_recueManager.getListByCapteur(). donnee_recue trouvée...<br>");}
    	}

    	return $donnee_recues;
	}

	public function getListByTypeNumeroDate($type_capteur,$numero_capteur, $date_recep)
	//retourne la liste de tous les donnee_recues
	{
      	if($this->_debug){print("...Donnee_recueManager.getListByTypeNumeroDate()...<br>");}
		$donnee_recues = [];

    	$q = $this->_db->prepare('SELECT id,numero_capteur,date_recep,type_capteur FROM donnee_recue WHERE type_capteur=:type_capteur AND numero_capteur=:numero_capteur AND date_recep=:date_recep');
    	$q->bindValue(':type_capteur',$type_capteur);
    	$q->bindValue(':numero_capteur',$numero_capteur);
    	$q->bindValue(':date_recep',$date_recep);
		$q->execute();

    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$donnee_recues[] = new Donnee_recue($donnees);
	      	if($this->_debug){print("...Donnee_recueManager.getListByTypeNumeroDate(). donnee_recue trouvée...<br>");}
    	}

    	return $donnee_recues;
	}
	public function getDateNomValeurUniteListbyNom($nom)
	//retourne la liste de tous les donnee_recues
	{
      	if($this->_debug){print("...Donnee_recueManager.getDateNomValeurUnite()...<br>");}
		$donnee_recues = [];


    // requete SELECT capteur.type,capteur.unite,donnee_recue.valeur,donnee_recue.date_recep FROM capteur,donnee_recue WHERE capteur.numero=donnee_recue.type_capteur

    	//$q = $this->_db->prepare('SELECT capteur.type, capteur.unite, donnee_recue.valeur, donnee_recue.date_recep FROM capteur, donnee_recue WHERE capteur.numero=donnee_recue.type_capteur);

    	$q=$this->_db->prepare('SELECT capteur.nom,capteur.type,capteur.unite,donnee_recue.valeur,donnee_recue.date_recep FROM capteur, donnee_recue WHERE capteur.numero=donnee_recue.type_capteur AND nom=:nom ');
    	$q->bindValue(':nom',$nom);
		$q->execute();
 	    if($this->_debug){print("<br>...Donnee_recueManager.getDateNomValeurUnite(). Requete executee<br>");}

    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$donnee_recues[] = $donnees;
	      	//if($this->_debug){print("...Donnee_recueManager.getDateNomValeurUnite(). donnee_recue trouvée...date=".$donnees[date_recep]."<br>");}
	      	if($this->_debug){print("<br>");print_r($donnees);}

    	}
    	if($this->_debug){print("<br>...Donnee_recueManager.getDateNomValeurUnite(). Boucle de lecture terminee<br>");}

    	return $donnee_recues;
	}




	public function getDateNomValeurUnite()
	//retourne la liste de tous les donnee_recues
	{
      	if($this->_debug){print("...Donnee_recueManager.getDateNomValeurUnite()...<br>");}
		$donnee_recues = [];


    // requete SELECT capteur.type,capteur.unite,donnee_recue.valeur,donnee_recue.date_recep FROM capteur,donnee_recue WHERE capteur.numero=donnee_recue.type_capteur

    	//$q = $this->_db->prepare('SELECT capteur.type, capteur.unite, donnee_recue.valeur, donnee_recue.date_recep FROM capteur, donnee_recue WHERE capteur.numero=donnee_recue.type_capteur);

    	$q=$this->_db->query('SELECT capteur.nom,capteur.type,capteur.unite,donnee_recue.valeur,donnee_recue.date_recep FROM capteur, donnee_recue WHERE capteur.numero=donnee_recue.type_capteur');
		$q->execute();
 	    if($this->_debug){print("<br>...Donnee_recueManager.getDateNomValeurUnite(). Requete executee<br>");}

    	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    	{
      		$donnee_recues[] = $donnees;
	      	//if($this->_debug){print("...Donnee_recueManager.getDateNomValeurUnite(). donnee_recue trouvée...date=".$donnees[date_recep]."<br>");}
	      	if($this->_debug){print("<br>");print_r($donnees);}

    	}
    	if($this->_debug){print("<br>...Donnee_recueManager.getDateNomValeurUnite(). Boucle de lecture terminee<br>");}

    	return $donnee_recues;
	}


	public function setDb(PDO $db)
	{
		$this->_db=$db;
	}

}
?>
