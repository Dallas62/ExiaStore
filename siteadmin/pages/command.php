<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$idCommande = (isset($_GET['commande']))?intval($_GET['commande']):false;
$setState = (isset($_GET['setState']))?intval($_GET['setState']):false;

$display = array();

if($account->getConnected())
{
	if ( $idCommande != false && $idCommande > 0 )
	{
		
		$smarty->assign('command_not_found', false);
		$command = new CommandAdmin($idCommande);
		
		if( $setState != false && $setState > 0 && $setState < 3)
		{
			$command->setState( $setState ); // on enregistre la nouvelle valeur de l'etat
		}
		
		$smarty->assign('command', $command);
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
