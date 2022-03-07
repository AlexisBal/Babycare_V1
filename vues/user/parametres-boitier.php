<?php 
/**
* Vue : Paramètres du boitier
*/
?>

<h1 class="user-title-page">
    <a href="/compte/moniteurs">Moniteurs</a>
    <a href="/compte/moniteurs?boitier=<?php echo $boitier_p['idBoitier']; ?>"><?php if($boitier_p['prenom']){ echo ucfirst($boitier_p['prenom']); } else { echo ucfirst($nomboitier); } ?></a>
    <span>Paramètres</span>
</h1>
<div class="adminFormContent">
	<form method="POST" action="">
        <input type="hidden" name="form" value="form1">

		<div class="adminform mt-20">
			<h2 class="text-center mb-20">Informations sur <span class="text-color text-green1"><?php echo ucfirst($nomboitier); ?></span></h2>

            <label>Prénom</label>
			<input placeholder="Entrer le prénom..." type="text" name="prenom" class="input-text" value="<?php echo ucfirst($boitier_p["prenom"]); ?>">

            <label>Date de naissance</label>
			<input type="date" name="dateNaissance" class="input-text" value="<?php echo $boitier_p["dateNaissance"]; ?>">

            <label>Sexe</label>
			<select name="sexe" class="input-text" value="<?php echo $boitier_p["sexe"]; ?>">
                <option value="" disabled selected>Select something...</option>
                <option value="0" <?php if (!$boitier_p["sexe"]) {echo "selected";} ?>>Homme</option>
                <option value="1" <?php if ($boitier_p["sexe"]) {echo "selected";} ?>>Femme</option>
            </select>

            <label>Poids (en kg)</label>
			<input type="text" inputmode="decimal" name="poids" class="input-text" value="<?php echo $boitier_p["poids"]; ?>">

            <label>Allergie(s) au pollen</label><br>
            <div>
                <input 
                    type="checkbox" 
                    id="Tilleul" 
                    name="Tilleul" 
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Tilleul") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Tilleul"> Tilleul</label><br>

                <input type="checkbox" id="Ambroisies" name="Ambroisies" value="Ambroisies" 
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Ambroisies") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Ambroisies"> Ambroisies</label><br>

                <input type="checkbox" id="Olivier" name="Olivier" value="Olivier"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Olivier") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Olivier"> Olivier</label><br>

                <input type="checkbox" id="Plantain" name="Plantain" value="Plantain"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Plantain") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Plantain"> Plantain</label><br>
                
                <input type="checkbox" id="Noisetier" name="Noisetier" value="Noisetier"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Noisetier") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Noisetier"> Noisetier</label><br>

                <input type="checkbox" id="Aulne" name="Aulne" value="Aulne"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Aulne") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Aulne"> Aulne</label><br>

                <input type="checkbox" id="Armoise" name="Armoise" value="Armoise"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Armoise") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Armoise"> Armoise</label><br>
                
                <input type="checkbox" id="Chataignier" name="Chataignier" value="Chataignier"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Chataignier") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Chataignier"> Châtaignier</label><br>

                <input type="checkbox" id="Urticacees" name="Urticacees" value="Urticacees"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Urticacees") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Urticacees"> Urticacées</label><br>

                <input type="checkbox" id="Oseille" name="Oseille" value="Oseille"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Oseille") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Oseille"> Oseille</label><br>

                <input type="checkbox" id="Graminees" name="Graminees" value="Graminees"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Graminees") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Graminees"> Graminées</label><br>

                <input type="checkbox" id="Chene" name="Chene" value="Chene"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Chene") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Chene"> Chêne</label><br>

                <input type="checkbox" id="Platane" name="Platane" value="Platane"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Platane") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Platane"> Platane</label><br>

                <input type="checkbox" id="Bouleau" name="Bouleau" value="Bouleau"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Bouleau") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Bouleau"> Bouleau</label><br>

                <input type="checkbox" id="Charme" name="Charme" value="Charme"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Charme") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Charme"> Charme</label><br>
                
                <input type="checkbox" id="Peuplier" name="Peuplier" value="Peuplier"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Peuplier") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Peuplier"> Peuplier</label><br>

                <input type="checkbox" id="Frene" name="Frene" value="Frene"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Frene") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Frene"> Frêne</label><br>

                <input type="checkbox" id="Saule" name="Saule" value="Saule"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Saule") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Saule"> Saule</label><br>

                <input type="checkbox" id="Cupressacees" name="Cupressacees" value="Cupressacees"
                    <?php foreach ($allergies as $a) {
                        if ($a["type"] == "Cupressacees") {
                            echo "checked";
                        }
                    }
                    ?> 
                >
                <label for="Cupressacees"> Cupressacées</label><br>
            </div>
		</div>
		<input type="submit" class="button_confirm" value="Valider" class="mt-20">
	</form>

    <form method="POST" action="">
        <input type="hidden" name="form" value="form2">

        <div class="adminform mt-60 mb-20 text-center">
            <h2 class="text-center mb-20">Paramètre de notification</h2>
            <div class="mt-20">				
				<label class="labelcheckbox"><input type="checkbox" id="son" name="son" class="mr-8" <?php if ($boitier_p["activerSon"]) {echo "checked";} ?>>Activer le son</label>
			</div>
            <div class="mt-20">				
				<label class="labelcheckbox"><input type="checkbox" id="push" name="push" class="mr-8" <?php if ($boitier_p["activerNotifPush"]) {echo "checked";} ?>>Notification push</label>
			</div>
            <div class="mt-20">				
				<label class="labelcheckbox"><input type="checkbox" id="mail" name="mail" class="mr-8" <?php if ($boitier_p["activerNotifMail"]) {echo "checked";} ?>>Notification par mail</label>
			</div>
            <div class="text-left mt-40">
                <label>Seuil d’alerte Fréquence Cardiaque (BPM)</label>
                <input placeholder="Entrer une valeur..." type="number" name="bpm" class="input-text" min="30" max="200" value="<?php echo $boitier_p["seuilAlerteFreq"]; ?>">
                <div class="text-right">
                    <button class="btn-reset">Réinitialiser</button>
                </div>

                <label>Seuil d’alerte Température Corporelle (°C)</label>
                <input placeholder="Entrer une valeur..." type="number" name="temp" class="input-text" min="30" max="50" value="<?php echo $boitier_p["seuilAlerteTemp"]; ?>">
                <div class="text-right">
                    <button class="btn-reset">Réinitialiser</button>
                </div>

                <label>Seuil d’alerte Humidité Corporelle (%)</label>
                <input placeholder="Entrer une valeur..." type="number" name="hum" class="input-text" min="0" max="100" value="<?php echo $boitier_p["seuilAlerteHum"]; ?>">
                <div class="text-right">
                    <button class="btn-reset">Réinitialiser</button>
                </div>
            </div>
            
        </div>
        <input type="submit" class="button_confirm" value="Valider" class="mt-20">
    </form>

</div>
