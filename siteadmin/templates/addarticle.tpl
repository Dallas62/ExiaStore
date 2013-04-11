<div class=contenu>
{if connected}	
	{if $not_all_value_founded}
		<p>Veuillez enter des donn&eacute;es dans tous les champs afin de pouvoir cr&eacute;er un article!</p>
	{/if}
		
			<h1>Cr&eacute;ation d'un article: </h1>
			<form method="POST" enctype="multipart/form-data">
				<table class=tresGrand CELLSPACING=0>
					<tr class="grise">
						<td>
							<h2>Image de l'article: </h2>
							<img src="img/articleTest.png" alt="photo exemple d'article" /><br />
							<input type="file" name="image" />
						</td>
						<td>
							<h2>Nom de l'article: </h2>
							<input type="text" name="name" />
							<h2>Reference de l'article: </h2>
							<input type="text" name="referency" />
							<h2>Date de sortie: </h2>
							<input type="text" name="date" title="Sous la forme jour/mois/ann&eacute;e" />
							<p>(au format jour/mois/ann&eacute;e)</p>
						</td>
					</tr>
					<tr >
						<td>
							<h2>TVA appliqu&eacute;e &agrave; l'article: </h2>
							<input type="text" name="TVA" />
							<h2>Cat&eacute;gorie: </h2>
							<input type="text" name="category">
						</td>
						<td>
							<h2>Prix &agrave; l'unit&eacute;: </h2>
							<input type="text" name="price" />
							<h2>Sous cat&eacute;gorie: </h2>
							<input type="text" name="subcategory" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h2>Description: </h2>
							<textarea rows=5 value="aucune description" name="description">Entrez ici la description de l'article</textarea>
						</td>
					</tr>
					<tr>
						<td>
							<h2>Quantit&eacute; disponible: </h2>
							<input type="text" name="quantitydisponible" />
						</td>
						<td>
							<h2>Seuil d'alerte quantit&eacute;: </h2>
							<input type="text" name="quantityalert" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p>ATTENTION ! Pour les &eacute;l&eacute;ments suivants, veuillez entrer les noms et les s&eacute;parer par une virgule(ne pas mettre d'espaces apr&egrave;s la virgule!!).
						</td>
					</tr>
					<tr>
						<td>
							<h2>Auteur(s):</h2>
							<input type="text" name="authors" />
							<p>(ex: Nom prenom,Nom prenom,...)</p>
						</td>
						<td>
							<h2>Acteur(s):</h2>
							<input type="text" name="actors" />
							<p>(ex: Nom prenom,Nom prenom,...)</p>
						</td>
					</tr>
					<tr>
						<td>
							<h2>Mots clefs: </h2>
							<input type="text" name="keywords" />
							<p>(ex: motclef,motclef,...)</p>
						</td>
					<tr>
					</tr>
						<td colspan="2">
							<h1><input type="submit" value="Cr&eacute;er l'article" title="Cr&eacute;er l'article!" /></h1>
						</td>
					</tr>
				
				</table>
			</form>
		{if !$not_all_value_founded}
			{if $created}
				<h1>Creation de l'article termin&eacute;e</h1>
				<h2>Votre article a &eacute;t&eacute; cr&eacute;&eacute; correctement</h2>
			{else}
				<h1 class=error>ERREUR !!</h1>
				<h2>Une erreur a &eacute;t&eacute; rencontr&eacute;e lors de la cr&eacute;ation de l'article</h2>
			{/if}
		{/if}
{else}
	<h1 class=error>Vous n'&ecirc;tes pas connect&eacute; !</h1>
	<p>Veuillez vous connecter via le site pour pouvoir acc&eacute;der au site d'administration.</p>
{/if}	
</div>