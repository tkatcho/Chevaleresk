<?php
require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

if (isset($_GET["idItem"]))
{
    $id = $_GET["idItem"];
    $item = ItemsTable()->get($id);

    if ($item->Type == "A")
    {
        $itemDetails = ArmuresTable()->selectWhere("idItem = $id") [0];
    }
    else if ($item->Type == "P")
    {
        $itemDetails = PotionsTable()->selectWhere("idItem = $id") [0];
    }
    else if ($item->Type == "W")
    {
        $itemDetails = ArmesTable()->selectWhere("idItem = $id") [0];
    }
    else if ($item->Type == "E")
    {
        $itemDetails = ElementsTable()->selectWhere("idItem = $id") [0];
    }
}
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];

$viewTitle = "Détails de l'item";
$viewMenu = "";

function addToCartButton($idJoueur, $idItem, $qt)
{
    return <<<HTML
        <button>
            <a href="addToCart.php?idJoueur=$idJoueur&idItem=$idItem&qt=$qt"><i class="fa fa-cart-plus"></i></a>
        </button>
    HTML;
}

$itemsDisplay = <<<HTML
    <div class="containerTousItems">
HTML;
    

    $index = 1;

    if ($itemDetails != null)
    {
        $addToCartBouton = "";
        if ($isConnected) $addToCartBouton = addToCartButton($_SESSION['id'], $id, 1);
        if ($item->Type == 'P')
        { // Potions
            $potion = PotionsTable()->selectWhere("idItem = $id")[0];
            $type = "Défence";
            if ($potion->estAttaque)
            {
                $type = "Attaque";
                $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <span class="idItem">$index</span> 
                    $item->Nom
                    <span>
                        $addToCartBouton
                    </span>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('./images/potion.png')"></div>
                    </div>
                    <hr>
                    <p>Type item: 
                        <span>Potion</span>
                    </p>
                    <p>Effet: 
                        <span>$potion->Effet</span>
                    </p>
                    <p>Durée: 
                        <span>$potion->Duree</span>
                    </p>
                    <p>Type: 
                        <span>$type</span>
                    </p>
                    <hr>
                    <p>Quantité en stock:
                        <span>$item->QuantiteStock</span>
                    </p>
                    <hr>
                    <p class="itemPrix">Prix: 
                        <span>$item->Prix</span> $
                    <p>
                </div>
            HTML;
        }
    }
        if ($item->Type == 'W') { // Armes
                $arme = ArmesTable()->selectWhere("idItem = $id")[0];
                $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <span class="idItem">$index</span> 
                    $item->Nom
                    <span>
                        $addToCartBouton
                    </span>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('./images/épée.png')"></div>
                    </div>
                    <hr>
                    <p>Type item: 
                        <span>Arme</span>
                    </p>
                    <p>Efficacité: 
                        <span>$arme->Efficacite</span>
                    </p>
                    <p>Genre: 
                        <span>$arme->Genre</span>
                    </p>
                    <p>Description:
                    <span>$arme->Description</span>
                    </p>
                    <hr>
                    <p>Quantité en stock: 
                        <span>$item->QuantiteStock</span>
                    </p>
                    <hr>
                    <p class="itemPrix">Prix: 
                        <span>$item->Prix</span> $
                    <p>
                </div>
            HTML;
        }

        if ($item->Type == 'A') { // Armures
                $armure = ArmuresTable()->selectWhere("idItem = $id")[0];
                $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <span class="idItem">$index</span> 
                    $item->Nom
                    <span>
                        $addToCartBouton
                    </span>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('./images/armure.png')"></div>
                    </div>
                    <hr>
                    <p>Type item: 
                        <span>Armure</span>
                    </p>
                    <p>Matière: 
                        <span>$armure->Matiere</span>
                    </p>
                    <p>Taille: 
                        <span>$armure->Taille</span>
                    </p>
                    
                    <hr>
                    <p>Quantité en stock: 
                        <span>$item->QuantiteStock</span>
                    </p>
                    <hr>
                    <p class="itemPrix">Prix: 
                        <span>$item->Prix</span> $
                    <p>
                </div>
            HTML;
        }
        
        //ok
        if ($item->Type == 'E') { // Éléments
                $element = ElementsTable()->selectWhere("idItem = $id")[0];
                $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <span class="idItem">$index</span> 
                    $item->Nom
                    <span>
                        $addToCartBouton
                    </span>
                    <hr>
                    <div class="itemImage">
                        <div  style="background-image:url('./images/élément.png')"></div>
                    </div>
                    <hr>
                    <p>Type item: 
                        <span>Élément</span>
                    </p>
                    <p>Type: 
                        <span>$element->Type</span>
                    </p>
                    <p>Rareté: 
                        <span>$element->Rarete</span>
                    </p>
                    <p>Dangerosité: 
                        <span>$element->Dangerosite</span>
                    </p>
                    
                    <hr>
                    <p>Quantité en stock: 
                        <span>$item->QuantiteStock</span>
                    </p>
                    <hr>
                    <p class="itemPrix">Prix: 
                        <span>$item->Prix</span> $
                    <p>
                </div>
            HTML;
        }
}            
 


$itemsDisplay .= <<<HTML
    </div>
HTML;
                

$content = $itemsDisplay;

include 'views/master.php';
                
