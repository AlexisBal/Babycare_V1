<?php 
/**
* Vue : Paramètres
*/
?>

<h1 class="user-title-page"><?php echo $title; ?></h1>

<div class="adminFormContent">
	<form method="POST" action="">
        <input type="hidden" name="form" value="form1">

		<div class="adminform mt-20">
			<h2 class="text-center mb-20">Informations personnelles</h2>
            <label>Nom</label>
			<input placeholder="Dupont" type="text" name="nom" class="input-text" required value="<?php echo ucfirst($user["nom"]); ?>">
            <span class="error"><?php echo $nomErr;?></span>

            <label class="mt-8 block">Prénom</label>
			<input placeholder="Tom" type="text" name="prenom" class="input-text" required value="<?php echo ucfirst($user["prenom"]); ?>">
            <span class="error"><?php echo $prenomErr;?></span>

            <label class="mt-8 block">Adresse email</label>
			<input placeholder="tom.dupont@gmail.com" type="email" name="email" class="input-text" required value="<?php echo $user["email"]; ?>">
            <span class="error"><?php echo $emailErr;?></span>

            <label class="mt-8 block">Code postal</label>
			<input placeholder="78490" type="text" name="cp" id="cp" class="input-text" required maxlength="5" minlength="5" required value="<?php echo $user["cp"]; ?>">
            <span class="error"><?php echo $cpErr;?></span>

		</div>
		<input type="submit" class="button_confirm mt-20" value="Valider">
	</form>

    <form method="POST" action="">
        <input type="hidden" name="form" value="form2">

        <div class="adminform mt-60">
            <h2 class="text-center mb-20">Modification du mot de passe</h2>
            <label>Ancien mot de passe</label>
            <input placeholder="Entrez le mot de passe..." type="password" name="password" class="input-text" required autocomplete="current-password">
            <span class="error"><?php echo $passwordErr;?></span>

            <label>Nouveau mot de passe</label>
            <input placeholder="Entrez le mot de passe..." type="password" name="newPassword" class="input-text" required autocomplete="new-password">
            <span class="error"><?php echo $newPasswordErr;?></span>

            <label>Confirmation du mot de passe</label>
            <input placeholder="Entrez le mot de passe..." type="password" name="newPasswordConfirm" class="input-text" required autocomplete="new-password">
            <span class="error"><?php echo $newPasswordConfirmErr;?></span>
        </div>
        <input type="submit" class="button_confirm mt-20" value="Valider">
    </form>

</div>

<?php echo $alert; ?>
