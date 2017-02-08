<?php

class Utilisateur
{
	private $_debug=false;
	private $_id;
	private $_pseudo;
	private $_nom;
	private $_prenom;
	private $_date_naissance;
	private $_rue;
	private $_numero_rue;
	private $_ville;
	private $_code_postal;
	private $_telephone;
	private $_mail;
	private $_password;

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
   			if($this->_debug)print("   each=" .$method ." <br>");
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
	public function pseudo() { return $this->_pseudo; }
	public function nom() { return $this->_nom; }
	public function prenom() { return $this->_prenom; }
	public function date_naissance() { return $this->_date_naissance; }
	public function rue() { return $this->_rue; }
	public function numero_rue() { return $this->_numero_rue; }
	public function ville() { return $this->_ville; }
	public function code_postal() { return $this->_code_postal; }
	public function telephone() { return $this->_telephone; }
	public function mail() { return $this->_mail; }
	public function password() { return $this->_password; }

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
	public function setPseudo($param)
	{
		if (is_string($param))
		{
			$this->_pseudo= htmlspecialchars($param);
		}
	}
	public function setNom($param)
	{
		if (is_string($param))
		{
			$this->_nom= htmlspecialchars($param);
		}
	}
	public function setPrenom($param)
	{
		if (is_string($param))
		{
			$this->_prenom= htmlspecialchars($param);
		}
	}
	public function setDate_naissance($param)
	{
		if (is_string($param))
		{
			$this->_date_naissance= htmlspecialchars($param);
		}
	}
	public function setRue($param)
	{
		if (is_string($param))
		{
			$this->_rue= htmlspecialchars($param);
		}
	}
	public function setNumero_rue($param)
	{
		if (is_string($param))
		{
			$this->_numero_rue= htmlspecialchars($param);
		}
	}
	public function setVille($param)
	{
		if (is_string($param))
		{
			$this->_ville= htmlspecialchars($param);
		}
	}
	public function setCode_postal($param)
	{
		if (is_string($param))
		{
			$this->_code_postal= htmlspecialchars($param);
		}
	}
	public function setTelephone($param)
	{
		if (is_string($param))
		{
			$this->_telephone= htmlspecialchars($param);
		}
	}
	public function setMail($param)
	{
		if (is_string($param))
		{
			$this->_mail= htmlspecialchars($param);
		}
	}
	public function setPassword($param)
	{
		if (is_string($param))
		{
			$this->_password= htmlspecialchars(md5($param));
		}
	}

	public function is_integre() {
		// Resumé des verifications des contraintes d'intégrités
		// - aucun champ ne doit être vide
		if (empty($this->pseudo()) OR empty($this->nom())  OR empty($this->prenom())  OR empty($this->date_naissance())  OR empty($this->rue())  OR empty($this->numero_rue())  OR empty($this->ville())  OR empty($this->code_postal())  OR empty($this->telephone())  OR empty($this->mail()))
		{
			if($this->_debug)print ("<br>..Au moins un attribut est vide erreur!");
			return false;
		}
		// - l unicité du pseudo est gérée par la base (cf: ADD UNIQUE KEY `pseudo` (`pseudo`);)
		// - la date doit être une date au format  aaa/mm/jj
		list($year,$month,$day)=explode("-",$this->date_naissance());
		if(!checkdate($month,$day,$year))
		{
			if($this->_debug)print ("<br>...date invalide!");
			return false;
 		}
		// - le numero de tel doit etre numero de telephone
		// Verifie que la chaine de caractère est un entier
		if (!ctype_digit($this->telephone()))
		{
			if($this->_debug)print ("<br>...le numero de telephone est invalide!");
			return false;
 		}
		// - la mail doit être un mail
		if (!filter_var($this->mail(), FILTER_VALIDATE_EMAIL))
		{
			if($this->_debug)print ("<br>...le mail est invalide!");
			return false;
		}
		// - le numero de rue doit être un numero
		if (!ctype_digit($this->numero_rue()))
		{
			if($this->_debug)print ("<br>...le numero de rue est invalide!");
			return false;
 		}
		// - idem pour le code postal
		if (!ctype_digit($this->code_postal()))
		{
			if($this->_debug)print ("<br>...le code postal est invalide!");
			return false;
 		}
 		return true;
	}
	// ==============================================
	// Fonction utilitaire d'affichage de l'objet
	public function affiche() {
		print(" id=" . $this->id() );
		print(" pseudo=" . $this->pseudo() );
		print(" nom=" . $this->nom() );
		print(" prenom=" . $this->prenom() );
		print(" date_naissance=" . $this->date_naissance() );
		print(" rue=" . $this->rue() );
		print(" numero_rue=" . $this->numero_rue() );
		print(" ville=" . $this->ville() );
		print(" code_postal=" . $this->code_postal() );
		print(" telephone=" . $this->telephone() );
		print(" mail=" . $this->mail() );
		print(" password=" . $this->password() );
		print("<br>");
	}
}
