<div class=contenu>
{if $connected == true}
	{if $command_not_found == false}
		<h1>Commande n&#176;{$commande.id}: </h1>
		
		<h2>Etat de la commande</h2>
		<p>
			Votre commande est {$commande.etat}.
		</p>
		<h2>Adresse de r&eacute;ception: </h2>
		<p> 
			{$commande.adresse}<br />
			{$commande.CP}, {$commande.ville}<br />
			{$commande.pays}
		</p>
		
		<h2>Contenu de la commande: </h2>
		<table CELLSPACING="0">
			<tr class=important>
				<th> Articles </th>
				<th> Quantit&eacute;s </th>
				<th> Prix </th>
			</tr>
									
			{foreach $commande.articles as $article}
			<tr class=grise>
				<td>
					<a href="#" title="Article commandé" >{$article.name}</a>
				</td>
								
				<td class=moyen>
					{$article.quantity}
				</td>
									
				<td class=moyen>
					{($article.price * (1 + $article.TVA / 100))*$article.quantity}
				</td>
			</tr>
			{/foreach}
									
			<tr class=important>
				<td> </td>
				<td>Total: </td>
				<td> {$commande.TTC} &euro;</td>
			</tr>
		</table>
	{else}
		<p class="error">Aucune commande n'a &eacute;t&eacute; trouv&eacute;e.<p>
	{/if}
{else}
	<p> Vous n'êtes pas connect&eacute; </p>
{/if}
	<br />
	<a href="javascript:window.history.back()" title="revenir sur la liste des commandes" class=boutton> Retour </a>
</div>