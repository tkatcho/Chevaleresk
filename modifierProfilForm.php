<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

$errorMessage = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "confirmPasswordFailed")
        $errorMessage = "Vos mots de passe ne correspondent pas";
    if ($error == "usernameExists")
        $errorMessage = "Cette alias est déjà utilisé";
}
$viewTitle = "Modifier Profil";

$content = <<<HTML
    <div class="signupForm">
        <form method='post' action='modifierProfil.php'>
            <div>
                <i class="fa-solid fa-user"></i>
                <input type='text' name='alias' required RequiredMessage='Veuillez entrer un alias' InvalidMessage='Alias invalide' value="$_SESSION[alias]">
            </div>
            <div>
                <i></i>
                <input type='text' name='nom' required RequiredMessage='Veuillez entrer un nom' InvalidMessage='Nom invalide' value="$_SESSION[nom]">
            </div>
            <div>
                <i></i>
                <input type='text' name='prenom' required RequiredMessage='Veuillez entrer un prénom' InvalidMessage='Prénom invalide' value="$_SESSION[prenom]">
            </div>
            <div>
                <i class="fa-solid fa-lock"></i>
                <input type='password' name='motDePasse' placeholder='Mot de passe' RequireMessage = 'Veuillez entrer votre mot de passe' InvalidMessage = 'Mot de passe invalide' >
            </div>
            <div>
                <i></i>
                <input type='password' name='confirmPassword' placeholder='Confirmer le mot de passe' RequireMessage = 'Veuillez confirmer votre mot de passe' InvalidMessage = 'Confirmation du mot de passe invalide' >
            </div>
            <p class="text-danger errorMessage">$errorMessage</p>
            <input type='submit' name='submit' value="Modification" class="signupFormBtn" >
        </form>
    </div>
HTML;

include 'views/master.php';
