<?php
require_once 'DAL/ChevalereskDB.php';

$sizesArmures = toDataArray(ArmuresTable()->selectDistinct("taille"), "Taille");
$efficaciteArme = toDataArray(ArmesTable()->selectDistinct("efficacite"), "Efficacite");
$effetPotion = toDataArray(PotionsTable()->selectDistinct("effet"), "Effet");
$typeElem = toDataArray(ElementsTable()->selectDistinct("type"), "Type");
$rareteElem = toDataArray(ElementsTable()->selectDistinct("rarete"), "Rarete");
$dangerositeElem = toDataArray(ElementsTable()->selectDistinct("dangerosite"), "Dangerosite");
$genresArmes = toDataArray(ArmesTable()->selectDistinct("genre"), "Genre");


function toDataArray($array, $row)
{
    $arr = [];
    foreach ($array as $armure)
        foreach ($armure as $key => $value)
            if ($key === $row)
                $arr[] = $value;
    return $arr;
}
