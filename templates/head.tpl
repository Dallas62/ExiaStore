<!DOCTYPE HTML>

<html>

	<head>
		<meta charset="utf-8" />		<!-- ex: ici on définit un encodage en utf-8 -->
		<link rel="stylesheet" href="style.css"/>
		<title>Exi@store</title>
	</head>
	
	<body>
		<header> <!-- contain the logo and the inputs to log in ... the head of the page !! -->
			<div id="logo">
				<a href="index.php" title="Page d'accueil" class=bouton>&nbsp;EXI@STORE&nbsp;</a>
				<p>The Online shop</p>
			</div>
			
			<div id="authentification">
			    {if $connected == false}
				<form name="authentification" method="post" action="index.php?page=login">
					<label>Identifiant: </label><input type="text" name="login" /><br />
					<label>Mot de passe: </label><input type="password" name="mdp" /><br />
					<label><a href="index.php?page=register" class=lienWhite>pas encore inscrit?</a></label><input type="submit" value=" Connexion " title="Se connecter" />
				</form>
				{else}
				<p>Bonjour <a href="index.php?page=commandes" class=bouton>{$username}</a>.</p>
				<a href="index.php?page=disconnect" class=bouton>D&eacute;connexion</a>
				{/if}
			</div>
		</header>
		
		<nav> <!-- contain the navigation bar, doesn't contain  -->
			<ul id="menu">
				<li><a href="index.php">Accueil</a></li>
				<li>
					<a href="index.php?page=category&category=1">Film</a>
					<ul class="sousMenu">
						{foreach $menu_cat_1 as $sub_cat}
						<li><a href="index.php?page=subcategory&subcategory={$sub_cat.id_sous_categorie}">{$sub_cat.nom_sous_categorie}</a></li>
					    {/foreach}
                    </ul>
				</li>
				<li>
					<a href="index.php?page=category&category=2">CD</a>
					<ul class="sousMenu">
						{foreach $menu_cat_2 as $sub_cat}
                        <li><a href="index.php?page=subcategory&subcategory={$sub_cat.id_sous_categorie}">{$sub_cat.nom_sous_categorie}</a></li>
					    {/foreach}
                    </ul>
				</li>
				<li><a href="index.php?page=cart">Mon panier</a></li>
				<span style="right:15px;">
				    <form method="GET" action="index.php">
				    <input type="hidden" name="page" value="search"/>
				    <li><input type="text" name="sname"/></li>
				    <li><input type="submit" value=" Rechercher l'article" title=" lancer la recherche! "/></li>
				    </form>
				</span>
			</ul>
		</nav>
		
		<section>
			<table>
			<tr>
			<td>
			<article> <!-- contain news, articles list ... -->
