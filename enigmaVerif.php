<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_POST['submit']))
{
    
    $choixJoueur= $_POST['reponse'];  //ce que le joueur a répondu à l'énigme
    
    $reponseJoueur = ReponsesTable()->selectWhere("reponse= $choixJoueur")[0];
    /*
    $enigme = EnigmesTable()->selectWhere("id= $reponseJoueur->IdEnigme")[0];
    $user = JoueursTable()->selectWhere("alias = '$username'")[0];

    
    if($reponseJoueur->EstBonne == '1' ){
        if($enigme->Difficulte == 'Facile'){
            $user->Solde = ($user->Solde) + 50;
        }
        
    }*/
    redirect("index.php?id=$reponseJoueur");
       
}