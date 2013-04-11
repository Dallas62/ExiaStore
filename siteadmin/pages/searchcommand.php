<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$id = (isset($_GET['id']))?intval($_GET['id']):0;
$name = (isset($_GET['name']))?$_GET['name']: null;
$firstname = (isset($_GET['firstname']))?$_GET['firstname']: null;
$display = array();


if($account->getConnected())
{
	$smarty->assign('connected', true);
	$smarty->assign('true_value', true);
	
	$commands = new SearchCommands();			
	$display = $commands->searchCommandsByIDNameFirstName($id, $name, $firstname);
	$smarty->assign('commands', $display);

}
else
{
	$smarty->assign('connected', false);
}
?>