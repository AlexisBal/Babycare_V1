function verifEmail() {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.forms["connexionForm"]["email"].value)) {
        document.getElementById("emailErr").innerHTML = "";
    }
    else {
        document.getElementById("emailErr").innerHTML = "L'email entrée est invalide !";
    }
}

function verifCp() {
    var cp = document.forms["inscriptionForm"]["cp"].value;
    const nb = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
    var test = 0;
    for (let i = 0; i < cp.length; i++) { 
        if (nb.indexOf(cp[i]) == -1) {
            document.getElementById("CpErr").innerHTML = "Le code postal entré est invalide !";
            test = 1;
        }
    }
    if (!test) {
        document.getElementById("CpErr").innerHTML = "";
    }
}

function verifPassword() {
    var password = document.forms["inscriptionForm"]["password"].value;
    document.getElementById("pwdErr").innerHTML = "";
    if (password.length < 8) {
        document.getElementById("pwdErr").innerHTML = "Le mot de passe doit faire plus de 8 caractères !";
    } 
    if (password.search(/[^a-zA-Z\d]/) < 0) {
        document.getElementById("pwdErr").innerHTML = "Le mot de passe doit contenir au moins 1 caractères spécial !";
    }
    if (password.search(/\d/) < 0) {
        document.getElementById("pwdErr").innerHTML = "Le mot de passe doit contenir au moins 1 chiffre !";
    } 
}

function verifConfirmPassword() {
    var password = document.forms["inscriptionForm"]["password"].value;
    var confirmPassword = document.forms["inscriptionForm"]["passwordConfirm"].value;
    if (password == confirmPassword) {
        document.getElementById("pwdConfErr").innerHTML = "";
    } else {
        document.getElementById("pwdConfErr").innerHTML = "Les mots de passe entrés sont différents !";
    }
}