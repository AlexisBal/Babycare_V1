<?php 
/**
* Vue : Gestion des utilisateurs
*/
?>

<h1>Gestion des utilisateurs</h1>

<form method="post" action="" class="mt-50">
  <input placeholder="Rechercher" type="text" name="search" id="search" class="input-text" onchange="submit">
  <a href="gestion-utilisateurs" class="button_confirm mt-30">Réinitialiser</a>
</form>

<table class="tableAdmin mt-50">
  <tr>
    <th><a href='/admin/gestion-utilisateurs&nom=idUtilisateur'>Id</a></th> 
    <th><a href='/admin/gestion-utilisateurs&nom=email'>Email</a></th> 
    <th><a href='/admin/gestion-utilisateurs&nom=nom'>Nom</a></th> 
    <th><a href='/admin/gestion-utilisateurs&nom=prenom'>Prénom</a></th> 
    <th><a href='/admin/gestion-utilisateurs&nom=cp'>Code Postal</a></th> 
    <th><a href='/admin/gestion-utilisateurs&nom=role'>Rôle</a></th> 
    <th>Action</th>
  </tr>
  <?php 
    foreach ($users as $user) {
      // Vérifie que le profil affiché n'est pas un superuser : sécurité si intrusion
      if ($user['role'] != "superuser") {
        // Privilèges SuperUser
        if($is_super_user) {
          ?>
          <tr>
            <td class="text-center"><?php echo htmlspecialchars($user["idUtilisateur"]); ?></td>
            <td class="text-left"><?php echo htmlspecialchars($user["email"]); ?></td>
            <td class="text-center capitalize"><?php echo htmlspecialchars($user["nom"]); ?></td>
            <td class="text-center capitalize"><?php echo htmlspecialchars($user["prenom"]); ?></td>
            <?php
            // L'utilisateur affiché est 1 gestionnaire
            if ($user['role'] == "admin") {
              ?>
              <td class="text-center">None</td>
              <td class="text-center capitalize">Gestionnaire
              <td class='text-left'> 
                <a href="/admin/gestion-utilisateur-reset_pwd?id_user=<?php echo $user['idUtilisateur']; ?>">Réinitialiser le mot de passe</a><br>
                <a href="/admin/gestion-utilisateur-delete_user?id_user=<?php echo $user['idUtilisateur']; ?>">Supprimer l'utilisateur</a><br>
                <a href="/admin/gestion-utilisateur-super_user?id_user=<?php echo $user['idUtilisateur']; ?>">Privilège administrateur</a>
              </td>
              <?php 
            } 
            // L'utilisateur affiché est 1 utilisateur lambda
            else {
              ?>
              <td class="text-center"><?php echo htmlspecialchars($user["cp"]); ?></td>
              <?php 
              // Vérifie si l'utilisateur est banni
              if (isBan($conn, $user['email'])) { 
                ?>
                <td class="text-center capitalize">Utilisateur Banni</td>
                <td class='text-left'> 
                  <a href="/admin/gestion-utilisateur-deban_user?id_user=<?php echo $user['idUtilisateur']; ?>">Ne plus bannir l'utilisateur</a>
                </td>
                <?php 
              } else {
                  ?>
                  <td class="text-center capitalize">Utilisateur</td>
                  <td class='text-left'> 
                    <a href="/admin/gestion-utilisateur-reset_pwd?id_user=<?php echo $user['idUtilisateur']; ?>">Réinitialiser le mot de passe</a><br>
                    <a href="/admin/gestion-utilisateur-delete_user?id_user=<?php echo $user['idUtilisateur']; ?>">Supprimer l'utilisateur</a><br>
                    <a href="/admin/gestion-utilisateur-ban_user?id_user=<?php echo $user['idUtilisateur']; ?>">Bannir l'utilisateur</a>
                  </td>
                  <?php
                }
            }
            ?>
          </tr>
        <?php
        } else {
          if ($user['role'] != "admin") {
            ?>
            <tr>
              <td class="text-center"><?php echo htmlspecialchars($user["idUtilisateur"]); ?></td>
              <td class="text-left"><?php echo htmlspecialchars($user["email"]); ?></td>
              <td class="text-center capitalize"><?php echo htmlspecialchars($user["nom"]); ?></td>
              <td class="text-center capitalize"><?php echo htmlspecialchars($user["prenom"]); ?></td>
              <td class="text-center"><?php echo htmlspecialchars($user["cp"]); ?></td>
              <?php 
              // Vérifie si l'utilisateur est banni
              if (isBan($conn, $user['email'])) { 
                ?>
                <td class="text-center capitalize">Utilisateur Banni</td>
                <td class="text-left">Aucune action possible</td>
                <?php 
              } else {
                  ?>
                  <td class="text-center capitalize">Utilisateur</td>
                  <td class='text-left'> 
                    <a href="/admin/gestion-utilisateur-reset_pwd?id_user=<?php echo $user['idUtilisateur']; ?>">Réinitialiser le mot de passe</a><br>
                  </td>
                  <?php
                }
                ?>
            </tr>
            <?php
          }
        }
      } 
    }
?>
</table>
