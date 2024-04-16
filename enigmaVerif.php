<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_POST['submit']))
{
    
    $choixJoueur= $_POST['reponse'];  //ce que le joueur a répondu à l'énigme
    $filtresDif = $_POST['filtresDif'];
    $filtresType = $_POST['filtresType'];

    $reponseJoueur = ReponsesTable()->selectById($choixJoueur)[0];
    
    $enigme = EnigmesTable()->selectById($reponseJoueur->IdEnigme)[0];
  
    $joueurId = $_SESSION['id'];
    
   
    DB()->nonQuerySqlCmd("CALL repondreEnigme($enigme->Id, $joueurId, $choixJoueur);"); 
    DB()->nonQuerySqlCmd("CALL checkEnigmesRésoluEnigmaAlchimiste($joueurId);"); 

    redirect("enigma.php?d=" . $filtresDif. "&t=".$filtresType);
}