<?php

include 'php/sessionManager.php';
include 'DAL/ChevalereskDB.php';

$userId = $_SESSION['id'];
$itemId = $_POST['itemId'];
$stars = $_POST['stars'];
$comment = $_POST['comment'];

if ($stars >= 1 && $stars <= 5 && EvaluationsTable()->selectWhere("idJoueur = $userId AND idItem = $itemId") == null) {
    $eval = new Evaluation();
    $eval->idItem = $itemId;
    $eval->idJoueur = $userId;
    $eval->Etoile = $stars;
    $eval->Commentaire = $comment;
    var_dump($eval);
    EvaluationsTable()->insert($eval);
} else {
    http_response_code(3000);
}