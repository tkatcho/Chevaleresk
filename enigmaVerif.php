<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_POST['submit']))
{
   
    //TODO: avoir une table avec des réponses possibles
    $choixJoueur= $_POST['reponse'];  //ce que le joueur a répondu à l'énigme
    
    

    $user = JoueursTable()->selectWhere("alias = '$username'")[0];


   
       
}