<div id="contenu">	
			<h1>Liste des articles: </h1>
			<table CELLSPACING=0>
				<tr>
					<th class=important>
						<h1> Articles: </h1>
					</th>
					<th class=important>
						<h1> Reference </h1>
					</th>
					<th class=important>
						<h1> Etat </h1>
					</th>
					<th class=important>
						<h1> Quantit&eacute; </h1>
					</th>
					<th class=important>
						<h1 class=moyen> Passer en disponible / hors-stocks </h1>
					</th>
					<th class=important>
						<h1 class=moyen> Supprimer </h1>
					</th>
				</tr>
				{foreach $articles as $article}
				<tr>
					<td class=grise >
						<p>
							<a href="#" title="Afficher la fiche de l'article" class="bouton">{$article->getHTMLName()}</a><br />
						</p>
					</td>
					<td class=grise>
						<h2>{$article->getHTMLReference()} </h2>
					</td>
					<td class=grise>
						<h2>{if $article->getAvailable() == 1} Disponible {elseif $article->getAvailable() == 2} Hors-stock {/if}</h2>
					</td>
					<td class=grise>
						<h2>{$article->getQuantityStock()} </h2> <!-- etat de l'article: nouveauté, disponible, hors stocks -->
					</td>
					<td class=grise> 
						<br />{if $article->getAvailable() == 1} <a href="index.php?page=listarticles&id={$article->getID()}&disponibilite=2" class="bouton">&nbsp&nbspPasser en hors stocks&nbsp&nbsp</a> {elseif $article->getAvailable() == 2} <a href="index.php?page=listarticles&id={$article->getID()}&disponibilite=1" class="bouton">&nbsp&nbspPasser en disponible&nbsp&nbsp</a> {/if}
					</td>
					<td class=grise> 
						<br /><a href="index.php?page=listarticles&supprimer={$article->getID()}" class="bouton">&nbsp&nbspSupprimer l'article&nbsp&nbsp</a>
					</td>
				</tr>
				{/foreach}
			</table>
			<br /><a href="#" class="bouton"> Supprimer tous les articles hors-stoks </a>	
</div>