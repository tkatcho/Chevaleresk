<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

$viewTitle = "Enigma";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];

if ($isConnected){
    $toutesEnigmes = EnigmesTable()->selectAll();

    $nbÉnigmesTotal = count($toutesEnigmes);
    $idDeEnigme = rand(1,$nbÉnigmesTotal);
    
    $enigme = EnigmesTable()->selectById($idDeEnigme)[0];

    $reponses = ReponsesTable()->selectWhere("idEnigme = $idDeEnigme");

    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];
    
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
            <!--TODO: Afficher options de réponse -->
            <!--URGENT: Il faudrait avoir une table pour avoir différente réponse-->
            <input type="radio" name='reponse'><label>$enigme->Reponse</label>
            <br>
            <input type="radio" name='reponse'><label>Option 2</label>
            <br>
            <input type="radio" name='reponse'><label>Option 3</label>
            <br>
            <input type="radio" name='reponse'><label>Option 4</label>
            <br>
            <!--TODO: Vérifier si bien répondu -->
            <input type='submit' name='submit' value="Répondre" class="enigmaEnigmeBackgroundBtn" >
        </form>
    </div>  
  
HTML;
}
include 'views/master.php';