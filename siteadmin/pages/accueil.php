<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

if($account->getConnected())
{	
	$id = (isset($_GET['id']))?intval($_GET['id']): null;
	$stocks = (isset($_GET['stocks']))?intval($_GET['stocks']): null;
	$articles = new ArticleAdmin;
	$smarty->assign('connected', true);
	
	if( $id > 0 && $stocks > 0)
	{	
		$articles->setStock($id, $stocks);
	}
	$smarty->assign('articles', $articles->getBySeuil());
	
}
else
{
	$smarty->assign('connected', false);
}

?>
