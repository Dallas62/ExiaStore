<div class=contenu>
	{if $connected}
			<div id="affichage">
				<h1>Articles dont les stocks sont &agrave; renouveler</h1>
					<table CELLSPACING=0>
						<tr>
							<th class=important>
								<h1> Article </h1>
							</th>
							<th class=important>
								<h1> R&eacute;f&eacute;rence </h1>
							</th>
							<th class=important>
								<h1> Quantit&eacute; &agrave; commander </h1>
							</th>
							<th class=important>
								<h1> Valider la r&eacute;ception des stocks d'un article </h1>
							</th>
						</tr>
						{foreach $articles as $article}
						<tr>
							<td class=grise >
								<h2>{$article->getHTMLName()}</h2>
							</td>
							<td class=grise>
								<h2> {$article->getHTMLReference()} </h2>
							</td>
							<td class=grise>
								<h2> {$article->getStockToCommand()} </h2>
							</td>
							<td class=grise>
								<h2><a href="index.php?page=accueil&id={$article->getID()}&stocks={$article->getStockToCommand()}" class=bouton>&nbsp&nbspStock renouvel&eacute;&nbsp&nbsp</a></h2>
							</td>
						</tr>
						{foreachelse}
							</table>
							<p class=error>Aucun article ne n&eacute;cessite un renouvellement des stocks.</p>
						{/foreach}
					</table>				
			</div>
	{else}
		<h1 class=error>Vous n'&ecirc;tes pas connect&eacute; !</h1>
		<p>Veuillez vous connecter via le site pour pouvoir acc&eacute;der au site d'administration.</p>	
	{/if}
</div>