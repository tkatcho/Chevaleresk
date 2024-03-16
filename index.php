<?php

include 'DAL/ChevalereskDB.php';

$results = JoueursTable()->selectAll();

$tableDesTests = "";
                
foreach ($results as $result) {
    $id = $result->Id;
    $alias = $result->Alias;
    $prenom = $result->Prenom;
    $nom = $result->Nom;

    $tableDesTests .= <<<HTML
        <tr>
            <td>$id</td>
            <td>$alias</td>
            <td>$prenom</td>
            <td>$nom</td>
        </tr>
HTML;
}

$pageTitle = "Catalogue de produit";

$content = <<<HTML
    <h1>Test de la BD</h1>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Alias</th>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
        $tableDesTests
    </table>
HTML;

include 'views/master.php';