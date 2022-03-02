<?php 
/**
* Vue : Moniteurs Environnement + Santé
*/

?>

<h1 class="user-title-page">
    <a href="/compte/moniteurs">Moniteurs</a>
    <a href="/compte/moniteurs?boitier=<?php echo $boitier['idBoitier']; ?>"><?php if($boitier['prenom']){ echo ucfirst($boitier['prenom']); } else { echo ucfirst($nomboitier); } ?></a>
    <span><?php echo $title; ?></span>
</h1>

<div class="monitor-data-container">

    <?php

        foreach($tousLesCapteurs as $capteur){
 
            //Si le capteur n'a pas de données
            if(empty($capteur['nom'])) continue;

            switch($capteur['type']){
                //Les capteurs listés ici vont dans la page environnement
                case "son":
                case "co2":
                case "pollen":
                    if($title == "Santé") continue 2;
                    break;
                //Les autres vont dans la page santé
                default:
                    if($title == "Environnement") continue 2;
                    break;
            }
            ?>              
                <div class="progress-container data-capteur" capteur-id="<?php echo $capteur["idCapteur"]; ?>" capteur-nom="<?php echo $capteur["nom"]; ?>">     
                    <button type="button" class="clickableProgress " onClick="javascript:openModalDialog('<?php echo $capteur['type']; ?>');">
                        <p class="progress-title"><?php echo $capteur["nom"]; ?></p>
                        <div class="progress" >
                            <div class="progress-value"></div>
                        </div>
                    </button>
                    <div class="progress-detail data-value"></div>
                </div>

            <?php
        }

    ?>
   <?php if(isset($risque)){ ?>
    <div class="progress-container">

            <button type="button" class="clickableProgress" onClick="javascript:openModalDialog('pollen');">
                <p class="progress-title">Risque d'allergie au pollen</p>
                <div class="progress" >
                    <div class="<?php if($risque) { echo "progress-pollen-alert"; } else { echo "progress-pollen"; } ?>"></div>
                </div>
            </button>
            <div class="progress-detail"><?php if($risque) { echo "OUI"; } else { echo "NON"; } ?></div>
    </div>
    <?php } ?>

</div>



<div class="modal" modal="modal-info">
    <div class="modal-content">
        <div class="modal-header">
            
            <p id="modal-title"></p>
            <button type="submit" class="close-modal" onClick="javascript:closeModal('modal-info');"><img alt="modal close icon" src="/assets/icons/close.svg" width="14"></button>
        </div>
        <div class="modal-body" id="modal-content"></div>
    </div>
</div>




