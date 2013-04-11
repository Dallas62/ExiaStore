<div class="contenu">
		<h1>Se connecter à notre site: </h1>
		    {if $connected == false}
			<table CELLSPACING="0" >
				<form method="post" name="connexion">
					<tr class=important>
						<td>
							Identifiant: 
						</td>
						<td>
							<input type="text" name="login" />
						</td>
					</tr>
					<tr class=important>
							<td>
								Mot de passe:
							</td>
							<td>
								<input type="text" name="mdp" />
							</td>
					</tr>
					<tr class=important>
							<td>
							</td>
							<td>
								<input type="submit" value=" Connexion " title="Se connecter" /><br />
								<a href="index.php?page=register" class=lienWhite>pas encore inscrit?</a>
							</td>
					</tr>
				</form>
			</table>
			{else}
			<p class="error">Vous &ecirc;tes connect&eacute;</p>
			{/if}
</div>
