<?php 
/**
* Vue : Espace accueil
*/
?>

<h1>Bienvenue, <?php echo $prenom; ?></h1>

<h2 class="mt-40 mb-20"> Notifications actives </h2> 
<div>
    <p> <img src="/assets/icons/notify.svg" alt= "clock" width="15" height="15" > Lundi 11 octobre - 13h40</p>
    <div>
        <div class="container-notif">
            <div class="notif-header">
                <div>
                    <img src="/assets/icons/thermometre-w.svg" alt= "thermometre" class="notif-icon"><span>Température élevée</span>
                </div>
                <button type="button" class="notif-close">
                    <img src="/assets/icons/close-w.svg" alt= "Croix" >
                </button>
            </div>
            <div class="notif-content">
                <p>La température du bébé est élevée, vérifiez ce qu'il se passe.</p>
                <div class="text-right mt-8">
                    <button class="button-more-info"
                        type="button"> Plus d'informations >
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</div>


<h2 class="mt-60 mb-20"> Dernières modifications </h2> 
<div>
    <p> <img src="/assets/icons/settings.svg" alt= "clock1" width="15" height="15" > Lundi 11 octobre - 13h41</p>
    <div>
        <div class="container-notif">
            <div class="notif-header">
                <div>
                    <img src="/assets/icons/thermometre-w.svg" alt= "thermometre" class="notif-icon"><span>Température élevée</span>
                </div>
                <button type="button" class="notif-close">
                    <img src="/assets/icons/close-w.svg" alt= "Croix" >
                </button>
            </div>
            <div class="notif-content">
                <p>La température du bébé est élevée, vérifiez ce qu'il se passe.</p>
                <div class="text-right mt-8">
                    <button class="button-more-info"
                        type="button"> Plus d'informations >
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</div>

