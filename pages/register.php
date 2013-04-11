<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

if(!$account->getConnected())
{
    $smarty->assign('missing_field', false);
    $smarty->assign('invalid_format', false);
    $smarty->assign('invalid_password', false);
    $smarty->assign('register_ok', false);
    if($_POST)
    {
        if(isset($_POST['login']) && !empty($_POST['login'])
            && isset($_POST['mdp']) && !empty($_POST['mdp'])
            && isset($_POST['mdpc']) && !empty($_POST['mdpc'])
            && isset($_POST['name']) && !empty($_POST['name'])
            && isset($_POST['firstname']) && !empty($_POST['firstname'])
            && isset($_POST['birthday']) && !empty($_POST['birthday'])
            && isset($_POST['pays']) && !empty($_POST['pays'])
            && isset($_POST['ville']) && !empty($_POST['ville'])
            && isset($_POST['mail']) && !empty($_POST['mail'])
            && isset($_POST['adresse']) && !empty($_POST['adresse'])
            && isset($_POST['cp']) && !empty($_POST['cp'])
           )
        {
            if(!preg_match('/^[a-zA-Z0-9]{6,20}$/', $_POST['login'])
                || !preg_match('/^[a-zA-Z\s]{3,}$/', $_POST['pays'])
                || !preg_match('/^[a-zA-Z\s]{3,}$/', $_POST['ville'])
                || !preg_match('/^[a-zA-Z\s]{3,}$/', $_POST['name'])
                || !preg_match('/^[a-zA-Z\s]{3,}$/', $_POST['firstname'])
                || !strtotime($_POST['birthday'])
                || !preg_match('/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$/', $_POST['mail'])
                || !preg_match('/^[0-9]{1,6}$/', $_POST['cp'])
              )
            {
                $smarty->assign('invalid_format', true);
            }
            else
            {
                if($_POST['mdpc'] != $_POST['mdp'])
                {
                    $smarty->assign('invalid_password', true);
                }
                else
                {
                    if($account->add($_POST['name'],
                                        $_POST['firstname'],
                                        $_POST['login'],
                                        $_POST['mail'],
                                        strip_tags($_POST['adresse']),
                                        strtotime($_POST['birthday']),
                                        time(),
                                        1,
                                        $_POST['ville'],
                                        $_POST['cp'],
                                        $_POST['pays'],
                                        $_POST['mdp']
                                     ))
                    {
                        $smarty->assign('register_ok', true);
                    }
                }
            }
        }
        else
        {
            $smarty->assign('missing_field', true);
        }
    }
}


?>
