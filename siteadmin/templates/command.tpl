{if $connected}
	{if $command_not_found == false}
		<div class=contenu>
								
			<h1> Commande n&#176; {$command->getID()} </h1>
	
			<h2>Adresse de reception: </h2>
			<p> {$command->getMemberName()}<br /> {$command->getAddress()},<br /> {$command->getCP()}, {$command->getCity()} <br /> {$command->getCountry()}</p>
			<table class=tresGrand CELLSPACING="0">
				<tr>
					<th class=important>
						<h1> Articles </h1>
					</th>
												
					<th class=important>
						<h1> R&eacute;f&eacute;rences </h1>
					</th>
											
					<th class=important>
						<h1> Quantit&eacute;s </h1>
					</th>
				</tr>
				{foreach $command->getArticlesList() as $article}
				<tr>
					<td class=grise>
						<h2> {$article.name} </h2>
					</td>
					<td class=grise>
						<h2> {$article.ref} </h2>
					</td>
					<td class=grise>
						<h2> {$article.quantity} </h2>
					</td>
				</tr>
				{foreachelse}
					<tr>
						<td colspan="3">
							<p class=error>ERREUR: aucun article n'a &eacutetait enregistrer dans la commande!</p>
						</td>
					</tr>
				{/foreach}
			</table><br />
			{if $command->getState() == 0}
				<a href="index.php?page=command&commande={$command->getID()}&setState=1" class=bouton title="Passer la commande en mode pr&ecirc;te"> Passer la commande en mode pr&ecirc;te </a>
				<a href="index.php?page=commands&etat=0" class=bouton>&nbsp Retour &agrave; la liste des commandes &nbsp</a>
			{elseif $command->getState() == 1}
				<a href="index.php?page=command&commande={$command->getID()}&setState=2" class=bouton title="Passer la commander en mode envoy&eacute;e"> Passer la commande en mode envoy&eacute;e </a>
				<a href="index.php?page=commands&etat=1" class=bouton>&nbsp Retour &agrave; la liste des commandes &nbsp</a>
			{else}
				<a href="index.php?page=commands&etat=3" class=bouton>&nbsp Retour &agrave; la liste des commandes &nbsp</a>
			{/if}
			
		</div>
	{else}
		<p class=error>ERREUR! Commande non trouv&eacute;e!</p>
	{/if}
{else}
	<h1 class=error>Vous n'&ecirc;tes pas connect&eacute;!</h1>
	<p>Veuillez vous connecter via le site pour pouvoir acc&eacute;der au site d'administration.</p>
	</div>
{/if}
	