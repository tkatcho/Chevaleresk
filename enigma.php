<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

$viewTitle = "Enigma";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];

if ($isConnected){

    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];
    $joueurId = $joueur->Id;
    //l'énigme
    $toutesEnigmes = EnigmesTable()->selectAll();
    
    //Les énigmes non pigées
    $estRepondu=1;
    //$idDeEnigme = $toutesEnigmes[rand(0,count($toutesEnigmes))]->Id;
   // $estRepondu = DB()->querySqlCmd("select verifierEnigmeRepondu($idDeEnigme,$joueurId);");

    while( $estRepondu == 1 ){
        $idDeEnigme = $toutesEnigmes[rand(0,count($toutesEnigmes))]->Id;
        $estRepondu = DB()->querySqlCmd("select verifierEnigmeRepondu($idDeEnigme,$joueurId);");
    }

    $enigme="";
    $reponses ="";
    if($estRepondu==2){   //Si toutes les énigmes sont répondu
        $enigme = <<<HTML
        <div class="enigmaEnigmeBackground">
            <strong> Vous avez répondu à toutes les énigmes</strong>
        </div>  
HTML;
    }else{
        $enigmeObj = EnigmesTable()->selectById($idDeEnigme)[0];

        //les réponses
        $reponses = ReponsesTable()->selectWhere("IdEnigme = $idDeEnigme");

    //pour chaque réponses possibles pour l'énigme, on doit mettre un input
    $réponsesAffichées ="";
    foreach($reponses as $reponse){
        $réponsesAffichées.=<<<HTML
        <input type="radio" id='reponse_$reponse->Id' name='reponse' value='$reponse->Id' ><label for="reponse_$reponse->Id">$reponse->Reponse</label>
        <br>
HTML;
        }

        $enigme = <<<HTML
        <div class="enigmaEnigmeBackground">
            <strong> $enigmeObj->Enigme</strong>
            <form method='post' action='enigmaVerif.php'>
                
                $réponsesAffichées
                <!--TODO: Vérifier si bien répondu -->
                <input type='submit' name='submit' value="Répondre" class="enigmaEnigmeBackgroundBtn" >
            </form>
        </div>  
HTML;
}
   
    $content = <<<HTML
  
    <div class="enigma">
        <div class="enigmaBackgroundVertRappel">
            <strong>Rappel du jeu</strong>
            <hr>
            <p>Répondez aux énigmes pour remporter le plus d'argent!</p>
            <br>
            <p>Chaque énigme a une difficulté</p>
            <ul>
                <li>Difficile : 200 écus</li>
                <li>Moyen : 100 écus</li>
                <li>Facile : 50 écus</li>
            </ul>
        </div>
        <div class="enigmaChoisirDifficulté">
            <p>Choisir la difficulté de l'énigme</p>
            <hr>
            <!--TODO: Modifier la difficulté de la question -->
            <input type="checkbox"><label>Difficile</label>
            <br>
            <input type="checkbox"><label>Moyen</label>
            <br>
            <input type="checkbox"><label>Facile</label>
        </div>
    </div>
    <hr>
    $enigme
  
HTML;
}
include 'views/master.php';