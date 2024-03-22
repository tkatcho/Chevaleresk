<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';


$isConnected = isset ($_SESSION['validUser']) && $_SESSION['validUser'];

if (isset ($_POST['filtre'])) {
    $filtres = $_POST['filtre'];
    foreach($filtres as $filtre){
        $sortType[] = $filtre;
    }
} else {
    $sortType[] = "all";

}
$viewTitle = "Catalogue de produit";
$viewMenu = "";
//$sortType = isset($_SESSION["itemSortType"]) ? $_SESSION["itemSortType"] : "prix";

$checkIcon = '<i class="menuIcon fa fa-check mx-2"></i>';
$uncheckIcon = '<i class="menuIcon fa fa-fw mx-2"></i>';

// Fonction pour vérifier si un filtre est sélectionné dans l'URL
// function isFilterSelected($filter) {
//     if (isset($_GET['sort'])) {
//         $selectedFilters = explode(',', $_GET['sort']);
//         return in_array($filter, $selectedFilters);
//     }
//     return false;
// }

// // Générer les icônes de sélection pour chaque filtre
// $sortByType = isFilterSelected('all') ? $checkIcon : $uncheckIcon;
// $sortByArmure = isFilterSelected('armure') ? $checkIcon : $uncheckIcon;
// $sortByPotion = isFilterSelected('potion') ? $checkIcon : $uncheckIcon;
// $sortByArme = isFilterSelected('arme') ? $checkIcon : $uncheckIcon;
// $sortByElement = isFilterSelected('element') ? $checkIcon : $uncheckIcon;


// <!-- <a href="index.php?sort=all" class="dropdown-item">
//             $sortByType <i class="menuIcon fa fa-calendar mx-2"></i> Pour tous les items
//          </a>
//          <a href="index.php?sort=armure" class="dropdown-item">
//             $sortByArmure <i class="menuIcon fa fa-heart mx-2"></i> Armures
//          </a>
//          <a href="index?sort=potion" class="dropdown-item">
//            $sortByPotion <i class="menuIcon fa fa-search mx-2"></i> Potions
//          </a> 
//          <a href="index.php?sort=arme" class="dropdown-item">
//             $sortByArme <i class="menuIcon fa fa-users mx-2"></i> Armes
//          </a>
//          <a href="index.php?sort=element" class="dropdown-item">
//             $sortByElement <i class="menuIcon fa fa-user mx-2"></i> Éléments
//          </a> -->

$checkedValues = [];
if ($_POST && isset($_POST['filtre'])) {
    foreach ($_POST['filtre'] as $value) {
        $checkedValues[$value] = 'checked';
    }
}


$viewMenu = '
<form id="formFiltre" action="index.php" method="POST"> 
    <p> <input type="checkbox" name="filtre[]" value="all" ' . (isset($checkedValues['all']) ? 'checked' : '') . '> <i class="fas fa-list"></i> Tous les éléments </p>
    <p> <input type="checkbox" name="filtre[]" value="armure" ' . (isset($checkedValues['armure']) ? 'checked' : '') . '> <i class="fas fa-vest"></i> Armures </p>
    <p> <input type="checkbox" name="filtre[]" value="arme" ' . (isset($checkedValues['arme']) ? 'checked' : '') . '> <i class="fas fa-gun"></i> Armes </p>
    <p> <input type="checkbox" name="filtre[]" value="potion" ' . (isset($checkedValues['potion']) ? 'checked' : '') . '> <i class="fas fa-flask"></i> Potions </p>
    <p> <input type="checkbox" name="filtre[]" value="element" ' . (isset($checkedValues['element']) ? 'checked' : '') . '> <i class="fas fa-magic"></i> Éléments </p>
</form>

<script> 
    const form = document.getElementById("formFiltre");

    form.addEventListener("change", function() {
        this.submit();
    });
</script>';


$content = <<<HTML
    <div class="headerMenusContainer">
            <span>&nbsp</span> <!--filler-->
            <div class="dropdown ms-auto dropdownLayout">
                <!-- <form action="photosList.php" method="POST">
                    <span class="searchContainer">
                        <input type="search" class="form-control" name="keyword" placeholder="Recherche par mots-clés" id="keywords" />
                        <button class="cmdIcon fa fa-search" type="submit" id="setSearchKeywordsCmd"></button>
                    </span>
                </form> -->
                <span class="textFilter"> Recherche par Filtre</span>
                <div data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="dropdown-menu noselect">
                    $viewMenu
                </div>
            </div>
    <hr>
HTML;


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
$items = ItemsTable()->selectAll();



if ($items != null) {

    if (!in_array("all",$sortType)) {
        usort($items, function ($a, $b) {
            return $a->Prix - $b->Prix;
        });
    }

    foreach ($items as $item) {

        $addToCartBouton = "";
        if ($isConnected)
            $addToCartBouton = addToCartButton($_SESSION['id'], $item->Id, 1);
        if ($item->Type == 'P') { // Potions
            if (in_array("potion",$sortType) || in_array("all",$sortType)) {
                $potion = PotionsTable()->selectWhere("idItem = $item->Id")[0];
                $type = "Défence";
                if ($potion->estAttaque)
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
            if(in_array("arme",$sortType) || in_array("all",$sortType)){
                $arme = ArmesTable()->selectWhere("idItem = $item->Id")[0];
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
            
        }

        if ($item->Type == 'A') { // Armures
            if(in_array("armure",$sortType) || in_array("all",$sortType)){
                $armure = ArmuresTable()->selectWhere("idItem = $item->Id")[0];
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
        }

        if ($item->Type == 'E') { // Éléments
            if(in_array("element",$sortType) || in_array("all",$sortType)){
                $element = ElementsTable()->selectWhere("idItem = $item->Id")[0];
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

        $index++;
    }
}

$itemsDisplay .= <<<HTML
    </div>
HTML;


$content .= $itemsDisplay;

include 'views/master.php';