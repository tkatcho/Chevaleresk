<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

$viewTitle = "Enigma";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];

if ($isConnected){

    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];
    //l'énigme
    $toutesEnigmes = EnigmesTable()->selectAll();
    
    //Les énigmes aléatoire non répondus
    
    $nbÉnigmesTotal = count($toutesEnigmes);
    
    
    $nbÉnigmesTotal = count($toutesEnigmes);
    $idDeEnigme = rand(1,$nbÉnigmesTotal);
    $enigme = EnigmesTable()->selectById($idDeEnigme)[0];

    //les réponses
    $reponses = ReponsesTable()->selectWhere("IdEnigme = $idDeEnigme");

    //pour chaque réponses possibles pour l'énigme, on doit mettre un input
    $réponsesAffichées ="";
    foreach($reponses as $reponse){
        $réponsesAffichées.=<<<HTML
        <input type="radio" id='reponse' name='reponse' value='$reponse->Reponse' ><label for="reponse">$reponse->Reponse</label>
        <br>
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
    <div class="enigmaEnigmeBackground">
        <strong> $enigme->Enigme</strong>
        <form method='post' action='enigmaVerif.php'>
            
            $réponsesAffichées
            <!--TODO: Vérifier si bien répondu -->
            <input type='submit' name='submit' value="Répondre" class="enigmaEnigmeBackgroundBtn" >
        </form>
    </div>  
  
HTML;
}
include 'views/master.php';