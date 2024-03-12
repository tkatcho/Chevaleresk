<?php

// TEST DE FONCTIONNEMENT!!!!

include 'DAL/ChevalereskDB.php';

$results = JoueursTable()->selectAll();

$tableDesJoueurs = "";
                
foreach ($results as $result) {
    $id = $result->Id;
    $alias = $result->Alias;
    $prenom = $result->Prenom;
    $nom = $result->Nom;
    $solde = $result->Solde;

    $tableDesJoueurs .= <<<HTML
        <tr>
            <td>$id</td>
            <td>$alias</td>
            <td>$prenom</td>
            <td>$nom</td>
            <td>$solde</td>
        </tr>
HTML;
}

$title = "Test";

$content = <<<HTML
    <h1>Test de la BD</h1>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Alias</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Solde</th>
        </tr>
        $tableDesJoueurs
    </table>
    <form method="POST" action="newJoueur.php">
        <input type="text" placeholder="Alias" name="alias">
        <input type="text" placeholder="Nom" name="nom">
        <input type="text" placeholder="Prenom" name="prenom">
        <input type="number" placeholder="Solde" name="solde">
        <input type="password" placeholder="Mot de passe" name="motDePasse">
        <input type="submit">
    </form>
HTML;

include 'views/master.php';