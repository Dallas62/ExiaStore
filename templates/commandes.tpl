<div class=contenu>
	<h1>Espace client</h1>
	<h2>Modifier les informations du compte: </h2>
	
	{if $format_false == true}
		<p class=error>Des champs sont invalides, veuillez les remplir correctement!</p>
	{/if}
	<table><form method="post" name="modification">
					

		<tr>
			<td><label>Adresse: </label></td><td><input type="text" title="Cette adresse sera utilisée par défaut comme adresse de facturation" name=adresse value="{$account->getHTMLAdress()}"/></td>
		</tr>
		<tr>
			<td><label>Code postal: </label></td><td><input type="text" name=cp value="{$account->getCP()}"/></td>
		</tr>
		<tr>
			<td><label>Ville: </label></td><td><input type="text" name=ville value="{$account->getHTMLCity()}"/></td>
		</tr>
		<tr>
			<td><label>Pays: </label></td><td><input type="text" name=pays value="{$account->getHTMLCountry()}"/></td>
		</tr>
		<tr>
			<td><label>Adresse email: </label></td><td><input type="text" name="mail" value="{$account->getHTMLMail()}"/></td>
		</tr>
		<tr>
			<td><label>Nouveau mot de passe: </label></td><td><input type="text" name="password"/></td>
		</tr>
		<tr>
			<td><label>Confirmation du nouveau mot de passe: </label></td><td><input type="text" title="Veuillez entrer le même mot de passe qu'au dessus." name="passwordVerif"/></td>
		</tr>
		<tr>
			<td> </td><td><br/><input type="submit" value="Enregistrer les modifications" title="Sauvegarder les modifications effectuées!"/></td>
		</tr>
	</form></table>
	{if $modified == 1}
		<p>Modification effectu&eacute;e</p>
	{elseif $modified == 2}
		<p class=error>Erreur dans la modification des informations</p>
	{/if}
	
	<h2>Liste des commandes pass&eacute;es: </h2>
	<table CELLSPACING=0 class=tresGrand>
		<tr class=important>
			<th class=petit>
				Numero de commande
			</th>
			<th>
				Date de commande
			</th>
			<th>
				Date de r&eacute;ception
			</th>
			<th>
				Etat
			</th>
		</tr>
		{foreach $list as $commande}
			<tr class=grise >
				<td >
					<a href="index.php?page=commande&commande={$commande.id}" class=bouton>{$commande.id}</a>
				</td>
				<td>
					{$commande.date_commande|date_format:"%d/%m/%y"}
				</td>
				<td>
					{$commande.date_delivery|date_format:"%d/%m/%y"}
				</td>
				<td>
					{if $commande.etat == 0}
					En pr&eacute;paration
					{elseif $commande.etat == 1}
					Pr&ecirc;te &agrave; envoyer
					{elseif $commande.etat == 2}
					Envoy&eacute;e
					{/if}
				</td>
			</tr>
		{foreachelse}
			<tr class=grise>
				<td colspan="4">
					Aucune commande n'a encore était pass&eacute;e
				</td>
			</tr>
		{/foreach}
	</table>
					
</div>