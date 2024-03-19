<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

$isConnected= isset($_SESSION['validUser']) && $_SESSION['validUser'];

$viewTitle = "Catalogue de produit";

$content = <<<HTML
    <div class="searchContainer">
        <h2>Recherche: </h2>
        <input type="search" class="form-control" placeholder ="Rechercher">
        <i class="fa fa-bars"></i>
    </div>
    <hr>
HTML;

// if (!$isConnected) { //n'est pas connecter
    // $content = <<<HTML
    // <div class="searchContainer">
    //     <h2>Recherche: </h2>
    //     <input type="search" class="form-control" placeholder ="Rechercher">
    //     <i class="fa fa-bars"></i>
    // </div>
    // <hr>

//     <!--Exemple html pour les items-->
//     <div class="containerTousItems">
//         <!--Un item (le div class="containerItem")-->
//         <div class="containerItem">
//             <span class="idItem">1</span> 
//             Épée
//             <hr>
//             <div class="itemImage">
//                 <div style="background-image:url('./images/épée.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Arme</span>
//             </p>
//             <p>Efficacité: 
//                 <span>2</span>
//             </p>
//             <p>Genre: 
//                 <span>2</span>
//             </p>
//             <p>Description:
//             <span>Cette arme est vraiment cool.</span>
//             </p>
//             <hr>
//             <p>Quantité en stock: 
//                 <span>2</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>25</span> $
//             <p>
//         </div>
        
        
//         <div class="containerItem">
//             <span class="idItem">2</span> 
//             Potion
//             <hr>
//             <div class="itemImage">
//                 <div style="background-image:url('./images/potion.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Potion</span>
//             </p>
//             <p>Effet: 
//                 <span>Vitesse</span>
//             </p>
//             <p>Durée: 
//                 <span>2 minutes</span>
//             </p>
//             <p>Type: 
//                 <span>Attaque</span>
//             </p>
//             <hr>
//             <p>Quantité en stock: 
//                 <span>3</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>20</span> $
//             <p>
//         </div>
        

//         <div class="containerItem">
//             <span class="idItem">3</span> 
//             Armure
//             <hr>
//             <div class="itemImage">
//                 <div  style="background-image:url('./images/armure.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Armure</span>
//             </p>
//             <p>Matière: 
//                 <span>Fer</span>
//             </p>
//             <p>Taille: 
//                 <span>75 cm</span>
//             </p>
            
//             <hr>
//             <p>Quantité en stock: 
//                 <span>5</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>40</span> $
//             <p>
//         </div>
        
//         <div class="containerItem">
//             <span class="idItem">4</span> 
//             Armure
//             <hr>
//             <div class="itemImage">
//                 <div  style="background-image:url('./images/armure.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Armure</span>
//             </p>
//             <p>Matière: 
//                 <span>Fer</span>
//             </p>
//             <p>Taille: 
//                 <span>75 cm</span>
//             </p>
            
//             <hr>
//             <p>Quantité en stock: 
//                 <span>5</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>40</span> $
//             <p>
//         </div>
        
//         <div class="containerItem">
//             <span class="idItem">5</span> 
//             Élément
//             <hr>
//             <div class="itemImage">
//                 <div  style="background-image:url('./images/élément.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Élément</span>
//             </p>
//             <p>Type: 
//                 <span>Plante</span>
//             </p>
//             <p>Rareté: 
//                 <span>Très rare</span>
//             </p>
//             <p>Dangerosité: 
//                 <span>1</span>
//             </p>
            
//             <hr>
//             <p>Quantité en stock: 
//                 <span>5</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>15</span> $
//             <p>
//         </div>

//     </div>
// HTML;
// } else {        //si le joueur est connecter
//     $content = <<<HTML
//     <div class="searchContainer">
//         <h2>Recherche: </h2>
//         <input type="search" class="form-control" placeholder ="Rechercher">
//         <i class="fa fa-bars"></i>
//     </div>
//     <hr>

//     <!--Exemple html pour les items-->
//     <div class="containerTousItems">
//         <!--Un item (le div class="containerItem")-->
//         <div class="containerItem">
//             <span class="idItem">1</span> 
//             Épée
//             <span>
//                 <button>
//                     <i class="fa fa-cart-plus"></i>
//                 </button>
//             </span>
//             <hr>
//             <div class="itemImage">
//                 <div style="background-image:url('./images/épée.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Arme</span>
//             </p>
//             <p>Efficacité: 
//                 <span>2</span>
//             </p>
//             <p>Genre: 
//                 <span>2</span>
//             </p>
//             <p>Description:
//             <span>Cette arme est vraiment cool.</span>
//             </p>
//             <hr>
//             <p>Quantité en stock: 
//                 <span>2</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>25</span> $
//             <p>
//         </div>
        
        
//         <div class="containerItem">
//             <span class="idItem">2</span> 
//             Potion
//             <span>
//                 <button>
//                     <i class="fa fa-cart-plus"></i>
//                 </button>
//             </span>
//             <hr>
//             <div class="itemImage">
//                 <div style="background-image:url('./images/potion.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Potion</span>
//             </p>
//             <p>Effet: 
//                 <span>Vitesse</span>
//             </p>
//             <p>Durée: 
//                 <span>2 minutes</span>
//             </p>
//             <p>Type: 
//                 <span>Attaque</span>
//             </p>
//             <hr>
//             <p>Quantité en stock: 
//                 <span>3</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>20</span> $
//             <p>
//         </div>
        

//         <div class="containerItem">
//             <span class="idItem">3</span> 
//             Armure
//             <span>
//                 <button>
//                     <i class="fa fa-cart-plus"></i>
//                 </button>
//             </span>
//             <hr>
//             <div class="itemImage">
//                 <div  style="background-image:url('./images/armure.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Armure</span>
//             </p>
//             <p>Matière: 
//                 <span>Fer</span>
//             </p>
//             <p>Taille: 
//                 <span>75 cm</span>
//             </p>
            
//             <hr>
//             <p>Quantité en stock: 
//                 <span>5</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>40</span> $
//             <p>
//         </div>
        
//         <div class="containerItem">
//             <span class="idItem">4</span> 
//             Armure
//             <span>
//                 <button>
//                     <i class="fa fa-cart-plus"></i>
//                 </button>
//             </span>
//             <hr>
//             <div class="itemImage">
//                 <div  style="background-image:url('./images/armure.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Armure</span>
//             </p>
//             <p>Matière: 
//                 <span>Fer</span>
//             </p>
//             <p>Taille: 
//                 <span>75 cm</span>
//             </p>
            
//             <hr>
//             <p>Quantité en stock: 
//                 <span>5</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>40</span> $
//             <p>
//         </div>
        
//         <div class="containerItem">
//             <span class="idItem">5</span> 
//             Élément
//             <span>
//                 <button>
//                     <i class="fa fa-cart-plus"></i>
//                 </button>
//             </span>
//             <hr>
//             <div class="itemImage">
//                 <div  style="background-image:url('./images/élément.png')"></div>
//             </div>
//             <hr>
//             <p>Type item: 
//                 <span>Élément</span>
//             </p>
//             <p>Type: 
//                 <span>Plante</span>
//             </p>
//             <p>Rareté: 
//                 <span>Très rare</span>
//             </p>
//             <p>Dangerosité: 
//                 <span>1</span>
//             </p>
            
//             <hr>
//             <p>Quantité en stock: 
//                 <span>5</span>
//             </p>
//             <hr>
//             <p class="itemPrix">Prix: 
//                 <span>15</span> $
//             <p>
//         </div>

//     </div>
// HTML;
// }

function addToCartButton($idJoueur, $idItem, $qt) {
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
    foreach ($items as $item) {

        $addToCartBouton = "";
        if ($isConnected)
            $addToCartBouton = addToCartButton($_SESSION['id'], $item->Id, 1);

        if ($item->Type == 'p') { // Potions
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
        
        if ($item->Type == 'w') { // Armes
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

        if ($item->Type == 'a') { // Armures
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

        if ($item->Type == 'e') { // Éléments
            $element = ElementsTable()->selectWhere("idItem = $item->Id")[0];
            $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <span class="idItem">5</span> 
                    $item->Nom
                    <span>
                        $addToCartBouton
                    </span>
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

        $index++;
    }
}

$itemsDisplay .= <<<HTML
    </div>
HTML;


$content .= $itemsDisplay;

include 'views/master.php';