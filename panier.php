<?php

include 'DAL/ChevalereskDB.php';


$viewTitle="Panier d'achat";
$content= <<<HTML
  
  <!------------------------------------------------------------------------->
        <!--1- Un item du panier-->
        <div class="panierItem">
            <!--L'image-->
            <div class="panierItemImg">
                <div style="background-image:url('./images/épée.png')"></div>
            </div>
            <!--Le nom de l'item-->
            <div>
                <p>Épée</p>
            </div>
            <!--Le prix-->
            <div class="panierItemPrix">
                <p>25 <span>$ <span></p>
            </div>
            <!--Gérer la quantité-->
            <div class="panierItemQt">
                <p>
                    <span>
                        <button>
                            <a href ="modifierQt.php">     <!--Va à une page de modifier la Quantité d'un item (modifier qt+1 dans BD)-->
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </button>
                    </span>   
                    Quantité
                    <span> 
                        <button>
                            <a href ="modifierQt.php">     <!--Va à une page de modifier la Quantité d'un item (modifier qt-1 dans BD)-->
                                <i class="fa fa-minus-circle"></i>
                            </a>
                        </button>
                    </span>
                </p>
            </div>
            <!--Bouton pour supprimer-->
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
<!------------------------------------------------------------------------->

        <div class="panierItem">
            <div class="panierItemImg">
                <div style="background-image:url('./images/élément.png')"></div>
            </div>
            <div>
                <p>Élément cool</p>
            </div>
            <div class="panierItemPrix">
                <p>40 <span>$ <span></p>
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
                    Quantité
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

include 'views/master.php';