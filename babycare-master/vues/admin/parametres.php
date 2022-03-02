<?php 
/**
* Vue : Paramètres
*/
?>

<h1>Paramètres</h1>

<div class="adminFormContent">
	<form method="POST" action="">
		<div class="adminform">
			<h2 class="text-center">Modification du mot de passe</h2>
			<input placeholder="Ancien mot de passe" type="password" name="password" class="input-text mt-20" required autocomplete="current-password">
			<span class="error"><?php echo $passwordErr;?></span>
			<input placeholder="Nouveau mot de passe" type="password" name="newPassword" class="input-text" required autocomplete="new-password">
			<span class="error"><?php echo $newPasswordErr;?></span>
			<input placeholder="Confirmation du mot de passe" type="password" name="newPasswordConfirm" class="input-text" required autocomplete="new-password">
			<span class="error"><?php echo $newPasswordConfirmErr;?></span>
		</div>
		<input type="submit" class="button_confirm" value="Valider" class="mt-20">
	</form>
</div>
