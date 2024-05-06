<?php

include_once 'php/sessionManager.php';
include_once 'DAL/ChevalereskDB.php';

DB()->nonQuerySqlCmd("CALL modifierNom($_SESSION[id], '$_POST[nom]')");