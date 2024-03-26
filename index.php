<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';


$isConnected = isset ($_SESSION['validUser']) && $_SESSION['validUser'];

if (isset ($_POST['filtre'])) {
    $filtres = $_POST['filtre'];
    foreach ($filtres as $filtre) {
        $sortType[] = $filtre;
    }
} else {
    $sortType[] = "all";

}
$viewTitle = "Catalogue de produit";
$viewMenu = "";

$checkIcon = '<i class="menuIcon fa fa-check mx-2"></i>';
$uncheckIcon = '<i class="menuIcon fa fa-fw mx-2"></i>';


$checkedValues = [];
if ($_POST && isset ($_POST['filtre'])) {
    foreach ($_POST['filtre'] as $value) {
        $checkedValues[$value] = 'checked';
    }
}
$recherche = trim($_POST['nom'] ?? '');


$viewMenu = '
<form id="formFiltre" action="index.php" method="POST" class="optionsRecherche"> 
    <p> <input type="checkbox" name="filtre[]" value="all" ' . (isset($checkedValues['all']) ? 'checked' : '') . '> <i class="fas fa-list"></i> Tous les éléments </p>
    <p> <input type="checkbox" name="filtre[]" value="armure" ' . (isset($checkedValues['armure']) ? 'checked' : '') . '> <i class="fas fa-vest"></i> Armures </p>
    <p> <input type="checkbox" name="filtre[]" value="arme" ' . (isset($checkedValues['arme']) ? 'checked' : '') . '> <i class="fas fa-gun"></i> Armes </p>
    <p> <input type="checkbox" name="filtre[]" value="potion" ' . (isset($checkedValues['potion']) ? 'checked' : '') . '> <i class="fas fa-flask"></i> Potions </p>
    <p> <input type="checkbox" name="filtre[]" value="element" ' . (isset($checkedValues['element']) ? 'checked' : '') . '> <i class="fas fa-magic"></i> Éléments </p>
    <input type="hidden" name="nom" value="' . htmlspecialchars($recherche) . '"> <!-- Hidden field for search term -->
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
                    <p class="textFilter"> Recherche par Filtre</p>
                    <form method="post">
                    <input type="text" class="autocomplete" name="nom" id="nom">
                    </form>                    
                    <div data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bars"></i>
                    </div>
                    <div class="dropdown-menu noselect">
                        $viewMenu
                    </div>
                </div>
                
            </div>
    <hr>
HTML;

function addToCartButton($idJoueur, $idItem, $qt)
{
    return <<<HTML
        <button onclick="location.href='addToCart.php?idJoueur=$idJoueur&idItem=$idItem&qt=$qt'">
            <a href="addToCart.php?idJoueur=$idJoueur&idItem=$idItem&qt=$qt"><i class="fa fa-cart-plus"></i></a>
        </button>
    HTML;
}

$itemsDisplay = <<<HTML
    <div class="containerTousItems">
HTML;


$index = 1;
$items = [];

if ($recherche !== '') {
    $items = ItemsTable()->selectWhere("nom like '%$recherche%'");
} else {
    $items = ItemsTable()->selectAll();
}

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
                <div class="containerItem" onclick="linked($item->Id)">
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
                <div class="containerItem" onclick="linked($item->Id)">
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
                <div class="containerItem" onclick="linked($item->Id)">
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
                    <div class="containerItem" onclick="linked($item->Id)">
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

$itemsDisplay .= <<<HTML
    <script>
        function linked(id){
            window.location.href = "details.php?idItem=" + id;
        }
    </script>
HTML;


$content .= $itemsDisplay;

include 'views/master.php';