	<div class=contenu id="affichageArticles">
		<h1 class=rouge>&nbsp{$sub_category.name}&nbsp</h1><br /><br />
		<table>
			<tr>
		    {foreach $sub_category.articles as $article}
				<td><a href="index.php?page=article&article={$article->getID()}"><img src="img/articles/{$article->getID()}.png" alt="{$article->getHTMLName()}"/></a><br /><a href="index.php?page=article&article={$article->getID()}" class=lienDiscret>{$article->getHTMLName()}</a></td>
		    {foreachelse}
		        <p>Pas d'article dans cette sous-cat&eacute;gorie.</p>
		    {/foreach}
			</tr>
		</table>
		<p>
		    {if $page_articles > 1} <a class=bouton href="index.php?page=subcategory&pagenb={$page_articles - 1}">&nbspPage pr&eacute;c&eacute;dente&nbsp</a> - {/if}
	    	{for $page=1 to $nb_pages_articles}
		        <a class=bouton href="index.php?page=subcategory&pagenb={$page}">&nbsp{$page}&nbsp</a>
		    {/for}
		    {if $page_articles < $nb_pages_articles} - <a class=bouton href="index.php?page=subcategory&pagenb={$page_articles + 1}">&nbspPage Suivante&nbsp</a>{/if}
		</p>
    </div>
