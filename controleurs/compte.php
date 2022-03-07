<?php

include_once('./modele/requetes.utilisateur.php');
include_once('./modele/requetes.modal.php');
include_once('./modele/requetes.allergie.php');
include_once('./modele/requetes.data.php');

//Socket timeout (pour le pollen)
ini_set('default_socket_timeout', 10);

// Initialiser la session
session_start();

// Vérifie que l'utilisateur est connecté, sinon redirection vers la page de connexion
if (isset($_COOKIE['token'])) {
    $_SESSION['token'] = $_COOKIE['token'];
}
if(!isset($_SESSION["token"])||isAdmin($conn, $_SESSION["token"])){
  header("Location: /utilisateur/connexion");
}

// Si la fonction n'est pas définie, l'accueil est affiché
if (!isset($_GET['fonction']) || empty($_GET['fonction'])) {
    $function = "accueil";
} else {
    $function = $_GET['fonction'];
}

// Récupère les données de l'utilisateur
try {
    $user = returnUserBytoken($conn, $_SESSION['token']);
    // Id de l'utilisateur
    $id_user = $user['idUtilisateur'];
    // Récupère les informations des boitiers de l'utilisateur
    $boitiers = recupereBoitiers($conn, $id_user);
}
catch (Exception $e )
{
    // Destruction des cookies
    setcookie("token", "", time() - 3600);
    // remove all session variables
    session_unset();
    // destroy the session 
    session_destroy(); 
    header("Location: /utilisateur/connexion");
}
catch (Throwable $t)
{
    // Destruction des cookies
    setcookie("token", "", time() - 3600);
    // remove all session variables
    session_unset();
    // destroy the session 
    session_destroy(); 
    header("Location: /utilisateur/connexion");
}

switch ($function) {
    // Accueil
    case 'accueil':
        $vue = "user/accueil";
        $title = "Espace Client";
        $prenom = ucfirst(returnName($conn, $_SESSION['token']));
        break;

    // Paramètres du compte 
    case 'parametres':
        $vue = "user/settings";
        $title = "Paramètres du compte";

        // Initialisation des variables
        $email = $prenom = $nom = $cp = $password = $newPassword = $newPasswordConfirm = $form = "";
        $emailErr = $prenomErr = $nomErr = $cpErr = $passwordErr = $newPasswordErr = $newPasswordConfirmErr = "";
        $alert = false;

        // Traitement du formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $form = test_input($_POST["form"]);
            if ($form == "form1") {
                if (isset($_POST["nom"])) {
                    $nom = test_input($_POST["nom"]);
                } else {
                    $nom = $user["nom"];
                }
                if (isset($_POST["prenom"])) {
                    $prenom = test_input($_POST["prenom"]);
                } else {
                    $prenom = $user["prenom"];
                }
                if (isset($_POST["cp"])) {
                    $cp = test_input($_POST["cp"]);
                } else {
                    $cp = $user["cp"];
                }
                if (isset($_POST["email"])) {
                    $email = test_input($_POST["email"]);
                } else {
                    $email = $user["email"];
                }
                // Mise à jour de la base de données 
                modifierUtilisateur(
                    $conn, 
                    $id_user, 
                    [
                        "prenom" => $prenom,
                        "nom" => $nom,
                        "email" => $email,
                        "cp" =>  intval($cp)
                    ]
                );
                // Actualisation de la page
                header("Location: /compte/parametres");
            } else if ($form == "form2")  {                
                $password = test_input($_POST["password"]);
                $newPassword = test_input($_POST["newPassword"]);
                $newPasswordConfirm = test_input($_POST["newPasswordConfirm"]);

                // Vérification des données saisies
                if ($password && $newPassword && $newPasswordConfirm) {
                    if (verifOldPwd($conn, $_SESSION["token"], $password)) {
                        if ($newPasswordConfirm == $newPassword) {
                            if (verifPassword($newPassword)) {
                                updatePwd($conn, $_SESSION["token"], $newPassword);
                                $alert = "<script>alert(\"Le mot de passe a bien été modifié !\")</script>";
                            }
                        } else {
                            $newPasswordConfirmErr = "Les mots de passe entrés sont différents !";
                        }
                    } else {
                        $passwordErr = "Le mot de passe entré est incorrect !";
                    }
                }
            }
        }
        break;

    // Paramètres des boitiers
    case 'parametres-boitier':
        // Vérifie que le boitier appartient à l'utilisateur connecté
        if (isset($_GET['boitier']) && returnIdUserByIdBoitier($conn, $_GET['boitier']) == returnIdUserBytoken($conn, $_SESSION['token'])) {
            $vue = "user/parametres-boitier";
            $title = "Paramètres du boitier";
            // Récupère les informations du boitier 
            $boitier_p = recupereBoitier($conn, $_GET['boitier']);
            if($boitier_p['prenom']){
                $nomboitier = $boitier_p['prenom'];
            } else {
                $i = 1;
                foreach ($boitiers as $b){
                    if($boitier_p['idBoitier'] == $b['idBoitier']) {
                        $nomboitier = 'Boitier '.$i; 
                    }
                    $i += 1;
                }
            }
            // Récupère les allergies de l'Enfant
            $allergies = recupereAllergies($conn, $boitier_p['idEnfant']);

            // Initialisation des variables
            $dateNaissance = $prenom = $sexe = $son = $mail = $push = $bpm = $temp = $hum = $form = $poids = "";
            $dateNaissanceErr = $prenomErr = $sexeErr = "";

            // Traitement du formulaire
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $form = test_input($_POST["form"]);
                if ($form == "form1") {
                    if (isset($_POST["dateNaissance"])) {
                        $dateNaissance = test_input($_POST["dateNaissance"]);
                    } else {
                        $dateNaissance = $boitier_p["dateNaissance"];
                    }
                    if (isset($_POST["prenom"])) {
                        $prenom = test_input($_POST["prenom"]);
                    } else {
                        $prenom = $boitier_p["prenom"];
                    }
                    if (isset($_POST["sexe"])) {
                        $sexe = test_input($_POST["sexe"]);
                    } else {
                        $sexe = $boitier_p["sexe"];
                    }
                    if (isset($_POST["poids"])) {
                        $poids = test_input($_POST["poids"]);
                    } else {
                        $poids = $boitier_p["poids"];
                    }
                    if (isset($_POST["Tilleul"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Tilleul") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Tilleul");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Tilleul") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Ambroisies"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Ambroisies") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Ambroisies");
                        } 
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Ambroisies") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Olivier"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Olivier") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Olivier");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Olivier") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Plantain"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Plantain") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Plantain");
                        }  
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Plantain") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Noisetier"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Noisetier") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Noisetier");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Noisetier") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Aulne"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Aulne") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Aulne");
                        }       
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Aulne") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Armoise"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Armoise") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Armoise");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Armoise") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Chataignier"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Chataignier") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Chataignier");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Chataignier") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Urticacees"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Urticacees") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Urticacees");
                        }   
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Urticacees") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Oseille"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Oseille") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Oseille");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Oseille") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Graminees"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Graminees") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Graminees");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Graminees") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Chene"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Chene") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Chene");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Chene") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Platane"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Platane") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Platane");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Platane") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Bouleau"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Bouleau") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Bouleau");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Bouleau") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Charme"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Charme") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Charme");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Charme") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Peuplier"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Peuplier") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Peuplier");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Peuplier") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Frene"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Frene") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Frene");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Frene") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Saule"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Saule") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Saule");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Saule") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                    if (isset($_POST["Cupressacees"])) {
                        $test = 0;
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Cupressacees") {
                                $test = 1;
                            } 
                        }
                        if (!$test) {
                            ajouteAllergie($conn, $boitier_p["idEnfant"], "Cupressacees");
                        }
                    } else {
                        foreach ($allergies as $a) {
                            if ($a["type"] == "Cupressacees") {
                                deleteAllergie($conn, $a["idAllergie"]);
                            }
                        }
                    }
                
                    // Mise à jour de la base de données 
                    modifierUtilisateurBoitier(
                        $conn, 
                        $boitier_p['idBoitier'], 
                        [
                            "prenom" => $prenom,
                            "dateNaissance" => $dateNaissance,
                            "sexe" => intval($sexe), 
                            "poids" =>  floatval($poids)
                        ]
                    );
                    // Actualisation de la page
                    header("Location: /compte/parametres-boitier?boitier=".$boitier_p['idBoitier']);
                } else if ($form == "form2")  {                
                    if (isset($_POST["son"])) {
                        $son = 1;
                    } else {
                        $son = 0;
                    }
                    if (isset($_POST["push"])) {
                        $push= 1;
                    } else {
                        $push = 0;
                    }
                    if (isset($_POST["mail"])) {
                        $mail = 1;
                    } else {
                        $mail = 0;
                    }
                    if (isset($_POST["hum"])) {
                        $hum = test_input($_POST["hum"]);
                    } else {
                        $hum = $boitier_p["seuilAlerteHum"];
                    }
                    if (isset($_POST["temp"])) {
                        $temp = test_input($_POST["temp"]);
                    } else {
                        $temp = $boitier_p["seuilAlerteTemp"];
                    }
                    if (isset($_POST["bpm"])) {
                        $bpm = test_input($_POST["bpm"]);
                    } else {
                        $bpm = $boitier_p["seuilAlerteFreq"];
                    }
                    // Mise à jour de la base de données 
                    modifierUtilisateurBoitier(
                        $conn, 
                        $boitier_p['idBoitier'], 
                        [
                            "activerSon" => intval($son),
                            "activerNotifPush" => intval($push),
                            "activerNotifMail" => intval($mail),
                            "seuilAlerteFreq" => floatval($bpm),
                            "seuilAlerteTemp" => floatval($temp),
                            "seuilAlerteHum" => floatval($hum)
                        ]
                    );
                    // Actualisation de la page
                    header("Location: /compte/parametres-boitier?boitier=".$boitier_p['idBoitier']);
                }
            }
        } else {
            header("Location: /compte/moniteurs");
        }

        break;
        

    // Accueuil Moniteurs
    case 'moniteurs':
        if (empty($_GET['boitier'])) {
            $vue = "user/moniteurs";
            $title = "Accueil Moniteurs";

            // Initialisation des variables
            $idActivation = $dateNaissance = $prenom = $sexe = "";
            $idActivationErr = $dateNaissanceErr = $prenomErr = $sexeErr = "";

            // Traitement du formulaire
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $idActivation = test_input($_POST["idActivation"]);
                $dateNaissance = test_input($_POST["dateNaissance"]);
                $prenom = test_input($_POST["prenom"]);
                $sexe = test_input($_POST["sexe"]);
                if (!$sexe) {
                    $sexe = 0;
                }
                // Vérification des données saisies
                if ($idActivation && $prenom && $dateNaissance) {
                    if (verifString($prenom)) {
                        // Vérification du numéro d'activation du boitier
                        $id = existIdActivation($conn, $idActivation);
                        if ($id) {
                            // Mise à jour de la table Boitier
                            modifierBoitier($conn, $id, ["isActive" => 1]);
                            // Mise à jour de la table Utilisateur-Boitier
                            ajouteUtilisateurBoitier(
                                $conn, 
                                [
                                    "idUtilisateur" => $id_user, 
                                    "idBoitier" => $id, 
                                    "dateNaissance" => $dateNaissance,
                                    "prenom" => $prenom,
                                    "sexe" => intval($sexe)
                                ]
                            );
                            // Rechargement de la page
                            header("Location: /compte/moniteurs");
                        } else {
                            $idActivationErr = "L'identifiant d'activation n'est pas valide !";
                        }
                    } else {
                        $prenomErr = "Entrer un prénom valide !";
                    }
                }
            }

        }
        // Vérifie que le boitier appartient à l'utilisateur connecté
        elseif(returnIdUserByIdBoitier($conn, $_GET['boitier']) == returnIdUserBytoken($conn, $_SESSION['token'])) {

            // Informations du boitier
            $boitier = recupereBoitier($conn, $_GET['boitier']);
            if($boitier['prenom']){
                $nomboitier = $boitier['prenom'];
            } else {
                $i = 1;
                foreach ($boitiers as $b){
                    if($boitier['idBoitier'] == $b['idBoitier']) {
                        $nomboitier = 'Boitier '.$i; 
                    }
                    $i += 1;
                }
            }

            // Accueil Boitier
            if (empty($_GET['donnees'])) {
                $title = "Moniteur Boitier ".$_GET['boitier'];
                $vue = "user/boitier";
            } else {

                $tousLesCapteurs = obtenirTouteLaData($conn, $_GET['boitier']);
                $vue = "user/data";

                 // Données Santé
                if($_GET['donnees'] == "sante") {
                    $title = "Santé";
                } 
                // Données Environnement
                elseif($_GET['donnees'] == "environnement") {
                    // print_r($boitier);
                    
                    $title = "Environnement";
                    // Numéro de département
                    $cp = substr($user['cp'], 0, -3); 
                    // Récupération des données Pollen du département 
                    $pollens_string = file_get_contents("https://www.pollens.fr/risks/thea/counties/".$cp);
                    // Décode les données et les stock dans une variable
                    $pollens = json_decode($pollens_string, true)["risks"];
                    // Récupère les allergies de l'Enfant
                    $allergies = recupereAllergies($conn, $boitier['idEnfant']);
                    // Vérifie s'il y a des risques
                    $risque = 0;
                    foreach($pollens as $pollen) {
                        if ($pollen["level"]!=0) {
                            foreach($allergies as $allergie) {
                                if ($pollen["pollenName"] == $allergie["type"]) {
                                    $risque = 1;
                                }
                            }
                        } 
                    }
                }
            }
        } 
        else {
            header("Location: /compte/moniteurs");
        } 
        break;
    
    // AJAX modal-content
    case 'modal-content':
        $vue = "user/moniteurs";
        $title = "Accueil Moniteurs";
        header('Content-Type: application/json; charset=utf-8');

        function writeError(){
            echo json_encode(array("response" => "error"));
        }

        // Si la fonction n'est pas définie, l'accueil est affiché
        if (empty($_GET['type'])) {
            writeError();
        } else {
            $type = $_GET['type'];
        }

        $rep = rechercheParCategorie($conn, $type);

        if(isset($rep[0])){
            echo json_encode(array('title' => $rep[0]["titre"], 'content' => $rep[0]["texte"]));
        } else {
            writeError();
        }

        break;
    
    
    // AJAX data-capteur
    case 'data-capteur':
        $vue = "user/moniteurs";
        $title = "Accueil Moniteurs";
        header('Content-Type: application/json; charset=utf-8');

        function writeError(){
            echo json_encode(array("response" => "error"));
        }

        // Si la fonction n'est pas définie, l'accueil est affiché
        if (empty($_GET['capteur-id']) || empty($_GET['capteur-nom'])) {
            writeError();
        } else {
            $capteur = $_GET['capteur-id'];
            $nom = $_GET['capteur-nom'];
        }

        echo json_encode(array("valeurs" => obtenirValeurCapteur($conn, intval($capteur), $nom), "capteur" => obtenirCapteurInfos($conn, intval($capteur))));
        
        break;


    // Changement de mot de passe 
    case 'changePassword':
        $vue = "user/parametres";
        $title = "Espace Utilisateur - Paramètres";

        // Initialisation des variables
        $password = $newPassword = $newPasswordConfirm =  "";
        $passwordErr = $newPasswordErr = $newPasswordConfirmErr =  "";
        $alert = null;

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
                            $alert = "<script>alert(\"Le mot de passe a bien été modifié !\")</script>";
                        }
                    } else {
                        $newPasswordConfirmErr = "Les mots de passe entrés sont différents !";
                    }
                } else {
                    $passwordErr = "Le mot de passe entré est incorrect !";
                }
            }
        }

    // Déconnexion
    case 'deconnexion':
        // Destruction des cookies
        setcookie("token", "", time() - 3600);
        // remove all session variables
        session_unset();
        // destroy the session 
        session_destroy(); 
        header("Location: /utilisateur/connexion");
        break;
        
    default:
        // si aucune fonction ne correspond au paramètre function passé en GET
        $vue = "erreur404";
        $title = "error404";
        $message = "Erreur 404 : la page recherchée n'existe pas.";
}

if ($_GET['fonction'] != "data-capteur" && $_GET['fonction'] != "modal-content") {
    include ('vues/user/header.php');
    include ('vues/' . $vue . '.php');
    include ('vues/user/footer.php');
}

?>