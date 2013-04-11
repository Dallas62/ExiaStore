<!DOCTYPE HTML>

<html>
	
	<head>
		<meta charset="utf-8" />		<!-- ex: ici on définit un encodage en utf-8 -->
		<link rel="stylesheet" href="style.css"/>
		<title>Exi@store, administration du site</title>
	</head>
	
	<body>
		<header> <!-- contain the logo and the inputs to log in ... the head of the page !! -->
			<div id="logo">
				<a href="index.php" class=bouton>&nbspEXI@STORE&nbsp</a>
			</div>	
			<a href="../index.php" class=bouton>&nbsp Deconnexion du site d'administration &nbsp</a>
		</header>
		<nav>
			<p class=contenu>Administration du site web</p>
		</nav>
		<section>
			<table CELLSPACING=0>
				<tr>
					<td class=important>
						<aside>
							
							<h1><a href="#">Gestion des stocks</a></h1>
							
							<h1><a href="index.php?page=listarticles">Gestion des articles</a></h1>
							<ul>
								<li><a href="index.php?page=addarticle"> Ajouter un article </a></li>
								<li><a href="index.php?page=listarticles"> Modifier un article </a></li>
							</ul>
							
							<h1>Gestion des commandes</h1>
							<ul>
								<li><a href="index.php?page=commands&etat=0"> Commandes en pr&eacute;paration </a></li>
								<li><a href="index.php?page=commands&etat=1"> Commandes &agrave; envoyer </a></li>
								<li><a href="index.php?page=commands&etat=2"> Historique des commandes envoy&eacute;es </a></li>
								<li><a href="index.php?page=searchcommand"> Rechercher une commande </a></li>
							</ul>
						</aside>
					</td>
					<td class=normal>
						<article>
