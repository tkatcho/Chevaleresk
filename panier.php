<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
userAccess();

$panier = PaniersTable()->selectWhere("idJoueur = $_SESSION[id]");
$itemsDisplay = "";
foreach ($panier as $itemInCart) {
    $item = ItemsTable()->selectById($itemInCart->Id)[0];
    $itemsDisplay .= <<<HTML
        <div class="panierItem">
            <div class="panierItemImg">
                <div style="background-image:url($item->Photo)"></div>
            </div>
            <div>
                <p>$item->Nom</p>
            </div>
            <div class="itemPrix">
                <p>$item->Prix <span>$ <span></p>
            </div>
            <div class="panierItemQt">
                <p>
                    <span>
                        <button>
                            <a href ="modifierQt.php">     <!--Va à une page de modifier la Quantité d'un item (modifier qt+1 dans BD)-->
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </button>
                    </span>   
                    $itemInCart->Quantite
                    <span> 
                        <button>
                            <a href ="modifierQt.php">     <!--Va à une page de modifier la Quantité d'un item (modifier qt-1 dans BD)-->
                                <i class="fa fa-minus-circle"></i>
                            </a>
                        </button>
                    </span>
                </p>
            </div>
            <div class="panierItemSupprimer">
                <p>
                    <button >
                        <a href ="modifierQt.php">     <!--Va à une page de modifier la Quantité d'un item (modifier qt=0 dans BD)-->
                            <i class="fa fa-trash"></i>
                        </a>
                    </button>
                </p>
            </div>
        </div>
    HTML;
}

$viewTitle="Panier d'achat";
$content = <<<HTML
    $itemsDisplay
HTML;


include 'views/master.php';