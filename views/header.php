<?php

include_once 'php/sessionManager.php';

#https://fontawesome.com/v4/icons/     -> les font awesome
$pageTitle = "Index";
if (!isset($pageTitle))
    $pageTitle = "";
if (!isset($viewTitle))
    $viewTitle = "";
if (!isset($viewHeadCustom))
    $viewHeadCustom = "";
if (!isset($viewName))
    $viewName = "";

$loggedUserMenu = "";

//Les boutons par défaut
//logout
$logoutButton=<<<HTML
    <div class="buttonOnSide">                              
        <button onclick="location.href='logout.php'">
            <a href="logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </button>
    </div>
HTML;

//panier
$panierButton =<<<HTML
    <button onclick="location.href='panier.php'">
        <a href ="panier.php">
            <i class="fa fa-shopping-cart"></i>
        </a>
    </button>
HTML;

//Panier et logout
$buttonOnSide =<<<HTML
    <div class="buttonOnSide">
        $panierButton
        $logoutButton
    </div>
HTML;

//retour Options Jeu
$buttonRetourOptionsJeu=<<<HTML
    <div class="btnRetour">
        <button onclick="location.href='optionsJeu.php'">
            <a href="optionsJeu.php">     
                <i class="fa fa-angle-left"></i>
            </a>
        </button>
    </div>
HTML;

//retour Catalogue Produit
$buttonRetourCatalogueProduit =<<<HTML
    <div class="btnRetour">
        <button onclick="location.href='index.php'">
            <a href="index.php">     <!--Retourne au catalogue de produit-->
                <i class="fa fa-angle-left"></i>
            </a>
        </button>
    </div>
HTML;


//JOUEUR CONNECTÉ
if (isset($_SESSION['validUser']) && $_SESSION['validUser']) {
    $playerAlias = $_SESSION["alias"];

    $loggedUserMenu = <<<HTML
        $buttonOnSide
    HTML;

    
    if ($viewTitle == "Catalogue de produit") {
        $loggedUserMenu = <<<HTML
            $buttonRetourOptionsJeu
            $buttonOnSide
        HTML;
    } else if ($viewTitle == "Panier d'achat" || $viewTitle == "Concocter des potions" || $viewTitle == "Détails de l'item") {
        $loggedUserMenu = <<<HTML
           $buttonRetourCatalogueProduit
            $logoutButton
        HTML;
    } else if ($viewTitle == "Bienvenue à Chevaleresk") {

        $loggedUserMenu = <<<HTML
        HTML;
    }else if ($viewTitle=="Inventaire"){
        $loggedUserMenu = <<<HTML
        $buttonRetourOptionsJeu
        $buttonOnSide
        <div class="buttonOnSide">
            <button onclick="location.href='concocterPotions.php'">
                <a href ="concocterPotions.php">     <!--Va à la page de concocter des potions-->
                    <i class="fa fa-flask"></i>
                </a>
            </button>
        </div>
    HTML;
    }else if ($viewTitle=="Nouveau item"){
        $loggedUserMenu = <<<HTML
            $buttonRetourOptionsJeu
            $logoutButton
        HTML;
      
    }
} else {  //si le joueur n'est pas connecté  -> a les btn de connexion/inscription

    if ($viewTitle == "Catalogue de produit") {
        $loggedUserMenu = <<<HTML
            <div class="buttonOnSide">
                <button onclick="location.href='loginForm.php'">
                    <a href ="loginForm.php">
                        <div>Connexion</div> <i class="fa fa-user"></i>
                    </a>
                </button>
                <button onclick="location.href='signupForm.php'">
                    <a href ="signupForm.php">
                        <div>S'inscrire</div> <i class="fa fa-sign-in"></i>
                    </a>
                </button>
            </div>
        HTML;
    } else if ($viewTitle == "Connexion" || $viewTitle == "Inscription" || $viewTitle == "Détails de l'item") {
        $loggedUserMenu = <<<HTML
            $buttonRetourCatalogueProduit
        HTML;
    } else {
        $loggedUserMenu = "";
    }
}

$viewHead = <<<HTML
        <h1>$viewTitle<span>$loggedUserMenu</span></h1>
HTML;
