<?php 
/**
* Vue : Edition des moniteurs 
*/
?>

<h1>Edition des moniteurs</h1>

<div class="adminFormContent">
<?php
foreach($modals as $modal){
    ?>
    <form method="POST" action="">
        <input type="hidden" name="idModal" value="<?php echo $modal["idModal"]; ?>">
        <div class="adminform mt-50">
            <h2 class="text-center mb-20"><span class="text-color text-green1"><?php echo $modal["titre"]; ?></span></h2>

            <label class="mt-8 block">Titre</label>
            <input type="text"  id="titre" name="titre" class="input-text" required value="<?php echo $modal["titre"]; ?>">

            <label class="mt-8 block">Texte</label>
            <textarea id="texte" name="texte"  class="input-text" required value="<?php echo $modal["texte"]; ?>"><?php echo $modal["texte"]; ?></textarea>

            <span class="inline-container">
                <input type="submit" class="button_confirm" value="Modifier" class="mt-20">
            </span>
        </div>
    </form>
    <?php
}
?>
</div>
