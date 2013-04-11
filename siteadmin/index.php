<?php
define('IN_STORE', true); //Protection pour les pages inclusent

require_once('./include/include.php');
if( $account->getRight() == 2)
{
	$page = (isset($_GET['page']) && in_array(strtolower($_GET['page']), $whiteList))?$_GET['page']:'accueil';



	include_once('pages/'.$page.'.php');

	$smarty->assign('connected', $account->getConnected());
	$smarty->assign('username', $account->getHTMLLogin());

	include_once('pages/head.php');

	$smarty->display('templates/'.$page.'.tpl');

	include_once('pages/foot.php');
}

?>
