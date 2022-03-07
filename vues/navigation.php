<header class="m-8 mt-0 header-visiteur">
    <a href="/"><img src="/assets/img/logo.png" class="header-logo" alt="Logo"></a>
    <button onClick="toggleMenu(true);" class="header-mobile-menu-icon lg-hide"><img src="/assets/icons/menu.svg" alt="Open menu"></button>
    <div class="header-link-container">
        <a href="/" class="header-logo-mobile lg-hide"><img src="/assets/img/logo.png" alt="Logo"></a>
        <button onClick="toggleMenu(false);" class="header-close-mobile lg-hide"><img src="/assets/icons/close.svg" alt="Close"></button>
        <div class="navigation-link">
            <a href="/" class="header-link hover-text-color hover-text-green2 duration-300">Accueil</a>
            <a href="/utilisateur/faq" class="header-link hover-text-color hover-text-green2 duration-500">FAQ</a>
            <a href="/utilisateur/contact" class="header-link hover-text-color hover-text-green2 duration-300">Contact</a>
        </div>
        
        <?php 
        if(isset($_SESSION["token"])) {
            $link = "/compte/accueil";
            if (isAdmin($conn, $_SESSION["token"])) {
                $link = "/admin/accueil";
            }
            ?>
                <a href="<?php echo $link; ?>" class="header-link hover-text-color hover-text-green2 duration-300 header-user-icon">
                    <img src='/assets/icons/user-circular.svg' width='28px' alt='User icon'>
                    <?php 
                        try {
                            echo(returnName($conn, $_SESSION["token"]) . ' ' . substr(returnLastName($conn, $_SESSION["token"]), 0, 1)); 
                        } catch (Exception $e){
                            // Destruction des cookies
                            setcookie("token", "", time() - 3600);
                            // remove all session variables
                            session_unset();
                            // destroy the session 
                            session_destroy(); 
                            exit();
                        }
                    ?>. 
                </a>
            <?php
        } else {
            ?>
            <div class='relative group-hover sm-hide'>
                <a href='#'><img src='/assets/icons/user-circular.svg' width='28px' alt='User icon'></a>
                <div class='absolute right-0 display-animation duration-300 p-8 z-1'>
                    <div class='login-submenu'>
                        <a class="login-submenu-item" href='/utilisateur/connexion'>Connexion</a>
                        <a class="login-submenu-item" href='/utilisateur/inscription'>Inscription</a>
                    </div>
                </div>
            </div>
            <div class="lg-hide text-center mt-40">
                <a class="header-link hover-text-color hover-text-green2 duration-300" href='/utilisateur/connexion'>Connexion</a>
                <a class="header-link hover-text-color hover-text-green2 duration-300" href='/utilisateur/inscription'>Inscription</a>
            </div>
            <?php
        }
        ?>
    </div>
</header>
   
