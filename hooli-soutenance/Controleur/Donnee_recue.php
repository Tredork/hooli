<?php

class Donnee_recue
{
	private $_debug=false;
	private $_id;
	private $_trame;
	private $_requete;
	private $_type_capteur;
	private $_numero_capteur;
	private $_valeur;
	private $_tim;
	private $_chk;
	private $_date_recep;


	// ==============================================
	// Constructeur de l'objet
	public function __construct(array $donnees)
  	{
    	if($this->_debug){print("Donnee_recue construct...<br>");}
    	$this->_id=(int)0;
    	$this->hydrate($donnees);
  	}

	// ==============================================
	// hydratation de l'objet (assignation des variables)
	public function hydrate(array $donnees)
	{
    	if($this->_debug)print("hydrate...<br>");
		foreach ($donnees as $key => $value) {
 			$method = 'set'.ucfirst($key);
   			if($this->_debug)print("   each=" .$method . "=". $value . " <br>");
			if (method_exists($this, $method))
			{
				$this->$method($value);
    			if($this->_debug)print("   init...<br>");
			}
		}
	}
	// ==============================================
	// Fonctions de lecture des attributs de l'objet
	public function id() { return $this->_id; }
	public function trame() { return $this->_trame; }
	public function objet() { return $this->_objet; }
	public function requete() { return $this->_requete; }
	public function type_capteur() { return $this->_type_capteur; }
	public function numero_capteur() { return $this->_numero_capteur; }
	public function valeur() { return $this->_valeur; }
	public function tim() { return $this->_tim; }
	public function chk() { return $this->_chk; }
	public function date_recep() { return $this->_date_recep; }



	// ==============================================
	// Fonctions d'écriture des attributs de l'objet
	// (avec vérification éventuelle des contraintes d'intégrité)
	public function setId($id)
	{
		$id= (int)$id;
		if ($id>0)
		{
			$this->_id = $id;
		}
	}
	public function setTrame($param)
	{
		if (is_string($param))
		{
			$this->_trame= $param;
		}
	}
		public function setObjet($param)
	{
		if (is_string($param))
		{
			$this->_objet= $param;
		}
	}
		public function setRequete($param)
	{
		if (is_string($param))
		{
			$this->_requete= $param;
		}
	}

		public function setType_capteur($param)
	{
		if (is_string($param))
		{
			$this->_type_capteur= $param;
		}
	}
			public function setNumero_capteur($param)
	{
		if (is_string($param))
		{
			$this->_numero_capteur= $param;
		}
	}

	public function setValeur($param)
	{
		if (is_string($param))
		{
			$this->_valeur= $param;
		}
	}

	public function setTim($param)
	{
		if (is_string($param))
		{
			$this->_tim= $param;
		}
	}
	public function setChk($param)
	{
		if (is_string($param))
		{
			$this->_chk= $param;
		}
	}
	public function setDate_recep($param)
	{

		if (is_string($param))
		{
			$this->_date_recep= $param;
		}
	}


	public function is_integre()
	{
		if($this->_debug)print("<br>is_integre...");

		if (empty($this->date_recep()) OR empty($this->type_capteur()) OR empty($this->valeur()))
		{
			if($this->_debug)print ("<br>..Au moins un attribut est vide erreur!");
			return false;
		}
		if($this->_debug)print ("...is_integre fin true");
		return true;
	}

	public function is_unique()
	{
		if($this->_debug)print("<br>is_unique...");

		if (getAttribute(empty($this->date_recep())) AND getAttribute(empty($this->numero_capteur())))
		{
			if($this->_debug)print ("<br>..Au moins un element avec la meme date et le meme numero de capteur existe deja en base : erreur!");
			return false;
		}
		return true;
	}





	// ==============================================
	// Fonction utilitaire d'affichage de l'objet
	public function affiche() {
		if($this->_debug)print ("<br>Affiche()...");

		print(" id=" . $this->id() );
		print(" trame=" . $this->trame() );
		print(" requete=" . $this->requete() );
		print(" type_capteur=" . $this->type_capteur() );
		print(" numero_capteur=" . $this->numero_capteur() );
		print(" valeur=" . $this->valeur() );
		print(" tim=" . $this->tim() );
		print(" chk=" . $this->chk() );
		print(" date_recep=" . $this->date_recep() );
		print("<br>");
	}
}
