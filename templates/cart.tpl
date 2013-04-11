<!-- Panier -->
<div class=contenu>
	<h1>Liste des articles du panier: </h1>
	<form method=post>
		<table CELLSPACING="0">
			<tr class=important>
				<th>
				
				</th>
				<th class=moyen> 
					Nom de l'article 
				</th>
				<th> 
					Quantit&eacute 
				</th>
				<th> 
					Prix 
				</th>
				<th> 
					Total HT
				</th>
				<th> 
					Supprimer
				</th>
			</tr>
						
			<!-- c'est cette ligne qu'il faut remplir et répéter avec les informations du panier -->
			{foreach $panier.articles as $key=>$article}
			<tr class=grise>
				<td>	<!--image de l'article-->
					<img src="img/articles/{$article->getID()}.png" alt="{$article->getHTMLName()}"/>
				</td>
				
				<td>	<!-- nom de l'article -->
					<a href="#" title="Afficher la fiche de l'article" class=boutonDiscret>{$article->getHTMLName()}</a>
				</td>
					
				<td> 	<!-- quantite de l'article -->
					{$panier.quantity[$key]}
				</td>
								
				<td> 	<!-- prix unitaire article -->
					{$article->getPrice()} &euro;
				</td>
				
				<td> <!-- prix unitaire total -->
					{$article->getPrice()*$panier.quantity[$key]} &euro;
				</td>
				
				<td>	<!-- Supprimer l'article-->
					<a href="index.php?page=cart&delete={$article->getID()}" title="Supprime l'article du panier" class=bouton>Supprimer article</a>
				</td>
				<!-- fin de la ligne -->
			</tr>
			{foreachelse}
			<tr class=grise>
				<td colspan="6">
					<h2>Votre panier est vide</h2>
				</td>
			</tr>
			{/foreach}
			<tr>
				<td colspan="2"> 
				</td>
				<td>
					<h2>Total HT du panier</h2> {$totalht} &euro;
				</td>
				<td>
				</td>
				<td>
					<h2>Total TTC du panier</h2> {$totalttc|string_format:"%.2f"} &euro;
				</td>
			</tr>
		</table>		
		<a href="index.php?page=cart" title="Actualise le panier" class=bouton>Mettre &agrave jour</a>
		<a href="index.php?page=cart&empty" title="Efface le contenu du panier" class=bouton>Vider le panier</a>
		<a href="index.php?page=validate" title="Confirme la commande" class=bouton>Valider la commande</a>
	</form>
</div>