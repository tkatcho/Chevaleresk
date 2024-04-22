<?php

include 'php/sessionManager.php';
include 'DAL/ChevalereskDB.php';
adminAccess();

DB()->nonQuerySqlCmd("CALL accepterDemande($_POST[idRequest])");
redirect('argentAdmin.php');