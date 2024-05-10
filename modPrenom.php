<?php

include_once 'php/sessionManager.php';
include_once 'DAL/ChevalereskDB.php';

DB()->nonQuerySqlCmd("CALL modifierPrenom($_SESSION[id], '$_POST[prenom]')");