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
    <table>
        <tr>
            <th>Montant demandé</th>
            <th>Statue</th>
        </tr>
        <tr>
            <td>200</td>
            <td>Accepté</td>
        </tr>
        <tr>
            <td>200</td>
            <td class="refuse">Refusé</td>
        </tr>
        <tr>
            <td>200</td>
            <td>En attente...</td>
        </tr>
    </table>
HTML;

require 'views/master.php';