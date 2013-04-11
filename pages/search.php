<?php
if(!defined('IN_STORE')) die(); //Si il faut que la page soit inclut

$searchName = (isset($_GET['sname']))?$_GET['sname']:'';
$searchDesc = (isset($_GET['sdesc']))?$_GET['sdesc']:'';
$searchKW = (isset($_GET['skw']))?$_GET['skw']:'';
$searchSubCat = (isset($_GET['ssubcat']))?intval($_GET['ssubcat']):0;



$smarty->assign('search_name', $searchName);
$smarty->assign('search_desc', $searchDesc);
$smarty->assign('search_kw', $searchKW);
$smarty->assign('search_subcat', $searchSubCat);
$smarty->assign('search_list_subcat', $articles->getCategoryAndSubCategory());
$smarty->assign('search_result', $articles->searchArticles($searchName, $searchDesc, $searchKW, $searchSubCat));


?>
