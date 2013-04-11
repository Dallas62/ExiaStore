<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$idArticle = (isset($_GET['article']))?intval($_GET['article']):false;

if($idArticle != false)
{
    $article = new Article($idArticle);
    if($article->getID() != 0)
    {
	    $_SESSION['last_article'] = $article->getID();
        $smarty->assign('article_not_found', false);
        $smarty->assign('article_infos', $article);
    }
    else
    {
        $smarty->assign('article_not_found', true);
    }
}
else
{
    $smarty->assign('article_not_found', true);
}
?>
