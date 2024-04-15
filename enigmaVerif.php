<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_POST['submit']))
{
    
    $choixJoueur= $_POST['reponse'];  //ce que le joueur a répondu à l'énigme

    $reponseJoueur = ReponsesTable()->selectById($choixJoueur)[0];
    
    $enigme = EnigmesTable()->selectById($reponseJoueur->IdEnigme)[0];
  
    $joueurId = $_SESSION['id'];
    
   
    DB()->nonQuerySqlCmd("CALL repondreEnigme($enigme->Id, $joueurId, $choixJoueur);"); 
    DB()->nonQuerySqlCmd("CALL checkEnigmesRésoluEnigmaAlchimiste($joueurId);"); 

   // redirect("enigma.php?choix=$choixJoueur&jou=$joueurId&eni=$enigme->Id");
    redirect("enigma.php");
}