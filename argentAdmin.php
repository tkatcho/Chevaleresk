<?php

require_once 'DAL/ChevalereskDB.php';
require 'php/sessionManager.php';
require_once 'php/config.php';

$viewTitle = "Demande d'argent";
$isConnected = isset($_SESSION['validUser']) && $_SESSION['validUser'];
userAccess();

$styles = <<<HTML
    <link rel="stylesheet" href="./css/demandeArgent.css">
HTML;

$content = <<<HTML
    <div class="demandesContainer">
        <table>
            <tr>
                <th>Montant demandé</th>
                <th>Statue</th>
            </tr>
HTML;

foreach (DemandesTable()->selectWhere("idJoueur = $_SESSION[id]") as $demande) {
    $statue;
    switch($demande->Statue) {
        case 'W':
            $statue = '<td>En attente...</td>';
            break;
        case 'A':
            $statue = '<td style="color:green;">Accepté</td>';
            break;
        case 'R':
            $statue = '<td style="color:red;">Refusé</td>';
            break;
        default:
            $statue = '<td>ERREUR</td>';
            break;
    }
    $content .= <<<HTML
        <tr>
            <td>200</td>
            $statue
        </tr>
HTML;
}

if (count(DemandesTable()->selectWhere("idJoueur = $_SESSION[id]")) >= 3) {
    $content .= <<<HTML
        </table>
            <form action="nouvelleDemande.php">
                <input style="cursor:not-allowed;" disabled type="submit" value="Demander 200 écus">
            <form>
        </div>
HTML;
} else {
    $content .= <<<HTML
        </table>
            <form action="nouvelleDemande.php">
                <input type="submit" value="Demander 200 écus">
            <form>
        </div>
HTML;
}

if ($_SESSION['isAdmin'] == 1) {
    $content = <<<HTML
    <div class="demandesContainer">
        <table>
            <tr>
                <th>Alias</th>
                <th>Montant demandé</th>
                <th>Statue</th>
            </tr>
HTML;

    foreach (DemandesTable()->selectAll() as $demande) {
        $joueur = JoueursTable()->selectById($demande->idJoueur)[0];
        $statue;
        switch($demande->Statue) {
            case 'W':
                $statue = '<td>En attente...</td>';
                break;
            case 'A':
                $statue = '<td style="color:green;">Accepté</td>';
                break;
            case 'R':
                $statue = '<td style="color:red;">Refusé</td>';
                break;
            default:
                $statue = '<td>ERREUR</td>';
                break;
        }

        if($demande->Statue != 'W') {
            $boutons = <<<HTML
                <form method="POST" action="accepterDemande.php">
                    <input type="hidden" name="idRequest" value="$demande->Id">
                    <td><input disabled type="submit" value="Accepté"></td>
                </form>
                <form method="POST" action="refuserDemande.php">
                    <input type="hidden" name="idRequest" value="$demande->Id">
                    <td><input disabled type="submit" value="Refusé"></td>
                </form>
HTML;
        } else {
            $boutons = <<<HTML
                <form method="POST" action="accepterDemande.php">
                    <input type="hidden" name="idRequest" value="$demande->Id">
                    <td><input type="submit" value="Accepté"></td>
                </form>
                <form method="POST" action="refuserDemande.php">
                    <input type="hidden" name="idRequest" value="$demande->Id">
                    <td><input type="submit" value="Refusé"></td>
                </form>
HTML;
        }

        $content .= <<<HTML
            <tr>
                <td>$joueur->Alias</td>
                <td>200</td>
                $statue
                $boutons
            </tr>
HTML;

    }

    $content .= <<<HTML
        </table>
        </div>
HTML;

}

require 'views/master.php';