<?php

require 'php/sessionManager.php';
anonymousAccess();

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

//Si le joueur est connecté
if (isset($_SESSION["validUser"])) {
    $playerAlias = $_SESSION["alias"];

    if ($viewTitle == "Catalogue de produit") {
        $loggedUserMenu = <<<HTML
            <div class="buttonOnSide">
                <button>
                    <a href ="index.php">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </button>
                <button>
                    <a href="logout.php">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                </button>
            </div>
            HTML;
    } else if ($viewTitle = "Panier d'achat") {
        $loggedUserMenu = <<<HTML
            <div class="btnRetour">
                <button>
                    <a href="index.php">     <!--Retourne au catalogue de produit-->
                        <i class="fa fa-angle-left"></i>
                    </a>
                </button>
            </div>
        HTML;
    }

} else {  //si le joueur n'est pas connecté  -> a les btn de connexion/inscription

    if ($viewTitle == "Catalogue de produit") {
        $loggedUserMenu = <<<HTML
            <div class="buttonOnSide">
                <button>
                    <a href ="loginForm.php">
                    Connexion <i class="fa fa-user"></i>
                    </a>
                </button>
                <button>
                    <a href ="signupForm.php">
                        S'inscrire <i class="fa fa-sign-in"></i>
                    </a>
                </button>
            </div>
        HTML;
    } else if ($viewTitle = "Panier d'achat") {  //pour voir si ça marche
        $loggedUserMenu = <<<HTML
            <div class="btnRetour">
                <button>
                    <a href ="index.php">     <!--Retourne au catalogue de produit-->
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