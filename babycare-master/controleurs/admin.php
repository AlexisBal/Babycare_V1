<?php

include_once('./modele/requetes.utilisateur.php');
include_once('./modele/requetes.faq.php');
include_once('./modele/requetes.capteur.php');
include_once('./modele/requetes.utilisateurBanni.php');
include_once('./modele/requetes.modal.php');
include_once('./modele/requetes.cgu.php');
include_once('./modele/requetes.accueil.equipe.php');
include_once('./modele/requetes.texte.php');

// Initialiser la session
session_start();

// Vérifie que l'utilisateur est connecté, sinon redirection vers la page de connexion
if (isset($_COOKIE['token'])) {
    $_SESSION['token'] = $_COOKIE['token'];
}
if(!isset($_SESSION["token"])||!isAdmin($conn, $_SESSION["token"])){
    header("Location: /utilisateur/connexion");
}

// Si la fonction n'est pas définie, l'accueil est affiché
if (!isset($_GET['fonction']) || empty($_GET['fonction'])) {
    $function = "accueil";
} else {
    $function = $_GET['fonction'];
}

// Vérifie si l'utilisateur est un superuser
$is_super_user = isSuperUser($conn, $_SESSION["token"]);

switch ($function) {
    // Accueil
    case 'accueil':
        $vue = "admin/home";
        $title = "Espace Admin - Accueil";

        $nvUtilisateurs = nbUtilisateursRécents($conn);
        $nbBoitiers = nbBoitiersActifs($conn);
        $nbFAQ = nbQuestionsFAQ($conn);

        break;

    // Gestion des utilisateur
    case 'gestion-utilisateurs':
        $vue = "admin/gestion-utilisateurs";
        $title = "Espace Admin";
        if(isset($_GET['nom'])) {
            $users = recupereUtilisateursAsc($conn, $_GET['nom']);
        } else {
            $users = recupereUtilisateursAsc($conn, "idUtilisateur");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = test_input($_POST["search"]);
            $request = searchUser($conn, $search);
            if ($request != []) {
                $users = $request;
            }
        }
        break;
    
    // Suppression d'un utilisateur
    case 'gestion-utilisateur-delete_user':
        $vue = "admin/gestion-utilisateurs";
        $title = "Espace Admin";
        
        if ($is_super_user) {
            $idUser = $_GET['id_user'];
            deleteUser($conn, $idUser);
            echo "<script>alert(\"L'utilisateur a été supprimé !\"); window.location.href = \"/admin/gestion-utilisateurs\";</script>";
        } else {
            header("Location: /admin/gestion-utilisateurs");
        }
        break;

    // Réinitialisation du mot de passe d'un utilisateur
    case 'gestion-utilisateur-reset_pwd':
        $vue = "admin/gestion-utilisateurs";
        $title = "Espace Admin";
        $idUser = $_GET['id_user'];
        $test = resetPwd($conn, $idUser);
        echo "<script>alert(\"Le mot de passe de l'utilisateur a été réinitialisé !\"); window.location.href = \"/admin/gestion-utilisateurs\";</script>";
        break;

    // Rendre le gestionnaire superuser 
    case "gestion-utilisateur-super_user":
        $vue = "admin/gestion-utilisateurs";
        $title = "Espace Admin";
        if (isset($_GET['id_user'])) {
            $idUser = $_GET['id_user'];
            // Vérifie que l'utilisateur connecté est superuser
            if ($is_super_user) {
                // Mise à jour de la base de données 
                modifierUtilisateur(
                    $conn, 
                    $idUser, 
                    [
                        "role" => "superuser"
                    ]
                );
                // Rafraichissement de la page
                echo "<script>alert(\"Le gestionnaire est maintenant superuser !\"); window.location.href = \"/admin/gestion-utilisateurs\";</script>";
            } else {
                header("Location: /admin/gestion-utilisateurs");
            }
        } else {
            header("Location: /admin/gestion-utilisateurs");
        }
        break;
    
    // Bannir un utilisateur
    case 'gestion-utilisateur-ban_user':
        $vue = "admin/gestion-utilisateurs";
        $title = "Espace Admin";
        if (isset($_GET['id_user'])) {
            $idUser = $_GET['id_user'];
            // Vérifie que l'utilisateur connecté est superuser
            if ($is_super_user) {
                // Récupère l'adresse email de l'utilisateur à bannir
                $email = returnEmail($conn, $idUser);
                if ($email) {
                    // Ajout de l'email à bannir dans la base de données
                    banUser($conn, ['email' => $email]); 
                    echo "<script>alert(\"L'utilisateur a été banni !\"); window.location.href = \"/admin/gestion-utilisateurs\";</script>";
                } else {
                    header("Location: /admin/gestion-utilisateurs");
                }
            } else {
                header("Location: /admin/gestion-utilisateurs");
            }
        } else {
            header("Location: /admin/gestion-utilisateurs");
        }
        break;
    
    // Ne plus bannir un utilisateur
    case 'gestion-utilisateur-deban_user':
        $vue = "admin/gestion-utilisateurs";
        $title = "Espace Admin";
        
        if (isset($_GET['id_user'])) {
            $idUser = $_GET['id_user'];
            // Vérifie que l'utilisateur connecté est superuser
            if ($is_super_user) {
                // Récupère l'adresse email de l'utilisateur à bannir
                $email = returnEmail($conn, $idUser);
                if ($email) {
                    // Suppression de l'email à bannir dans la base de données
                    debanUser($conn, $email); 
                    echo "<script>alert(\"L'utilisateur n'est plus banni !\"); window.location.href = \"/admin/gestion-utilisateurs\";</script>";
                } else {
                    header("Location: /admin/gestion-utilisateurs");
                }
            } else {
                header("Location: /admin/gestion-utilisateurs");
            }
        } else {
            header("Location: /admin/gestion-utilisateurs");
        }
        break;

    // Création d'un compte administrateur 
    case 'creation-utilisateur':
        $vue = "admin/creation-utilisateur";
        $title = "Espace Admin";

        // Initialisation des variables
        $email = $prenom = $nom =  "";
        $emailErr = "";
        echo null;

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["email"]) && isset($_POST["prenom"]) && isset($_POST["nom"])) {
                $email = test_input($_POST["email"]);
                $prenom = test_input($_POST["prenom"]);
                $nom = test_input($_POST["nom"]);
                // Vérification des données saisies
                if (verifEmail($email)) {
                    if (!returnIdUser($conn, $email)) {
                        $token = generateToken();
                        $pwd = generatePassword();
                        sendEmailAdmin($prenom, $email, $pwd);
                        ajouteUtilisateur(
                            $conn, 
                            ['prenom' => $prenom, 
                            'nom' => $nom,
                            'email' => $email, 
                            'motDePasse' => hashPassword($pwd), 
                            'role' => "admin", 
                            'token' => $token]
                        );
                        echo "<script>alert(\"L'administrateur a été créé !\")</script>";
                    } else {
                        $emailErr = "Cette adresse email est déjà utilisée !";
                    }
                } else {
                    $emailErr = "Entrer une adresse email valide !";
                }
            }
        }
        break;

    // Gestion des boitiers 
    case 'gestion-boitiers':
        $vue = "admin/boitiers";
        $title = "Espace Admin - Gestion boitiers";
        if(isset($_GET['nom'])) {
            $boitiers = joinLeftBoitiersUtilisateursAsc($conn, $_GET['nom']);
        } else {
            $boitiers = joinLeftBoitiersUtilisateursAsc($conn, "idBoitier");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $form = test_input($_POST["form"]);
            // Recherche d'un boitier
            if ($form == "form1") {
                $search = test_input($_POST["search"]);
                $request = joinLeftBoitiersUtilisateursSearch($conn, $search);
                if ($request != []) {
                    $boitiers = $request;
                }
            } 
            // Ajout d'un boitier
            else {
                ajouteBoitier($conn);
                header("Location: /admin/gestion-boitiers");
            } 
        }
        break;
    
    // Suppression d'un boitier
    case 'gestion-boitier-delete':
        $idBoitier = $_GET['id_boitier'];
        deleteBoitier($conn, $idBoitier);
        header("Location: /admin/gestion-boitiers");
        break;
    
    // Gestion des capteurs
    case 'gestion-capteurs':
        $vue = "admin/capteurs";
        $title = "Espace Admin - Gestion capteurs";

        // Initialisation des variables
        
        $type = $sensibilite = $sensibiliteEdit = "";
        $typeErr = $sensibiliteErr = $sensibiliteEditErr = "";
            
        // Récupère Id du Boitier ou redirection vers la page "gestion-boitiers"
        if (isset($_GET['id_boitier'])) {
            $idBoitier = $_GET['id_boitier'];
            $capteurs = rechercheParBoitier($conn, $idBoitier);
        } else {
            header("Location: /admin/gestion-boitiers");
        }
        // Pop up si pas encore de capteurs dans la base de données 
        if (!$capteurs) {
            echo "<script>alert(\"Oups, il semblerait qu'il n'y ait pas encore de capteurs associés à ce boitier !\")</script>";
        }
        // Récupère Id du capteur 
        if (isset($_GET['id_capteur'])) {
            $idCapteur = $_GET['id_capteur'];
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $form = test_input($_POST["form"]);
            // Ajouter un capteur
            if ($form == "form1") {
                if(isset($_POST["type"]) && isset($_POST["sensibilite"])) {
                    $type = test_input($_POST["type"]);
                    $sensibilite = test_input($_POST["sensibilite"]);
                    if (is_string($type)) {
                        if (is_numeric($sensibilite)) {
                            ajouteCapteur(
                                $conn, 
                                [
                                    "idBoitier" => intval($idBoitier),
                                    "type" => $type,
                                    "sensibilite" => $sensibilite
                                ]
                            );
                            header("Location: /admin/gestion-capteurs?id_boitier=".$idBoitier);
                        } else {
                            echo "<script>alert(\"Oups, il semblerait qu'il y ait eu une erreur !\")</script>";
                            $sensibiliteErr = "Merci d'entrer une sensibilité valide !";
                        }
                    } else {
                        echo "<script>alert(\"Oups, il semblerait qu'il y ait eu une erreur !\")</script>";
                        $typeErr = "Merci d'entrer un type valide !";
                    }
                } else {
                    echo "<script>alert(\"Oups, il semblerait qu'il y ait eu une erreur !\")</script>";
                    $typeErr = $sensibiliteErr = "Le champ est incorrect !";
                }
            } 
            if ($form == "form2") {
                if (isset($_POST["sensibiliteEdit"]) && isset($_POST["idCapteur"])) {
                    $sensibiliteEdit = test_input($_POST["sensibiliteEdit"]);
                    $idCapteur = test_input($_POST["idCapteur"]);
                    if (is_numeric($sensibiliteEdit)) {
                        modifierCapteur(
                            $conn, 
                            intval($idCapteur), 
                            ["sensibilite" => $sensibiliteEdit]
                        );
                        header("Location: /admin/gestion-capteurs?id_boitier=".$idBoitier);
                    } else {
                        echo "<script>alert(\"Oups, il semblerait qu'il y ait eu une erreur !\")</script>";
                        $sensibiliteEditErr = "Merci d'entrer une sensibilité valide !";
                    }
                } else {
                    echo "<script>alert(\"Oups, il semblerait qu'il y ait eu une erreur !\")</script>";
                    $sensibiliteEditErr = "Le champ est incorrect !";
                }
            }
        }
        break;
    
    // Suppression d'un capteur
    case 'gestion-capteur-delete':
        // Récupère Id du Boitier ou redirection vers la page "gestion-boitiers"
        if (!isset($_GET['id_boitier'])) {
            header("Location: /admin/gestion-boitiers");
        } else {
            $idBoitier = $_GET['id_boitier'];
            // Récupère Id du capteur ou redirection vers la page "gestion-capteurs"
            if (!isset($_GET['id_capteur'])) {
                header("Location: /admin/gestion-capteurs?id_boitier={$idBoitier}");
            } else {
                $idCapteur = $_GET['id_capteur'];
                deleteCapteur($conn, $idCapteur);
                header("Location: /admin/gestion-capteurs?id_boitier={$idBoitier}");
            }
        }
        break;

    // Paramètres
    case 'parametres':
        $vue = "admin/parametres";
        $title = "Espace Admin - Paramètres";

        // Initialisation des variables
        $password = $newPassword = $newPasswordConfirm =  "";
        $passwordErr = $newPasswordErr = $newPasswordConfirmErr =  "";
        

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = test_input($_POST["password"]);
            $newPassword = test_input($_POST["newPassword"]);
            $newPasswordConfirm = test_input($_POST["newPasswordConfirm"]);

            // Vérification des données saisies
            if ($password && $newPassword && $newPasswordConfirm) {
                if (verifOldPwd($conn, $_SESSION["token"], $password)) {
                    if ($newPasswordConfirm == $newPassword) {
                        if (verifPassword($newPassword)) {
                            updatePwd($conn, $_SESSION["token"], $newPassword);
                            echo "<script>alert(\"Le mot de passe a bien été modifié !\")</script>";
                        }
                    } else {
                        $newPasswordConfirmErr = "Les mots de passe entrés sont différents !";
                    }
                } else {
                    $passwordErr = "Le mot de passe entré est incorrect !";
                }
            }
        }

        break;
    
    // Suppression d'une question de la FAQ
    case 'edition-faq-delete_question':
        if (isset($_GET['id_question'])) {
            $idQuestion = $_GET['id_question'];
            deleteQuestion($conn, $idQuestion);
        }

        header("Location: /admin/edition-faq");

        break;
    
    // Suppression d'un article des CGU
    case 'edition-cgu-delete_article':
        if(isset($_GET['id_article'])){
            $idArticle = $_GET['id_article'];
            deleteArticle($conn, $idArticle);
        } 

        header("Location: /admin/edition-cgu");

        break;
    

    // Suppression d'une membre de l'équipe
    case 'edition-accueil-delete_member':
        if(isset($_GET['id_member'])){
            $idMember = $_GET['id_member'];
            deleteMembreEquipe($conn, $idMember);
        } 

        header("Location: /admin/edition-accueil");

        break;

    
    # Edition de la page d'accueil
    case 'edition-accueil':
        $vue = "admin/edition-accueil";
        $title = "Espace Admin - Edition de la page d'accueil";

        // Récupère les membres de l'entreprise
        $personnes = recupereEquipe($conn);

        // Récupère le texte de présentation de l'entreprise
        $texte_accueil = recupereTexte($conn, "accueil-présentation_entreprise")[0];

        // Initialisation des variables
        $prenom = $nom = $role = $idPersonne = $form = $text = "";

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $form = test_input($_POST["form"]);
            if ($form == "form0") {
                // Modification du texte de présentation de l'entreprise
                if(isset($_POST["text-accueil"])) {
                    $text = test_input($_POST["text-accueil"]);
                    // Mise à jour de la base de données 
                    modifierTexte(
                        $conn, 
                        'accueil-présentation_entreprise', 
                        ['texte' => $text]
                    );
                    header("Location: /admin/edition-accueil");
                }
            }
            if ($form == "form1") {
                // Modification d'un membre
                if(isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["idPersonne"]) && isset($_POST["role"])) {
                    $idPersonne = test_input($_POST["idPersonne"]);
                    $prenom = test_input($_POST["prenom"]);
                    $nom = test_input($_POST["nom"]);
                    $role = test_input($_POST["role"]);
                    // Mise à jour de la base de données 
                    modifierEquipe(
                        $conn, 
                        $idPersonne,
                        [
                            "prenom" => $prenom,
                            "nom" => $nom,
                            "role" => $role
                        ] 
                    );
                    header("Location: /admin/edition-accueil");
                }
            }
            // Création d'un membre 
            elseif (isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["role"])) {
                $prenom = test_input($_POST["prenom"]);
                $nom = test_input($_POST["nom"]);
                $role = test_input($_POST["role"]);

                // Mise à jour de la base de données
                ajouteMembreEquipe(
                    $conn, 
                    [
                        "prenom" => $prenom,
                        "nom" => $nom,
                        "role" => $role
                    ] 
                );

                // Actualisation de la page
                header("Location: /admin/edition-accueil");
            }
            
        }

        break;

    # Edition-cgu
    case 'edition-cgu':
        $vue = "admin/edition-cgu";
        $title = "Espace Admin - Edition des CGU";

        $articles = recupereArticles($conn);

        // Initialisation des variables
        $titre = $texte = $categorie = $idArticle = $form = "";

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $form = test_input($_POST["form"]);
            if ($form == "form1") {
                // Modification d'un article
                if(isset($_POST["titre"]) && isset($_POST["texte"]) && isset($_POST["idArticle"]) && isset($_POST["categorie"])) {
                    $idArticle = test_input($_POST["idArticle"]);
                    $titre = test_input($_POST["titre"]);
                    $texte = test_input($_POST["texte"]);
                    $categorie = test_input($_POST["categorie"]);
                    // Mise à jour de la base de données 
                    modifierArticle(
                        $conn, 
                        $idArticle,
                        [
                            "titre" => $titre,
                            "texte" => $texte,
                            "categorie" => $categorie
                        ] 
                    );
                    header("Location: /admin/edition-cgu");
                }
            }
            // Création d'un article
            else {
                $titre = test_input($_POST["titre"]);
                $texte = test_input($_POST["texte"]);
                $categorie = test_input($_POST["categorie"]);
                // Mise à jour de la base de données
                if ($titre && $texte && $categorie) {
                    ajouteArticle(
                        $conn, 
                        $idArticle,
                        $titre,
                        $texte,
                        $categorie
                    );
                    // Actualisation de la page
                    header("Location: /admin/edition-cgu");
                }
            }
            
        }

        break;
    

    // Edition des moniteurs
    case 'edition-moniteurs':
        $vue = "admin/modal";
        $title = "Espace Admin - Edition des moniteurs";

        $modals = recupereModal($conn);

        // Initialisation des variables
        $idModal = $titre = $texte = "";

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Modification du modal 
            if(isset($_POST["titre"]) && isset($_POST["texte"]) && isset($_POST["idModal"])) {
                $idModal = test_input($_POST["idModal"]);
                $titre = test_input($_POST["titre"]);
                $texte = test_input($_POST["texte"]);
                // Mise à jour de la base de données 
                modifierModal(
                    $conn, 
                    $idModal,
                    [
                        "titre" => $titre,
                        "texte" => $texte
                    ] 
                );
                header("Location: /admin/edition-moniteurs");
            }
        }

        break;

    // Edition de la faq
    case 'edition-faq':
        $vue = "admin/edition-faq";
        $title = "Espace Admin - Edition de la FAQ";

        $questions = recupereQuestions($conn);

        // Initialisation des variables
        $question_p = $reponse_p = $categorie_p = $form = $idQuestion = "";

        // Récupère les valeurs saisies dans le formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $form = test_input($_POST["form"]);
            // Modification d'une question
            if ($form == "form1"){
                if (isset($_POST["question"]) && isset($_POST["reponse"]) && isset($_POST["idQuestion"]) && isset($_POST["categorie"])) {
                    $idQuestion = test_input($_POST["idQuestion"]);
                    $question_p = test_input($_POST["question"]);
                    $reponse_p = test_input($_POST["reponse"]);
                    $categorie_p = test_input($_POST["categorie"]);
                    // Mise à jour de la base de données
                    modifierQuestion(
                        $conn, 
                        intval($idQuestion), 
                        [
                            "categorie" => $categorie_p, 
                            "question" => $question_p, 
                            "reponse" => $reponse_p
                        ]
                    );
                    // Actualisation de la page
                    header("Location: /admin/edition-faq");
                }
            } 
            // Création d'une question
            else {
                $question_p = test_input($_POST["question"]);
                $reponse_p = test_input($_POST["reponse"]);
                $categorie_p = test_input($_POST["categorie"]);
                // Mise à jour de la base de données
                if ($question_p && $reponse_p && $categorie_p) {
                    ajouteQuestion($conn, $categorie_p, $question_p, $reponse_p);
                    // Actualisation de la page
                    header("Location: /admin/edition-faq");
                }
            }
        }
        break;

    // Déconnexion
    case 'deconnexion':
        // Destruction des cookies
        setcookie("token", null, -1, '/');
        // remove all session variables
        session_unset();
        // destroy the session 
        session_destroy(); 
        header("Location: /utilisateur/connexion");
        break;
    
    # AJAX capteur-edit-modal
    case "capteur-edit-modal":
        header('Content-Type: application/json; charset=utf-8');
        function writeError(){
            echo json_encode(array("response" => "error"));
        }
        // Si la fonction n'est pas définie, l'accueil est affiché
        if (empty($_GET['idCapteur'])) {
            writeError();
        } else {
            $idCapteur = $_GET['idCapteur'];
        }
        echo json_encode(search($conn, "Capteur", ['idCapteur' => $idCapteur])[0]);
        break;

    // si aucune fonction ne correspond au paramètre function passé en GET
    default:
    $vue = "erreur404";
    $title = "error404";
    $message = "Erreur 404 : la page recherchée n'existe pas.";
}   
    
if ($_GET['fonction'] != "capteur-edit-modal") {
    include ('vues/admin/header.php');
    include ('vues/' . $vue . '.php');
    include ('vues/admin/footer.php');
}


?>

