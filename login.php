<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_POST['submit']))
{
    $validUser = true;

    $username = $_POST['alias'];
    $password = $_POST['motDePasse'];

    $user = JoueursTable()->selectWhere("alias = '$username'")[0];

    if (!JoueursTable()->aliasExist($username))
    {
        $validUser = false;
        redirect('loginForm.php?error=usernameNotExists');
    }
    if (!password_verify($password, $user->MotDePasse)){
        $validUser = false;
        redirect('loginForm.php?error=passwordFailed');
    }
    

    if ($validUser)
    {
        $_SESSION['validUser'] = true;
        $_SESSION['isAdmin'] = $user->estAdmin;
        $_SESSION['id'] = $user->Id;
        $_SESSION['alias'] = $user->Alias;
        $_SESSION['nom'] = $user->Nom;
        $_SESSION['prenom'] = $user->Prenom;
        $_SESSION['solde'] = $user->Solde;
        $_SESSION['niveau'] = $user->Niveau;
        $_SESSION['estAlchimiste'] = $user->estAlchimiste;
        $_SESSION['erreur'] = "";
        $_SESSION['success'] = "";
        redirect('optionsJeu.php');
    }

   // redirect('index.php');
  
       
}