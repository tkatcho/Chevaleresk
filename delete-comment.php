<?php

include 'php/sessionManager.php';
include 'DAL/ChevalereskDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['alias'])) {
        $alias = $_POST['alias'];
        $idComment = $_POST['idComment'];

        $playerId = JoueursTable()->findByAlias($alias)->Id;


        $oldComment = EvaluationsTable()->selectWhere("id = $idComment")[0];

        EvaluationsTable()->delete($oldComment->Id);
        echo "Commentaire a ete supprimer";
        
    } else {
        echo "Alias not set in POST data.";
    }
} else {
    echo "Invalid request method.";
}
