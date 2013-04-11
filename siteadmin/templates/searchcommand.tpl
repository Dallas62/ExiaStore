<div id=contenu>
	{if $connected}
			<h1> Recherche d'une commande </h1>
			<div class=fonce>
				<form method="GET">
					<input type="hidden" name="page" value="searchcommand"/>
					<label>Nom de client</label><input type=text name="name" />
					<label>Prenom de client</label><input type=text name="firstname" />
					<label>Numero de commande</label><input type=text name="id" /><br />
					
					<input type=submit value="Chercher la commande"/>
				</form>
			</div>
		{if $true_value}
			<div id="affichage">
				<h1> Resultats de la recherche :</h1>
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
							<th class=important>
								<h1> Etat </h1>
							</th>
							<th class=important>
								<h1> Date d'envoie </h1>
							</th>
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
							<td class=grise>
								<h2> {$command->getStateWord()} </h2>
							</td>
							<td class=grise>
							{if $command->getState() == 2}
									<h2> {$command->getDeliveryDate()|date_format:"%d/%m/%y"} </h2>
							{/if}
							</td>
							
							<td class=grise>
								<h2><a href="index.php?page=command&commande={$command->getID()}" class=bouton> fiche d&eacute;taill&eacute;e</a></h2>
							</td>
						</tr>
						{foreachelse}
							</table>
							<p class=error>Aucune commande ne correspond aux crit&egrave;res de s&eacute;l&eacute;ction.</p>
						{/foreach}
					</table>				
			</div>
		{/if}
	{else}
		<h1 class=error>Vous n'&ecirc;tes pas connect&eacute; !</h1>
		<p>Veuillez vous connecter via le site pour pouvoir acc&eacute;der au site d'administration.</p>	
	{/if}
</div>
		
		