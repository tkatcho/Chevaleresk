<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_POST['submit'])) {
    $joueur;
    if ($_POST['confirmPassword'] != $_POST['motDePasse']) {
        redirect('modifierProfilForm.php?error=confirmPasswordFailed');
    }
    if (!isset($_POST['alias']) || !isset($_POST['nom']) || !isset($_POST['prenom'])) {
        redirect('modifierProfilForm.php?error=missingField');
    }

    if (!JoueursTable()->aliasExist($_POST['alias']) || $_POST['alias'] == $_SESSION['alias']) {
        $joueur = JoueursTable()->findByAlias($_SESSION['alias']);

        $joueur->Alias = $_POST['alias'] ?? 0;
        $joueur->Nom = $_POST['nom'] ?? 0;
        $joueur->Prenom = $_POST['prenom'] ?? 0;

        $_SESSION["alias"] = $joueur->Alias;
        $_SESSION["nom"] = $joueur->Nom;
        $_SESSION["prenom"] = $joueur->Prenom;

        if (strlen($_POST['motDePasse']) != 0) {
            $joueur->MotDePasse = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
        } else {
            $joueur->MotDePasse = "";
        }

        JoueursTable()->update($joueur);

        redirect('modifierProfilForm.php?sucess="Reussi"');
    } else {
        redirect('modifierProfilForm.php?error=usernameExists');
    }
}

//redirect('options.php');
