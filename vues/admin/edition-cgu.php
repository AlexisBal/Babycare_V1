<?php 
/**
* Vue : Edition des CGU
*/
?>
<h1>Edition des CGU</h1>

<div class="adminFormContent">
<?php
foreach($articles as $article){
    ?>

    <form method="POST" action="">
        <input type="hidden" name="idArticle" value="<?php echo $article["idArticle"]; ?>">
        <input type="hidden" name="form" value="form1">
        <div class="adminform mt-50">
            <h2 class="text-center mb-20"><span class="text-color text-green1"><?php echo $article["titre"]; ?></span></h2>

            <label class="mt-8 block">Catégorie</label>
            <input type="text"  id="categorie" name="categorie" class="input-text" required value="<?php echo $article["categorie"]; ?>">

            <label class="mt-8 block">Titre</label>
            <input type="text"  id="titre" name="titre" class="input-text" required value="<?php echo $article["titre"]; ?>">

            <label class="mt-8 block">Texte</label>
            <textarea id="texte" name="texte"  class="input-text" required value="<?php echo $article["texte"]; ?>"><?php echo $article["texte"]; ?></textarea>

            <span class="inline-container">
                <input type="submit" class="button_confirm" value="Modifier" class="mt-20">
                <a class="button_delete" href="/admin/edition-cgu-delete_article?id_article=<?php echo $article['idArticle']; ?>">Supprimer</a><br>
            </span>
            
        </div>
    </form>
    <?php
}
?>
<button type="button" onClick="javascript:openModal('nvArticle');" class="button_confirm mt-50">Nouvel Article</Button>


<div class="modal" modal="nvArticle">
    <div class="modal-content">
        <div class="modal-header">
            <div></div>
            <p>Ajouter un Article</p>
            <button type="submit" class="close-modal" onClick="javascript:closeModal('nvArticle');"><img alt="modal close icon" src="/assets/icons/close.svg" width="14"></button>
        </div>
        <div class="modal-body">
            <form method="POST">
                <input type="hidden" name="form" value="form2">

                <label>Catégorie</label>
                <input placeholder="Conditions générales d'utilisation du compte" type="text"  id="categorie" name="categorie" class="input-text" required>
                
                <label>Titre</label>
                <input placeholder="Article 2 - Conditions d'accès aux Services et d'utilisation du compte Babycare" type="text"  id="titre" name="titre" class="input-text" required>

                <label>Texte</label>
                <textarea id="texte" name="texte" class="input-text" required></textarea>

                <input type="submit" value="Ajouter" class="button_confirm mt-20">            
            </form>
        </div>
    </div>
</div>
</div>


