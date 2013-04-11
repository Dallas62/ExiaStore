<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

if(!$account->getConnected())
{
    if($_POST)
    {
        if(isset($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['login']) && !empty($_POST['mdp']))
        {
            $smarty->assign('correct_field', true);
            if($account->connect($_POST['login'], $_POST['mdp']))
            {
                $smarty->assign('now_connected', true);
            }
            else
            {
                $smarty->assign('now_connected', false);
            }
        }
        else
        {
            $smarty->assign('correct_field', false);
        }
    }
}

?>
