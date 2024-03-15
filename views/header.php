<?php
#https://fontawesome.com/v4/icons/     -> les font awesome
    if(!isset($viewTitle))
        $viewTitle="";
    if(!isset($viewHeadCustom))
        $viewHeadCustom="";
    if (!isset($viewName))
        $viewName = "";

    $loggedPlayerMenu = "";
    
    //Si le joueur est connecté
    if (isset($_SESSION["validPlayer"]) ) {
        $playerAlias = $_SESSION["playerAlias"];
        
       // $loggedPlayerMenu = <<<HTML
        
           
    }else {  //si le joueur n'est pas connecté
        //est dans catalogue produit
        if($viewMenu=="Catalogue de produit"){
            $loggedUserMenu =<<<HTML
            <a href ="loginForm.php">
            <button><i class="fa fa-user" aria-hidden="true">Connexion</i></button>
            </a>
            <a href ="subscribeForm.php">
            <button><i class="fa fa-sign-in" aria-hidden="true"></i>S'inscrire</i></button>
            </a>
            <hr>
        HTML;
        }else {
            //ne pas l'enlever, sinon ça bogue
            $loggedUserMenu =<<<HTML
        
        HTML;
        }
        
        
    }