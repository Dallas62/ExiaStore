<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

/**
* \file articles.class.php
* \author Tacyniak
* \brief Gestion de la selection des articles
*
* \class Articles
*/
class Articles
{
    private $m_NbPagesSubCategoryByCategory = 0;
    private $m_NbPagesBySubCategory = 0;

    /**
	* \fn public function getSubCategoryByCategory($IDCategory, $Page = 1, $NbDisplay = 10)
	* \author Tacyniak Boris
	* \brief Obtention des sous catégories en fonction de la catégorie
	*
	* \param $IDCategory identifiant de la catégorie souhaitée
	* \param $Page la page de la recherche, 1 si non renseigné
	* \param $NbDisplay Nombre de résultats sélectionnés
	*
	* \return La liste des sous categories
	*/
	public function getSubCategoryByCategory($IDCategory, $Page = 1, $NbDisplay = 10)
	{
	    global $PDO;
	    $req = $PDO->prepare('SELECT count(*) AS counter FROM sous_categories WHERE id_categorie = :id');
	    $req->bindValue(':id', $IDCategory, PDO::PARAM_INT);
	    $req->execute();
	    if($temp = $req->fetch())
	    {
	        $this->m_NbPagesSubCategoryByCategory = round($temp['counter']/$NbDisplay + 0.5);
	    }
	    $req = $PDO->prepare('SELECT id_sous_categorie, nom_sous_categorie FROM sous_categories WHERE id_categorie = :id ORDER BY nom_sous_categorie ASC LIMIT :from, :display');
	    $req->bindValue(':id', $IDCategory, PDO::PARAM_INT);
	    $req->bindValue(':from', ($Page - 1) * $NbDisplay, PDO::PARAM_INT);
	    $req->bindValue(':display', $NbDisplay, PDO::PARAM_INT);
	    $req->execute();
	    return $req->fetchAll();
	}
	
    /**
	* \fn public function getNbPagesBySubCategory()
	* \author Tacyniak Boris
	* \brief Obtention du nombres d'articles en fonction de la sous catégorie
	*
	* \param $IDSubCategory identifiant de la sous-catégorie souhaitée
	*
	* \return Nombres de résultats
	*/
	public function getNbPagesSubCategoryByCategory()
	{
	    return $this->m_NbPagesSubCategoryByCategory;
	}
	
    /**
	* \fn public function getBySubCategory($IDSubCategory, $Page = 1, $NbDisplay = 10)
	* \author Tacyniak Boris
	* \brief Obtention des articles en fonction de la sous catégorie
	*
	* \param $IDSubCategory identifiant de la sous-catégorie souhaitée
	* \param $Page la page de la recherche, 1 si non renseigné
	* \param $NbDisplay Nombre de résultats sélectionnés
	*
	* \return La liste des articles
	*/
	public function getBySubCategory($IDSubCategory, $Page = 1, $NbDisplay = 10)
	{
	    global $PDO;
	    $req = $PDO->prepare('SELECT count(*) AS counter FROM articles WHERE id_sous_categorie = :id AND disponibilite = 1');
	    $req->bindValue(':id', $IDSubCategory, PDO::PARAM_INT);
	    $req->execute();
	    if($temp = $req->fetch())
	    {
	        $this->m_NbPagesBySubCategory = round($temp['counter']/$NbDisplay + 0.5);
	    }
	    $req = $PDO->prepare('SELECT id_article FROM articles WHERE id_sous_categorie = :id AND disponibilite = 1 ORDER BY id_article DESC LIMIT :from, :display');
	    $req->bindValue(':id', $IDSubCategory, PDO::PARAM_INT);
	    $req->bindValue(':from', ($Page - 1) * $NbDisplay, PDO::PARAM_INT);
	    $req->bindValue(':display', $NbDisplay, PDO::PARAM_INT);
	    $req->execute();
	    $return = array();
	    while($temp = $req->fetch())
	        $return[] = new Article($temp['id_article']);
	    return $return;
	}
	
	/**
	* \fn public function getSubCategory($IDSubCategory)
	* \author Tacyniak Boris
	* \brief Obtention du nom de la sous catégorie
	*
	* \param $IDSubCategory identifiant de la sous-catégorie souhaitée
	*
	* \return Le nom de la sous categorie
	*/
	public function getSubCategory($IDSubCategory)
	{
	    global $PDO;
	    $req = $PDO->prepare('SELECT nom_sous_categorie FROM sous_categories WHERE id_sous_categorie = :id');
	    $req->bindValue(':id', $IDSubCategory, PDO::PARAM_INT);
	    $req->execute();
	    if($temp = $req->fetch())
	    {
	        return htmlentities($temp['nom_sous_categorie']);
	    }
	    return '';
	}
	
    /**
	* \fn public function getNbPagesBySubCategory()
	* \author Tacyniak Boris
	* \brief Obtention du nombres d'articles en fonction de la sous catégorie
	*
	* \return Nombres de résultats
	*/
	public function getNbPagesBySubCategory()
	{
	    return $this->m_NbPagesBySubCategory;
	}
	
    /**
	* \fn public function getLastArticles($NbDisplay = 5)
	* \author Tacyniak Boris
	* \brief Obtention des derniers articles
	*
	* \param $NbDisplay Nombre de résultats sélectionnés
	*
	* \return La liste des articles
	*/
	public function getLastArticles($NbDisplay = 10)
	{
	    global $PDO;
	    $req = $PDO->prepare('SELECT id_article FROM articles WHERE disponibilite = 1 ORDER BY id_article DESC LIMIT :display');
	    $req->bindValue(':display', $NbDisplay, PDO::PARAM_INT);
	    $req->execute();
	    $return = array();
	    while($temp = $req->fetch())
	        $return[] = new Article($temp['id_article']);
	    return $return;
	}
	
    /**
	* \fn public function searchArticles($NbDisplay = 5)
	* \author Tacyniak Boris
	* \brief Obtention des derniers articles
	*
	* \param $Name le nom rechercher
	* \param $Description la description
	* \param $KeyWords les mots cles en texte
	* \param $SubCategory La categorie
	*
	* \return La liste des articles
	*/
	public function searchArticles($Name = '', $Description = '', $KeyWords = '', $SubCategory = 0)
	{
	    global $PDO;
	    $listInName = array_filter(explode(' ', $Name));
	    $listInDescription = array_filter(explode(' ', $Description));
	    $listInKeyWords = array_filter(explode(' ', $KeyWords));
	    
	    $allElements = array();
	    
	    if(!empty($Name)) $allElements[] = '%'.$Name.'%';
	    if(!empty($Name)) $allElements[] = '%'.$Name.'%';
	    $allElements = array_merge($allElements, $listInName);
	    if(!empty($Description)) $allElements[] = '%'.$Description.'%';
	    $allElements = array_merge($allElements, $listInDescription, $listInKeyWords);
	    
	    $sql = 'SELECT id_article FROM articles WHERE (';
	    if(!empty($Name)) $sql .= 'nom_article LIKE ? OR reference LIKE ?';
	    foreach($listInName as $key => $inName)
	    {
    	    $listInName[$key] = '%'.$inName.'%';
	        $sql .= ' OR nom_article LIKE ?';
	    }
	    if(!empty($Name)) $sql .= ' OR ';
	    if(!empty($Description)) $sql .= 'description LIKE ?';
	    foreach($listInDescription as $key => $inDescription)
	    {
    	    $listInDescription[$key] = '%'.$inDescription.'%';
	        $sql .= ' OR description LIKE ?';
	    }
	    if(!empty($Description)) $sql .= ' OR ';
	    $sql .= 'id_article IN (SELECT id_article FROM referer INNER JOIN mots_cles ON referer.id_mot_cle = mots_cles.id_mot_cle WHERE';
	    foreach($listInKeyWords as $inKeyWords)
	    {
	        $sql .= ' mot_cle LIKE ? OR';
	    }
	    $sql .= ' 1=0))';
	    if($SubCategory > 0)
	    {
	        $sql .= ' AND (id_sous_categorie = ?)';
	        $allElements[] = $SubCategory;
	    }
	    $sql .= ' LIMIT 0, 50';
	    
	    $req = $PDO->prepare($sql);
	    $req->execute($allElements);
	    $return = array();
	    while($temp = $req->fetch())
	        $return[] = new Article($temp['id_article']);
	    return $return;
	}
	
	/**
	* \fn public function getCategoryAndSubCategory()
	* \author Tacyniak Boris
	* \brief Obtention du nom des categorie avec les sous catégories
	*
	* \return Les noms des categorie avec les sous catégories
	*/
	public function getCategoryAndSubCategory()
	{
	    global $PDO;
	    $reqCat = $PDO->prepare('SELECT id_categorie, nom_categorie FROM categories');
	    $reqCat->execute();
	    $ret = array();
	    $ret['--'][0] = 'Aucune';
	    while($temp = $reqCat->fetch())
	    {
	        $reqSubCat = $PDO->prepare('SELECT id_sous_categorie, nom_sous_categorie FROM sous_categories WHERE id_categorie = :id');
	        $reqSubCat->bindValue(':id', $temp['id_categorie'], PDO::PARAM_INT);
	        $reqSubCat->execute();
	        if($temp2 = $reqSubCat->fetchAll())
	        {
	            foreach($temp2 as $key => $subCat)
	            {
	                $ret[htmlentities($temp['nom_categorie'])][$subCat['id_sous_categorie']] = htmlentities($subCat['nom_sous_categorie']);
	            }
	        }
	    }
	    return $ret;
	}
	
	
	/**
	* \fn public function getSimilar()
	* \author Tacyniak Boris
	* \brief Obtention des articles similaire au dernier article afficher
	*
	* \return Les articles similaire au dernier article afficher
	*/
	public function getSimilar()
	{
	    global $PDO;
	    $sql = 'SELECT id_article FROM articles ';
	    if(isset($_SESSION['last_article']))
	    {
	        $lastArticle = intval($_SESSION['last_article']);
	        $sql .= 'WHERE disponibilite = 1 AND id_article IN (SELECT id_article FROM referer WHERE id_mot_cle IN (SELECT id_mot_cle FROM referer WHERE id_article = :id)) ORDER BY rand() LIMIT 5';
	    }
	    else
	    {
	        $sql .= 'WHERE disponibilite = 1 ORDER BY rand() LIMIT 5';
	    }
	    
	    $req = $PDO->prepare($sql);
	    
	    if(isset($lastArticle))
	    {
	        $req->bindValue(':id', $lastArticle, PDO::PARAM_INT);
	    }
	    $req->execute();
	    $return = array();
	    while($temp = $req->fetch())
	        $return[] = new Article($temp['id_article']);
	    return $return;
	}
}

?>
