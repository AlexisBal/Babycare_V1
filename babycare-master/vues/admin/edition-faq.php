<?php 
/**
* Vue : Edition de la FAQ
*/
?>

<h1>Edition de la FAQ</h1>


<div class="adminFormContent">
<?php 
$i = 1;
foreach ($questions as $question) {
    ?>
       <form method="POST" action="">
            <input type="hidden" name="form" value="form1">
            <input type="hidden" name="idQuestion" value="<?php echo $question["idQuestion"]; ?>">
            <div class="adminform mt-50">
                <h2 class="text-center mb-20"><span class="text-color text-green1">Question <?php echo $i; ?></span></h2>

                <label>Catégorie</label>
                <input type="text"  id="categorie" name="categorie" class="input-text"  value="<?php echo $question["categorie"]; ?>" required>

                <label class="mt-8 block">Question</label>
                <input type="text"  id="question" name="question" class="input-text" required value="<?php echo $question["question"]; ?>">

                <label class="mt-8 block">Réponse</label>
                <textarea id="reponse" name="reponse"  class="input-text" required value="<?php echo $question["reponse"]; ?>"><?php echo $question["reponse"]; ?></textarea>

                <span class="inline-container">
                    <input type="submit" class="button_confirm" value="Modifier">
                    <a class="button_delete" href="/admin/edition-faq-delete_question?id_question=<?php echo $question['idQuestion']; ?>">Supprimer</a><br>
                </span>
            </div>
        </form>
    <?php
    $i += 1;
}
?>
</div>

<button type="button" onClick="javascript:openModal('nvQuestion');" class="button_confirm mt-50">Nouvelle Question</Button>


<div class="modal" modal="nvQuestion">
    <div class="modal-content">
        <div class="modal-header">
            <div></div>
            <p>Ajouter une question</p>
            <button type="submit" class="close-modal" onClick="javascript:closeModal('nvQuestion');"><img alt="modal close icon" src="/assets/icons/close.svg" width="14"></button>
        </div>
        <div class="modal-body">
            <form method="POST">
                <input type="hidden" name="form" value="form2">

                <label>Catégorie</label>
                <input placeholder="Boitier" type="text"  id="categorie" name="categorie" class="input-text" required>
                
                <label>Question</label>
                <input placeholder="Le boitier de Babycare assure t’il la bonne santé de mon enfant ?" type="text"  id="question" name="question" class="input-text" required>

                <label>Réponse</label>
                <textarea id="reponse" name="reponse" placeholder="Le boitier que vous recevrez est à titre préventif de la santé de votre enfant, nous ne fournissons pas de solution médicale en cas de crise de votre enfant." class="input-text" required></textarea>

                <input type="submit" value="Ajouter" class="button_confirm mt-20">            
            </form>
        </div>
    </div>
</div>