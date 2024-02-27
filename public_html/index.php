<?php

include 'DAL/ChevalereskDB.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Chevaleresk - test</title>
    <meta charset="UTF-8">
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Test de la BD</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Alias</th>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
        <?php

        $results = TestsTable()->selectAll();

        foreach ($results as $result) {
            $id = $result->Id;
            $alias = $result->Alias;
            $prenom = $result->Prenom;
            $nom = $result->Nom;

            echo <<<HTML
                    <tr>
                        <td>$id</td>
                        <td>$alias</td>
                        <td>$prenom</td>
                        <td>$nom</td>
                    </tr>
HTML;
        }

        ?>
    </table>
</body>

</html>