<?php
require_once("./modele/connexion.php"); 
include_once('./modele/requetes.utilisateur.php');
include_once('./modele/requetes.faq.php');
include_once('./modele/requetes.accueil.equipe.php');
include_once('./modele/requetes.utilisateurBanni.php');
include_once('./modele/requetes.cgu.php');
include_once('./modele/requetes.texte.php');


// Si la fonction n'est pas définie, l'accueil est affiché
if (!isset($_GET['fonction']) || empty($_GET['fonction'])) {
    $function = "accueil";
} else {
    $function = $_GET['fonction'];
}

// Initialiser la session
session_start();

switch ($function) {
    // Accueil
    case 'accueil':
        $vue = "accueil";
        $title = "Babycare - Accueil";
        $url = "https://babycare-website.com";
        $description = "Babycare, le premier outil de veille de l'environnement dédié à la santé des bébés asthmatiques.";

        // Récupère les cookies
        if (isset($_COOKIE['token'])) {
            $_SESSION['token'] = $_COOKIE['token'];
        }

        // Récupère les membres de l'équipe
        $equipe = recupereEquipe($conn);

        // Récupère le texte de présentation de l'entreprise
        $texte_accueil = recupereTexte($conn, "accueil-présentation_entreprise")[0];
        
        break;
    
     // CGU
     case 'cgu':
        $vue = "cgu";
        $title = "Babycare - CGU";
        $url = "https://babycare-website.com/utilisateur/cgu";
        $description = "Babycare, le premier outil de veille de l'environnement dédié à la santé des bébés asthmatiques.";

        // Récupère les cookies
        if (isset($_COOKIE['token'])) {
            $_SESSION['token'] = $_COOKIE['token'];
        }

        $articles = recupereArticles($conn);
        
        break;

    // Page FAQ
    case 'faq':
        $vue = "faq";
        $title = "Babycare - FAQ";
        $url = "https://babycare-website.com/utilisateur/faq";
        $description = "Babycare, le premier outil de veille de l'environnement dédié à la santé des bébés asthmatiques.";

        // Récupère les questions de la FAQ
        $questions = recupereQuestions($conn);

        break; 

    // Page Contact
    case 'contact':
        $vue = "contact";
        $title = "Babycare - Contact";
        $url = "https://babycare-website.com/utilisateur/contact";
        $description = "Babycare, le premier outil de veille de l'environnement dédié à la santé des bébés asthmatiques.";

        // Initialisation des variables
        $email = $tokencaptcha = $prenom = $nom = $email = $message = $objet = $action = "";
        define("RECAPTCHA_V3_SECRET_KEY", '6Lf4Nm4dAAAAAAQ8FymkoqNqMVT84fKGSB2THpvh');

        // Récupère les cookies
        if (isset($_COOKIE['token'])) {
            $_SESSION['token'] = $_COOKIE['token'];
        }

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["email"]) && isset($_POST["message"]) && isset($_POST["objet"]) && isset($_POST["token"]) && isset($_POST["action"])) {
                $prenom = test_input($_POST["prenom"]);
                $nom = test_input($_POST["nom"]);
                $email = test_input($_POST["email"]);
                $message = test_input($_POST["message"]);
                $objet = test_input($_POST["objet"]);
                $tokencaptcha = test_input($_POST['token']);
                $action = test_input($_POST['action']);
                if(getCaptchaVerif($tokencaptcha, $action)) {
                    // Vérification des données saisies
                    if (verifEmail($email)) {
                        sendToAdmin($email, $prenom, $nom, $message, $objet);
                        echo "<script>alert(\"Message envoyé !\")</script>";
                    }
                }
            }
        }

        break;   
    
    // Mot de passe oublé
    case 'forgotpassword':
        $vue = "forgotPassword";
        $title = "Mot de passe oublié";
        $url = "https://babycare-website.com/utilisateur/forgotpassword";
        $description = "Babycare, le premier outil de veille de l'environnement dédié à la santé des bébés asthmatiques.";

        // Initialisation des variables
        $email = $tokencaptcha = "";
        define("RECAPTCHA_V3_SECRET_KEY", '6Lf4Nm4dAAAAAAQ8FymkoqNqMVT84fKGSB2THpvh');

        // Récupère les cookies
        if (isset($_COOKIE['token'])) {
            $_SESSION['token'] = $_COOKIE['token'];
        }

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['email']) && isset($_POST['token']) && isset($_POST['action'])) {
                $email = test_input($_POST["email"]);
                $tokencaptcha = test_input($_POST['token']);
                $action = test_input($_POST['action']);

                if(getCaptchaVerif($tokencaptcha, $action)) {
                    // Vérification des données saisies
                    if (verifEmail($email)) {
                        $idUser = returnIdUser($conn, $email);
                        if ($idUser) {
                            resetPwd($conn, $idUser);
                            echo "<script>alert(\"Nous avons envoyé un mail au compte concerné !\"); window.location.href = \"/utilisateur/connexion\";</script>";
                        }
                    }
                }
            }  
        }   

        break;


    // Inscription
    case 'inscription':
        $title = "Babycare - Inscription";
        $vue = "inscription";
        $url = "https://babycare-website.com/utilisateur/inscription";
        $description = "Babycare, le premier outil de veille de l'environnement dédié à la santé des bébés asthmatiques.";

        // Initialisation des variables
        $idActivation = $email = $prenom = $nom = $cp = $password = $passwordConfirm = $tokencaptcha = $action = "";
        $idActivationErr = $emailErr = $prenomErr = $nomErr = $cpErr = $passwordErr = $passwordConfirmErr = "";
        define("RECAPTCHA_V3_SECRET_KEY", '6Lf4Nm4dAAAAAAQ8FymkoqNqMVT84fKGSB2THpvh');

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["idActivation"]) && isset($_POST["email"]) && isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["cp"]) && isset($_POST["password"]) && isset($_POST["passwordConfirm"]) && isset($_POST["token"]) && isset($_POST["action"])) {
                $idActivation = test_input($_POST["idActivation"]);
                $email = test_input($_POST["email"]);
                $prenom = test_input($_POST["prenom"]);
                $nom = test_input($_POST["nom"]);
                $cp = test_input($_POST["cp"]);
                $password = test_input($_POST["password"]);
                $passwordConfirm = test_input($_POST["passwordConfirm"]);
                $tokencaptcha = test_input($_POST['token']);
                $action = test_input($_POST['action']);

                // Vérification Captcha
                if(getCaptchaVerif($tokencaptcha, $action)) {
                    // Vérification des données saisies
                    if (verifString($prenom)) {
                        if (verifString($nom)) {
                            if (verifIntLen(intval($cp), 5)) {
                                if (verifEmail($email)) {
                                    if (!existEmail($conn, $email) && !isBan($conn, $email)) {
                                        if ($password == $passwordConfirm) {
                                            if (verifPassword($password)) {
                                                // Vérification du numéro d'activation du boitier
                                                $id = existIdActivation($conn, $idActivation);
                                                if ($id) {
                                                    $token = generateToken();
                                                    ajouteUtilisateur(
                                                        $conn, 
                                                        ['prenom' => $prenom, 
                                                        'nom' => $nom,
                                                        'cp' => intval($cp), 
                                                        'email' => $email, 
                                                        'motDePasse' => hashPassword($password), 
                                                        'role' => "utilisateur", 
                                                        'token' => $token]
                                                    );
                                                    // Récupère l'id de l'utilisateur
                                                    $idUser = rechercheParEmail($conn, $email)[0]["idUtilisateur"];
                                                    // Mise à jour de la table Boitier
                                                    modifierBoitier($conn, $id, ["isActive" => 1]);
                                                    // Mise à jour de la table Utilisateur-Boitier
                                                    ajouteUtilisateurBoitier(
                                                        $conn, 
                                                        [
                                                            "idUtilisateur" => $idUser, 
                                                            "idBoitier" => $id, 
                                                        ]
                                                    );
                                                    // Stockage du token dans la session
                                                    $_SESSION['token'] = $token;
                                                    // Redirection vers l'espace Utilisateur
                                                    header("Location: /compte/accueil");
                                                } else {
                                                    $idActivationErr = "L'identifiant d'activation n'est pas valide !";
                                                }
                                            } else {
                                                $passwordErr = "Le mot de passe doit faire plus de 8 caractères et posséder au moins un chiffre et un caractère spécial !";
                                            }
                                        } else {
                                            $passwordConfirmErr = "Les mots de passe entrés sont différents !";
                                        }
                                    } else {
                                        $emailErr = "L'email est déjà utilisée !";
                                    }
                                } else {
                                    $emailErr = "Entrer une adresse email valide !";
                                }
                            } else {
                                $cpErr = "Entrer un code postal valide !";
                            }
                        } else {
                            $nomErr = "Entrer un nom valide !";
                        }
                    } else {
                        $prenomErr = "Entrer un prénom valide !";
                    }
                }
            }
        }

        // Redirection si l'utilisateur est connecté
        if (isset($_COOKIE['token'])) {
            $_SESSION['token'] = $_COOKIE['token'];
        }
        if (isset($_SESSION['token'])) {
            // Admin  
            if (isAdmin($conn, $_SESSION['token'])) {
                header("Location: /admin/accueil");
            }
            // Utilisateur Lambda 
            else {
                header("Location: /compte/accueil");
            }
        }
        
        break;
    
    // Connexion
    case 'connexion':
        $title = "Babycare - Connexion";
        $vue = "connexion";
        $url = "https://babycare-website.com/utilisateur/connexion";
        $description = "Babycare, le premier outil de veille de l'environnement dédié à la santé des bébés asthmatiques.";

        // Initialisation des variables
        $email = $password = $rememberMe = $tokencaptcha = $action = "";
        $emailErr = $passwordErr = "";
        define("RECAPTCHA_V3_SECRET_KEY", '6Lf4Nm4dAAAAAAQ8FymkoqNqMVT84fKGSB2THpvh');

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = test_input($_POST["email"]);
            $password = test_input($_POST["password"]);
            $tokencaptcha = test_input($_POST['token']);
            $action = test_input($_POST['action']);
            if (isset($_POST["rememberMe"])) {
                $rememberMe = test_input($_POST["rememberMe"]);
            }

            // reCAPTCHA
           if(getCaptchaVerif($tokencaptcha, $action)){
                // Vérification des données saisies
                if ($email && $password) {   
                    // Vérifie que le compte n'est pas bloqué 
                    if (isBan($conn, $email)) {
                        echo "<script>alert(\"Oups, il semblerait que ce compte est bloqué ! Veuillez nous contacter pour plus d'informations.\")</script>";
                    } else {
                        if (verifEmail($email)) {
                            $result = verifLogin($conn, $email, $password);
                            if ($result) {
                                $_SESSION['token'] = $result[0];
                                if ($rememberMe) {
                                    setcookie("token", $result[0], time() + (86400 * 30), "/"); // 30 days
                                }
                                // Admin
                                if ($result[1] == "admin" || $result[1] == "superuser") {
                                    header("Location: /admin/accueil");
                                } 
                                // Utilisateur Lambda 
                                else {
                                    header("Location: /compte/accueil");
                                }
                            } else {
                                $passwordErr = "Identifiants incorrects !";
                            }
                        } else {
                            $emailErr = "Entrer une adresse email valide !";
                        }
                    }
                }
            } 
        }
        

        // Redirection si l'utilisateur est connecté
        if (isset($_COOKIE['token'])) {
            $_SESSION['token'] = $_COOKIE['token'];
        }
        if (isset($_SESSION['token'])) {
            // Admin  
            if (isAdmin($conn, $_SESSION['token'])) {
                header("Location: /admin/accueil");
            }
            // Utilisateur Lambda 
            else {
                header("Location: /compte/accueil");
            }
        }

        break;
        
    default:
        // si aucune fonction ne correspond au paramètre function passé en GET
        $vue = "erreur404";
        $title = "error404";
        $message = "Erreur 404 : la page recherchée n'existe pas.";
}

include ('vues/header.php');
include ('vues/' . $vue . '.php');
include ('vues/footer.php');

?>