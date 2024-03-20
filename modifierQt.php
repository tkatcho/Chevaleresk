<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

$panier = PaniersTable()->selectById($_GET['id'])[0];

if (isset($_GET['id']) && isset($_GET['qt']))
{
    if ($_SESSION['id'] == $panier->idJoueur)
    {
        DB()->nonQuerySqlCmd("CALL changePanierQt($_GET[id], $_GET[qt]);");
        redirect('panier.php');
    }
    else
    {
        redirect('panier.php?error=wrongId');
    }
}
redirect('panier.php?error=noParam');