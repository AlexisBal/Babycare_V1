<?php 
/**
* Vue : Gestion des boitiers 
*/
?>

<h1>Gestion des boitiers</h1>

<form method="post" action="" class="mt-50">
  <input type="hidden" name="form" value="form1">
  <input placeholder="Rechercher" type="text" name="search" id="search" class="input-text" onchange="submit">
  <a href="gestion-boitiers" class="button_confirm mt-30">Réinitialiser</a>
</form>

<table class="tableAdmin mt-50">
  <tr>
    <th><a href='/admin/gestion-boitiers&nom=idBoitier'>ID</a></th> 
    <th><a href='/admin/gestion-boitiers&nom=idActivation'>ID Activation</a></th> 
    <th><a href='/admin/gestion-boitiers&nom=idUtilisateur'>ID Utilisateur</a></th> 
    <th><a href='/admin/gestion-boitiers&nom=prenom'>Prénom</a></th> 
    <th>Action</th>
  </tr>
<?php 
    foreach ($boitiers as $boitier) {
      ?>
        <tr>
          <td class="text-center"><?php echo htmlspecialchars($boitier["idBoitier"]); ?></td>
          <td class="text-center"><?php echo htmlspecialchars($boitier["idActivation"]); ?></td>
        <?php
          if ($boitier["idUtilisateur"]) {
            ?>
            <td class="text-center"><?php echo htmlspecialchars($boitier["idUtilisateur"]); ?></td>
            <?php
            if ($boitier['prenom']) {
              ?>
              <td class="text-center capitalize"><?php echo htmlspecialchars($boitier["prenom"]); ?></td>
              <?php
            } else {
              ?>
              <td class="text-center">None</td>
              <?php  
            }
          } else {
            ?>
            <td class="text-center">Non Actif</td>
            <td class="text-center">None</td>
            <?php
          }
          ?>
          <td class="text-left">
            <a href="/admin/gestion-boitier-delete&id_boitier=<?php echo htmlspecialchars($boitier['idBoitier']); ?>">Supprimer le boitier</a><br>
            <a href='/admin/gestion-capteurs?id_boitier=<?php echo htmlspecialchars($boitier['idBoitier']); ?>'>Gérer les capteurs</a>
          </td>
      </tr>
    <?php
    }
?>
</table>

<form method="POST" class="mt-30">
  <input type="hidden" name="form" value="form2">
  <input type="submit" value="Nouveau boitier" class="button_confirm">            
</form>
