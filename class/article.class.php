<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

/**
* \file article.class.php
* \author Beddiaf Mehdi
* \brief Classe d'un article
*
* \class Article
*/

class Article
{
    protected $m_ID             = 0; //Identifiant de l'article
    protected $m_Name           = ''; //Nom de l'article
    protected $m_Reference      = ''; //Référence de l'article
    protected $m_IDCategory     = 0; //Identifiant de la categorie
    protected $m_Category       = ''; //Catégorie
    protected $m_IDSubCategory  = 0; //Identifiant de la categorie
    protected $m_SubCategory    = ''; //Sous catégorie
    protected $m_ParutionDate; //Date de sortie
    protected $m_QuantityStock  = 0; //Quantité en stock
    protected $m_Price          = 0; //Prix de l'article
    protected $m_TVA            = 0; //TVA appliquée
    protected $m_Available      = false; //Disponibilité
    protected $m_Description    = ''; //Description de l'article
    protected $m_Authors        = array(); //Liste des auteurs/Réalisateurs
    protected $m_HTMLAuthors    = array(); //Liste des auteurs/Réalisateurs sécurisée
    protected $m_Actors         = array(); //Liste des acteurs
    protected $m_HTMLActors     = array(); //Liste des acteurs sécurisée
    protected $m_KeyWords       = array(); //Mots clés
	protected $m_QuantityAlert  = 0;
    
    /**
	* \fn public function getID()
	* \author Beddiaf Mehdi
	* \brief Getter de l'identifiant
	*
	* \return L'identifiant
	*/
    public function getID()
    {
        return $this->m_ID;
    }
    
    /**
	* \fn public function getName()
	* \author Beddiaf Mehdi
	* \brief Getter du nom
	*
	* \return Le nom
	*/
    public function getName()
    {
        return $this->m_Name;
    }
    
    /**
	* \fn public function getHTMLName()
	* \author Beddiaf Mehdi
	* \brief Getter du nom sécurisé
	*
	* \return Le nom sécurisé
	*/
    public function getHTMLName()
    {
        return htmlentities($this->m_Name);
    }
    
    /**
	* \fn public function getReference()
	* \author Beddiaf Mehdi
	* \brief Getter de la référence
	*
	* \return La référence
	*/
    public function getReference()
    {
        return $this->m_Reference;
    }
    
    /**
	* \fn public function getHTMLReference()
	* \author Beddiaf Mehdi
	* \brief Getter de la référence sécurisée
	*
	* \return La référence sécurisée
	*/
    public function getHTMLReference()
    {
        return htmlentities($this->m_Reference);
    }
    
    /**
	* \fn public function getDescription()
	* \author Beddiaf Mehdi
	* \brief Getter de la description
	*
	* \return La description
	*/
    public function getDescription()
    {
        return $this->m_Description;
    }
    
    /**
	* \fn public function getHTMLDescription()
	* \author Beddiaf Mehdi
	* \brief Getter de la description sécurisée
	*
	* \return La description sécurisée
	*/
    public function getHTMLDescription()
    {
        return htmlentities($this->m_Description);
    }
    
    /**
	* \fn public function getParutionDate()
	* \author Beddiaf Mehdi
	* \brief Getter la date de parution
	*
	* \return La date de parution en timestamp
	*/
    public function getParutionDate()
    {
        return $this->m_ParutionDate;
    }
    
    /**
	* \fn public function getQuantityStock()
	* \author Beddiaf Mehdi
	* \brief Getter de la quantité restante
	*
	* \return La quantité restante
	*/
    public function getQuantityStock()
    {
        return $this->m_QuantityStock;
    }
    
    /**
	* \fn public function getPrice()
	* \author Beddiaf Mehdi
	* \brief Getter du prix
	*
	* \return Le prix
	*/
    public function getPrice()
    {
        return $this->m_Price;
    }
    
    /**
	* \fn public function getTVA()
	* \author Beddiaf Mehdi
	* \brief Getter de la TVA
	*
	* \return La TVA
	*/
    public function getTVA()
    {
        return $this->m_TVA;
    }
    
    /**
	* \fn public function getAvailable()
	* \author Beddiaf Mehdi
	* \brief Getter de la disponibilité
	*
	* \return La disponibilité
	*/
    public function getAvailable()
    {
        return $this->m_Available;
    }
    
    /**
	* \fn public function getCategory()
	* \author Beddiaf Mehdi
	* \brief Getter de la catégorie
	*
	* \return La catégorie
	*/
    public function getGategory()
    {
        return $this->m_Category;
    }
    
    /**
	* \fn public function getIDCategory()
	* \author Beddiaf Mehdi
	* \brief Getter de l'identifiant de la catégorie
	*
	* \return L'identifiant de la catégorie
	*/
    public function getIDGategory()
    {
        return $this->m_IDCategory;
    }
    
    /**
	* \fn public function getSubCategory()
	* \author Beddiaf Mehdi
	* \brief Getter de la sous-catégorie
	*
	* \return La sous-catégorie
	*/
    public function getSubGategory()
    {
        return $this->m_SubCategory;
    }
    
    /**
	* \fn public function getIDSubCategory()
	* \author Beddiaf Mehdi
	* \brief Getter de l'identifiant de la sous-catégorie
	*
	* \return L'identifiant de la sous-catégorie
	*/
    public function getIDSubGategory()
    {
        return $this->m_IDSubCategory;
    }
    
    /**
	* \fn public function getKeyWords()
	* \author Beddiaf Mehdi
	* \brief Getter des mots clés
	*
	* \return La liste de mots clés
	*/
    public function getKeyWords()
    {
        return $this->m_Category;
    }
    
    /**
	* \fn public function getAuthors()
	* \author Beddiaf Mehdi
	* \brief Getter des Auteurs
	*
	* \return La liste des auteurs
	*/
    public function getAuthors()
    {
        return $this->m_Authors;
    }
    
    /**
	* \fn public function getHTMLAuthors()
	* \author Beddiaf Mehdi
	* \brief Getter des Auteurs sécurisée
	*
	* \return La liste des auteurs sécurisée
	*/
    public function getHTMLAuthors()
    {
        return $this->m_HTMLAuthors;
    }
    
    /**
	* \fn public function getActors()
	* \author Beddiaf Mehdi
	* \brief Getter des acteurs
	*
	* \return La liste des acteurs
	*/
    public function getActors()
    {
        return $this->m_Actors;
    }
    
    /**
	* \fn public function getHTMLActors()
	* \author Beddiaf Mehdi
	* \brief Getter des acteurs sécurisée
	*
	* \return La liste des acteurs sécurisée
	*/
    public function getHTMLActors()
    {
        return $this->m_HTMLActors;
    }

		
	/**
	* \fn public function getStockToCommand()
	* \author Beddiaf Mehdi
	* \brief get les stocks à commander
	*
	* \return stocks à commander
	*/
	public function getStockToCommand()
	{
		$stocks;
		
		if($this->m_Available == 0)
		{
			$stocks = $this->m_QuantityAlert * 3;
			if($this->m_QuantityStock < 0)
			{
				$stocks += -1 * $this->m_QuantityStock;
			}
		}
		elseif($this->m_Available == 1)
		{
			$stocks = $this->m_QuantityAlert * 2;
			if($this->m_QuantityStock < 0)
			{
				$stocks += -1 * $this->m_QuantityStock;
			}
		}
		return $stocks;
	}
	
	
    /**
	* \fn public function __construct($ID)
	* \author Beddiaf Mehdi
	* \brief Constructeur de la classe Article
	*
	* Charge les informations d' un article
	*
	* \param $ID L'identifiant de l'article
	*/
	public function __construct($ID)
	{
	    global $PDO;
	    //Recupération de l'article
	    $req = $PDO->prepare('SELECT articles.*, sous_categories.*, categories.*
	                            FROM articles
	                                INNER JOIN sous_categories ON articles.id_sous_categorie = sous_categories.id_sous_categorie
	                                INNER JOIN categories ON sous_categories.id_categorie = categories.id_categorie
	                            WHERE articles.id_article = :id AND disponibilite < 3');
	    $req->bindValue(':id', $ID, PDO::PARAM_INT);
	    $req->execute();
	    if($result = $req->fetch())
	    {
	        //Récupération des auteurs
	        $reqAuthors = $PDO->prepare('SELECT auteurs.*
	                            FROM creer INNER JOIN auteurs ON auteurs.id_auteur = creer.id_auteur
	                            WHERE creer.id_article = :id');
	        $reqAuthors->bindValue(':id', $ID, PDO::PARAM_INT);
	        $reqAuthors->execute();
	        $this->m_Authors = $reqAuthors->fetchAll();
	        foreach($this->m_Authors as $author)
	            $this->m_HTMLAuthors[] = htmlentities(ucwords($author['nom_auteur'].' '.$author['prenom_auteur']));
	        
	        //Récupération des acteurs
	        $reqActors = $PDO->prepare('SELECT acteurs.*
	                            FROM jouer INNER JOIN acteurs ON acteurs.id_acteur = jouer.id_acteur
	                            WHERE jouer.id_article = :id');
	        $reqActors->bindValue(':id', $ID, PDO::PARAM_INT);
	        $reqActors->execute();
	        $this->m_Actors = $reqActors->fetchAll();
	        foreach($this->m_Actors as $actor)
	            $this->m_HTMLActors[] = htmlentities(ucwords($actor['nom_acteur'].' '.$actor['prenom_acteur']));
	        
	        //Récupération des acteurs
	        $reqKeyWords = $PDO->prepare('SELECT mots_cles.*
	                            FROM referer INNER JOIN referer.id_mot_cle = jouer.id_acteur
	                            WHERE jouer.id_article = :id');
	        $reqKeyWords->bindValue(':id', $ID, PDO::PARAM_INT);
	        $reqKeyWords->execute();
	        $this->m_KeyWords = $reqKeyWords->fetchAll();
	        
	        //On stock les infos
	        $this->m_ID             = $ID;
	        $this->m_Name           = $result['nom_article'];
	        $this->m_Reference      = $result['reference'];
	        $this->m_ParutionDate   = $result['date_sortie'];
	        $this->m_QuantityStock  = $result['quantite_stock'];
	        $this->m_Price          = $result['prix'];
	        $this->m_TVA            = $result['TVA_article'];
	        $this->m_Description    = $result['description'];
	        $this->m_Available      = $result['disponibilite'];
	        $this->m_IDSubCategory  = $result['id_sous_categorie'];
	        $this->m_SubCategory    = $result['nom_sous_categorie'];
	        $this->m_IDCategory     = $result['id_categorie'];
	        $this->m_Category       = $result['nom_categorie'];
	        $this->m_QuantityAlert  = $result['quantite_seuil'];
	    }
	}	
}

?>
