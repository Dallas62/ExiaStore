<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$etat = (isset($_GET['etat']))?intval($_GET['etat']):false;
$display = array();

if($account->getConnected())
{
	$smarty->assign('connected', true);
	if( $etat >= 0)
	{	
		
		if($etat == 0 || $etat == 1 || $etat == 2)
		{
			$commandes = new SearchCommands();
			$display = $commandes->searchCommandsByState($etat);
			$smarty->assign('true_value', true);
			$smarty->assign('commands', $display);
			$smarty->assign('state', $etat);
		}
		else
		{
			$smarty->assign('true_value', false);
		}
	}
	else
	{
		$smarty->assign('true_value', false);
	}
}
else
{
	$smarty->assign('connected', false);
}
?>