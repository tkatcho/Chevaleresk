<?php

require 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
anonymousAccess();

if ($_POST['confirmPassword'] == $_POST['motDePasse']) {
    // Hashing du mot de passe
    $_POST['motDePasse'] = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
    JoueursTable()->insert(new Joueur($_POST));
} else {
    redirect('signupForm.php?error=confirmPasswordFailed');
}

redirect('signupForm.php');