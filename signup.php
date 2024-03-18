<?php

require 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
anonymousAccess();

if (isset($_POST['submit']))
{
    $validUser = true;
    if ($_POST['confirmPassword'] != $_POST['motDePasse'])
    {
        $validUser = false;
        redirect('signupForm.php?error=confirmPasswordFailed');
    }

    if (JoueursTable()->aliasExist($_POST['alias']))
    {
        $validUser = false;
        redirect('signupForm.php?error=usernameExists');
    }

    if ($validUser)
    {
        // Hashing du mot de passe
        $_POST['motDePasse'] = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
        JoueursTable()->insert(new Joueur($_POST));
    }

    redirect('login.php');
}

redirect('index.php');