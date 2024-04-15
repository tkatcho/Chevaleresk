<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

$viewTitle = "Enigma";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];
userAccess();

$scripts = <<<HTML
    <script src="js/enigma.js"></script>
HTML;

if ($isConnected){

    $checkedDifficile = "";
    $checkedMoyen = "";
    $checkedFacile = "";

    if(isset($_GET['d'])) {
        if (str_contains($_GET['d'], "difficile"))
            $checkedDifficile = "checked";
        if (str_contains($_GET['d'], "moyen"))
            $checkedMoyen = "checked";
        if (str_contains($_GET['d'], "facile"))
            $checkedFacile = "checked";
    }

    $where = "";
    if ($checkedDifficile != "") {
        $where .= " difficulte = 'Difficile'";
    }
    if ($checkedMoyen != "") {
        if ($where != "")
            $where .= " OR difficulte = 'Moyen'";
        else
            $where .= " difficulte = 'Moyen'";
    }
    if ($checkedFacile != "") {
        if ($where != "")
            $where .= " OR difficulte = 'Facile'";
        else
            $where .= " difficulte = 'Facile'";
    }
    if ($where == "")
        $where = "1 = 1";

    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];
    $joueurId = $joueur->Id;
    $toutesEnigmes = EnigmesTable()->selectWhere($where);
    $enigmesNonRepondu = [];

    foreach ($toutesEnigmes as $enigme) {
        if (QuetesTable()->selectWhere("idEnigme = $enigme->Id")) {
            continue;
        } else {
            $enigmesNonRepondu[] = $enigme;
        }
    }
    
    //Les énigmes non pigées
    $idDeEnigme=0;

    $enigmeHTML="";
    $reponses ="";

    //----------------------------------------------------------------------------------------------------------------//
    //Si joueur n'a pas répondu à toutes les énigmes
    if(count($enigmesNonRepondu) > 0) {
         
        $idDeEnigme = $enigmesNonRepondu[rand(0,count($enigmesNonRepondu)-1)]->Id;
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
            <span class="ckDif" d="difficile"><input type="checkbox" $checkedDifficile><label>Difficile</label></span>
            <br>
            <span class="ckDif" d="moyen"><input type="checkbox" $checkedMoyen><label>Moyen</label></span>
            <br>
            <span class="ckDif" d="facile"><input type="checkbox" $checkedFacile><label>Facile</label></span>
        </div>
    </div>
    <hr>
    $enigmeHTML
  
HTML;
}
include 'views/master.php';