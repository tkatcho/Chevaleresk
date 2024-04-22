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
$inventaire = InventairesTable()->selectWhere("idJoueur = $_SESSION[id]");
var_dump($element1);
var_dump($element2);

//$qtInventaireJoueur = InventairesTable()->selectWhere("idJoueur = $_SESSION[id] AND idItem = {$temp[0]->Id}")[0]->Quantite ?? '0';



//var_dump($inventaire);

$peuxConcocter = false;
if ($inventaire != null) {


    
}