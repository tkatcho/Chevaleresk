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
    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];

    
    if($reponse->EstBonne == 1 ){
        if($enigme->Difficulte == 'Facile'){
            $_SESSION['solde'] = ($joueur->Solde) +50;
        }
        
    }
    redirect("index.php?id=$joueur->Solde");
       
}