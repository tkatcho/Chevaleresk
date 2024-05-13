<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
adminAccess();

if (isset($_POST['idEval'])) {
    $idEval = $_POST['idEval'];
    EvaluationsTable()->delete($idEval);
}