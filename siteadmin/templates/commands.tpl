<div class=contenu>
{if $connected}
	{if $true_value}
		<div id="affichage">
			{if $state == 0}
				<h1>Liste des commandes en pr&eacute;paration: </h1>
			{elseif $state == 1}
				<h1>Liste des commandes pr&ecirc;tes &agrave; envoyer: </h1>
			{elseif $state == 2}
				<h1>Liste des commandes envoy&eacute;es: </h1>
			{/if}
				<table CELLSPACING=0>
					<tr>
						<th class=important>
							<h1> Numero de commande </h1>
						</th>
						<th class=important>
							<h1> Client </h1>
						</th>
						<th class=important>
							<h1> Date de commande </h1>
						</th>
						{if $state == 2}
							<th class=important>
								<h1> Date d'envoie </h1>
							</th>
						{/if}
						<th class=important>
							<h1> Voir la fiche de la commande </h1>
						</th>
					</tr>
					{foreach $commands as $command}
					<tr>
						<td class=grise >
							<h2>{$command->getID()}</h2>
						</td>
						<td class=grise>
							<h2> {$command->getMemberName()} </h2>
						</td>
						<td class=grise>
							<h2> {$command->getDate()|date_format:"%d/%m/%y"} </h2> <!-- prix en euros de la commande -->
						</td>
						{if $state == 2}
							<td class=grise>
								<h2> {$command->getDeliveryDate()|date_format:"%d/%m/%y"} </h2>
							</td>
						{/if}
						<td class=grise>
							<h2><a href="index.php?page=command&commande={$command->getID()}" class=bouton> voir la fiche d&eacute;taill&eacute;e</a></h2>
						</td>
					</tr>
					{foreachelse}
						</table>
						<p class=error>Aucune commande ne correspond aux crit&egrave;res de s&eacute;l&eacute;ction.</p>
					{/foreach}
				</table>				
		</div>
	{else}
		<h1 class=error>Erreur dans le chargement de la page!</h1>
		<p>Veuillez selectionner dans le menu de gauche une catégorie valide.</p>	
	{/if}
{else}
	<h1 class=error>Vous n'&ecirc;tes pas connect&eacute; !</h1>
	<p>Veuillez vous connecter via le site pour pouvoir acc&eacute;der au site d'administration.</p>	
{/if}
</div>