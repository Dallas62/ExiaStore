<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$smarty->assign('articles_similaire', $articles->getSimilar());

$smarty->assign('panier', $cart->getArticles());
$smarty->assign('nbarticle', $cart->getNbArticle()); 
$smarty->assign('totalttc', $cart->getTotalTTC()); 

$smarty->display('templates/foot.tpl');
?>
