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

        if (strlen($_POST['motDePasse']) != 0) {
            $joueur->MotDePasse = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
        } else {
            $joueur->MotDePasse = "";
        }


        if (PlayerVerif($joueur)) {
            JoueursTable()->update($joueur);
            $_SESSION["alias"] = $joueur->Alias;
            $_SESSION["nom"] = $joueur->Nom;
            $_SESSION["prenom"] = $joueur->Prenom;
            redirect('modifierProfilForm.php?sucess="Reussi"');
        }
    } else {
        redirect('modifierProfilForm.php?error=usernameExists');
    }
}

function PlayerVerif($joueur)
{
    if (strlen($joueur->Alias) >= 20) {
        redirect('modifierProfilForm.php?error=aliasInvalid');
        return false;
    }
    if (strlen($joueur->Nom) >= 20) {
        redirect('modifierProfilForm.php?error=nameInvalid');
        return false;
    }
    if (strlen($joueur->Prenom) >= 20) {
        redirect('modifierProfilForm.php?error=firstNameInvalid');
        return false;
    }
    if (strlen($joueur->MotDePasse) >= 20) {
        redirect('modifierProfilForm.php?error=passwordInvalid');
        return false;
    }
    return true;
}
//redirect('options.php');
