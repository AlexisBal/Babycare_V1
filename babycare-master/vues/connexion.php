<?php 
/**
* Vue : Connexion
*/
?>

<div class="login-container">
	<div class="login-content">
		<form id="connexionForm" method="POST" action="">
			<a href="/"><img src="/assets/img/logo.png" class="logo" alt="Logo"></a>
			<div>
				<input placeholder="Email" type="email" name="email" id="email" class="input-text" required autocomplete="username" onchange="javascript:verifEmail();"> 
				<div>
					<span class="error" id="emailError"><?php echo $emailErr;?></span><br/>
				</div>
				<input placeholder="Mot de passe" type="password" id="password" name="password" class="input-text" required autocomplete="current-password">
				<span class="error" id="pwdError"><?php echo $passwordErr;?></span><br/>
				<div class="mt-20">				
					<label class="labelcheckbox"><input type="checkbox" id="rememberMe" name="rememberMe" class="mr-8">Se souvenir de moi</label>
				</div>
			</div>
			<input type="submit" class="button_confirm mt-20" value="Connexion">
			<a class="login-forgot" href="/utilisateur/forgotpassword">Mot de passe oublié ?</a>
		</form>
	</div>
</div>
