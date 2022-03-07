<?php 
/**
* Vue : FAQ
*/

include("navigation.php")
?>

<h1 class="title-section ml-16">Foire Aux Questions</h1>
<?php 
$i = 0;
$q = 1;
foreach ($questions as $question) {
    ?>
    <?php
    if ($i>0) {
        if ($question['categorie'] == $questions[$i-1]['categorie']) {
            ?>
            <div class="faqItem">
                <h3> <?php echo $question["question"]; ?> </h3>
                <p> <?php echo $question["reponse"]; ?> </p>
            </div>
            <?php
        } else {
            ?>
            </div>
            <h2 class="faq-cat"><?php echo $q.". ".$question['categorie']?></h2>
            <div class="faqContainer">
                <div class="faqItem">
                    <h3> <?php echo $question["question"]; ?> </h3>
                    <p> <?php echo $question["reponse"]; ?> </p>
                </div>
            <?php
            $q += 1;
        }
    } else {
        ?>
        <h2 class="faq-cat"><?php echo $q.". ".$question['categorie']?></h2>
        <div class="faqContainer">
            <div class="faqItem">
                <h3> <?php echo $question["question"]; ?> </h3>
                <p> <?php echo $question["reponse"]; ?> </p>
            </div>
        <?php
        $q += 1;
    }
    $i += 1;
}
?>
</div>
    

