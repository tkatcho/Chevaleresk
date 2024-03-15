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
    <h1>Inscription</h1>
    <form method="POST" action="newJoueur.php">
        <input type="text" placeholder="Alias" name="alias" required>
        <input type="text" placeholder="Nom" name="nom" required>
        <input type="text" placeholder="Prenom" name="prenom" required>
        <input type="password" placeholder="Mot de passe" name="motDePasse" required>
        <input type="password" placeholder="Confirmer mot de passe" name="confirmPassword" required>
        <input type="submit">
    </form>
    <div class="errors">
        <p class="text-danger">$errorMessage</p>
    </div>
HTML;

include 'views/master.php';