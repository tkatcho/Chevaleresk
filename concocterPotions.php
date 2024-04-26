<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
include_once 'php/utils.php';
userAccess();

#region variables
$chosen_item = $_GET['chosenItem'] ?? '';

$message_concoction = 'Veuillez choisir une potion a concocter';
$messageHtml = '';

if (isset($_SESSION['success'])) {
    $messageHtml = '<h1 style="color: green;">' . htmlspecialchars($_SESSION['success']) . '</h1>';
    unset($_SESSION['success']);
} elseif (isset($_SESSION['error'])) {
    $messageHtml = '<h1 style="color: red;">' . htmlspecialchars($_SESSION['error']) . '</h1>';
    unset($_SESSION['error']);
}
$items = ItemsTable()->selectAll();

$potions = PotionsTable()->selectAll();
$potion = '';

$elem1 = "Unavailable";
$elem2 = "Unavailable";

$qt1 = 0;
$qt2 = 0;

$qtRequis1 = 1;
$qtRequis2 = 1;

$textColor0 = 'color: red;';
$textColor1 = 'color: red;';

$recette = RecettesTable()->selectWhere("idPotion = $chosen_item");

$disabled = "Disabled";
#endregion

$itemsDisplay = "";
foreach ($items as $item) {
    if ($item->Type == 'P') {
        $potion = PotionsTable()->selectWhere("idItem = $item->Id");
        $itemsDisplay .= <<<HTML
        <div class="concocterPotionsItem"data-id="{$potion[0]->Id}">
            <div class="concocterPotionsImg">
                <div style="background-image:url($item->Photo)"></div>
            </div>
            <div>
                <p class="concocterPotionNom">$item->Nom</p>
            </div>
         </div>
    
HTML;
    }
}


if (isset($recette[1]) && isset($recette[0])) {

    $temp = ElementsTable()->selectById($recette[0]->idElement);
    $temp = ItemsTable()->selectById($temp[0]->idItem);
    $elem1 = $temp[0]->Nom;
    $qt1 = InventairesTable()->selectWhere("idJoueur = $_SESSION[id] AND idItem = {$temp[0]->Id}")[0]->Quantite ?? '0';


    $temp = ElementsTable()->selectById($recette[1]->idElement);
    $temp = ItemsTable()->selectById($temp[0]->idItem);
    $elem2 = $temp[0]->Nom;
    $qt2 = InventairesTable()->selectWhere("idJoueur = $_SESSION[id] AND idItem = {$temp[0]->Id}")[0]->Quantite ?? '0';


    $qtRequis1 = $recette[0]->qtElement;
    $qtRequis2 = $recette[1]->qtElement;

    $textColor0 = $qt1 < $qtRequis1 ? 'color: red;' : '';
    $textColor1 = $qt2 < $qtRequis2 ? 'color: red;' : '';

    $message_concoction = "Pour la potion, il faut:";
}

function créerBouton($qt1, $qtRequis1, $qt2, $qtRequis2)
{

    if ($qt1 >= $qtRequis1 && $qt2 >= $qtRequis2) {
        return <<<HTML
            <input class="concocterPotionBtn"type="submit" value="Faire la potion">
HTML;
    } else {
        return <<<HTML
            <input disabled class="concocterPotionBtn" style="cursor: not-allowed;" type="submit" value="Faire la potion">
HTML;
    }
}

$bouton = créerBouton($qt1, $qtRequis1, $qt2, $qtRequis2);

$viewTitle = "Concocter des potions";
$content = <<<HTML
    <div class="concocterPotionsPage">
        <hr>
        <div class="concocterPotionsToutesPotions">
        $itemsDisplay
        </div>
        <hr>
        <div class="concocterPotionsRecettes">
            <strong class="concocterPotionsIngredient">Ingrédients</strong>
            <hr>
            <p>$message_concoction</p>

            <!--La liste des ingrédients-->
            <ul>
                <li style="{$textColor0}">$elem1 $qt1/$qtRequis1</li>
                <li style="{$textColor1}">$elem2 $qt2/$qtRequis2</li>
            </ul>

            <form action="fairePotionConfirm.php" method="post">

            <!-- Liste elements envoyer au form -->
            <input type="hidden" name="elem1" value="{$elem1}">
            <input type="hidden" name="elem2" value="{$elem2}">
            <input type="hidden" name="qtRequis1" value="{$qtRequis1}">
            <input type="hidden" name="qtRequis2" value="{$qtRequis2}">
            <input type="hidden" name="potionId" value="{$chosen_item}">

            $bouton
            </form>
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
                item.scrollIntoView();
                item.classList.add("chosen_item");
            }
        }
    });
</script>
HTML;

include 'views/master.php';
