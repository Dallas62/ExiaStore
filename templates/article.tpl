{if $article_not_found == false}
    <div class="contenu" >
	    <h1>{$article_infos->getHTMLName()}</h1>
	    <table>
			    <tr>
				    <td>
						<img id="articleDetail" src="img/articles/{$article_infos->getID()}.png" alt="{$article_infos->getHTMLName()}" />
					</td>
				    <td>
				        <h2>Description: </h2>
				        <p>
				            R&eacute;f&eacute;rence: {$article_infos->getReference()}
				        </p>
				        <p>
				            Date de sortie: {$article_infos->getParutionDate()|date_format:"%d/%m/%y"}
				        </p>
				        <p>
				            Auteur(s)/R&eacute;alisateur:{foreach $article_infos->getHTMLAuthors() as $author} {$author}, {/foreach}
				        </p>
				        <p>
							Acteur(s):{foreach $article_infos->getHTMLActors() as $actor} {$actor}, {/foreach}
				        </p>
						<p>
						
						</p>
				        
				        <p>
							{$article_infos->getHTMLDescription()}
						</p>
				    </td>
			    </tr>
			    <tr>
				    <td> </td>
				    <td><h2>Commander cet article:</h2><form method="post" name="ajoutArticle" action="index.php?page=cart&article={$article_infos->getID()}"><input type="text" name="quantite"/><input type=submit value="Ajouter au panier" title="Ajouter l'article au panier"/></form></td>
			    </tr>
	    </table>
    </div>
{else}
    <p class="error">Aucun article n'a &eacute;t&eacute; trouv&eacute;.<p>
{/if}
