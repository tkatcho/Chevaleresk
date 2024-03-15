<?php

include 'DAL/ChevalereskDB.php';

$errorMessage = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "confirmPasswordFailed")
        $errorMessage = "Vos mots de passe ne correspondent pas";
}

$title = "Test";

$content = <<<HTML
    <h1>Inscription</h1>
    <form method="POST" action="newJoueur.php">
        <input type="text" placeholder="Alias" name="alias">
        <input type="text" placeholder="Nom" name="nom">
        <input type="text" placeholder="Prenom" name="prenom">
        <input type="number" placeholder="Solde" name="solde">
        <input type="password" placeholder="Mot de passe" name="motDePasse">
        <input type="submit">
    </form>
    <div class="errors">
        <p class="text-danger">$errorMessage</p>
    </div>
HTML;

include 'views/master.php';