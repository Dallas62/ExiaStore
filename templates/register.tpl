<div class=contenu>
		<h1>Inscription</h1>
		<p>
				L'inscription permet des achats plus facile sur notre site! En créant un compte, vous pourrait effectuer des commandes sur notre site.
		</p>
		{if $connected == false}
		{if $missing_field == true}
		<p class="error">Des champs ne sont pas remplis.</p>
		{/if}
		{if $invalid_format == true}
		<p class="error">Format non valide.</p>
		{/if}	
		{if $invalid_password == true}
		<p class="error">Les mots de passe ne correspondent pas.</p>
		{/if}	
		{if $register_ok == true}
		<p class="error">Vous &ecirc;tes maintenant enregistr&eacute; sur le site.</p>
		{/if}	
		<table>
					<form method="post" name="inscription" action="index.php?page=register">
						<tr>
								<td><label>Login: </label></td>
								<td><input type="text" name="login" title="Le pseudo est l'identifiant qui vous permettra de vous connecter à votre compte"/></td>
						</tr>
						<tr>
								<td><label>Mot de passe: </label></td>
								<td><input type="password" name="mdp"/></td>
						</tr>
						<tr>
								<td><label>Confirmation du mot de passe: </label></td>
								<td><input type="password" name="mdpc" title="Veuillez entrer le même mot de passe qu'au dessus."/></td>
						</tr>
						<tr>
								<td><label>Nom: </label></td>
								<td><input type="text" name="name" /></td>
						</tr>
						<tr>
								<td><label>Prenom: </label></td>
								<td><input type="text" name="firstname" /></td>
						</tr>
						<tr>
								<td><label>Date de naissance: </label></td>
								<td><input type="text" name="birthday" /><br/>(jj-mm-aaaa)</td>
						</tr>
						<tr>
								<td><label>Adresse: </label></td>
								<td><input type="text" name="adresse" title="Cette adresse sera utilisée par défaut comme adresse de facturation"/></td>
						</tr>
						<tr>
								<td><label>Pays: </label></td>
								<td><input type="text" name="pays"/></td>
						</tr>
						<tr>
								<td><label>Code postal: </label></td>
								<td><input type="text" name="cp"/></td>
						</tr>
						<tr>
								<td><label>Ville: </label></td>
								<td><input type="text" name="ville"/></td>
						</tr>
						<tr>
								<td><label>Adresse email: </label></td>
								<td><input type="text" name="mail"/></td>
						</tr>
						<tr>
								<td colspan="2"><br/><input type="submit" value="Devenir membre" title="S'incrire maintenant!"/></td>
						</tr>
					</form>
		</table>
		{else}
		<p class="error">Vous &ecirc;tes connect&eacute;.</p>
		{/if}	
</div>
