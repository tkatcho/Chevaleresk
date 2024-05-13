<?php

include 'php/sessionManager.php';
include 'DAL/ChevalereskDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['alias'])) {
        $alias = $_POST['alias'];
        $itemId = $_POST['itemId'];

        $playerId = JoueursTable()->findByAlias($alias)->Id;

        $oldComment = EvaluationsTable()->selectWhere("idItem=$itemId && idJoueur=$playerId")[0];

        //trycatch
        EvaluationsTable()->delete($oldComment->Id);

        echo "Le commentaire a bien ete supprimer";
    } else {
        echo "Alias not set in POST data.";
    }
} else {
    echo "Invalid request method.";
}
