<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut


$smarty->assign('last_articles', $articles->getLastArticles());


?>
