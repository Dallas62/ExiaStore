<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

/**
* \file articleadmin.class.php
* \author Pouille Matthieu
* \brief Classe article côté administrateur pour l'ajout et la modification
*
* \class admin_article
*/

class ArticleAdmin extends Article
{

	public function __construct()
	{
	
	}
    /**
	* \fn public function add()
	* \author Pouille Matthieu 
	* \brief Ajouter un article
	*/
	public function add($Name, $Ref, $Category, $SubCategory, $ParutionDate, $QuantityStock, $QuantityLevel, $Price, $TVA, $Description, $author Pouille Matthieus, $Actors, $Keywords)
	{
		// Catégorie & Sous-catégorie
		global $PDO;
		$reqSelectID = $PDO->prepare('SELECT id_article FROM articles WHERE nom_article LIKE :nom_article');
		$reqSelectID->bindValue(':nom_article', $Name);
        $reqSelectID->execute();
        if($result = $reqSelectID->fetch())
        {
            return false;
        }
        else
        {
			$ID_Category = 0;
			$ID_SubCategory = 0;
			$reqSelectSubcat = $PDO->prepare('SELECT id_sous_categorie FROM sous_categories WHERE nom_sous_categorie LIKE :nom_sous_categorie');
			$reqSelectSubcat->bindValue(':nom_sous_categorie', $SubCategory);
			$reqSelectSubcat->execute();
			if ($result = $reqSelectSubcat->fetch())
			{
				$ID_SubCategory = $result['id_sous_categorie'];// on recupere l'ID de la sous-catégorie
			}
			else
			{
				$reqSelectCategory = $PDO->prepare('SELECT id_categorie FROM categories WHERE nom_categorie LIKE :nom_categorie');
				$reqSelectCategory->bindValue(':nom_categorie', $Category );
				$reqSelectCategory->execute();
				if ($result = $reqSelectCategory->fetch())
				{
					$ID_Category = $result['id_categorie'];
				}
				else
				{
					$req = $PDO->prepare('INSERT INTO categories SET nom_categorie = :nom_categorie');
					$req->bindValue(':nom_categorie', $Category );
					$req->execute();
					$reqSelectCategory->bindValue(':nom_categorie', $Category );
					$reqSelectCategory->execute();
					if ($result = $reqSelectCategory->fetch())
					{
						$ID_Category = $result['id_categorie'];
					}	
				}
				$reqSelectSubCat = $PDO->prepare('INSERT INTO sous_categories SET nom_sous_categorie = :nom_sous_categorie, id_categorie = :id_categorie');
				$reqSelectSubCat->bindValue(':nom_sous_categorie', $SubCategory);
				$reqSelectSubCat->bindValue(':id_categorie', $ID_Category);
				$reqSelectSubCat->execute();
				if ($result = $reqSelectSubCat->fetch())
				{
					$ID_SubCategory = $result['id_sous_categorie'];// on recupere l'ID de la sous_categorie
				}	
			}
			
			// Acteurs
			$ArrayActors = explode(',', $Actors);
			foreach($ArrayActors as $actor)
			{
				$NameFirstName = explode(' ', $actor);
				$NameActor = $NameFirstName[0];
				$FirstNameActor = $NameFirstName[1];
			
				$reqSelectActors = $PDO->prepare('SELECT id_acteur FROM acteurs WHERE nom_acteur LIKE :nom_acteur AND prenom_acteur LIKE :prenom_acteur');
				$reqSelectActors->bindValue(':nom_acteur', $NameActor);
				$reqSelectActors->bindValue(':prenom_acteur', $FirstNameActor);
				$reqSelectActors->execute();
				if(!($result = $reqSelectActors->fetch()))
				{
					$reqNewActor = $PDO->prepare('INSERT INTO acteurs SET nom_acteur = :nom_acteur, prenom_acteur = :prenom_acteur');
					$reqNewActor->bindvalue(':nom_acteur', $NameActor);
					$reqNewActor->bindvalue(':prenom_acteur', $FirstNameActor);
					$reqNewActor->execute();
				}
			}
			
			// Auteurs
			$Arrayauthor Pouille Matthieus = explode(',', $author Pouille Matthieus);
			foreach($Arrayauthor Pouille Matthieus as $author Pouille Matthieu)
			{
				$NameFirstName = explode(' ', $author Pouille Matthieu);
				$Nameauthor Pouille Matthieu = $NameFirstName[0];
				$FirstNameauthor Pouille Matthieu = $NameFirstName[1];
				$reqSelectauthor Pouille Matthieus = $PDO->prepare('SELECT id_auteur FROM auteurs WHERE nom_auteur LIKE :nom_auteur AND prenom_auteur LIKE :prenom_auteur');
				$reqSelectauthor Pouille Matthieus->bindValue(':nom_auteur', $Nameauthor Pouille Matthieu);
				$reqSelectauthor Pouille Matthieus->bindValue(':prenom_auteur', $FirstNameauthor Pouille Matthieu);
				$reqSelectauthor Pouille Matthieus->execute();
				if(!($result = $reqSelectauthor Pouille Matthieus->fetch()))
				{
					$reqNewauthor Pouille Matthieu = $PDO->prepare('INSERT INTO auteurs(nom_auteur, prenom_auteur) VALUES(:nom_auteur,:prenom_auteur)');
					$reqNewauthor Pouille Matthieu->bindvalue(':nom_auteur', $Nameauthor Pouille Matthieu);
					$reqNewauthor Pouille Matthieu->bindvalue(':prenom_auteur', $FirstNameauthor Pouille Matthieu);
					$reqNewauthor Pouille Matthieu->execute();
				}
			}
			// Mots-clefs
			$ArrayKeywords = explode(',', $Keywords);
			foreach($ArrayKeywords as $keyword)
			{			
				$reqSelectKW = $PDO->prepare('SELECT id_mot_cle FROM mots_cles WHERE mot_cle LIKE :mot_cle');
				$reqSelectKW->bindValue(':mot_cle', $keyword);
				$reqSelectKW->execute();
				if(!($result = $reqSelectKW->fetch()))
				{
					$reqNewKW = $PDO->prepare('INSERT INTO mots_cles SET mot_cle = :mot_cle');
					$reqNewKW ->bindvalue(':mot_cle', $keyword);
					$reqNewKW ->execute();
				}
			}
			// NOUVEL ARTICLE
			$Disponibility = 1; // 1 Dispo <=> 2 Indispo
			$reqNewArticle = $PDO->prepare('INSERT INTO articles SET 
											nom_article = :nom_article,
											reference = :reference,
											date_sortie = :date_sortie,
											quantite_stock = :quantite_stock,
											quantite_seuil = :quantite_seuil,
											prix = :prix,
											disponibilite = :disponibilite,
											description = :description,
											TVA_article = :TVA_article,
											id_sous_categorie = :id_sous_categorie');
			$reqNewArticle->bindValue(':nom_article', $Name);
			$reqNewArticle->bindValue(':reference', $Ref);
			//explode la date en jour, moi, année
			list($day, $month, $year) = explode('/', $ParutionDate);
			
			$reqNewArticle->bindValue(':date_sortie', mktime(0,0,0,$month, $day, $year));
			$reqNewArticle->bindValue(':quantite_stock', $QuantityStock);
			$reqNewArticle->bindValue(':quantite_seuil', $QuantityLevel);
			$reqNewArticle->bindValue(':prix', $Price);
			$reqNewArticle->bindValue(':disponibilite', $Disponibility);
			$reqNewArticle->bindValue(':description', $Description);
			$reqNewArticle->bindValue(':TVA_article', $TVA);
			$reqNewArticle->bindValue(':id_sous_categorie', $ID_SubCategory);
			$reqNewArticle->execute();
			// ID ARTICLE
			$ID_Article = 0;
			$reqSelectID->execute();
			if($result = $reqSelectID->fetch())
			{
				$ID_Article = $result['id_article'];
			}
			
					
			
			// Relier acteurs
			foreach($ArrayActors as $actor)
			{
				$NameFirstName = explode(' ', $actor);
				$NameActor = $NameFirstName[0];
				$FirstNameActor = $NameFirstName[1];
			
				$reqSelectActors = $PDO->prepare('SELECT id_acteur FROM acteurs WHERE nom_acteur LIKE :nom_acteur AND prenom_acteur LIKE :prenom_acteur');
				$reqSelectActors->bindValue(':nom_acteur', $NameActor);
				$reqSelectActors->bindValue(':prenom_acteur', $FirstNameActor);
				$reqSelectActors->execute();
				if($result = $reqSelectActors->fetch())
				{
					$ID_Actor = $result['id_acteur'];
					$reqJoinActors = $PDO->prepare('INSERT INTO jouer(id_acteur, id_article) VALUES(:id_acteur,:id_article)');
					$reqJoinActors->bindValue(':id_article', $ID_Article);
					$reqJoinActors->bindValue(':id_acteur', $ID_Actor);
					$reqJoinActors->execute();
				}
			}
			// Relier auteurs
			foreach($Arrayauthor Pouille Matthieus as $author Pouille Matthieu)
			{
				$NameFirstName = explode(' ', $author Pouille Matthieu);
				$Nameauthor Pouille Matthieu = $NameFirstName[0];
				$FirstNameauthor Pouille Matthieu = $NameFirstName[1];
			
				$reqSelectauthor Pouille Matthieus = $PDO->prepare('SELECT id_auteur FROM auteurs WHERE nom_auteur LIKE :nom_auteur AND prenom_auteur LIKE :prenom_auteur');
				$reqSelectauthor Pouille Matthieus->bindValue(':nom_auteur', $Nameauthor Pouille Matthieu);
				$reqSelectauthor Pouille Matthieus->bindValue(':prenom_auteur', $FirstNameauthor Pouille Matthieu);
				$reqSelectauthor Pouille Matthieus->execute();
				if($result = $reqSelectauthor Pouille Matthieus->fetch())
				{
					$ID_author Pouille Matthieu = $result['id_auteur'];
					$reqJoinAutors = $PDO->prepare('INSERT INTO creer(id_auteur, id_article) VALUES(:id_auteur,:id_article)');
					$reqJoinAutors->bindValue(':id_article', $ID_Article);
					$reqJoinAutors->bindValue(':id_auteur', $ID_author Pouille Matthieu);
					$reqJoinAutors->execute();
				}
			}
			// Relier Mots-clés
			foreach($ArrayKeywords as $keyword)
			{			
				$reqSelectKW = $PDO->prepare('SELECT id_mot_cle FROM mots_cles WHERE mot_cle LIKE :mot_cle');
				$reqSelectKW->bindValue(':mot_cle', $keyword);
				$reqSelectKW->execute();
				if($result = $reqSelectKW->fetch())
				{
					$ID_KW = $result['id_mot_cle'];
					$reqJoinKW = $PDO->prepare('INSERT INTO referer(id_mot_cle, id_article) VALUES (:id_mot_cle, :id_article)');
					$reqJoinKW->bindValue(':id_article', $ID_Article);
					$reqJoinKW->bindValue(':id_mot_cle', $ID_KW);
					$reqJoinKW->execute();
				}
			}
			
			//script pour uploader l'image dans le dossier du site admin et dans le dossier du site extranet
			if(isset($_FILES['image']))
			{
				$extension = '.png';
				$png = strrchr($_FILES['image']['name'], '.');
				if($extension == $png)
				{
					move_uploaded_file($_FILES['image']['tmp_name'], '../img/articles/'.$ID_Article.$extension);
				}
			}
			
			return true;
		}
	}	

    /**
	* \fn public function setArticle()
	* \author Pouille Matthieu 
	* \brief Modifier un article
	*/
	public function setArticle($ID, $Name, $Ref, $Category, $Subcategory, $ParutionDate, $Price, $TVA, $Description, $author Pouille Matthieus, $Actors, $Keywords)
	{
		global $PDO;
		$req = $PDO->prepare('SELECT id_article FROM articles WHERE id_article = :id_article');
		$req->bindValue(':id_article', $ID);
		$req->execute();
		if( $result = $req->fetch())
		{
			return false;
		}
		else
        {
			$ID_Category = 0;
			$ID_SubCategory = 0;
			$reqSelectSubcat = $PDO->prepare('SELECT id_sous_categorie FROM sous_categories WHERE nom_sous_categorie LIKE :nom_sous_categorie');
			$reqSelectSubcat->bindValue(':nom_sous_categorie', $SubCategory);
			$reqSelectSubcat->execute();
			if ($result = $reqSelectSubcat->fetch())
			{
				$ID_SubCategory = $result['id_sous_categorie'];// on recupere l'ID de la sous-catégorie
			}
			else
			{
				$reqSelectCategory = $PDO->prepare('SELECT id_categorie FROM categories WHERE nom_categorie LIKE :nom_categorie');
				$reqSelectCategory->bindValue(':nom_categorie', $Category );
				$reqSelectCategory->execute();
				if ($result = $reqSelectCategory->fetch())
				{
					$ID_Category = $result['id_categorie'];
				}
				else
				{
					$req = $PDO->prepare('INSERT INTO categories SET nom_categorie = :nom_categorie');
					$req->bindValue(':nom_categorie', $Category );
					$req->execute();
					$reqSelectCategory->execute();
					if ($result = $reqSelectCategory->fetch())
					{
						$ID_Category = $result['id_categorie'];
					}	
				}
				$req = $PDO->prepare('INSERT INTO sous_categories SET nom_sous_categorie = :nom_sous_categorie, id_categorie = :id_categorie');
				$req->bindValue(':nom_sous_categorie', $SubCategory);
				$req->bindValue(':id_categorie', $ID_Category);
				$req->execute();
				$reqSelectSubCat->execute();
				if ($result = $reqSelectSubCat->fetch())
				{
					$ID_SubCategory = $result['id_sous_categorie'];// on recupere l'ID de la sous_categorie
				}	
			}
			
			// Acteurs
			$ArrayActors = explode(',', $Actors);
			foreach($ArrayActors as $actor)
			{
				$NameFirstName = explode(' ', $actor);
				$NameActor = $NameFirstName[0];
				$FirstNameActor = $NameFirstName[1];
			
				$reqSelectActors = $PDO->prepare('SELECT id_acteur FROM acteurs where nom_acteur LIKE :nom_acteur AND prenom_acteur LIKE :prenom_acteur');
				$reqSelectActors->bindValue(':nom_acteur', $NameActor);
				$reqSelectActors->bindValue(':prenom_acteur', $FirstNameActor);
				$reqSelectActors->execute();
				if($result = $reqSelectActors->fetch())
				{
					return false;
				}
				else
				{
					$ID_Actor = 0;
					$reqNewActor = $PDO->prepare('INSERT INTO acteurs SET nom_acteur = :nom_acteur, prenom_acteur = :prenom_acteur');
					$reqNewActor->bindvalue(':nom_acteur', $NameActor);
					$reqNewActor->bindvalue(':prenom_acteur', $FirstNameActor);
					$reqNewActor->execute();
					$reqSelectActors->execute();
					if($result = $reqSelectActors->fetch())
					{
						$ID_Actor = ['id_acteur'];
					}
				}
			}
			
			// Auteurs
			$Arrayauthor Pouille Matthieus = explode(',', $author Pouille Matthieus);
			foreach($Arrayauthor Pouille Matthieus as $author Pouille Matthieu)
			{
				$NameFirstName = explode(' ', $author Pouille Matthieu);
				$Nameauthor Pouille Matthieu = $NameFirstName[0];
				$FirstNameauthor Pouille Matthieu = $NameFirstName[1];
			
				$reqSelectauthor Pouille Matthieus = $PDO->prepare('SELECT id_acteur FROM auteurs where nom_auteur LIKE :nom_auteur AND prenom_auteur LIKE :prenom_auteur');
				$reqSelectauthor Pouille Matthieus->bindValue(':nom_acteur', $Nameauthor Pouille Matthieu);
				$reqSelectauthor Pouille Matthieus->bindValue(':prenom_acteur', $FirstNameauthor Pouille Matthieu);
				$reqSelectauthor Pouille Matthieus->execute();
				if($result = $reqSelectauthor Pouille Matthieus->fetch())
				{
					return false;
				}
				else
				{
					$ID_author Pouille Matthieu = 0;
					$reqNewauthor Pouille Matthieu = $PDO->prepare('INSERT INTO auteurs SET nom_auteur = :nom_auteur, prenom_auteur = :prenom_auteur');
					$reqNewauthor Pouille Matthieu->bindvalue(':nom_acteur', $Nameauthor Pouille Matthieu);
					$reqNewauthor Pouille Matthieu->bindvalue(':prenom_acteur', $FirstNameauthor Pouille Matthieu);
					$reqNewauthor Pouille Matthieu->execute();
					$reqSelectauthor Pouille Matthieus->execute();
					if($result = $reqSelectauthor Pouille Matthieus->fetch())
					{
						$ID_author Pouille Matthieu = ['id_auteur'];
					}
				}
			}
			// Mots-clefs
			$ArrayKeywords = explode(',', $Keywords);
			foreach($ArrayKeywords as $keyword)
			{
				$KeyW = explode(' ', $keyword);
				$KW = $keyW[0];
			
				$reqSelectKW = $PDO->prepare('SELECT id_mot_cle FROM mots_cles where mot_cle LIKE :mot_cle');
				$reqSelectKW->bindValue(':mot_cle', $KW);
				$reqSelectKW->execute();
				if($result = $reqSelectKW->fetch())
				{
					return false;
				}
				else
				{
					$ID_KW = 0;
					$reqNewKW = $PDO->prepare('INSERT INTO auteurs SET mots_cles where mot_cle = :mot_cle');
					$reqNewKW ->bindvalue(':nom_acteur', $KW);
					$reqNewKW ->execute();
					$reqSelectKW ->execute();
					if($result = $reqSelectKW->fetch())
					{
						$ID_KW = ['id_mot_cle'];
					}
				}
			}
			// MAJ ARTICLE
			$reqUpdateArticle = $PDO->prepare('UPDATE articles SET 
											nom_article = :nom_article,
											reference = :reference,
											date_sortie = :date_sortie,
											prix = :prix,
											description = :description,
											TVA_article = :TVA_article,
											id_sous_categorie = :id_sous_categorie');
			$reqUpdateArticle->bindValue(':nom_article', $Name);
			$reqUpdateArticle->bindValue(':reference', $Ref);
			//division de la date en jour, moi, année
			list($day, $month, $year) = explode('/', $ParutionDate);
			
			$reqUpdateArticle->bindValue(':date_sortie', mktime(0,0,0,$month, $day, $year));
			$reqUpdateArticle->bindValue(':prix', $Price);
			$reqUpdateArticle->bindValue(':description', $Description);
			$reqUpdateArticle->bindValue(':TVA_article', $TVA);
			$reqUpdateArticle->bindValue(':id_sous_categorie', $ID_SubCategory);
			$reqUpdateArticle->execute();
			// ID ARTICLE
			$ID_Article = 0;
			$reqSelectID->execute();
			if($result = $reqSelectID->fetch())
			{
				$ID_Article = ['id_article'];
			}
			// Relier acteurs
			foreach($ArrayActors as $actor)
			{
				$NameFirstName = explode(' ', $actor);
				$NameActor = $NameFirstName[0];
				$FirstNameActor = $NameFirstName[1];
			
				$reqSelectActors = $PDO->prepare('SELECT id_acteur FROM acteurs where nom_acteur LIKE :nom_acteur AND prenom_acteur LIKE :prenom_acteur');
				$reqSelectActors->bindValue(':nom_acteur', $NameActor);
				$reqSelectActors->bindValue(':prenom_acteur', $FirstNameActor);
				$reqSelectActors->execute();
				if($result = $reqSelectActors->fetch())
				{
					$ID_Actor = ['id_acteur'];
				}
				$reqJoinActors = $PDO->prepare('UPDATE jouer SET id_acteur = :id_acteur WHERE id_article = :id_article');
				$reqJoinActors->bindValue(':id_article', $ID_Article);
				$reqJoinActors->bindValue(':id_acteur', $ID_Actor);
				$reqJoinActors->execute();
			}
			// Relier auteurs
			foreach($Arrayauthor Pouille Matthieus as $author Pouille Matthieu)
			{
				$NameFirstName = explode(' ', $author Pouille Matthieu);
				$Nameauthor Pouille Matthieu = $NameFirstName[0];
				$FirstNameauthor Pouille Matthieu = $NameFirstName[1];
			
				$reqSelectauthor Pouille Matthieus = $PDO->prepare('SELECT id_acteur FROM auteurs where nom_auteur LIKE :nom_auteur AND prenom_auteur LIKE :prenom_auteur');
				$reqSelectauthor Pouille Matthieus->bindValue(':nom_acteur', $Nameauthor Pouille Matthieu);
				$reqSelectauthor Pouille Matthieus->bindValue(':prenom_acteur', $FirstNameauthor Pouille Matthieu);
				$reqSelectauthor Pouille Matthieus->execute();
				if($result = $reqSelectauthor Pouille Matthieus->fetch())
				{
					$ID_author Pouille Matthieu = ['id_auteur'];
				}
				$reqJoinAutors = $PDO->prepare('UPDATE creer SET id_auteur = :id_auteur WHERE id_article = :id_article');
				$reqJoinAutors->bindValue(':id_article', $ID_Article);
				$reqJoinAutors->bindValue(':id_auteur', $ID_author Pouille Matthieu);
				$reqJoinAutors->execute();
			}
			// Relier Mots-clés
			foreach($ArrayKeywords as $keyword)
			{
				$KeyW = explode(' ', $keyword);
				$KW = $keyW[0];
			
				$reqSelectKW = $PDO->prepare('SELECT id_mot_cle FROM mots_cles where mot_cle LIKE :mot_cle');
				$reqSelectKW->bindValue(':mot_cle', $KW);
				$reqSelectKW->execute();
				if($result = $reqSelectKW->fetch())
				{
					$ID_KW = ['id_mot_cle'];
				}
				$reqJoinKW = $PDO->prepare('UPDATE referer SET id_mot_cle = :id_mot_cle WHERE id_article = :id_article');
				$reqJoinKW->bindValue(':id_article', $ID_Article);
				$reqJoinKW->bindValue(':id_mot_cle', $ID_KW);
				$reqJoinKW->execute();
			}
			
			return true;
		}	
	}
	
	/**
	* \fn public function setStock()
	* \author Pouille Matthieu 
	* \brief Modifier un article
	*/
	public function setStock($ID, $QuantityStock)
	{
		global $PDO;
		$req = $PDO->prepare('SELECT id_article FROM articles WHERE id_article = :id_article');
		$req->bindValue(':id_article', $ID);
		$req->execute();
		if ($result = $req->fetch())
		{
			$article = new Article($result['id_article']);
			
			// MAJ STOCK
			$reqUpdateStock = $PDO->prepare('UPDATE articles SET quantite_stock = :quantite_stock WHERE id_article = :id_article');
			$reqUpdateStock->bindValue(':quantite_stock', $QuantityStock);
			$reqUpdateStock->bindValue(':id_article', $ID);
			$reqUpdateStock->execute();
		}
	}
	
	/**
	* \fn public function setDisponibility()
	* \author Pouille Matthieu 
	* \brief Modifier la disponibilite d'un article
	*/
	public function setDisponibility($ID, $disponibilite) //1 pour disponible, 2 pour hors stock, 3 pour 'supprimer' un article
	{
		if( $disponibilite == 1 || $disponibilite == 2 || $disponibilite == 3 )
		{
			global $PDO;
			$req = $PDO->prepare('UPDATE articles SET disponibilite = :disponibilite WHERE id_article = :id_article');
			$req->bindValue(':disponibilite', $disponibilite);
			$req->bindValue(':id_article', $ID);
			$req->execute();
		}
	}
	
	
	/**
	* \fn public function getBySeuil()
	* \author Pouille Matthieu
	* \brief retourne la liste des articles dont on doit renouveler les stocks
	*/
	public function getBySeuil()
	{
		global $PDO;
		$req = $PDO->prepare('SELECT id_article FROM articles WHERE quantite_seuil > quantite_stock');
		$req->execute();
		$tab = array();
		while($result = $req->fetch())
		{
			$tab[] = new Article($result['id_article']);
		}
		return $tab;
	}
	
	

	
	/**
	* \fn public function selectArticles()
	* \author Pouille Matthieu
	* \brief liste tous les articles disponibles ou hors stocks
	*
	* \return tableau d'articles
	*/
	public function selectArticles()
	{
		global $PDO;
		$reqSelect = $PDO->prepare('SELECT id_article FROM articles WHERE disponibilite < 3');
		$reqSelect->execute();
		
		$return = array();
	    while($temp = $reqSelect->fetch())
		{
	        $return[] = new Article($temp['id_article']);
		}
	    return $return;
	}
	
	
}	

?>
