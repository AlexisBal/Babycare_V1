<?php
/**
* Vue : entête HTML
*/
?>

<!DOCTYPE html>
<html class="no-js" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR" lang="fr-FR" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=IANAcharset">
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/ico" href="/favicon.ico">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/color.css">
    <link rel="stylesheet" href="/assets/css/animation.css">
    <link rel="stylesheet" href="/assets/css/decoration.css">
    <link rel="stylesheet" href="/assets/css/user.css">
    <link rel="stylesheet" href="/assets/css/modal.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
</head>
<body>
        <div class="user-page">

            <!-- left bar -->
            <div class="user-leftbar">
                <div class="mt-40 text-center">
                    <a href="/"><img src="/assets/img/logo.png" class="w-200" alt="Logo"></a>
                    <div class="user-leftmenu">
                        <div>
                            <a href="/admin/accueil" class="user-leftmenu-item hover-text-color hover-text-green2 duration-300">
                                <img src="/assets/icons/home.svg" alt="Home"> Accueil
                            </a>
                        </div>
                        <?php
                        if ($is_super_user) {
                        ?>
                        <div class="group-hover">
                            <a href="#" class="user-leftmenu-item hover-text-color hover-text-green2 duration-300">
                                <img src="/assets/icons/user-list.svg" alt="User-list"> Utilisateurs
                            </a>
                            <div class="absolute w-full display-animation group-child duration-300 p-8">
                                <div class="user-leftmenu-submenu">
                                    <a href="/admin/gestion-utilisateurs" class="user-leftmenu-submenu-item">Gérer Utilisateurs</a>
                                    <a href="/admin/creation-utilisateur" class="user-leftmenu-submenu-item">Créer Compte</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        } else {
                            ?>
                            <div>
                                <a href="/admin/gestion-utilisateurs" class="user-leftmenu-item hover-text-color hover-text-green2 duration-300">
                                    <img src="/assets/icons/user-list.svg" alt="User-list"> Utilisateurs
                                </a>
                            </div> 
                            <?php
                        }
                        ?>
                        <div>
                            <a href="/admin/gestion-boitiers" class="user-leftmenu-item hover-text-color hover-text-green2 duration-300">
                                <img src="/assets/icons/electronics.png" alt="boitiers"> Boitiers
                            </a>
                        </div> 
                        <div class="group-hover">
                            <a href="#" class="user-leftmenu-item hover-text-color hover-text-green2 duration-300">
                                <img src="/assets/icons/edit.svg" alt="Edit"> Editer une page
                            </a>
                            <div class="absolute w-full display-animation group-child duration-300 p-8">
                                <div class="user-leftmenu-submenu">
                                    <a href="/admin/edition-accueil" class="user-leftmenu-submenu-item">Editer Accueil </a>
                                    <a href="/admin/edition-faq" class="user-leftmenu-submenu-item">Editer FAQ</a>
                                    <a href="/admin/edition-cgu" class="user-leftmenu-submenu-item">Editer CGU</a>
                                    <a href="/admin/edition-moniteurs" class="user-leftmenu-submenu-item">Editer Moniteurs </a>
                                </div>
                            </div>
                        </div>                   
                    </div>
                </div>
            </div>
            
            <div class="user-content" >
            <!-- top bar -->
            <div class="user-topbar">
            <div class="user-topbar-icons-container">
                    <button id="buttonMenu" onClick="showMenu();"><img src="/assets/icons/menu.svg"></button>
                </div>
                <div class="user-topbar-icons-container">
                        <a href="/admin/parametres"><img src="/assets/icons/settings.svg"></a>
                        <a href="/admin/deconnexion"><img src="/assets/icons/logout.svg"></a>
                </div>
            </div>
            <!-- content -->
            <div class="user-content-body">
