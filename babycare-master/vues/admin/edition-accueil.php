<?php 
/**
* Vue : Edition Page d'accueil
*/
?>

<h1>Edition de la page d'accueil</h1>

<div class="adminFormContent">
    <h2 class="text-center">Présentation de l'entreprise</h2>
    <form method="POST" action="">
        <input type="hidden" name="form" value="form0">
        <div class="adminform mt-20">
            <textarea id="text-accueil" name="text-accueil" class="input-text" required value="<?php echo $texte_accueil["texte"]; ?>"><?php echo $texte_accueil["texte"]; ?></textarea>
            <span class="inline-container">
                <input type="submit" class="button_confirm" value="Modifier" class="mt-20">
            </span>
        </div>
    </form>

    <h2 class="text-center mt-50">Membres de l'entreprise</h2>
<?php
foreach($personnes as $personne){
    ?>
    <form method="POST" action="">
        <input type="hidden" name="idPersonne" value="<?php echo $personne["idPersonne"]; ?>">
        <input type="hidden" name="form" value="form1">
        <div class="adminform mt-20">
            <h2 class="text-center mb-20"><span class="text-color text-green1"><?php echo ucfirst($personne["prenom"])." ".ucfirst($personne["nom"]); ?></span></h2>

            <label class="mt-8 block">Nom</label>
            <input type="text"  id="nom" name="nom" class="input-text capitalize" required value="<?php echo $personne["nom"]; ?>">

            <label class="mt-8 block">Prénom</label>
            <input type="text"  id="prenom" name="prenom" class="input-text capitalize" required value="<?php echo $personne["prenom"]; ?>">

            <label class="mt-8 block">role</label>
            <input type="text"  id="role" name="role" class="input-text capitalize" required value="<?php echo $personne["role"]; ?>">

            <span class="inline-container">
                <input type="submit" class="button_confirm" value="Modifier" class="mt-20">
                <a class="button_delete" href="/admin/edition-accueil-delete_member?id_member=<?php echo $personne['idPersonne']; ?>">Supprimer</a><br>
            </span>
        </div>
    </form>
    <?php
}
?>
<button type="button" onClick="javascript:openModal('nvMembre');" class="button_confirm mt-50">Nouveau Membre</Button>


<div class="modal" modal="nvMembre">
    <div class="modal-content">
        <div class="modal-header">
            <div></div>
            <p>Ajouter un Membre</p>
            <button type="submit" class="close-modal" onClick="javascript:closeModal('nvMembre');"><img alt="modal close icon" src="/assets/icons/close.svg" width="14"></button>
        </div>
        <div class="modal-body">
            <form method="POST">
                <input type="hidden" name="form" value="form2">

                <label>Prenom</label>
                <input placeholder="Tom" type="text"  id="prenom" name="prenom" class="input-text" required>
                
                <label>Nom</label>
                <input placeholder="Dupont" type="text"  id="nom" name="nom" class="input-text" required>

                <label class="mt-8 block">role</label>
                <input type="text"  id="role" name="role" class="input-text capitalize" required>

                <input type="submit" value="Ajouter" class="button_confirm mt-20">            
            </form>
        </div>
    </div>
</div>
</div>
