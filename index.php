<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';


error_reporting(0);

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

$checkIcon = '<i class="menuIcon fa fa-check mx-2"></i>';
$uncheckIcon = '<i class="menuIcon fa fa-fw mx-2"></i>';

$jsonNom = json_encode($noms);

$checkedValues = [];
if ($_POST && isset($_POST['filtre'])) {
    foreach ($_POST['filtre'] as $value) {
        $checkedValues[$value] = 'checked';
    }
}
$recherche = trim($_POST['nom'] ?? '');


$viewMenu = '
<form id="formFiltre" action="index.php" method="POST" class="optionsRecherche"> 
    <p> <input id="all" type="checkbox" name="filtre[]" value="all" ' . (isset($checkedValues['all']) ? 'checked' : '') . '> <i class="fas fa-list"></i> <label for="all">Tous les éléments</label> </p>
    <p> <input id="armure" type="checkbox" name="filtre[]" value="armure" ' . (isset($checkedValues['armure']) ? 'checked' : '') . '> <i class="fa-solid fa-shield"></i></i></i> <label for="armure">Armures</label> </p>
    <p> <input id="arme" type="checkbox" name="filtre[]" value="arme" ' . (isset($checkedValues['arme']) ? 'checked' : '') . '> <i class="fa-solid fa-staff-snake"></i></i> <label for="arme">Armes</label> </p>
    <p> <input id="potion" type="checkbox" name="filtre[]" value="potion" ' . (isset($checkedValues['potion']) ? 'checked' : '') . '> <i class="fa-solid fa-flask-vial"></i></i> <label for="potion">Potions</label> </p>
    <p> <input id="element" type="checkbox" name="filtre[]" value="element" ' . (isset($checkedValues['element']) ? 'checked' : '') . '> <i class="fa-solid fa-wand-sparkles"></i></i> <label for="element">Éléments</label> </p>
    <input type="hidden" name="nom" value="' . htmlspecialchars($recherche) . '"> <!-- Hidden field for search term -->
</form>

<script> 
    const form = document.getElementById("formFiltre");

    form.addEventListener("change", function() {
        this.submit();
    });
</script>';


$content = <<<HTML
    <script>
        // A venir, on devrait remplacer les lien pour des fonctions AJAX et afficher des popups d'erreur ou de succès
        //
        // $('.lienAjouterPanier').on("click", function() {
        //     Swal.fire({
        //         position: "top-end",
        //         icon: "success",
        //         title: "L'item a été ajouter au panier",
        //         showConfirmButton: true,
        //         timer: 1000
        //     });
        // });
    </script>
    <div class="headerMenusContainer">
    <span>&nbsp</span> <!--filler-->
            <div class="dropdown ms-auto dropdownLayout">
                <div class="searchContainer">
                    <p class="textFilter"> Recherche </p>
                    <form method="post">
                    <input type="text" class="autocomplete" name="nom" id="nom">
                    <script>
                    let noms = JSON.parse('$jsonNom');

                    $('#nom').autocomplete({
                        source: noms
                    });
                    </script>
                    </form>                    
                    <div class="searchContainerIcone" data-bs-toggle="dropdown" aria-expanded="false">
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
        <button class="ajouterPanier" onclick="location.href='addToCart.php?idJoueur=$idJoueur&idItem=$idItem&qt=$qt'">
            <a class="lienAjouterPanier" title="Ajouter au panier" href="addToCart.php?idJoueur=$idJoueur&idItem=$idItem&qt=$qt"><i class="fa fa-cart-plus"></i></a>
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
                    <div class="containerFlexIdNom">
                        <span style="flex-grow:2;"class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px; font-size:14px;">$item->Nom</span> 
                        
                    </div>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('$item->Photo')"></div>
                    </div>
                    <hr>
                    <p>Type: 
                        <span>Potion</span>
                    </p>
                    <hr>
                    <p>Quantité en stock:
                        <span>$item->QuantiteStock</span>
                    </p>
                    <hr>
                    <p class="itemPrix"> Prix:
                        <span>$item->Prix $</span>
                        $addToCartBouton
                        
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
                    <div class="containerFlexIdNom">
                        <span style="flex-grow:2;"class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px; font-size:14px;">$item->Nom</span> 
                       
                    </div>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('$item->Photo')"></div>
                    </div>
                    <hr>
                    <p>Type: 
                        <span>Arme</span>
                    </p>
                    <hr>
                    <p>Quantité en stock: 
                        <span>$item->QuantiteStock</span>
                    </p>
                    <hr>
                    <p class="itemPrix"> Prix:
                        <span>$item->Prix</span> $
                        $addToCartBouton
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
                    <div class="containerFlexIdNom">
                        <span style="flex-grow:2;"class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px; font-size:14px;">$item->Nom</span> 
                       
                    </div>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('$item->Photo')"></div>
                    </div>
                    <hr>
                    <p>Type: 
                        <span>Armure</span>
                    </p>
                    <hr>
                    <p>Quantité en stock: 
                        <span>$item->QuantiteStock</span>
                    </p>
                    <hr>
                    <p class="itemPrix"> Prix:
                        <span>$item->Prix</span> $
                        $addToCartBouton
                    <p>
                </div>
HTML;
            }
        }

        if ($item->Type == 'E') { // Éléments
            if ($isConnected) {
                if (JoueursTable()->selectById($_SESSION['id'])[0]->estAlchimiste == 1) {
                    if (in_array("element", $sortType) || in_array("all", $sortType)) {
                        $element = ElementsTable()->selectWhere("idItem = $item->Id");
                        $itemsDisplay .= <<<HTML
                            <div class="containerItem" onclick="linked($item->Id)">
                            <div class="containerFlexIdNom">
                                <span style="flex-grow:2;"class="idItem">$index</span> 
                                <span style="flex-grow:2;  margin-left:4px; font-size:14px;">$item->Nom</span> 
                                
                            </div>
                                <hr>
                                <div class="itemImage">
                                    <div  style="background-image:url('$item->Photo')"></div>
                                </div>
                                <hr>
                                <p>Type: 
                                    <span>Élément</span>
                                </p>
                                <hr>
                                <p>Quantité en stock: 
                                    <span>$item->QuantiteStock</span>
                                </p>
                                <hr>
                                <p class="itemPrix"> Prix:
                                    <span>$item->Prix</span> $
                                    $addToCartBouton
                                <p>
                            </div>
HTML;
                    }
                }
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
