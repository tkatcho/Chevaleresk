<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

$viewTitle="Bienvenue à Chevaleresk";
$isConnected= isset($_SESSION['validUser']) && $_SESSION['validUser'];

/*$content= <<<HTML
  
<!---------------------------Options pour admin-------------------------------->
  <!--Le profil à droite-->
  <div class="optionsJeu">
    <div class="optionsBackgroundGrisProfil">
        <strong>Profil</strong>
        <div class="optionsBackgroundBleuProfilImg">
            <div style="background-image:url('./images/chevalier.png')"></div>
        </div>
        <p>Admin</p>
        
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
HTML;*/

if($isConnected){

    //Faire une condition pour savoir si admin ou si joueur (les boutons ne seront pas les mêmes)
    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];

    $content = <<<HTML
    <!---------------------------Options pour joueur-------------------------------->
    <!--Le profil à droite-->
    <div class="optionsJeu">
      <div class="optionsBackgroundGrisProfil">
          <strong>Profil</strong>
          <div class="optionsBackgroundBleuProfilImg">
              <div style="background-image:url('./images/chevalier.png')"></div>
          </div>
          <p>$joueur->Alias</p>
          <p>Nombre écus: <span>$joueur->Solde</span>$</p> 
      </div>
      
      <!--Les options à gauche-->
      <div class="optionsBtn" >
          <button>
              <a class="optionsBtnIcon" href ="index.php">
              Achat <i class="fa fa-money"></i>
              </a>
          </button>
          <button>
              <a class="optionsBtnIcon" href ="inventaire.php">
              Inventaire <i class="fa fa-id-card-o"></i>
              </a>
          </button>
          <button>
              <a class="optionsBtnIcon" href ="modifierProfil.php">
              Modifier Profil <i class="fa fa-user"></i>
              </a>
          </button>
          <button>
              <a class="optionsBtnIcon" href ="optionsGagnerArgent.php">
              Gagner plus d'argent <i class="fa fa-gift"></i>
              </a>
          </button>
          <button>
              <a class="optionsBtnIcon" href ="logout.php">
              Déconnexion <i class="fa fa-sign-out"></i>
              </a>
          </button>
      </div>
  </div>
  
  HTML;
}else {
    redirect("index.php");
}

include 'views/master.php';