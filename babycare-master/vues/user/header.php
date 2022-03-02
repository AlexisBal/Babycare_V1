<?php
/**
* Vue : entête HTML
*/
?>

<!DOCTYPE html>
<html class="no-js" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR" lang="fr-FR" dir="ltr">
<head>
    <meta charset="utf-8">
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
                            <a href="/compte/accueil" class="user-leftmenu-item hover-text-color hover-text-green2 duration-300">
                                <img src="/assets/icons/home.svg" alt="Home"> Accueil
                            </a>
                        </div>

                        <div class="relative group-hover">
                            <a href="#" class="user-leftmenu-item hover-text-color hover-text-green2 duration-300">
                                <img src="/assets/icons/dashboard.svg" alt="Dashboard"> Moniteurs
                            </a>
                            <div class="absolute w-full display-animation group-child duration-300 p-8">
                                <div class="user-leftmenu-submenu">
                                    <a href="/compte/moniteurs" class="user-leftmenu-submenu-item">Accueil</a>
                                    <?php 
                                    $i = 1;
                                    foreach ($boitiers as $boitier_h) {
                                        if ($boitier_h['prenom']) {
                                            ?>
                                            <a href="<?php echo '/compte/moniteurs?boitier='.$boitier_h['idBoitier']; ?>" class="user-leftmenu-submenu-item">Boitier de <?php echo ucfirst($boitier_h['prenom']); ?></a>
                                            <?php 
                                        } else {
                                            ?>
                                            <a href="<?php echo '/compte/moniteurs?boitier='.$boitier_h['idBoitier']; ?>" class="user-leftmenu-submenu-item">Boitier <?php echo $i; ?></a>
                                            <?php
                                        }
                                        $i += 1;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="/compte/parametres" class="user-leftmenu-item hover-text-color hover-text-green2 duration-300">
                                <img src="/assets/icons/settings.svg" alt="Settings"> Paramètres
                            </a>
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
                        <div class="progress-detail">
                            <div class="group-hover">
                                <a href="#">
                                    <img src="/assets/icons/notify.svg" alt="Notify">
                                </a>
                                <div class="absolute notification-panel display-animation group-child duration-300">
                                    <div class="notification-panel-content">

                                        <?php

                                        for ($i = 1; $i <= 15; $i++) {

                                            $type = "";
                                            switch(rand(0, 2)){
                                                case 0:
                                                    $type = "notification-success";
                                                    break;
                                                case 1:
                                                    $type = "notification-warning";
                                                    break;
                                                case 2:
                                                    $type = "notification-danger";
                                                    break;
                                            }

                                            ?>
                                            <div class="notification <?php echo $type; ?>">                                      
                                                <h4>Notification <?php echo $i; ?></h4>
                                                <p>Contenu de la notification</p>                                  
                                            </div>

                                            <?php
                                        }

                                        ?>
                                        
                                        <div class="notification-gradient-border"></div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <a href="/compte/deconnexion"><img src="/assets/icons/logout.svg"></a>
                    </div>
                </div>
                <!-- content -->
                <div class="user-content-body">
