<?php 
/**
* Vue : CGU
*/

include("navigation.php")
?>

<h1 class="title-section ml-16">Conditions Générales d'Utilisation</h1>
<?php 
$i = 0;
$q = 1;
foreach ($articles as $article) {
    ?>
    <?php
    if ($i>0) {
        if ($article['categorie'] == $articles[$i-1]['categorie']) {
            ?>
            <div class="faqItem">
                <h3> <?php echo $article["titre"]; ?> </h3>
                <p> <?php echo $article["texte"]; ?> </p>
            </div>
            <?php
        } else {
            ?>
            </div>
            <h2 class="faq-cat"><?php echo $q.". ".$article['categorie']?></h2>
            <div class="faqContainer">
                <div class="faqItem">
                    <h3> <?php echo $article["titre"]; ?> </h3>
                    <p> <?php echo $article["texte"]; ?> </p>
                </div>
            <?php
            $q += 1;
        }
    } else {
        ?>
        <h2 class="faq-cat"><?php echo $q.". ".$article['categorie']?></h2>
        <div class="faqContainer">
            <div class="faqItem">
                <h3> <?php echo $article["titre"]; ?> </h3>
                <p> <?php echo $article["texte"]; ?> </p>
            </div>
        <?php
        $q += 1;
    }
    $i += 1;
}
?>
</div>
    

