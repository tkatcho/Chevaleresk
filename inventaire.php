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
        if ($item->Type == 'P') { // Potions
            $potion = PotionsTable()->selectWhere("idItem = $item->Id")[0];
            $type = "Défence";
            if ($potion->estAttaque)
                $type = "Attaque";
            $itemsDisplay .= <<<HTML
                <div class="containerItem" onclick="linked($item->Id)">
                    <div class="containerFlexIdNom">
                        <span style="flex-grow:2;"class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                    </div>
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
                </div>
HTML;
        }
        
        if ($item->Type == 'W') { // Armes
            $arme = ArmesTable()->selectWhere("idItem = $item->Id")[0];
            $itemsDisplay .= <<<HTML
                <div class="containerItem" onclick="linked($item->Id)">
                    <div class="containerFlexIdNom">
                        <span style="flex-grow:2;"class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                    </div>
                    <hr>
                    <div class="itemImage">
                        <div style="background-image:url('$item->Photo')"></div>
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

        if ($item->Type == 'A') { // Armures
            $armure = ArmuresTable()->selectWhere("idItem = $item->Id")[0];
            $itemsDisplay .= <<<HTML
                 <div class="containerItem" onclick="linked($item->Id)">
                    <div class="containerFlexIdNom">
                        <span style="flex-grow:2;"class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                    </div>
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

        if ($item->Type == 'E') { // Éléments
            $element = ElementsTable()->selectWhere("idItem = $item->Id")[0];
            $itemsDisplay .= <<<HTML
                 <div class="containerItem" onclick="linked($item->Id)">
                    <div class="containerFlexIdNom">
                        <span style="flex-grow:2;"class="idItem">$index</span> 
                        <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                    </div>
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
$itemsDisplay .= <<<HTML
    <script>
        function linked(id){
            window.location.href = "details.php?idItem=" + id;
        }
    </script>
HTML;

$content .= $itemsDisplay;

include 'views/master.php';