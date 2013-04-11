            </article>
			</td>
			<td>
		
			<aside> <!-- contain the left bar that is visible all the time. It contains a little view of the shopping cart and some article wich can be interesting for the user -->
				<div id="shoppingCart">
					<p >
						Nombre d'articles : {$nbarticle} <br/>
						Cout total: {$totalttc|string_format:"%.2f"} &euro;<br/>
						<a href="index.php?page=cart" title="Afficher le contenu du panier" class=bouton>Afficher le panier</a>
					</p>
				</div>
				
				<h1>Articles Intéressants:</h1>
				<table id="otherArticles">
				    {foreach $articles_similaire as $article_infos}
					<tr>
						<td><img src="img/articles/{$article_infos->getID()}.png" alt="{$article_infos->getHTMLName()}"/></td>
						<td>{$article_infos->getHTMLName()}<br/><a href="index.php?page=article&article={$article_infos->getID()}" title="Voir l'article" class=lienDiscret>plus d'infos...</a></td>
					</tr>
					{/foreach}
				</table>
				
			</td>
			</tr>
			</table>
		<section>
		
		
		<footer> <!-- Contain the info that are usefull to see in the bottom of the page -->
			<table class=tresGrand>					
				<tr>
					<td>
						<a href="#" class=lienWhite> Qui somme nous ? </a>
					</td>
					<td>
						<a href="#" class=lienWhite> Nous contacter </a>
					</td>
					<td>
						<a href="#" class=lienWhite> Mention légales </a>
					</td>
					<td>
						<a href="#" class=lienWhite> Plan du site </a>
					</td>
				</tr>
			</table>
		</footer>
	</body>

</html>
