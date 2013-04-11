<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

session_start();

///////////////////////////////////////
//Liste des fichiers à inclure
///////////////////////////////////////

require_once('../include/config.bdd.php');
require_once('../lib/Smarty/Smarty.class.php');
require_once('../class/account.class.php');
require_once('../class/article.class.php');
require_once('../class/articles.class.php');
require_once('../class/cart.class.php');
require_once('../class/command.class.php');
require_once('class/commandadmin.class.php');
require_once('class/searchcommands.class.php');
require_once('class/articleadmin.class.php');

///////////////////////////////////////
//Liste des fichiers à inclure
///////////////////////////////////////

// Liste des pages autorisées
$whiteList = array(
        'accueil',
		'commands',
		'command',
		'searchcommand',
		'addarticle',
		'listarticles'
    );

//Initialisation de Smarty
$smarty = new Smarty;

//Connexion à la base de données
try
{
    $PDO = new PDO('mysql:host='.$bdd['host'].';dbname='.$bdd['dbname'], $bdd['user'], $bdd['password']); //PDO en global
}
catch (Exception $e)
{
    die('Erreur de connexion.');
}

$account = new Account();
$articles = new Articles();
?>
