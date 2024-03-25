<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require 'php/config.php';


$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];

if (isset($_POST['filtre'])) {
    $filtres = $_POST['filtre'];
    foreach ($filtres as $filtre) {
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

$jsonNom = json_encode($noms);

print_r($jsonNom);
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
                <div class="searchContainer">
                    <input type="text" class="autocomplete" name="nom" id="nom">
                </div>
                <span class="textFilter"> Recherche par Filtre</span>
                <div data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="dropdown-menu noselect">
                    $viewMenu
                </div>
            </div>
            <script>
            let noms = JSON.parse('$jsonNom');
            $('#nom').autocomplete({
                source:noms
            });
            </script>
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

    if (!in_array("all", $sortType)) {
        usort($items, function ($a, $b) {
            return $a->Prix - $b->Prix;
        });
    }

    foreach ($items as $item) {

        $addToCartBouton = "";
        if ($isConnected)
            $addToCartBouton = addToCartButton($_SESSION['id'], $item->Id, 1);
        if ($item->Type == 'P') { // Potions
            if (in_array("potion", $sortType) || in_array("all", $sortType)) {
                $potion = PotionsTable()->selectWhere("idItem = $item->Id")[0];
                $type = "Défence";
                if ($potion->estAttaque)
                    $type = "Attaque";
                $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <div class="containerFlexIdNom">
                        <span class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                        <span>$addToCartBouton</span>
                    </div>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('$item->Photo')"></div>
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
            if (in_array("arme", $sortType) || in_array("all", $sortType)) {
                $arme = ArmesTable()->selectWhere("idItem = $item->Id")[0];
                $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <div class="containerFlexIdNom">
                        <span class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                        <span>$addToCartBouton</span>
                    </div>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('$item->Photo')"></div>
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
            if (in_array("armure", $sortType) || in_array("all", $sortType)) {
                $armure = ArmuresTable()->selectWhere("idItem = $item->Id")[0];
                $itemsDisplay .= <<<HTML
                <div class="containerItem">
                <div class="containerFlexIdNom">
                        <span class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                        <span>$addToCartBouton</span>
                    </div>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('$item->Photo')"></div>
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
            if (in_array("element", $sortType) || in_array("all", $sortType)) {
                $element = ElementsTable()->selectWhere("idItem = $item->Id")[0];
                $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <div class="containerFlexIdNom">
                        <span class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                        <span>$addToCartBouton</span>
                    </div>
                    <hr>
                    <div class="itemImage">
                        <div  style="background-image:url('$item->Photo')"></div>
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
