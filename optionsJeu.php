<?php

include 'DAL/ChevalereskDB.php';


$viewTitle="Bienvenue à Chevaleresk";
$content= <<<HTML
  
  <!------------------------------------------------------------------------->
  <!--Le profil à droite-->
  <div class="optionsJeu">
    <div class="optionsBackgroundGrisProfil">
        <strong>Profil</strong>
        <div class="optionsBackgroundBleuProfilImg">
            <div style="background-image:url('./images/chevalier.png')"></div>
        </div>
        <p>Alias</p>
        <p>Nombre écus: <span>1000</span>$</p> 
    </div>
    
    <!--Les options à gauche-->
    <div class="optionsBtn" >
        <button>
            <a href ="loginForm.php">
            Achat <i class="fa fa-user"></i>
            </a>
        </button>
        <button>
            <a href ="subscribeForm.php">
            S'inscrire <i class="fa fa-sign-in"></i>
            </a>
        </button>
    </div>
</div>
HTML;

include 'views/master.php';