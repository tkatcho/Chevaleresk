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

// Je pense qu'on devrait toujours afficher le bouton panier et logout peut importe la page. Si pas daccord, contacter thomas
$logoutButton = <<<HTML
    <button onclick="location.href='logout.php'">
        <a href="logout.php">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </button>
HTML;
$buttonOnSide = <<<HTML
    <div class="buttonOnSide">
        <button onclick="location.href='panier.php'">
            <a href ="panier.php">
                <i class="fa fa-shopping-cart"></i>
            </a>
        </button>
        $logoutButton
    </div>
HTML;

//Si le joueur est connecté
if (isset($_SESSION['validUser']) && $_SESSION['validUser']) {
    $playerAlias = $_SESSION["alias"];

    $loggedUserMenu = <<<HTML
        $buttonOnSide
HTML;

    if ($viewTitle == "Catalogue de produit"  ) {
        $loggedUserMenu = <<<HTML
        <div class="btnRetour">
                <button onclick="location.href='optionsJeu.php'">
                    <a href="optionsJeu.php">     <!--Retourne au options de jeu-->
                        <i class="fa fa-angle-left"></i>
                    </a>
                </button>
            </div>
            $buttonOnSide
HTML;
    } else if ($viewTitle == "Panier d'achat"  || $viewTitle == "Détails de l'item") {
        $loggedUserMenu = <<<HTML
            <div class="btnRetour">
                <button onclick="location.href='index.php'">
                    <a href="index.php">     <!--Retourne au catalogue de produit-->
                        <i class="fa fa-angle-left"></i>
                    </a>
                </button>
            </div>
            <div class="buttonOnSide">
                $logoutButton
            </div>
HTML;
    } else if ($viewTitle == "Bienvenue à Chevaleresk") {

        $loggedUserMenu = <<<HTML
HTML;
    }else if ($viewTitle=="Inventaire"){
        $loggedUserMenu = <<<HTML
        <div class="btnRetour">
            <button onclick="location.href='optionsJeu.php'">
                <a href="optionsJeu.php">     <!--Retourne aux options du jeu-->
                    <i class="fa fa-angle-left"></i>
                </a>
            </button>
        </div>
        $buttonOnSide
        <div class="buttonOnSide">
            <button onclick="location.href='concocterPotions.php'">
                <a href ="concocterPotions.php">     <!--Va à la page de concocter des potions-->
                    <i class="fa fa-flask"></i>
                </a>
            </button>
        </div>
HTML;
    } else if ($viewTitle == "Nouveau item" || $viewTitle == "Gagner plus d'argent" ) {
        $loggedUserMenu = <<<HTML
        <div class="btnRetour">
            <button>
                <a href="optionsJeu.php">     <!--Retourne aux options du jeu-->
                    <i class="fa fa-angle-left"></i>
                </a>
            </button>
        </div>
        <div class="buttonOnSide">
            $logoutButton
        </div>
HTML;
    }else if($viewTitle=="Enigma"){
        $loggedUserMenu = <<<HTML
        <div class="btnRetour">
            <button class="enigmaColor">
                <a href="optionsGagnerArgent.php">     <!--Retourne aux options de gagner plus d'argent-->
                    <i class="fa fa-angle-left"></i>
                </a>
            </button>
        </div>
        <div class="buttonOnSide">
            <button onclick="location.href='statistiques.php'">
                <a href="statistiques.php">
                    <i class="fa fa-bar-chart"></i>
                </a>
            </button>
            $logoutButton
            
        </div>
HTML;
    }else if(  $viewTitle == "Concocter des potions"){
        $loggedUserMenu = <<<HTML
        <div class="btnRetour">
            <button>
                <a href="inventaire.php">     <!--Retourne aux options du jeu-->
                    <i class="fa fa-angle-left"></i>
                </a>
            </button>
        </div>
        <div class="buttonOnSide">
            $logoutButton
        </div>
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
            <div class="btnRetour">
                <button onclick="location.href='index.php'">
                    <a href="index.php">     <!--Retourne au catalogue de produit-->
                        <i class="fa fa-angle-left"></i>
                    </a>
                </button>
            </div>
HTML;
    } else {
        $loggedUserMenu = "";
    }
}

$viewHead = <<<HTML
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <span class="header"> 
        <h1>$viewTitle<span>$loggedUserMenu</span></h1>
    </span>
HTML;
