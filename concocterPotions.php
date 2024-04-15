<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
include_once 'php/utils.php';
userAccess();


$chosen_item = $_GET['chosenItem'] ?? '';
$items = ItemsTable()->selectAll();
$potions = PotionsTable()->selectAll();

$elem1 = "Unavailable";
$elem2 = "Unavailable";

$qt0 = "0";
$qt1 = "0";

$textColor0 = 'color: red;';
$textColor1 = 'color: red;';

$recette = RecettesTable()->selectWhere("idPotion = $chosen_item");

$itemsDisplay = "";
foreach ($items as $item) {
    //$recette = RecettesTable()->selectWhere("idPotion = $potion->Id");
    //$itemPotion =ItemsTable()->selectWhere("id = $potion->IdItem");
    if ($item->Type == 'P') {
        $itemsDisplay .= <<<HTML
        
        <div class="concocterPotionsItem"data-id="{$item->Id}">
            <div class="concocterPotionsImg">
                <div style="background-image:url($item->Photo)"></div>
            </div>
            <div>
                <p>$item->Nom</p>
            </div>
         </div>
    
HTML;
    }
}


if (isset($recette[1]) && isset($recette[0])) {

    $temp = ElementsTable()->selectById($recette[0]->idElement);
    $temp = ItemsTable()->selectById($temp[0]->idItem);
    $elem1 = $temp[0]->Nom;
    $qt0 = InventairesTable()->selectWhere("idJoueur = $_SESSION[id] AND idItem = {$temp[0]->Id}")[0]->Quantite ?? '0';


    $temp = ElementsTable()->selectById($recette[1]->idElement);
    $temp = ItemsTable()->selectById($temp[0]->idItem);
    $elem2 = $temp[0]->Nom;
    $qt1 = InventairesTable()->selectWhere("idJoueur = $_SESSION[id] AND idItem = {$temp[0]->Id}")[0]->Quantite ?? '0';


    $textColor0 = $qt0 == 0 ? 'color: red;' : '';
    $textColor1 = $qt1 == 0 ? 'color: red;' : '';
}

$viewTitle = "Concocter des potions";
$content = <<<HTML
    <div class="concocterPotionsPage">
        <div class="concocterPotionsToutesPotions">
        $itemsDisplay
        </div>
        <div class="concocterPotionsRecettes">
            <p>Ingrédients</p>
            <hr>
            <p>Pour la potion, il faut:</p>

            <!--La liste des ingrédients-->
            <ul>
                <li style="{$textColor0}">$elem1 $qt0/1</li>
                <li style="{$textColor1}">$elem2 $qt1/1</li>
            </ul>

            <form action="">

            </form>
            <button class="concocterPotionBtn">
              <a class="optionsBtnIcon" href ="index.php">    <!--Changer le href-->
              Faire la potion <i class="fa fa-flask"></i>
              </a>
          </button>
        </div>
    </div>
    <script>
    var buttons = document.getElementsByClassName("concocterPotionsItem");

    for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", function() {
        for (var j = 0; j < buttons.length; j++) {
            buttons[j].classList.remove("chosen_item");
        }

        window.location.href = "concocterPotions.php?chosenItem=" + this.getAttribute('data-id');
        localStorage.setItem('chosenItemId', this.getAttribute('data-id'));
    });
    
}
    document.addEventListener('DOMContentLoaded', function() {
        var chosenItemId = localStorage.getItem('chosenItemId');

        if (chosenItemId) {
            var item = document.querySelector('[data-id="' + chosenItemId + '"]');
            if (item) {
               item.classList.add("chosen_item");
            }
        }
    });
</script>
HTML;

include 'views/master.php';
