<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
userAccess();
$isConnected= isset($_SESSION['validUser']) && $_SESSION['validUser'];

$inventaire = InventairesTable()->selectWhere("idJoueur = $_SESSION[id]");

$viewTitle = "Inventaire";

$content = <<<HTML
    
HTML;

//$btnCommenterEtÉvaluer=<<<HTML

//HTML;
$itemsDisplay = <<<HTML
    <div class="containerTousItems">
HTML;

$index = 1;

if ($inventaire != null) {
    foreach ($inventaire as $inventaireRow) {
        $item = ItemsTable()->selectById($inventaireRow->idItem)[0];
        if ($item->Type == 'p') { // Potions
            $potion = PotionsTable()->selectWhere("idItem = $item->Id")[0];
            $type = "Défence";
            if ($potion->estAttaque)
                $type = "Attaque";
            $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <span class="idItem">$index</span> 
                    $item->Nom
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
                    <p>Quantité:
                        <span>$inventaireRow->Quantite</span>
                    </p>
                    <button>
                        <a href="evaluationsEtCommentaires.php">
                            Évaluer et commenter <i class="fa fa-comments"></i>
                        </a>
                    </button>
                </div>
            HTML;
        }
        
        if ($item->Type == 'w') { // Armes
            $arme = ArmesTable()->selectWhere("idItem = $item->Id")[0];
            $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <span class="idItem">$index</span> 
                    $item->Nom
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
                    <p>Quantité:
                        <span>$inventaireRow->Quantite</span>
                    </p>
                </div>
            HTML;
        }

        if ($item->Type == 'a') { // Armures
            $armure = ArmuresTable()->selectWhere("idItem = $item->Id")[0];
            $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <span class="idItem">$index</span> 
                    $item->Nom
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
                    <p>Quantité:
                        <span>$inventaireRow->Quantite</span>
                    </p>
                </div>
            HTML;
        }

        if ($item->Type == 'e') { // Éléments
            $element = ElementsTable()->selectWhere("idItem = $item->Id")[0];
            $itemsDisplay .= <<<HTML
                <div class="containerItem">
                    <span class="idItem">$index</span> 
                    $item->Nom
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
                    <p>Quantité:
                        <span>$inventaireRow->Quantite</span>
                    </p>
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