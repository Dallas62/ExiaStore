<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$commandes = array();

if($account->getConnected())
{
	$smarty->assign('modified', 0);
	
	if( $_POST)
	{
		$address = (isset($_POST['adresse']))?$_POST['adresse']: '';
		$cp = (isset($_POST['cp']))?intval($_POST['cp']): 0;
		$city = (isset($_POST['ville']))?$_POST['ville']: '';
		$country = (isset($_POST['pays']))?$_POST['pays']: '';
		$password = (isset($_POST['password']))?$_POST['password']: '';
		$passwordVerify = (isset($_POST['passwordVerif']))?$_POST['passwordVerif']: '';
		$mail = (isset($_POST['mail']))?$_POST['mail']: '';
		
		if(	    !preg_match('/^[a-zA-Z\s]{3,}$/', $_POST['pays'])
                || !preg_match('/^[a-zA-Z\s]{3,}$/', $_POST['ville'])
                || !preg_match('/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$/', $_POST['mail'])
                || !preg_match('/^[0-9]{1,6}$/', $_POST['cp'])
          )
		{
			$smarty->assign('format_false', true);
		}
		else
		{
			if( !empty($address) && $cp > 0 && !empty($city) && !empty($country) && !empty($mail) && $password == $passwordVerify)
			{
				$smarty->assign('format_false', false);
				if($account->update($mail, $address, $city, $cp, $country, $password))
				{
					$smarty->assign('modified', 1);
				}
				else
				{
					$smarty->assign('modified', 2);
				}
				
			}
		}
	}
	$smarty->assign('connected', true);
	$commandes = $account->getCommandsList();
	$smarty->assign('list', $commandes);
	$smarty->assign('account', $account);
}
else
{
	$smarty->assign('connected', false);
}



?>
