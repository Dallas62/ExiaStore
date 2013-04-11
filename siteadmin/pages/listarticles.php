<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$articles = new ArticleAdmin();
$display = $articles->selectArticles();

$smarty->assign('articles', $display);

if(isset($_GET['supprimer']) && $_GET['supprimer'] > 0)
{
	$articles->setDisponibility($_GET['supprimer'], 3);
}

if( isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['disponibilite']) && $_GET['disponibilite'] > 0 )
{
	$articles->setDisponibility($_GET['id'], $_GET['disponibilite']);
}
?>