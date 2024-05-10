<?php

include 'php/sessionManager.php';
include 'DAL/ChevalereskDB.php';

$userId = $_SESSION['id'];
$itemId = $_POST['itemId'];

$comment = $_POST['comment'];

//verif if comment is chill
$isChill = true;

if ($isChill) {
    //find comment
    //set new comment
    //update
    //return notif saying its fine
    echo 'alert("Comment has been modified")';
}

http_response_code(200);
// $eval = new Evaluation();
// $eval->idItem = $itemId;
// $eval->idJoueur = $userId;
// $eval->Etoile = $stars;
// $eval->Commentaire = $comment;
// var_dump($eval);
