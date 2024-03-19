<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_GET['idJoueur']) && isset($_GET['idItem']) && isset($_GET['qt']))
{
    DB()->nonQuerySqlCmd("CALL addPanier($_GET[idJoueur], $_GET[idItem], $_GET[qt]);");
    redirect('index.php');
}
redirect('index.php?error=noParam');