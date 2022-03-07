<?php 
/**
* Vue : Gestion des capteurs
*/
?>

<h1>Gestion des capteurs</h1>

<?php 
if ($capteurs) {
    ?>
    <table class="tableAdmin mt-50">
    <tr>
        <th>ID</th> 
        <th>ID Boitier</th>  
        <th>Type</th> 
        <th>Sensibilité</th>
        <th>Action</th>
    </tr>
        <?php 
        foreach ($capteurs as $capteur) {
        ?>
            <tr>
                <td class="text-center"><?php echo htmlspecialchars($capteur["idCapteur"]); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($capteur["idBoitier"]); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($capteur["type"]); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($capteur["sensibilite"]); ?></td>
                <td class="text-left">
                    <a href="/admin/gestion-capteur-delete?id_boitier=<?php echo htmlspecialchars($capteur['idBoitier']); ?>&amp;id_capteur=<?php echo htmlspecialchars($capteur['idCapteur']); ?>">Supprimer le capteur</a><br>
                    <a href="javascript:openModalEditDialog('<?php echo htmlspecialchars($capteur["idCapteur"]); ?>');">Modifier le capteur</a>
                </td>
        </tr>
        <?php
        }
    ?>
    </table>
    <?php 
}
?>

<button type="button" onClick="javascript:openModal('nvCapteur');" class="button_confirm mt-50">Nouveau Capteur</Button>

<div class="modal" modal="nvCapteur">
    <div class="modal-content">
        <div class="modal-header">
            <p>Ajouter un nouveau capteur</p>
            <button type="submit" class="close-modal" onClick="javascript:closeModal('nvCapteur');"><img alt="modal close icon" src="/assets/icons/close.svg" width="14"></button>
        </div>
        <div class="modal-body">
            <form method="POST">
                <input type="hidden" name="form" value="form1">

                <label>Type</label>
                <input placeholder="son" type="text" name="type" id="type" class="input-text" required>
                <span class="error"><?php echo $typeErr;?></span>

                <label class="mt-8 block">Sensibilité</label>
                <input placeholder="0.9" type="number" name="sensibilite" id="sensibilite" class="input-text" min="0" step=".01" required>
                <span class="error"><?php echo $sensibiliteErr;?></span>

                <input type="submit" value="Ajouter" class="button_confirm mt-20">            
            </form>
        </div>
    </div>
</div>

<div class="modal" modal="modEditCapteur">
    <div class="modal-content">
        <div class="modal-header">
            <p>Modifier un capteur</p>
            <button type="submit" class="close-modal" onClick="javascript:closeModal('modEditCapteur');"><img alt="modal close icon" src="/assets/icons/close.svg" width="14"></button>
        </div>
        <div class="modal-body">
            <form method="POST">
                <input type="hidden" name="form" value="form2">
                <input type="hidden" name="idCapteur" id="idEdit">

                <label>Sensibilité</label>
                <input placeholder="0.9" type="number" name="sensibiliteEdit" id="sensibiliteEdit" class="input-text" min="0" step=".01" required>
                <span class="error"><?php echo $sensibiliteEditErr;?></span>

                <input type="submit" value="Modifier" class="button_confirm mt-20">            
            </form>
        </div>
    </div>
</div>



