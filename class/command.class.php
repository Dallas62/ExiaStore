<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

/**
* \file FichierPHPType.class.php
* \author Beddiaf Mehdi 
* \brief Descritpion de la classe de test
*
* \class Test
*/

class Command
{
	private $m_ID; //ID de la commande
	private $m_Date; //Date de la commande
	private $m_Address; //Adresse de facturation
	private $m_City; //Adresse de facturation
	private $m_CP; //Adresse de facturation
	private $m_Country; //Adresse de facturation
	protected $m_State; //Etat actuel de la commande
	protected $m_DeliveryDate; //Date de livraison
	private $m_Member; //Membre qui à passer la commande: ID
	private $m_MemberName; //Membre qui à passer la commande: nom prenom
	private $m_Articles; //nom des articles
	
	
	/**
	* \fn public function __construct()
	* \author Beddiaf Mehdi 
	* \brief Constructeur
	*/
	public function __construct( $ID )
	{
	    global $PDO;
		if( $ID > 0 )
        {
            $req = $PDO->prepare('SELECT id_commande, date_commande, adresse_facturation, etat_commande, date_livraison, id_membre,villes.nom_ville, villes.cp_ville, pays.nom_pays 
								  FROM commandes INNER JOIN villes ON commandes.id_ville=villes.id_ville INNER JOIN pays ON villes.id_pays=pays.id_pays
								  WHERE id_commande = :id');
            $req->bindValue(':id', $ID, PDO::PARAM_INT);
            $req->execute();
            if($result = $req->fetch())
            {
				$this->m_ID				= $result['id_commande'];
                $this->m_Date 			= $result['date_commande'];
				$this->m_Address 		= $result['adresse_facturation'];
				$this->m_State			= $result['etat_commande'];
				$this->m_DeliveryDate	= $result['date_livraison'];
				$this->m_Member			= $result['id_membre'];
				$this->m_City 			= $result['nom_ville'];
				$this->m_CP				= $result['cp_ville'];
				$this->m_Country 		= $result['nom_pays'];
            }
			
			$req = $PDO->prepare('SELECT nom_membre, prenom_membre
								  FROM membres
								  WHERE id_membre = :id');
            $req->bindValue(':id', $this->m_Member, PDO::PARAM_INT);
            $req->execute();
            if($result = $req->fetch())
            {
                $this->m_MemberName	= $result['nom_membre'].' '.$result['prenom_membre'];
            }
        }
		
		$req = $PDO->prepare('SELECT prix_unitaire_ht, qte_commande, TVA, articles.nom_article, articles.reference
								  FROM articles_commandes INNER JOIN articles ON articles_commandes.id_article = articles.id_article
								  WHERE id_commande = :id');
        $req->bindValue(':id', $ID, PDO::PARAM_INT);
        $req->execute();
		$this->m_Articles = array(); // m_articles va contenir la liste des articles avec leur nom, quantité, TVA et prix unitaire
		$i = 0;
        while($result = $req->fetch())
        {
            $this->m_Articles[$i]['name'] 		= $result['nom_article'];
			$this->m_Articles[$i]['ref']		= $result['reference'];
			$this->m_Articles[$i]['price'] 		= $result['prix_unitaire_ht'];
			$this->m_Articles[$i]['quantity'] 	= $result['qte_commande'];
			$this->m_Articles[$i]['TVA']		= $result['TVA'];
			$i ++;
        }
	}	
	
	/**
	* \fn public function getID()
	* \author Beddiaf Mehdi
	* \brief getter ID
	*
	* \return ID de la commande
	*/
    public function getID()
    {
        return $this->m_ID;
    }
	
	/**
	*\fn public function getMemberName()
	*\author Beddiaf Mehdi
	*\brief getter Member Name
	*
	*\return Nom et prenom du client
	*/
	public function getMemberName()
	{
		return htmlentities($this->m_MemberName);
	}
	
	/**
	* \fn public function getDate()
	* \author Beddiaf Mehdi
	* \brief getter Date
	*
	* \return Date de commande
	*/
    public function getDate()
    {
        return $this->m_Date;
    }

	/**
	* \fn public function getAddress()
	* \author Beddiaf Mehdi
	* \brief getter Address
	*
	* \return Adresse de commande
	*/
    public function getAddress()
    {
        return htmlentities($this->m_Address);
    }	
	
	/**
	* \fn public function getCP()
	* \author Beddiaf Mehdi
	* \brief getter CP
	*
	* \return Code postal de l'adresse de commande
	*/
    public function getCP()
    {
        return $this->m_CP;
    }

	/**
	* \fn public function getCity()
	* \author Beddiaf Mehdi
	* \brief getter City
	*
	* \return la ville de l'adresse de commande
	*/
    public function getCity()
    {
        return htmlentities($this->m_City);
    }	
	
	/**
	* \fn public function getCountry()
	* \author Beddiaf Mehdi
	* \brief getter Country
	*
	* \return le pays de l'adresse de commande
	*/
    public function getCountry()
    {
        return htmlentities($this->m_Country);
    }
	
	/**
	* \fn public function getStateWord()
	* \author Beddiaf Mehdi
	* \brief getter State affichant le mot de l'etat (en préparation, ...)
	*
	* \return état de commande en texte
	*/
    public function getStateWord()
    {
        
		if( $this->m_State == 0)
		{
			return "en pr&eacute;paration";
		}
		if( $this->m_State == 1)
		{
			return "pr&#234te";
		}
		else
		{
			return "envoy&eacute;e";
		}
    }

	/**
	* \fn public function getState()
	* \author Beddiaf Mehdi
	* \brief getter State
	*
	* \return état de commande
	*/	
	public function getState()
    {
        return $this->m_State;
    }
	
	/**
	* \fn public function getDeliveryDate()
	* \author Beddiaf Mehdi
	* \brief getter DeliveryDate
	*
	* \return Date de réception commande
	*/
	
    public function getDeliveryDate()
    {
        return $this->m_DeliveryDate;
    }

	/**
	* \fn public function getArticles()
	* \author Beddiaf Mehdi
	* \brief getter Articles
	*
	* \return Articles de la commande, en tableau[x][] (x allant de 0 à n-1 articles) (avec []['name'], []['ref'], []['price'], []['quantity'], []['TVA']) 
	*/
	public function getArticlesList()
	{
		return  $this->m_Articles;
	}
	
	
	/**
	* \fn public function getTotalHT() 
	* \author Beddiaf Mehdi
	* \brief methode de calcul du total HT
	*
	* \return total HT de la commande
	*/
	public function getTotalHT()
	{
		$sum =0;
		
		foreach( $this->m_Articles as $value)
		{
			$sum += $value['quantity'] * $value['price'];
		}
		
		return $sum;
	}
    
	/**
	* \fn public function getTotalTTC() 
	* \author Beddiaf Mehdi
	* \brief methode de calcul du total TTC
	*
	* \return total TTC de la commande
	*/
	public function getTotalTTC()
	{
		$sum =0;
		
		foreach( $this->m_Articles as $value)
		{
			$sum += $value['quantity'] * $value['price'] *  ( 1 + ($value['TVA'] / 100) );
		}
		
		return $sum;
	}
}

?>
