<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
userAccess();

$items = ItemsTable()->selectAll();
$potions = PotionsTable()->selectAll();

$itemsDisplay = "";
foreach ($items as $item) {
//$recette = RecettesTable()->selectWhere("idPotion = $potion->Id");
   // $itemPotion =ItemsTable()->selectWhere("id = $potion->IdItem");
    if($item->Type == 'P'){
    $itemsDisplay .= <<<HTML
        
        <div class="concocterPotionsItem">
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


$viewTitle="Concocter des potions";
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
                <li>Ingrédient 1</li>
                <li>Ingrédient 2</li>
            </ul>

            <button>
              <a class="optionsBtnIcon" href ="index.php">    <!--Changer le href-->
              Faire la potion <i class="fa fa-flask"></i>
              </a>
          </button>
        </div>
    </div>
HTML;

include 'views/master.php';