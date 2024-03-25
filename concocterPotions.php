<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
userAccess();

$items = ItemsTable()->selectAll();
$potions = PotionsTable()->selectAll();
$itemsDisplay = "";
foreach ($potions as $potion) {
    $recette = RecettesTable()->selectWhere("idPotion = $potion->Id");

    $itemsDisplay .= <<<HTML
    <div class="concocterPotionsPage ">
        <div class="concocterPotions">
            <div class="concocterPotionsImg">
                <div style="background-image:url($potion->Photo)"></div>
            </div>
            <div>
                <p>$potion->Nom</p>
            </div>
        </div>

    </div>
    HTML;
}

$viewTitle="Panier d'achat";
$content = <<<HTML
    $itemsDisplay
HTML;

$solde = JoueursTable()->selectById($_SESSION['id'])[0]->Solde;

$content .= <<<HTML
    
    <h2>Total: <span class="prix">$total $</span></h2>
    <h2>Solde: <span class="prix">$solde $</span></h2>
    <button class="buyButton">
        <a href="buyCart.php?idJoueur=$_SESSION[id]">Acheter <i class="fa-solid fa-cash-register"></i></a>
    </button>
HTML;


include 'views/master.php';