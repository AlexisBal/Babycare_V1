<?php 
/**
* Vue : Création d'un compte admin 
*/
?>

<h1>Création d'un compte gestionnaire</h1>

<div class="adminFormContent">
	<form method="POST" action="">
		<div class="adminForm">
			<label class="bold" for="email">Email</label>
			<input placeholder="admin1@babycare.fr" type="email" name="email" class="input-text" required autocomplete="off"> 
			<span class="error"><?php echo $emailErr;?></span>

			<label class="bold mt-8 block" for="prenom">Prénom</label>
			<input placeholder="Jimmy" type="text" name="prenom" class="input-text" required>

			<label class="bold mt-8 block" for="nom">Nom</label>
			<input placeholder="Sing" type="text" name="nom" class="input-text" required>
		</div>
		<input type="submit" class="button_confirm mt-20" value="Valider">
	</form>
</div>
