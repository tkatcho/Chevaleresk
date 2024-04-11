<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_POST['submit']))
{
    
    $choixJoueur= $_POST['reponse'];  //ce que le joueur a répondu à l'énigme

    //Le selectWhere ne marchait pas
    $reponseJoueur = ReponsesTable()->selectAll();
    $reponse="";
    foreach($reponseJoueur as $rep){
        if($rep->Reponse == $choixJoueur){
            $reponse = $rep;
        }
    }
    
    //TODO: faire une procédure pour modifier le solde du joueur lorsqu'il a répondu à une bonne énigme
    
    $enigme = EnigmesTable()->selectWhere("id= $reponse->IdEnigme")[0];
  
    $joueurId = $_SESSION['id'];
    /*
    if($reponse->EstBonne == 1 ){
        if($enigme->Difficulte == 'Facile'){
            $_SESSION['solde'] = ($joueur->Solde) +50;
        }
        
    }*/

    DB()->nonQuerySqlCmd("CALL soldeEnigma($enigme->Difficulte,$joueurId);");
    redirect("optionsJeu.php?difficulte=$enigme->Difficulte");
   
       
}