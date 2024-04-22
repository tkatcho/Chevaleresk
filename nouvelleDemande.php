<?php

include 'php/sessionManager.php';
include 'DAL/ChevalereskDB.php';

if (isset($_SESSION['id']))
{
    DB()->nonQuerySqlCmd("CALL nouvelleDemande($_SESSION[id])");
    redirect('argentAdmin.php');
}
redirect('argentAdmin.php');