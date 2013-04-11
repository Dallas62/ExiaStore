<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$idSubCategory = (isset($_GET['subcategory']))?intval($_GET['subcategory']):1;
$pageNb = (isset($_GET['pagenb']))?intval($_GET['pagenb']):1;

$SubCategory = $articles->getSubCategory($idSubCategory);

$display = array();

$display['name'] = $SubCategory;
$display['articles'] = $articles->getBySubCategory($idSubCategory, $pageNb);

$smarty->assign('sub_category', $display);
$smarty->assign('nb_pages_articles', $articles->getNbPagesBySubCategory());
$smarty->assign('page_articles', $pageNb);

?>
