<?php 
/**
* Vue : Accueil Administrateur 
*/
?>

<h1>Accueil</h1>

<div class="admin-home-cards">
    <div class="cards">
        <label><?php echo $nvUtilisateurs; ?></label>
        <p>Nouveaux utilisateurs ce mois</p>     
    </div>

    <div class="cards">
        <label><?php echo $nbBoitiers; ?></label>
        <p>Boitiers actifs</p>     
    </div>

    <div class="cards">
        <label><?php echo $nbFAQ; ?></label>
        <p>Questions dans la F.A.Q</p>     
    </div>
</div>
<h3>Accès rapides</h3>
<div class="admin-home-container">
    <a href="/admin/gestion-utilisateurs" class="category">
        <img src="/assets/icons/users.svg" alt="icon users">
        <p>Utilisateurs</p>
    </a>
    <a href="/admin/gestion-boitiers" class="category">
        <img src="/assets/icons/electronics.png" alt="icon boitier">
        <p>Boitiers</p>
    </a>
</div>

