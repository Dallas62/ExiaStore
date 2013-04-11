<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

if (isset($_POST['quantite']) && isset($_GET['article']))
{
	$quantite = intval($_POST['quantite']);
	$article = new Article(intval($_GET['article']));
	if ($article->getID() != 0)
	{
		$cart->add($article->getID(), $quantite);
	}
}

if (isset($_GET['delete']))
{
	$cart->delArticle(intval($_GET['delete']));
}

if (isset($_GET['empty']))
{
	$cart->delCart(intval($_GET['empty']));
}

$smarty->assign('panier', $cart->getArticles());
$smarty->assign('totalht', $cart->getTotalHT()); 
$smarty->assign('totalttc', $cart->getTotalTTC()); 
?>