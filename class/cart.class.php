<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

/**
* \file cart.class.php
* \author Beddiaf Mehdi
* \brief Classe Panier
*
* \class Cart
*/

class Cart
{
	private $m_IDArticle; // ID de l'article
	private $m_QuantityOrder = array(); // Quantité commandée 
	private $m_Articles = array(); // nom de l'article

	/**
	* \fn public function getArticles()
	* \author Beddiaf Mehdi
	* \brief getter article
	*
	* \return libéllé de l'article
	*/
	
    public function getArticles()
    {
        return array('articles'=>$this->m_Articles,'quantity'=>$this->m_QuantityOrder);
	
    }
	
    /**
	* \fn public function __construct()
	* \author Beddiaf Mehdi 
	* \brief Constructeur
	*/
	public function __construct()
	{
		if (!isset($_SESSION['cart']))
		{
			$_SESSION['cart']=array(); // tableau panier en variable de session
			$_SESSION['cart']['id_article'] = array(); 
			$_SESSION['cart']['qt_ordered'] = array();
			$_SESSION['cart']['locked'] = false;
		}
		$this->m_QuantityOrder = $_SESSION['cart']['qt_ordered'];
		foreach ($_SESSION['cart']['id_article'] as $id)
		{
			$this->m_Articles[] = new Article($id);
		}
		return true;
   }
	
	/**
	* \fn public function getLock()
	* \author Beddiaf Mehdi
	* \brief Vérifie l'état de verrouillage d'un panier
	*
	* \return True si vérouillé
	*/
	public function getLock()
	{
		// si tableau existe & verrou existe
		if(isset($_SESSION['cart']) && isset($_SESSION['cart']['locked']))
		{
			return $_SESSION['cart']['locked']; // on verouille
		}
		else
		{
			return false;
		}
	}
	
	/**
	* \fn public function delCart()
	* \author Beddiaf Mehdi
	* \brief Vide le panier
	*
	*/
	public function delCart()
	{
		// on vide le panier
		unset($_SESSION['cart']);
		$this->m_Articles = array();
		$this->m_QuantityOrder = array();
	}
	
	/**
	* \fn public function getNbArticle()
	* \author Beddiaf Mehdi
	* \brief compte le nombre d'article dans le panier
	*
	* \return le nombre d'article
	*/
	public function getNbArticle()
	{
		if(isset($_SESSION['cart']))
		{
			// compte le nombre d'article dans le panier
			return count($_SESSION['cart']['id_article']);
		}
		else
		{
			return 0;
		}
	}
	
	/**
	* \fn public function getTotalHT()
	* \author Beddiaf Mehdi
	* \brief compte le nombre d'article dans le panier
	*
	* \return le total ht 
	*/
	public function getTotalHT()
	{
		$sum = 0;
		foreach ($this->m_Articles as $key=>$article)
		{
			$sum += $this->m_QuantityOrder[$key] * $article->getPrice();
		}
		return $sum;
	}
	
	/**
	* \fn public function getTotalTTC()
	* \author Beddiaf Mehdi
	* \brief compte le nombre d'article dans le panier
	*
	* \return le total TTC par article
	*/
	public function getTotalTTC()
	{
		$sum = 0;
		foreach ($this->m_Articles as $key=>$article)
		{
			$sum += $this->m_QuantityOrder[$key] * $article->getPrice() * (100 + $this->m_Articles[$key]->getTVA())/100;
		}
		return $sum;
	}

	/**
	* \fn public function add($id, $qt)
	* \author Beddiaf Mehdi
	* \brief ajout d'un article
	*
	* \param $id id de l'article
	* \param $qt quantité commandé
	*
	*/
	public function add($id, $qt)
	{	
		if(isset($_SESSION['cart']) && !$this->getLock())
		{
			// On recherche la clé de l'aticle dans notre tableau panier
			$keyart = array_search($id, $_SESSION['cart']['id_article']);
			
			// si l'article existe dans notre panier, on ajoute uniquement la quantité
			if($keyart !== false)
			{
				$_SESSION['cart']['qt_ordered'][$keyart] += $qt;
			}
			// sinon c'est un nouveau produit
			else
			{
				$article = new Article($id);
				if($article->getID() != 0)
				{
					$_SESSION['cart']['id_article'][] = $id;
					$_SESSION['cart']['qt_ordered'][] = $qt;
					$this->m_Articles[] = $article;
				}
			}
			$this->m_QuantityOrder = $_SESSION['cart']['qt_ordered'];
		}
		else
		{
			return false;
		}
	}
	
	/**
	* \fn public function delArticle($id)
	* \author Beddiaf Mehdi
	* \brief Suppression d'un article
	*
	* \param $id id de l'article
	*
	*/
	public function delArticle($id)
	{
		if (isset($_SESSION['cart']) && !$this->getLock())
		{
			// Panier temporaire
			$tmp = array();
			$tmp['id_article'] = array();
			$tmp['qt_ordered'] = array();
			$tmp['locked']	   = $_SESSION['cart']['locked'];
			
			for( $i = 0; $i < count($_SESSION['cart']['id_article']); $i++)
			{
				if($_SESSION['cart']['id_article'][$i] !== $id)
				{
					array_push($tmp['id_article'],$_SESSION['cart']['id_article'][$i]);
					array_push($tmp['qt_ordered'],$_SESSION['cart']['qt_ordered'][$i]);
				}
			}
			// On remplace le panier par le panier temporaire
			$_SESSION['cart'] = $tmp;
			$this->m_QuantityOrder = $_SESSION['cart']['qt_ordered'];
			$this->m_Articles = array();
			foreach ($_SESSION['cart']['id_article'] as $id)
			{
				$this->m_Articles[] = new Article($id);
			}
			// On efface le panier temporaire
			unset($tmp);
		}
		else
		{
			return false;
		}
	}
	
	/**
	* \fn public function setQt($id, $qt)
	* \author Beddiaf Mehdi
	* \brief Modifie la quantité d'un article
	*
	* \param $id id de l'article
	* \param $qt quantité de l'article
	*
	*/
	public function setQt($id, $qt)
	{
		if(isset($_SESSION['cart']) && !$this->getLock())
		{
			// Si la quantité est positive, on modifie
			if ($qt > 0)
			{
				// On recherche la clé de l'aticle dans notre tableau panier
				$keyart = array_search($id, $_SESSION['cart']['id_article']);
			
				// si l'article existe dans notre panier, on ajoute uniquement la quantité
				if($keyart !== false)
				{
					$_SESSION['cart']['qt_ordered'][$keyart] = $qt;
					$this->m_QuantyOrder[$keyart] = $qt;
				}
			}
			else
			{
				$this->delArticle($id);
			}
		}
		else
		{
			return false;
		}
	}
	
	/**
	* \fn public function getDeliveryDate()
	* \author Beddiaf Mehdi
	* \brief valide le panier
	*
	* \return la date de livraison prévisionelle
	*
	*/
	public function getDeliveryDate()
	{
		foreach ($this->m_Articles as $key => $Article)
		{
			$Stock = $Article->getQuantityStock();
			$Qt_ord = $this->m_QuantityOrder[$key];
			
			if($Stock - $Qt_ord < 0)
			{
				return 3;
			}
		}
		return 1;
	}
	
	/**
	* \fn public function validate($id_membre, $adresse, $CP, $ville, $pays, $date_com = 0)
	* \author Beddiaf Mehdi
	* \brief valide le panier
	*
	*/
	public function validate($id_membre, $adresse, $CP, $City, $Country)
	{
		global $PDO;
		$date_com = time();
		// vérifie nombre article dans le panier > 0
		if( $this->getNbArticle() != 0)
		{
			$IDVille = 0;
			$IDPays = 0;
			$reqSelectVille = $PDO->prepare('SELECT id_ville FROM villes WHERE nom_ville LIKE :nom_ville');
			$reqSelectVille->bindValue(':nom_ville', $City);
			var_dump($City);
			$reqSelectVille->execute();
			if ($result = $reqSelectVille->fetch())
			{
				$IDVille = $result['id_ville'];// on recupere l'ID de la ville
			}
			else
			{
				$reqSelectPays = $PDO->prepare('SELECT id_pays FROM pays WHERE nom_pays LIKE :nom_pays');
				$reqSelectPays->bindValue(':nom_pays', $Country );
				var_dump($Country);
				$reqSelectPays->execute();
				if ($result = $reqSelectPays->fetch())
				{
					$IDPays = $result['id_pays']; // on recupere l'ID pays
				}
				else // sinon on le crée
				{
					$req = $PDO->prepare('INSERT INTO pays SET nom_pays = :nom_pays'); 
					$req->bindValue(':nom_pays', $Country );
					var_dump($Country);
					$req->execute();
					$reqSelectPays->execute();
					if ($result = $reqSelectPays->fetch())
					{
						$IDPays=$result['id_pays'];
					}	
				}
				// on crée la ville
				$req = $PDO->prepare('INSERT INTO villes SET nom_ville = :nom_ville, cp_ville = :cp_ville, id_pays = :id_pays');
				$req->bindValue(':nom_ville', $City);
				var_dump($Country);
				$req->bindValue(':cp_ville', $CP);
				var_dump($CP);
				$req->bindValue(':id_pays', $IDPays);
				var_dump($IDPays);
				$req->execute();
				$reqSelectVille->execute();
				if ($result = $reqSelectVille->fetch())
				{
					$IDVille=$result['id_ville'];// on recupere l'ID de la ville
				}
			}
			
			// requete de création d'une commande
			$reqCom = $PDO->prepare('INSERT INTO commandes
									SET date_commande = :date_commande,
									adresse_facturation = :adresse_facturation,
									id_ville = :id_ville,
									id_membre = :id_membre');
			$reqCom->bindValue(':date_commande', $date_com);
			var_dump($date_com);
			$reqCom->bindValue(':adresse_facturation', $adresse);
			var_dump($adresse);
			$reqCom->bindValue(':id_ville', $IDVille);
			var_dump($IDVille);
			$reqCom->bindValue(':id_membre', $id_membre);
			var_dump($id_membre);
            $reqCom->execute();

			//recupere l'id commande
			$IDcom = 0;
			$reqIDcom = $PDO->prepare('SELECT id_commande FROM commandes WHERE id_membre = :id_membre AND date_commande = :date_commande');
			$reqIDcom->bindValue(':id_membre', $id_membre);
			var_dump($id_membre);
			$reqIDcom->bindValue(':date_commande', $date_com);
			var_dump($date_com);
			$reqIDcom->execute();
			if ($result = $reqIDcom->fetch())
				{
					$IDcom = $result['id_commande']; // on recupere l'ID commande
				}
			
			//Pour chaque article du panier, on insére dans articles_commandes et on soustrait dans stock
			$prix_unit_Ht = 0;
			$TVA = 0;
			$Id_art = 0;
			$Qt_ord = 0;
			foreach ($this->m_Articles as $key => $Article)
			{
				$prix_unit_Ht = $Article->getPrice();
				$TVA = $Article->getTVA();
				$Qt_ord = $this->m_QuantityOrder[$key];
				$Id_art = $Article->getID();
				
				// Requete d'écriture dans articles_commandes
				$reqArtCom = $PDO->prepare('INSERT INTO articles_commandes 
											SET prix_unitaire_ht = :prix_unitaire_HT, 
											qte_commande = :qte_commande,
											TVA = :TVA,
											id_commande = :id_commande,
											id_article = :id_article');
				$reqArtCom->bindValue(':prix_unitaire_HT', $prix_unit_Ht);
				var_dump($prix_unit_Ht);
				$reqArtCom->bindValue(':qte_commande', $Qt_ord);
				var_dump( $Qt_ord);
				$reqArtCom->bindValue(':TVA', $TVA);
				var_dump($TVA);
				$reqArtCom->bindValue(':id_commande', $IDcom);
				var_dump( $IDcom);
				$reqArtCom->bindValue(':id_article',$Id_art);
				var_dump($Id_art);
				$reqArtCom->execute();
				
				$Stock = $Article->getQuantityStock();
				$UpdateStock = $Stock - $Qt_ord;
				
				// Requete de MAJ du stock dans la table articles
				$reqArtStock = $PDO->prepare('UPDATE articles
												SET quantite_stock = :quantite_stock');
				$reqArtStock->bindValue(':quantite_stock', $UpdateStock);
				var_dump($UpdateStock);
				$reqArtStock->execute();
				
			}
			$this->delCart();
			return true;			
		}
		return false;
	}
}

?>