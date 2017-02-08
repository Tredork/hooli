<?php

class Capteur
{
	private $_debug=false;
	private $_id;
	private $_type;
	private $_nom;
	private $_numero;
	private $_unite;


	// ==============================================
	// Constructeur de l'objet
	public function __construct(array $donnees)
  	{
    	if($this->_debug){print("construct...<br>");}
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
	public function type() { return $this->_type; }
	public function nom() { return $this->_nom; }
	public function numero() { return $this->_numero; }
	public function unite() { return $this->_unite; }

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
	public function setType($param)
	{
		if (is_string($param))
		{
			$this->_type= $param;
		}
	}
	public function setNom($param)
	{
		if (is_string($param))
		{
			$this->_nom= $param;
		}
	}
	public function setNumero($param)
	{
		if (is_string($param))
		{
			$this->_numero= $param;
		}
	}
		public function setUnite($param)
	{
		if (is_string($param))
		{
			$this->_unite= $param;
		}
	}
	public function is_integre() {
		// Resumé des verifications des contraintes d'intégrités
		// - aucun champ ne doit être vide
		if (empty($this->type()) OR empty($this->numero()) OR empty($this->nom()))
		{
			if($this->_debug)print ("<br>..Au moins un attribut est vide erreur!");
			return false;
		}
 		return true;
	}


	// ==============================================
	// Fonction utilitaire d'affichage de l'objet
	public function affiche() {
		print(" id=" . $this->id() );
		print(" type=" . $this->type() );
		print(" nom=" . $this->nom() );
		print(" numero=" . $this->numero() );
		print(" unite=" . $this->unite() );
		print("<br>");
	}
}


?>
