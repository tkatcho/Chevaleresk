<?php

include_once 'php/sessionManager.php';
include_once 'DAL/ChevalereskDB.php';

$user = JoueursTable()->selectById($_SESSION['id'])[0];

if (password_verify($_POST['mdpCourant'], $user->MotDePasse)) {
    $password = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    DB()->nonQuerySqlCmd("CALL modifierPassword($_SESSION[id], '$password')");
} else {
    http_response_code(400);
}