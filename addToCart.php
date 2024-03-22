<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_GET['idJoueur']) && isset($_GET['idItem']) && isset($_GET['qt']))
{
    if ($_SESSION['id'] === $_GET['idJoueur'])
    {
        DB()->nonQuerySqlCmd("CALL addPanier($_GET[idJoueur], $_GET[idItem], $_GET[qt]);");
        redirect('index.php');
    }
    else
    {
        redirect('index.php?error=wrongId');
    }
}
redirect('index.php?error=noParam');