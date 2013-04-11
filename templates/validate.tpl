<div class=contenu>
<h1>Finaliser la commande : </h1>
<p>
	Afin de valider votre panier et de recevoir votre commande, veuillez entrer vos coordonn&eacute;es banquaires ci-dessous pour finaliser le paiement.
</p>
{if $connected == true}
	{if $is_validate == false}
		{if $missing_field == true}
			<p class="error"> Des champs sont vides </p> 
		{/if}
		{if $invalid_format == true}
			<p class="error"> Format non valide </p> 
		{/if}
		{if $expired_card == true}
			<p class="error"> Carte expir&eacute;e </p> 
		{/if}
		<table>
			<form method="post">
				<!-- Num de carte -->
				<tr><td>Num&eacute;ro de carte bancaire</td><td><input type="text" name="numeroCarte"/></td></tr>
				<!-- Trigramme de carte -->
				<tr><td>Trigramme de s&eacute;curit&eacute;</td><td><input type=text name="trigramme"/></td></tr>
				<!-- Date de carte -->
				<tr><td>Date d'expiration (mm/aa)</td><td><input type=text name="dateExp"/></td></tr>
				<!-- Adresse de livraison -->
				<tr><td>Adresse de livraison</td><td><input type="text" name="adLiv" value="{$account->getHTMLAdress()}"/></td></tr>
				<!-- Pays -->
				<tr><td>Pays</td><td><input type="text" name="pays" value="{$account->getHTMLCountry()}"/></td></tr>
				<!-- Code postal -->
				<tr><td>Code Postal</td><td><input type="text" name="cp" value="{$account->getCP()}"/></td></tr>
				<!-- Ville -->
				<tr><td>Ville</td><td><input type="text" name="ville" value="{$account->getHTMLCity()}"/></td></tr>
				<tr><td colspan="2"><input type="submit" value="Payer la commande" title="confirmer la commande et payer." /><td></tr>
			</form>
		</table>
	{else}
		<p> votre commande a bien &eacute;tait pass&eacute; </p>
	{/if}
{else}
	<p class="error">Vous devez &ecirc;tre connect&eacute;</p>
{/if}

</div>