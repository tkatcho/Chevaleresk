<?php
    $pageTitle = "Catalogue de produits";
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
        $loggedUserMenu =<<<HTML
        <a href ="loginForm.php">
        <i >
        </a>
        
        HTML;
        
    }