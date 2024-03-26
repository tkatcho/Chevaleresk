<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
userAccess();

$total = 0;
$panier = PaniersTable()->selectWhere("idJoueur = $_SESSION[id]");
$itemsDisplay = "";
foreach ($panier as $itemInCart) {
    $item = ItemsTable()->selectWhere("id = $itemInCart->idItem")[0];
    $total += ($itemInCart->Quantite * $item->Prix);
    $itemsDisplay .= <<<HTML
        <div class="panierItem">
            <div class="panierItemImg">
                <div style="background-image:url($item->Photo)"></div>
            </div>
            <div>
                <p>$item->Nom</p>
            </div>
            <div class="panierItemPrix">
                <p>$item->Prix <span>$ <span></p>
            </div>
            <div class="panierItemQt">
                <p>
                    <span>
                        <button onclick="location.href='modifierQt.php?id=$itemInCart->Id&qt=1'">
                            <a href ="modifierQt.php?id=$itemInCart->Id&qt=1">     <!--Va à une page de modifier la Quantité d'un item (modifier qt+1 dans BD)-->
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </button>
                    </span>   
                    $itemInCart->Quantite / $item->QuantiteStock
                    <span> 
                        <button onclick="location.href='modifierQt.php?id=$itemInCart->Id&qt=-1'">
                            <a href ="modifierQt.php?id=$itemInCart->Id&qt=-1">     <!--Va à une page de modifier la Quantité d'un item (modifier qt-1 dans BD)-->
                                <i class="fa fa-minus-circle"></i>
                            </a>
                        </button>
                    </span>
                </p>
            </div>
            <div class="panierItemSupprimer">
                <p>
                    <button onclick="location.href='modifierQt.php?id=$itemInCart->Id&qt=-$item->QuantiteStock'">
                        <a href ="modifierQt.php?id=$itemInCart->Id&qt=-$item->QuantiteStock">     <!--Va à une page de modifier la Quantité d'un item (modifier qt=0 dans BD)-->
                            <i class="fa fa-trash"></i>
                        </a>
                    </button>
                </p>
            </div>
        </div>
    HTML;
}

$viewTitle = "Panier d'achat";
$content = <<<HTML
    $itemsDisplay
HTML;

$solde = JoueursTable()->selectById($_SESSION['id'])[0]->Solde;

$content .= <<<HTML
    
    <h2>Total: <span class="prix">$total $</span></h2>
    <h2>Solde: <span class="prix">$solde $</span></h2>
    <button class="buyButton"  onclick="location.href='buyCart.php?idJoueur=$_SESSION[id]'">
        <a href="buyCart.php?idJoueur=$_SESSION[id]">Acheter <i class="fa-solid fa-cash-register"></i></a>
    </button>
HTML;


include 'views/master.php';
