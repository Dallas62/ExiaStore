<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$idCommande = (isset($_GET['commande']))?intval($_GET['commande']):false;
$display = array();
if($account->getConnected())
{
	if ( $idCommande != false && $idCommande > 0 )
	{
		$smarty->assign('command_not_found', false);
		$commande = new command($idCommande);
		
		$display['id']		= $idCommande;
		$display['etat'] 	= $commande->getStateWord();
		$display['adresse']	= $commande->getAddress();
		$display['CP']		= $commande->getCP();
		$display['ville']	= $commande->getCity();
		$display['pays']	= $commande->getCountry();
		$display['articles']= $commande->getArticlesList();
		$display['TTC']		= $commande->getTotalTTC();
		$smarty->assign('commande', $display);
	}
	else
	{
		$smarty->assign('command_not_found', true);
	}
}
else
{
	$smarty->assign('connected', false); 
}
?>
