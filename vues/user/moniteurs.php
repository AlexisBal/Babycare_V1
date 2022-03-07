<?php 
/**
* Vue : Moniteur
*/
?>

<h1 class="user-title-page">
    <a href="/compte/moniteurs">Moniteurs</a>
    <span>Accueil</span>
</h1>

<?php 
$i = 1;
foreach ($boitiers as $boitier) {
    ?>
    <div class="monitor-container">
        <div class="title">
            <?php if($boitier['prenom']){
                echo 'Boitier de '.$boitier['prenom'];
            } else {
                echo 'Boitier '.$i; 
            }
            ?>
            <span class="action-required">
                Action requise <img src="/assets/icons/danger-red.svg" alt="icon danger">
            </span>
        </div>
        <div class="status">
            <div class="icon">
                <img src="/assets/icons/eco.svg">
            </div>
            Gros danger pour le bébé :(
        </div>
        <div class="monitor-container-foot">
            <a href="/compte/parametres-boitier?boitier=<?php echo $boitier['idBoitier']; ?>"><img class="mr-8" src="/assets/icons/settings.svg" alt="icon settings">Paramètres du boitier</a>
            <a href="/compte/moniteurs?boitier=<?php echo $boitier['idBoitier']; ?>">Plus de détails<img class="ml-8" src="/assets/icons/right-arrow.svg" alt="icon chevron right"></a>
        </div>
    </div>
    <?php
    $i += 1;
}
?>

<button type="button" onClick="javascript:openModal('nvBoitier');" class="button_confirm mt-50">Nouveau boitier</Button>

<div class="modal" modal="nvBoitier">
    <div class="modal-content">
        <div class="modal-header">
            <div></div>
            <p>Ajouter un nouveau boitier</p>
            <button type="submit" class="close-modal" onClick="javascript:closeModal('nvBoitier');"><img alt="modal close icon" src="/assets/icons/close.svg" width="14"></button>
        </div>
        <div class="modal-body">

            <form method="POST">
                <label>ID d'activation</label>
                <input placeholder="91221f7237d98d95" type="text" name="idActivation" id="idActivation" class="input-text" required>
                <span class="error"><?php echo $idActivationErr;?></span>

                <label class="mt-8 block">Prénom</label>
                <input placeholder="Tom" type="text" name="prenom" class="input-text" requird>
                <span class="error"><?php echo $prenomErr;?></span>

                <label class="mt-8 block">Date de naissance</label>
                <input type="date" name="dateNaissance" class="input-text" required>
                <span class="error"><?php echo $dateNaissanceErr;?></span>

                <label class="mt-8 block">Sexe</label>
                <select name="sexe" class="input-text" required>
                    <option value="0">Homme</option>
                    <option value="1">Femme</option>
                </select>  
                <span class="error"><?php echo $sexeErr;?></span>

                <input type="submit" value="Ajouter" class="button_confirm mt-20">            
            </form>
              
        </div>
    </div>
</div>
