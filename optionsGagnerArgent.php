<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

$viewTitle = "Gagner plus d'argent";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];

if ($isConnected){

    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];
    $content = <<<HTML
    
   
    <div class="optionsGagnerPlusArgent">
        <!--Demander à l'Admin à droite-->
        <div>
            <div class="optionsGagnerPlusArgentImg ">
                <div style="background-image:url('./images/argent.png')"></div>
            </div>
            <button onclick="location.href='argentAdmin.php'">
                <a class="optionsBtnIcon" href ="argentAdmin.php">
                Demander à l'administrateur <i class="fa-solid fa-hat-wizard"></i>
                </a>
            </button>      
        </div>
        
        <!--Enigma-->
       <div>
            <div class="optionsGagnerPlusArgentImg ">
                <div style="background-image:url('./images/parchemin.png')"></div>
            </div>
            <button onclick="location.href='enigma.php'">
                <a class="optionsBtnIcon" href ="enigma.php">
                Enigma <i class="fa-solid fa-puzzle-piece"></i>
                </a>
            </button>     
       </div>
    </div>
  
HTML;
}
include 'views/master.php';