<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_POST['submit'])) {
    $validUser = true;
    $joueur;
    if ($_POST['confirmPassword'] != $_POST['motDePasse']) {
        $validUser = false;
        redirect('modifierProfilForm.php?error=confirmPasswordFailed');
    }

    if (!JoueursTable()->aliasExist($_POST['alias']) || JoueursTable()->aliasExist($_POST['alias']) == $_SESSION['alias']) {
        $joueur = JoueursTable()->findByAlias($_SESSION['alias']);
        $joueur->Alias = $_POST['alias'];
        $joueur->Nom = $_POST['nom'];
        $joueur->Prenom = $_POST['prenom'];

        if (strlen($_POST['motDePasse']) != 0) {
            $joueur->MotDePasse = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
        } else {
            $joueur->MotDePasse = "";
        }

        print_r($joueur);
        JoueursTable()->update($joueur);
        //ajouter min max requirements on html

        redirect('loginForm.php');
    }

    //redirect('loginForm.php');
}

//redirect('options.php');
