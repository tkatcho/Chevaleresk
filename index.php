<?php

include 'DAL/ChevalereskDB.php';

$results = JoueursTable()->selectAll();
//$items = ItemsTable() ->selectAll();
//faire le DAL pour les items  
//$tableDesTests = "";
                
/*foreach ($results as $result) {
    $id = $result->Id;
    $alias = $result->Alias;
    $prenom = $result->Prenom;
    $nom = $result->Nom;

    $tableDesTests .= <<<HTML
        <tr>
            <td>$id</td>
            <td>$alias</td>
            <td>$prenom</td>
            <td>$nom</td>
        </tr>
HTML;
}

$content = <<<HTML
    <h1>Test de la BD</h1>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Alias</th>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
        $tableDesTests
    </table>
HTML;*/
$viewTitle="Catalogue de produit";

/*if(!$_SESSION["validPlayer"])  { //n'est pas connecter
$content= <<<HTML
    <div class="searchContainer">
        <h2>Recherche: </h2>
        <input type="search" class="form-control" placeholder ="Rechercher">
        <i class="fa fa-bars"></i>
    </div>
    <hr>

    <!--Exemple html pour les items-->
    <div class="containerTousItems">
        <!--Un item (le div class="containerItem")-->
        <div class="containerItem">
            <span class="idItem">1</span> 
            Épée
            <hr>
            <div class="itemImage">
                <div style="background-image:url('./images/épée.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Arme</span>
            </p>
            <p>Efficacité: 
                <span>2</span>
            </p>
            <p>Genre: 
                <span>2</span>
            </p>
            <p>Description:
            <span>Cette arme est vraiment cool.</span>
            </p>
            <hr>
            <p>Quantité en stock: 
                <span>2</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>25</span> $
            <p>
        </div>
        
        
        <div class="containerItem">
            <span class="idItem">2</span> 
            Potion
            <hr>
            <div class="itemImage">
                <div style="background-image:url('./images/potion.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Potion</span>
            </p>
            <p>Effet: 
                <span>Vitesse</span>
            </p>
            <p>Durée: 
                <span>2 minutes</span>
            </p>
            <p>Type: 
                <span>Attaque</span>
            </p>
            <hr>
            <p>Quantité en stock: 
                <span>3</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>20</span> $
            <p>
        </div>
        

        <div class="containerItem">
            <span class="idItem">3</span> 
            Armure
            <hr>
            <div class="itemImage">
                <div  style="background-image:url('./images/armure.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Armure</span>
            </p>
            <p>Matière: 
                <span>Fer</span>
            </p>
            <p>Taille: 
                <span>75 cm</span>
            </p>
            
            <hr>
            <p>Quantité en stock: 
                <span>5</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>40</span> $
            <p>
        </div>
        
        <div class="containerItem">
            <span class="idItem">4</span> 
            Armure
            <hr>
            <div class="itemImage">
                <div  style="background-image:url('./images/armure.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Armure</span>
            </p>
            <p>Matière: 
                <span>Fer</span>
            </p>
            <p>Taille: 
                <span>75 cm</span>
            </p>
            
            <hr>
            <p>Quantité en stock: 
                <span>5</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>40</span> $
            <p>
        </div>
        
        <div class="containerItem">
            <span class="idItem">5</span> 
            Élément
            <hr>
            <div class="itemImage">
                <div  style="background-image:url('./images/élément.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Élément</span>
            </p>
            <p>Type: 
                <span>Plante</span>
            </p>
            <p>Rareté: 
                <span>Très rare</span>
            </p>
            <p>Dangerosité: 
                <span>1</span>
            </p>
            
            <hr>
            <p>Quantité en stock: 
                <span>5</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>15</span> $
            <p>
        </div>

    </div>
HTML;
}else {        //si le joueur est connecter*/
    $content= <<<HTML
    <div class="searchContainer">
        <h2>Recherche: </h2>
        <input type="search" class="form-control" placeholder ="Rechercher">
        <i class="fa fa-bars"></i>
    </div>
    <hr>

    <!--Exemple html pour les items-->
    <div class="containerTousItems">
        <!--Un item (le div class="containerItem")-->
        <div class="containerItem">
            <span class="idItem">1</span> 
            Épée
            <hr>
            <div class="itemImage">
                <div style="background-image:url('./images/épée.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Arme</span>
            </p>
            <p>Efficacité: 
                <span>2</span>
            </p>
            <p>Genre: 
                <span>2</span>
            </p>
            <p>Description:
            <span>Cette arme est vraiment cool.</span>
            </p>
            <hr>
            <p>Quantité en stock: 
                <span>2</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>25</span> $
            <p>
        </div>
        
        
        <div class="containerItem">
            <span class="idItem">2</span> 
            Potion
            <hr>
            <div class="itemImage">
                <div style="background-image:url('./images/potion.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Potion</span>
            </p>
            <p>Effet: 
                <span>Vitesse</span>
            </p>
            <p>Durée: 
                <span>2 minutes</span>
            </p>
            <p>Type: 
                <span>Attaque</span>
            </p>
            <hr>
            <p>Quantité en stock: 
                <span>3</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>20</span> $
            <p>
        </div>
        

        <div class="containerItem">
            <span class="idItem">3</span> 
            Armure
            <hr>
            <div class="itemImage">
                <div  style="background-image:url('./images/armure.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Armure</span>
            </p>
            <p>Matière: 
                <span>Fer</span>
            </p>
            <p>Taille: 
                <span>75 cm</span>
            </p>
            
            <hr>
            <p>Quantité en stock: 
                <span>5</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>40</span> $
            <p>
        </div>
        
        <div class="containerItem">
            <span class="idItem">4</span> 
            Armure
            <hr>
            <div class="itemImage">
                <div  style="background-image:url('./images/armure.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Armure</span>
            </p>
            <p>Matière: 
                <span>Fer</span>
            </p>
            <p>Taille: 
                <span>75 cm</span>
            </p>
            
            <hr>
            <p>Quantité en stock: 
                <span>5</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>40</span> $
            <p>
        </div>
        
        <div class="containerItem">
            <span class="idItem">5</span> 
            Élément
            <hr>
            <div class="itemImage">
                <div  style="background-image:url('./images/élément.png')"></div>
            </div>
            <hr>
            <p>Type item: 
                <span>Élément</span>
            </p>
            <p>Type: 
                <span>Plante</span>
            </p>
            <p>Rareté: 
                <span>Très rare</span>
            </p>
            <p>Dangerosité: 
                <span>1</span>
            </p>
            
            <hr>
            <p>Quantité en stock: 
                <span>5</span>
            </p>
            <hr>
            <p class="itemPrix">Prix: 
                <span>15</span> $
            <p>
        </div>

    </div>
HTML;
//}


include 'views/master.php';