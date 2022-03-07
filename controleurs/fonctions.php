<?php
/**
 * Fonctions liées aux contrôleurs
 */

define("DEV_MODE", false);

// Détermine si le paramètre est un entier ou non
function verifInt($int): bool
{
    if (empty($int)) {
        return false;

    } else {
        return is_numeric($int);
    }
}

// Détermine si le paramètre est une string ou non
function verifString($chaine): bool
{
    if (empty($chaine)) {
        return false;

    } else {
        return is_string($chaine);
    }
}

// Détermine si le paramètre est un email
function verifEmail($chaine): bool
{
    if (empty($chaine)) {
        return false;

    } else {
        $verif1 = strpos($chaine, ".");
        $verif2 = strpos($chaine, "@");
        if ($verif1 && $verif2) {
            return is_string($chaine);
        }
    }
}


// Détermine si la chaine respecte le nombre de caractères min
function verifStringLenMin($chaine, $nbChar): bool
{
    if (empty($chaine) || strlen($chaine) < $nbChar) {
        return false;
    } else {
        return is_string($chaine);
    }
}

// Détermine si la chaine respecte le nombre de caractères max 
function verifStringLenMax($chaine, $nbChar): bool
{
    if (empty($chaine) || strlen($chaine) > $nbChar) {
        return false;
    } else {
        return is_string($chaine);
    }
}

// Détermine si la chaine respecte le nombre de caractères 
function verifStringLen($chaine, $nbChar): bool
{
    if (empty($chaine) || strlen($chaine) == $nbChar) {
        return false;
    } else {
        return is_string($chaine);
    }
}

// Détermine si l'entier respecte le nombre de caractères min
function verifIntLenMin($int, $nbChar): bool
{
    if (empty($int) || strlen($int) < $nbChar) {
        return false;
    } else {
        return is_numeric($int);
    }
}

// Détermine si l'entier respecte le nombre de caractères max 
function verifIntLenMax($int, $nbChar): bool
{
    if (empty($int) || strlen($int) > $nbChar) {
        return false;
    } else {
        return is_numeric($int);
    }
}

// Détermine si l'entier respecte le nombre de caractères 
function verifIntLen($int, $nbChar): bool
{
    if (empty($int) || strlen($int) != $nbChar) {
        return false;
    } else {
        return is_numeric($int);
    }
}

// Contient au moins un chiffre et un caractère spécial et fait plus de 8 caractères
function verifPassword($chaine): bool
{
    // digit verif 
    $verif1 = preg_match('/\d/', $chaine);
    // special char verif
    $verif2 = preg_match('/[^a-zA-Z\d]/', $chaine);
    $verif3 = verifStringLenMin($chaine, 8);
    if ($verif1 && $verif2 && $verif3) {
        return true; 
    } else {
        return false;
    }
}

// Hash le mot de passe 
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Vérifie que le mot de passe est valide
function verifHashPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Generate a cryptographically secure token 
function generateToken() {
    // Generate a random string.
    $token = openssl_random_pseudo_bytes(16);
    // Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);
    return $token;
}

// Envoie du mot de passe par mail aux admin
function sendEmailAdmin($prenom, $email, $pwd) {
    // Expéditeur et Destinataire
    $from = "Babycare <nepasrepondre.babycare@gmail.com>";
    $to = $prenom." <".$email.">";

    // Objet et contenu du mail 
    $subject = 'Identifiants de connexion';
    $body = "
    <html>
     <body>
        <p>Bonjour ".ucfirst($prenom).",<br><br>Voici vos identifiants de connexion :<br><br><b>Identifiant :</b> ".$email."<br><b>Mot de passe :</b> ".$pwd."</p>
        <p style='color:red;'><b>Veuillez modifier le mot de passe d&#232;s la reception de cet email !</b></p>
        <a href='https://babycare-website.com/utilisateur/connexion'><p>Cliquez ici pour vous connecter (si le lien ne fonctionne pas, copier-coller l'url dans votre navigateur)</p></a>
        <a href='https://babycare-website.com/utilisateur/connexion'><img src='https://babycare-website.com/assets/img/logo.png' style='width:200px' alt='Logo Babycare'></a>
     </body>
    </html>
    ";

    // Header du mail
    $headers = array (
        'From' => $from,
        'MIME-Version' => "1.0",
        'Content-type' => "text/html", 
        'charset' => "iso-8859-1"); 

    // Envoie de l'email
    mail($to, $subject, $body, $headers);
}

// Envoie du mot de passe par mail aux utilisateurs
function sendEmailUser($prenom, $email, $pwd) {
    // Expéditeur et Destinataire
    $from = "Babycare <nepasrepondre.babycare@gmail.com>";
    $to = $prenom." <".$email.">";

    // Objet et contenu du mail 
    $subject = 'Reinitialisation de votre mot de passe';
    $body = "
    <html>
     <body>
        <p>Bonjour ".ucfirst($prenom).",<br><br>Pour des raisons de sécurité, votre mot de passe a été modifié.<br>Voici vos nouveaux identifiants de connexion :<br><br><b>Identifiant :</b> ".$email."<br><b>Mot de passe :</b> ".$pwd."</p>
        <p style='color:red;'><b>Veuillez modifier le mot de passe d&#232;s la reception de cet email !</b></p>
        <a href='https://babycare-website.com/utilisateur/connexion'><p>Cliquez ici pour vous connecter (si le lien ne fonctionne pas, copier-coller l'url dans votre navigateur)</p></a>
        <a href='https://babycare-website.com/utilisateur/connexion'><img src='https://babycare-website.com/assets/img/logo.png' style='width:200px' alt='Logo Babycare'></a>
     </body>
    </html>
    ";

    // Header du mail
    $headers = array (
        'From' => $from,
        'MIME-Version' => "1.0",
        'Content-type' => "text/html", 
        'charset' => "iso-8859-1"); 

    // Envoie de l'email
    mail($to, $subject, $body, $headers);
}

// Envoie du mot de passe par mail aux utilisateurs
function sendToAdmin($email, $prenom, $nom, $message, $objet) {
    // Expéditeur et Destinataire
    $from = "Babycare <nepasrepondre.babycare@gmail.com>";
    $to = "Alexis <alexis.balayre@gmail.com>";

    // Objet et contenu du mail 
    $body = "
    <html>
     <body>
        <p><b>Prénom:</b> ".ucfirst($prenom)."<br><b>Nom:</b> ".ucfirst($nom)."<br><b>Email:</b> ".$email."</p>
        <p>".$message."</p>
        <a href='https://babycare-website.com/connexion'><img src='https://babycare-website.com/assets/img/logo.png' style='width:200px' alt='Logo Babycare'></a>
     </body>
    </html>
    ";

    // Header du mail
    $headers = array (
        'From' => $from,
        'MIME-Version' => "1.0",
        'Content-type' => "text/html", 
        'charset' => "iso-8859-1"); 

    // Envoie de l'email
    mail($to, $objet, $body, $headers);
}

// Generate a cryptographically secure password
function generatePassword() {
    // Generate a random string.
    $pwd = openssl_random_pseudo_bytes(20);
    // Convert the binary data into hexadecimal representation.
    $pwd = bin2hex($pwd);
    return $pwd;
}

// Generation d'un identifiant d'activation unique 
function generateId() {
    $id = openssl_random_pseudo_bytes(8);
    return bin2hex($id);
}

function isHttps(){
    if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    return true;
    }
    else {
    return false;
    }
}

//Effectue une verification captcha
function getCaptchaVerif($tokencaptcha, $action){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $tokencaptcha)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, isHttps());
    $response = curl_exec($ch);
    curl_close($ch);
    if(empty($response)) return false;
    $arrResponse = json_decode($response, true);
    return $arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5;
}

// Sécurité anti-injection
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);
    return $data;
}
?>
