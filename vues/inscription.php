<?php 
/**
* Vue : Inscription
*/
?>
<div class="login-container">
	<div class="login-content">
		<form id="inscriptionForm" method="POST" action="" autocomplete="off">
			<a href="/"><img src="/assets/img/logo.png" class="logo" alt="Logo"></a>
			<div>
				<input placeholder="Numéro d'activation" type="text" name="idActivation" id="idActivation" class="input-text" required>
				<span class="error"><?php echo $idActivationErr;?></span><br/>
				<input placeholder="Email" type="email" name="email" id="email" class="input-text" required onkeypress="javascript:verifEmail();" onchange="javascript:verifEmail();> 
				<span class="error" id="emailErr"><?php echo $emailErr;?></span><br/>
				<input placeholder="Prénom" type="text" name="prenom" id="prenom" class="input-text" required>
				<span class="error"><?php echo $prenomErr;?></span><br/>
				<input placeholder="Nom" type="text" name="nom" class="input-text" id="nom" required>
				<span class="error"><?php echo $nomErr;?></span><br/>
				<input placeholder="Code Postal" type="text" name="cp" id="cp" class="input-text" required maxlength="5" minlength="5" onkeypress="javascript:verifCp();" onchange="javascript:verifCp();">
				<span id="CpErr" class="error"><?php echo $cpErr;?></span><br/>
				<input placeholder="Mot de passe" type="password" name="password" id="password" class="input-text" required onkeypress="javascript:verifPassword();" onchange="javascript:verifPassword();">
				<span id="pwdErr" class="error"><?php echo $passwordErr;?></span><br/>
				<input placeholder="Confirmation du mot de passe" type="password" name="passwordConfirm" id="passwordConfirm" class="input-text" required onkeypress="javascript:verifConfirmPassword();" onchange="javascript:verifConfirmPassword();">
				<span id="pwdConfErr" class="error"><?php echo $passwordConfirmErr;?></span><br/>
				<div class="mt-20">			
					<label><input type="checkbox" name="cgu_confirmation" class="mr-8" required> J'ai lu et j'accepte les </label>
					<a href="/utilisateur/cgu"><u>CGU</u></a>.
				</div>
			</div>
			<input type="submit" class="button_confirm mt-20" value="Inscription">
		</form>
	</div>
</div>
