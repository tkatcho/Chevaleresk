<?php
require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

// adminAccess();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $formData = getFormData('POST');
        if (!empty($formData["photo"])) {
            createItem($formData);
        } else {
            echo "Erreur pas de photo";
        }
    }
}


function createItem($data)
{
    $item = [
        'nom' => $data['nom'],
        'type' => $data['typeItem'],
        'quantiteStock' => $data['quantiteStock'],
        'prix' => $data['prix'],
        'photo' => $data['photo']
    ];

    $sousItemData = $data;
    unset($sousItemData['nom'], $sousItemData['typeItem'], $sousItemData['quantiteStock'], $sousItemData['prix'], $sousItemData['photo'], $sousItemData['submit']);

    $db = DB(); // Get the database connection.
    try {
        $db->beginTransaction();
        $x = $item['nom'];

        ItemsTable()->insert(new Item($item));
        $itemInserted = ItemsTable()->selectWhere("nom = '$x'")[0]->Id;

        if (isset($itemInserted)) {
            $sousItemData = ["idItem" => $itemInserted] + $sousItemData;

            print_r($sousItemData);
            switch ($data["typeItem"]) {
                case "A":
                    ArmuresTable()->insert(new Armure($sousItemData));
                    break;
                case "W":
                    ArmesTable()->insert(new Arme($sousItemData));
                    break;
                case "P":
                    PotionsTable()->insert(new Potion($sousItemData));
                    break;
                case "E":
                    ElementsTable()->insert(new Element($sousItemData));
                    break;
            }

            $db->commitTransaction();
        } else {
            throw new Exception('Failed to insert item.'); // Throw an exception if item insertion failed.
        }
    } catch (Exception $e) {
        $db->rollbackTransaction(); // Roll back the transaction on error.
        echo "Error: " . $e->getMessage(); // Output error message.
    }
}

// function testing()
// {
//     $temp = new Armure(['idItem' => 62, 'Matiere' => "S", 'Taille' => 'L']);
//     $temp->setId(69);
//     ArmuresTable()->insert($temp);
// }
$jsonEffets = json_encode($effetPotion);
$jsonGenres = json_encode($genresArmes);
$jsonEff = json_encode($efficaciteArme);
$jsonSizes = json_encode($sizesArmures);
$jsonTypes = json_encode($typeElem);
$jsonRarete = json_encode($rareteElem);
$jsonDangerosite = json_encode($dangerositeElem);
