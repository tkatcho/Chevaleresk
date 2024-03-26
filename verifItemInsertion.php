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
            $_SESSION['error'] = "Aucune photo choisi!";
            redirect("newItem.php");
        }
    }
}
function createItem($data)
{
    $itemInsertedVerif = 0;
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

        $itemInsertedVerif = ItemsTable()->insert(new Item($item));
        $itemInserted = ItemsTable()->selectWhere("nom = '$x'")[0]->Id;

        if (isset($itemInserted) && $itemInsertedVerif != 0) {
            $sousItemData = ["idItem" => $itemInserted] + $sousItemData;

            switch ($data["typeItem"]) {
                case "A":
                    $itemInsertedVerif = ArmuresTable()->insert(new Armure($sousItemData));
                    break;
                case "W":
                    $itemInsertedVerif = ArmesTable()->insert(new Arme($sousItemData));
                    break;
                case "P":
                    $itemInsertedVerif = PotionsTable()->insert(new Potion($sousItemData));
                    break;
                case "E":
                    $itemInsertedVerif = ElementsTable()->insert(new Element($sousItemData));
                    break;
            }

            if ($itemInserted == 0) {
                $db->rollbackTransaction();
                throw new Exception("Error: N'a pas pue inserer l'item, veuillez ressayer!");
            }
            $db->commitTransaction();
            $_SESSION['success'] = "Insertion reussi! l'item est ajoute a la BD!";
            redirect("newItem.php");
        } else {
            $db->rollbackTransaction();
            throw new Exception('Nom deja choisi, insertion impossible.');
        }
    } catch (Exception $e) {

        $db->rollbackTransaction();
        $_SESSION['error'] = "Error: " . $e->getMessage();;
        redirect("newItem.php");
    }
}

$jsonEffets = json_encode($effetPotion);
$jsonGenres = json_encode($genresArmes);
$jsonEff = json_encode($efficaciteArme);
$jsonSizes = json_encode($sizesArmures);
$jsonTypes = json_encode($typeElem);
$jsonRarete = json_encode($rareteElem);
$jsonDangerosite = json_encode($dangerositeElem);
