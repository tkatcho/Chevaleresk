<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_GET['id']) && isset($_GET['qt']))
{
    DB()->nonQuerySqlCmd("CALL changePanierQt($_GET[id], $_GET[qt]);");
    redirect('panier.php');
}
redirect('panier.php?error=noParam');