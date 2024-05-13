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

//Les différents bouton (logout, onside, bouton retour)
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

function buttonRetour($location)
{
    return <<<HTML
       <div class="btnRetour">
            <button onclick="location.href='$location'">
                <a href="$location">     
                    <i class="fa fa-angle-left"></i>
                </a>
            </button>
        </div>
HTML;
}

//-----------------------------------------------------------------//
//JOUEUR CONNECTÉ
if (isset($_SESSION['validUser']) && $_SESSION['validUser']) {
    $playerAlias = $_SESSION["alias"];
    $joueur = JoueursTable()->selectById($_SESSION['id'])[0];

    $loggedUserMenu = <<<HTML
        $buttonOnSide
HTML;

    if ($viewTitle == "Catalogue de produit") {
        $buttonRetour = buttonRetour('optionsJeu.php');
        $loggedUserMenu = <<<HTML
            $buttonRetour
            $buttonOnSide
HTML;
    } else if ($viewTitle == "Panier d'achat"  || $viewTitle == "Détails de l'item") {
        $buttonRetour = buttonRetour('index.php');
        $loggedUserMenu = <<<HTML
            $buttonRetour
            <div class="buttonOnSide">
                $logoutButton
            </div>
HTML;
    } else if ($viewTitle == "Bienvenue à Chevaleresk") {
        $loggedUserMenu = <<<HTML
HTML;
    } else if ($viewTitle == "Inventaire") {
        $buttonRetour = buttonRetour('optionsJeu.php');
        $loggedUserMenu = <<<HTML
            $buttonRetour 
            $buttonOnSide
HTML;
        if ($joueur->isAlchimiste()) {
            $loggedUserMenu .= <<<HTML
             <div class="buttonOnSide">
            <button onclick="location.href='concocterPotions.php'">
                <a href ="concocterPotions.php">     <!--Va à la page de concocter des potions-->
                    <i class="fa fa-flask"></i>
                </a>
            </button>
        </div>
HTML;
        }
    } else if ($viewTitle == "Nouveau item" || $viewTitle == "Gagner plus d'argent") {
        $buttonRetour = buttonRetour('optionsJeu.php');
        $loggedUserMenu = <<<HTML
            $buttonRetour
            <div class="buttonOnSide">
                $logoutButton
            </div>
HTML;
    } else if ($viewTitle == "Enigma" || $viewTitle == "Statistiques") {
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
    } else if ($viewTitle == "Demande d'argent") {
        $buttonRetour = buttonRetour('optionsGagnerArgent.php');
        $loggedUserMenu = <<<HTML
            $buttonRetour
            <div class="buttonOnSide">
                <button onclick="location.href='statistiques.php'">
                    <a href="statistiques.php">
                        <i class="fa fa-bar-chart"></i>
                    </a>
                </button>
                $logoutButton
                
            </div>
    HTML;
    } else if ($viewTitle == "Concocter des potions") {
        $buttonRetour = buttonRetour('inventaire.php');
        $loggedUserMenu = <<<HTML
            $buttonRetour
            <div class="buttonOnSide">
                $logoutButton
            </div>
HTML;
    } else if ($viewTitle == "Modérer les commentaires") {
        $buttonRetour = buttonRetour('optionsJeu.php');
        $loggedUserMenu = <<<HTML
            $buttonRetour
            <div class="buttonOnSide">
                $logoutButton
            </div>
HTML;
    } else if ($viewTitle == "Modifier Profil") {
        $buttonRetour = buttonRetour('optionsJeu.php');
        $loggedUserMenu = <<<HTML
            $buttonRetour
            <div class="buttonOnSide">
                $logoutButton
            </div>
HTML;
    }else if($viewTitle == "Les évaluations"){
        if (isset($_GET["idItem"])) {
            $id = $_GET["idItem"];
            $item = ItemsTable()->get($id);
        }
        $buttonRetour= <<<HTML
        <script>
            function linked(id){
                window.location.href = "details.php?idItem=" + id;
            }
        </script>
        <div class="btnRetour">
            <button onclick="linked($item->Id)">
                <a href="details.php?idItem=$item->Id">     
                    <i class="fa fa-angle-left"></i>
                </a>
            </button>
        </div>
HTML;
        $loggedUserMenu = <<<HTML
            $buttonRetour
            <div class="buttonOnSide">
                $logoutButton
            </div>

HTML;
    
    }
    //JOUEUR PAS CONNECTÉ
} else {

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
        $buttonRetour = buttonRetour('index.php');
        $loggedUserMenu = <<<HTML
            $buttonRetour
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


