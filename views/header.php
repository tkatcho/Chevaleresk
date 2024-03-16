<?php

#https://fontawesome.com/v4/icons/     -> les font awesome
// if(!isset($viewTitle))
//     $viewTitle="";
// if(!isset($viewHeadCustom))
//     $viewHeadCustom="";
// if (!isset($viewName))
//     $viewName = "";
// if (!isset($viewMenu))
//     $viewMenu = "";

$loggedPlayerMenu = "";
    
//Si le joueur est connecté
if (isset($_SESSION["validPlayer"])) {
    $playerAlias = $_SESSION["playerAlias"];
       
    // $loggedPlayerMenu = <<<HTML
                 
} else {  //si le joueur n'est pas connecté
    //est dans catalogue produit
    // if ($viewMenu=="Catalogue de produit") {
    //     $loggedUserMenu = <<<HTML
    //     <a href ="loginForm.php">
    //         <button><i class="fa fa-user" aria-hidden="true">Connexion</i></button>
    //     </a>
    //     <a href ="subscribeForm.php">
    //         <button><i class="fa fa-sign-in" aria-hidden="true"></i>S'inscrire</i></button>
    //     </a>
    //     <hr>
    // HTML;
    // } else {
    //     //ne pas l'enlever, sinon ça bogue
    //     $loggedUserMenu = <<<HTML
        
    // HTML;
    // }


    // Je n'ai pas compris pourquoi seulement afficher le menu sur catalogue de produit,
    // je pense qu'il faut plustot restreinde l'access au page autre que le catalogue aux 
    // users non inscrit.
    $loggedUserMenu = <<<HTML
        <div class="authentificationMenu">
            <a href ="loginForm.php">
                <button><i class="fa fa-user" aria-hidden="true">Connexion</i></button>
            </a>
            <a href ="signupForm.php">
                <button><i class="fa fa-sign-in" aria-hidden="true"></i>S'inscrire</i></button>
            </a>
        </div>
    HTML;
}

$header = <<<HTML
    <h1><a style="color: black;" href="./index.php">Chevaleresk</a> - $pageTitle</h1>
    $loggedUserMenu
HTML;