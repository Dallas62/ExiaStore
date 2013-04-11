	<div class=contenu id="affichageArticles">
		{foreach $sub_categories as $id_sub_category => $sub_category}
		<h1><a href="index.php?page=subcategory&subcategory={$id_sub_category}" class=bouton>{$sub_category.name}</a></h1>
		<table>
			<tr>
		    {foreach $sub_category.articles as $article}
				<td><a class=lienDiscret href="index.php?page=article&article={$article->getID()}"><img src="img/articles/{$article->getID()}.png" alt="{$article->getHTMLName()}"/></a><br /><a class=lienDiscret href="index.php?page=article&article={$article->getID()}">{$article->getHTMLName()}</a></td>
		    {foreachelse}
		        <p>Pas d'article dans cette sous-cat&eacute;gorie.</p>
		    {/foreach}
			</tr>
		</table>
		{foreachelse}
		    <p>Pas de sous-cat&eacute;gorie.</p>
		{/foreach}
		<p>
		    {if $page_sub_category > 1} <a class=&nbsp href="index.php?page=category&category={$id_sub_category}&pagenb={$page_sub_category - 1}">&nbspPage pr&eacute;c&eacute;dente&nbsp</a> - {/if}
	    	{for $page=1 to $nb_pages_sub_category}
		        <a class=bouton href="index.php?page=category&category={$id_sub_category}&pagenb={$page}">&nbsp{$page}&nbsp</a>
		    {/for}
		    {if $page_sub_category < $nb_pages_sub_category} - <a class=bouton href="index.php?page=category&category={$id_sub_category}&pagenb={$page_sub_category + 1}">&nbspPage Suivante&nbsp</a>{/if}
		</p>
    </div>
