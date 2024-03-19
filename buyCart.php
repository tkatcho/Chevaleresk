<?php

include 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';

if (isset($_GET['idJoueur']))
{
    DB()->nonQuerySqlCmd("CALL buyPanier($_GET[idJoueur]);");
    redirect('panier.php');
}
redirect('panier.php?error=noParam');