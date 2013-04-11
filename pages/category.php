<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$idCategory = (isset($_GET['category']))?intval($_GET['category']):1;
$pageNb = (isset($_GET['pagenb']))?intval($_GET['pagenb']):1;

$listSubCategory = $articles->getSubCategoryByCategory($idCategory);

$display = array();

foreach($listSubCategory as $SubCategory)
{
    $display[$SubCategory['id_sous_categorie']]['name'] = $SubCategory['nom_sous_categorie'];
    $display[$SubCategory['id_sous_categorie']]['articles'] = $articles->getBySubCategory($SubCategory['id_sous_categorie'], $pageNb, 5);
}

$smarty->assign('sub_categories', $display);
$smarty->assign('nb_pages_sub_category', $articles->getNbPagesSubCategoryByCategory());
$smarty->assign('page_sub_category', $pageNb);

?>
