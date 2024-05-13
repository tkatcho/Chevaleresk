<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

$styles = <<<HTML
    <link rel="stylesheet" href="./css/stats.css">
HTML;
$viewTitle = "Statistiques";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];
userAccess();
$content = "";
$image = "";
$items_display = <<<HTML
    <table>
        <tr class="categories">
            <th>Avatar</th>
            <th>Alias</th>
            <th>Niveau</th>
            <th>Solde</th>
            <th>Nombre d'énigme réussi</th>
            <th>Nombre d'énigme échoué</th>
        </tr>
HTML;

if ($isConnected){
    $joueurs = JoueursTable()->selectAll();
    usort($joueurs, function($a, $b) {
        $bonnesReponsesA = count(QuetesTable()->selectWhere("idJoueur = $a->Id AND reussi = 1"));
        $bonnesReponsesB = count(QuetesTable()->selectWhere("idJoueur = $b->Id AND reussi = 1"));
    
        return $bonnesReponsesB <=> $bonnesReponsesA;
    });
    foreach($joueurs as $joueur){
        $quetesReussi = QuetesTable()->selectWhere("idJoueur = $joueur->Id AND reussi = 1");
        $reussi = count($quetesReussi);
        $quetesÉchoué = QuetesTable()->selectWhere("idJoueur = $joueur->Id AND reussi = 0");
        $échoué = count($quetesÉchoué);
        if($joueur->estAlchimiste == 1 || $joueur->estAdmin == 1 ){
            if($joueur->estAlchimiste == 1){
                $image = <<<HTML
                    <td>
                        <div class="avatar" style="background-image:url('./images/alchimiste.png')"></div>
                    </td>
    HTML;
            }
            if($joueur->estAdmin == 1 ){
                $image = <<<HTML
                    <td>
                        <div class="avatar" style="background-image:url('./images/admin.png')"></div>
                    </td>
    HTML;       
            }

        }
        else{
            $image = <<<HTML
                <td>
		            <div class="avatar" style="background-image:url('./images/chevalier.png')"></div>
                </td>
HTML;
        } 
        $items_display .= <<<HTML
        <tr>
            $image
            <td class="stats">
                $joueur->Alias
            </td>
            <td class="stats">
                $joueur->Niveau
            </td>
            <td class="stats">
                $joueur->Solde
            </td>
            <td class="stats">
                $reussi
            </td>
            <td class="stats">
                $échoué
            </td>
        </tr>
HTML;
    }

    $items_display .= <<<HTML
    </table>
HTML;

    $content .= $items_display;
    include 'views/master.php';
}
