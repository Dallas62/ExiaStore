<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$smarty->assign('menu_cat_1', $articles->getSubCategoryByCategory(1));
$smarty->assign('menu_cat_2', $articles->getSubCategoryByCategory(2));

$smarty->display('templates/head.tpl');

?>
