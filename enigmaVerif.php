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
    
    $enigme = EnigmesTable()->selectWhere("id= $reponse->IdEnigme")[0];
  
    $joueurId = (int)$_SESSION['id'];
    
    if($reponse->EstBonne == 1 ){ 
        //TODO: Faire marcher la procédure qui augmente le solde du joueur
        DB()->nonQuerySqlCmd("CALL soldeEnigma('$enigme->Difficulte',$joueurId);"); 
    }

    redirect("optionsJeu.php");
   
       
}