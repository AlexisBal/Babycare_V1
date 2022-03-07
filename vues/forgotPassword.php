<?php 
/**
* Vue : Mot de passe oublié 
*/
?>

<div class="forgotpassword-content">
	<header>
		
	</header>
	<form id="forgotPasswordForm" method="POST" action="">
		<a href="/"><img src="/assets/img/logo.png" class="logo-small" alt="Logo"></a>
		<div>
			<h1 class="bold text-center">Récupération de compte</h1>
			<p class="mt-20">Nous allons vous envoyer un lien vous permettant de vous connecter.</p>
			<input placeholder="Email" type="email" name="email" id="email" class="input-text mt-20" required autocomplete="username"> 
		</div>
		<input type="submit" class="button_confirm mt-20" value="Envoyer un email">
	</form>
</div>




