<?php

include 'DAL/ChevalereskDB.php';

$errorMessage = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "confirmPasswordFailed")
        $errorMessage = "Vos mots de passe ne correspondent pas";
}

$pageTitle = "Inscription";

$content = <<<HTML
    <form method='post' action='newJoueur.php'>
        <div class="loginForm">
            <div>
                <input  type='text' 
                        name='alias' 
                        required 
                        RequiredMessage='Veuillez entrer un alias'
                        InvalidMessage='Alias invalide'
                        placeholder="Alias">
                <input  type='text' 
                        name='nom' 
                        required 
                        RequiredMessage='Veuillez entrer un nom'
                        InvalidMessage='Nom invalide'
                        placeholder="Nom">
                <input  type='text' 
                        name='prenom' 
                        required 
                        RequiredMessage='Veuillez entrer un prénom'
                        InvalidMessage='Prénom invalide'
                        placeholder="Prénom">
                <input  type='password' 
                        name='motDePasse' 
                        placeholder='Mot de passe'
                        required
                        RequireMessage = 'Veuillez entrer votre mot de passe'
                        InvalidMessage = 'Mot de passe invalide' >
                <input  type='password'
                        name='confirmPassword'
                        placeholder='Confirmer le mot de passe'
                        required
                        RequireMessage = 'Veuillez confirmer votre mot de passe'
                        InvalidMessage = 'Confirmation du mot de passe invalide' >
                <input type='submit' name='submit' value="Inscription" class="loginFormBtn" >
                <p class="text-danger errorMessage">$errorMessage</p>
            </div>
        </div>
    </form>
HTML;

include 'views/master.php';