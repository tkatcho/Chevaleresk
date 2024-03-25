<?php

include 'DAL/ChevalereskDB.php';


$viewTitle="Bienvenue à Chevaleresk";

if((bool)$_SESSION["isAdmin"] && isset($_SESSION['isAdmin'])){
adminAccess();
$content= <<<HTML
  
  <!---------------------------Options pour admin-------------------------------->
  <!--Le profil à droite-->
  <div class="optionsJeu">
    <div class="optionsBackgroundGrisProfil">
        <strong>Profil</strong>
        <div class="optionsBackgroundBleuProfilImg">
            <div style="background-image:url('./images/chevalier.png')"></div>
        </div>
        <p>Alias</p>
       
    </div>
    
    <!--Les options à gauche-->
    <div class="optionsBtn" >
       
        <button>
            <a class="optionsBtnIcon" href ="newItem.php">
            Nouveau item <i class="fa fa-id-card-o"></i>
            </a>
        </button>
        
        <button>
            <a class="optionsBtnIcon" href ="subscribeForm.php">
            Argent <i class="fa fa-gift"></i>
            </a>
        </button>
        <button>
            <a class="optionsBtnIcon" href ="subscribeForm.php">
            Déconnexion <i class="fa fa-sign-out"></i>
            </a>
        </button>
    </div>
</div>
HTML;
} else{

$content=<<<HTML
<!---------------------------Options pour joueur-------------------------------->


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
            <a class="optionsBtnIcon" href ="loginForm.php">
            Achat <i class="fa fa-money"></i>
            </a>
        </button>
        <button>
            <a class="optionsBtnIcon" href ="subscribeForm.php">
            Inventaire <i class="fa fa-id-card-o"></i>
            </a>
        </button>
        <button>
            <a class="optionsBtnIcon" href ="subscribeForm.php">
            Modifier Profil <i class="fa fa-user"></i>
            </a>
        </button>
        <button>
            <a class="optionsBtnIcon" href ="subscribeForm.php">
            Gagner plus d'argent <i class="fa fa-gift"></i>
            </a>
        </button>
        <button>
            <a class="optionsBtnIcon" href ="subscribeForm.php">
            Déconnexion <i class="fa fa-sign-out"></i>
            </a>
        </button>
    </div>
</div>

HTML;
}
include 'views/master.php';