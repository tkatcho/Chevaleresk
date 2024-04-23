<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
userAccess();
$viewTitle="Bienvenue à Chevaleresk";
$isConnected= isset($_SESSION['validUser']) && $_SESSION['validUser'];
$element1 = $_POST['elem1'];
$element2 = $_POST['elem2'];
$qtRequis1 = $_POST['qtRequis1'];
$qtRequis2 = $_POST['qtRequis2'];
$potionId = $_POST['potionId'];

$peuxConcocter = false;
//$qtInventaireJoueur = InventairesTable()->selectWhere("idJoueur = $_SESSION[id] AND idItem = {$temp[0]->Id}")[0]->Quantite ?? '0';
try{
    $elem1 = ItemsTable()->selectWhere("nom = '$element1'");
    $elem2 = ItemsTable()->selectWhere("nom = '$element2'");
    $inventaire = InventairesTable()->selectWhere("idJoueur = $_SESSION[id] AND idItem = {$elem1[0]->Id} OR idItem = {$elem2[0]->Id}");
    foreach($inventaire as $element){
        if($element->Quantite >= $qtRequis1){
            $peuxConcocter = true;
        }
    }
}catch(Exception $e){
    $_SESSION['erreur'] = "La potion ne peux pas être concocté";
}

if($peuxConcocter){
    $elem1Id = $elem1[0]->Id; 
    $elem2Id = $elem2[0]->Id;
    $sql = "CALL ajouterPotion($potionId, $_SESSION[id], $elem1Id, $elem2Id)";
    print("Je peux concoter et j'appelle la procédure stockée.");
    DB()->nonQuerySqlCmd($sql);
    $_SESSION['success'] = "La potion a été concocté !";
    print("potion concocté");
    //redirect('concocterPotions.php');
}


