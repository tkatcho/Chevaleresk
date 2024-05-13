<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

$viewTitle = "Modérer les commentaires";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];

$styles = <<<HTML
    <link rel="stylesheet" href="./css/moderationCommentaires.css">
HTML;

$scripts = <<<HTML
    <script src="./js/moderationCommentaires"></script>
HTML;

$commentaires = EvaluationsTable()->selectAll();

$content = <<<HTML
    <table>
        <tr>
            <th>Alias</th>
            <th>Etoiles</th>
            <th>Commentaire</th>
        </tr>
HTML;

foreach ($commentaires as $commentaire) {

    $joueur = JoueursTable()->selectById($commentaire->idJoueur)[0];

    $content .= <<<HTML
        <tr id="$commentaire->Id">
            <td>$joueur->Alias</td>
            <td>$commentaire->Etoile</td>
            <td>$commentaire->Commentaire</td>
            <td class="supprimerCommentaire" commentaireId="$commentaire->Id"><i class="fa-solid fa-trash"></i></td>
        </tr>
HTML;
}

$content .= <<<HTML
    </table>
HTML;

include 'views/master.php';