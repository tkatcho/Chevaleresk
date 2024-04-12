<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

$viewTitle = "Enigma";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];

if ($isConnected){

    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];
    $joueurId = $joueur->Id;
    $toutesEnigmes = EnigmesTable()->selectAll();
    
    //Les énigmes non pigées
    $idDeEnigme = $toutesEnigmes[rand(0,count($toutesEnigmes)-1)]->Id;
    $estRepondu = DB()->querySqlCmd("select verifierEnigmeRepondu($idDeEnigme,$joueurId);");  // 1 = déjà répondu | 0 = pas répondu | 2 = toutes les énigmes répondues

    $enigmeHTML="";
    $reponses ="";

    //----------------------------------------------------------------------------------------------------------------//
    //Si joueur n'a pas répondu à toutes les énigmes
    if($estRepondu != 2 ){
        while($estRepondu !=0){  //Tant que l'énigme a déjà été répondu, choisir une autre
            $idDeEnigme = $toutesEnigmes[rand(0,count($toutesEnigmes)-1)]->Id;
            $estRepondu = DB()->querySqlCmd("select verifierEnigmeRepondu($idDeEnigme,$joueurId);");
        }
        $enigmeObj = EnigmesTable()->selectById($idDeEnigme)[0];
        $reponses = ReponsesTable()->selectWhere("IdEnigme = $idDeEnigme");

        //pour chaque réponses possibles pour l'énigme, on doit mettre un input
        $réponsesAffichées ="";
        foreach($reponses as $reponse){
            $réponsesAffichées.=<<<HTML
            <input type="radio" id='reponse_$reponse->Id' name='reponse' value='$reponse->Id' ><label for="reponse_$reponse->Id">$reponse->Reponse</label>
            <br>
HTML;
        }
        $enigmeHTML = <<<HTML
        <div class="enigmaEnigmeBackground">
            <strong> $enigmeObj->Enigme</strong>
            <form method='post' action='enigmaVerif.php'>
                $réponsesAffichées
                <input type='submit' name='submit' value="Répondre" class="enigmaEnigmeBackgroundBtn" >
            </form>
        </div>  
HTML;
    }else {    //Joueur a répondu a toutes les énigmes
        $enigmeHTML = <<<HTML
        <div class="enigmaEnigmeBackground">
            <strong> Vous avez répondu à toutes les énigmes</strong>
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
    $enigmeHTML
  
HTML;
}
include 'views/master.php';