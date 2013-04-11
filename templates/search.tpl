<div id="recherche">
	<div id="barreRecherche">
		<form method="GET">
		<input type="hidden" name="page" value="search"/>
			<h1> Paramètres de la recherche </h1>
			<label>Nom de l'article: </label><input type=text name="sname" value="{$search_name}" />
			<label>Mot clé: </label><input type=text name="skw" title="utiliser un mot clé référant à l'article" value="{$search_kw}" />
			<label>Catégorie: </label>{html_options name=ssubcat options=$search_list_subcat selected=$search_subcat}
			<label>Description: </label><input type=text name="sdesc" value="{$search_desc}" /><br />
			<input type="submit" value="Chercher" title="Lancer la recherche!"/>
		</form>
	</div>
	<div class=contenu>			
	<h1>Resultats: </h1>
	<table>
		<tr>
			<th> Nom de l'article </th><th></th><th> Prix </th>
		</tr>
		{foreach $search_result as $article_infos}
		<tr>
			<td><img src="img/articles/{$article_infos->getID()}.png" alt="{$article_infos->getHTMLName()}"/></td>
			<td>
				<a href="index.php?page=article&article={$article_infos->getID()}" title="Afficher la fiche de l'article">{$article_infos->getHTMLName()}</a>
				<p>
					{$article_infos->getHTMLDescription()|truncate:60:"..."}
				</p>
			</td>
			<td>
				<h2> {$article_infos->getPrice()} &euro; </h2>
			</td>
		</tr>
		{foreachelse}
		<tr>
		    <td colspan="2">
		        Aucun r&eacute;sultat n'a &eacute;t&eacute; trouv&eacute;
		    </td>
		</tr>
		{/foreach}
	</table>
</div>	
</div>
