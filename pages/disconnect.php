<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

$account->disconnect();

header('Location: index.php');

die();

?>
