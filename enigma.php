<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

$viewTitle = "Enigma";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];
userAccess();

//-------Choisir Difficulté et Type énigmes------------//
$scripts = <<<HTML
    <script src="js/enigma.js"></script>
HTML;

if ($isConnected){

    $hidden="";
    $checkedDifficile = "";
    $checkedMoyen = "";
    $checkedFacile = "";
    $hidden = "";

    $checkedPotions = "";
    $checkedElements = "";
    $checkedAutres = "";

    if(isset($_GET['d'])) {   //difficulté
        if (str_contains($_GET['d'], "difficile"))
            $checkedDifficile = "checked";
        if (str_contains($_GET['d'], "moyen"))
            $checkedMoyen = "checked";
        if (str_contains($_GET['d'], "facile"))
            $checkedFacile = "checked";
        $hidden .= <<<HTML
            <input type="hidden" name="filtresDif" value="$_GET[d]">
        HTML;
    }

    if(isset($_GET['t'])) {  //type
        if (str_contains($_GET['t'], "P"))
            $checkedPotions = "checked";
        if (str_contains($_GET['t'], "E"))
            $checkedElements = "checked";
        if (str_contains($_GET['t'], "Z"))
            $checkedAutres = "checked";
        $hidden .= <<<HTML
            <input type="hidden" name="filtresType" value="$_GET[t]">
        HTML;
    }

    //Where difficulté
    $whereDif = "";
    if ($checkedDifficile != "") {
        $whereDif .= " difficulte = 'Difficile'";
    }
    if ($checkedMoyen != "") {
        if ($whereDif != "")
            $whereDif .= " OR difficulte = 'Moyen'";
        else
            $whereDif .= " difficulte = 'Moyen'";
    }
    if ($checkedFacile != "") {
        if ($whereDif != "")
            $whereDif .= " OR difficulte = 'Facile'";
        else
            $whereDif .= " difficulte = 'Facile'";
    }
    if ($whereDif == "")
        $whereDif = "1 = 1";

    //Where type
    $whereType ="";
    if ($checkedPotions != "") {
        $whereType .= " type = 'P'";
    }
    if($checkedElements !=""){
        if($whereType !="")
            $whereType .= "OR type = 'E'";
        else
            $whereType .= " type = 'E'";
    }
    if($checkedAutres !=""){
        if($whereType !="")
            $whereType .= "OR type = 'Z'";
        else
            $whereType .= " type = 'Z'";
    }
    if($whereType=="")
        $whereType= "1 = 1";
    


//---------------------------------------------------------//

    //Choisir énigme    
    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];
    $joueurId = $joueur->Id;
    $toutesEnigmes = EnigmesTable()->selectWhere("$whereDif AND $whereType");
    $enigmesNonRepondu = [];

    foreach ($toutesEnigmes as $enigme) {
        if (QuetesTable()->selectWhere("idEnigme = $enigme->Id and idJoueur = $joueurId")) {
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
                $hidden
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


 //----------------------------------------------------------------------------------------------------------------//
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
            <p>Choisir la difficulté </p>
            <hr>
            <span class="ckDif" d="difficile"><input type="checkbox" $checkedDifficile><label>Difficile</label></span>
            <br>
            <span class="ckDif" d="moyen"><input type="checkbox" $checkedMoyen><label>Moyen</label></span>
            <br>
            <span class="ckDif" d="facile"><input type="checkbox" $checkedFacile><label>Facile</label></span>
        </div>
        <div class="enigmaChoisirDifficulté">
            <p>Choisir le type</p>
            <hr>
            <span class="ckType" t="P"><input type="checkbox" $checkedPotions><label>Potions</label></span>
            <br>
            <span class="ckType" t="E"><input type="checkbox" $checkedElements><label>Élements</label></span>
            <br>
            <span class="ckType" t="Z"><input type="checkbox" $checkedAutres><label>Autres</label></span>
        </div>
    </div>
    <hr>
    $enigmeHTML
  
HTML;
}
include 'views/master.php';