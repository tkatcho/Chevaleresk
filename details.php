<?php
require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

$scripts = <<<HTML
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/eval.js"></script>
HTML;

if (isset($_GET["idItem"])) {
    $id = $_GET["idItem"];
    $item = ItemsTable()->get($id);
    if ($item == null)
        redirect('index.php');
}
else
{
    redirect('index.php');
}
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];

$viewTitle = "Détails de l'item";
$viewMenu = "";

function addToCartButton($idJoueur, $idItem, $qt)
{
    
    return <<<HTML
        <button>
            <a title="Ajouter au panier" href="addToCart.php?idJoueur=$idJoueur&idItem=$idItem&qt=$qt"><i class="fa fa-cart-plus"></i></a>
        </button>
HTML;
    
}

function évaluerEtCommenter($idJoueur, $idItem)
{
    if (InventairesTable()->selectWhere("idJoueur = $idJoueur AND idItem = $idItem")){
        if (EvaluationsTable()->selectWhere("idJoueur = $idJoueur AND idItem = $idItem") == null) {
            return <<<HTML
                <button class="btnÉvaluerCommenter">
                    <a>Évaluer et commenter <i class="fa fa-comments"></i></a>
                </button>
HTML;
        } else {
            return <<<HTML
                <button class="btnDejaEvaluer">
                    <a href="" title="Aller à votre commentaire">Vous avez déja commenté</a>
                </button>
HTML;
        }
    }
    return "";
   
}

$itemsDisplay = <<<HTML
    <div class="détailsContainer">
HTML;


    $index = $item->Id;

    if ($item != null)
    {
        $addToCartBouton = "";
        $buttonÉvaluerCommentaire="";
        if ($isConnected) {
            $addToCartBouton = addToCartButton($_SESSION['id'], $id, 1);
            $buttonÉvaluerCommentaire = évaluerEtCommenter($_SESSION['id'], $id);
        }
           
          
        if ($item->Type == 'P')
        { // Potions
            $potion = PotionsTable()->selectWhere("idItem = $id")[0];
            $type = "Défence";
            if ($potion->estAttaque)
                $type = "Attaque";
           
            $itemsDisplay .= <<<HTML
            <div class="détailsContainerItem">
                <div class="détailsImg">
                    <div style="background-image:url('$item->Photo')"></div>
                </div>
                $buttonÉvaluerCommentaire
            </div>

            <div class="détailsContainerItem">
                <div class="containerFlexIdNom">
                    <!-- <span class="idItem">$index</span> -->
                    <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                    <span>$addToCartBouton</span>
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
    
        if ($item->Type == 'W') { // Armes
                $arme = ArmesTable()->selectWhere("idItem = $id")[0];
                $itemsDisplay .= <<<HTML
                    <div class="détailsContainerItem">
                        <div class="détailsImg">
                            <div style="background-image:url('$item->Photo')"></div>
                        </div>
                        $buttonÉvaluerCommentaire
                    </div>

                    <div class="détailsContainerItem">
                        <div class="containerFlexIdNom">
                            <!-- <span class="idItem">$index</span> -->
                            <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                            <span>$addToCartBouton</span>
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

        if ($item->Type == 'A') { // Armures
                $armure = ArmuresTable()->selectWhere("idItem = $id")[0];
                $itemsDisplay .= <<<HTML
                    <div class="détailsContainerItem">
                        <div class="détailsImg">
                            <div style="background-image:url('$item->Photo')"></div>
                        </div>
                        $buttonÉvaluerCommentaire
                    </div>

                    <div class="détailsContainerItem">
                        <div class="containerFlexIdNom">
                            <!-- <span class="idItem">$index</span> -->
                            <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                            <span>$addToCartBouton</span>
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
        
        //ok
        if ($item->Type == 'E') { // Éléments
            $element = ElementsTable()->selectWhere("idItem = $id")[0];
            $itemsDisplay .= <<<HTML
            <div class="détailsContainerItem">
                <div class="détailsImg">
                    <div style="background-image:url('$item->Photo')"></div>
                </div>
                $buttonÉvaluerCommentaire
            </div>

            <div class="détailsContainerItem">
                <div class="containerFlexIdNom">
                    <!-- <span class="idItem">$index</span> -->
                    <span style="flex-grow:2;  margin-left:4px;">$item->Nom</span> 
                    <span>$addToCartBouton</span>
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
    }    
 


$itemsDisplay .= <<<HTML
    </div>
HTML;


$content = $itemsDisplay;

include 'views/master.php';
