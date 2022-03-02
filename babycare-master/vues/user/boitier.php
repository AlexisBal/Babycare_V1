<?php 
/**
* Vue : Informations Boitier
*/
?>

<h1 class="user-title-page">
    <a href="/compte/moniteurs">Moniteurs</a>
    <span><?php if($boitier['prenom']){ echo ucfirst($boitier['prenom']); } else { echo ucfirst($nomboitier); } ?></span>
</h1>

<div class="float-right">
    <a href="/compte/parametres-boitier?boitier=<?php echo $_GET['boitier']; ?>" style="display:flex;align-items: center;">
        <img class="mr-8 w-20" src="/assets/icons/settings.svg" alt="icon settings">
        <span>Paramètres du boitier</span>
    </a>

</div>

<h2 class="mt-40 mb-20"> Notifications actives </h2> 
<div class="mb-60">
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


<div class="monitor-icon-container">
    <a href="<?php echo '/compte/moniteurs?boitier='.$_GET['boitier'].'&donnees=environnement'; ?>" class="category">
        <img src="/assets/icons/eco-black.svg" alt="icon eco">
        <p>Environnement</p>
    </a>
    <a href="<?php echo '/compte/moniteurs?boitier='.$_GET['boitier'].'&donnees=sante'; ?>" class="category">
        <img src="/assets/icons/first-aid-kit.svg" alt="icon first aid kits">
        <p>Santé</p>
    </a>
</div>