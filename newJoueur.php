<?php

// TEST DE FONCTIONNEMENT!!!!

require "DAL/ChevalereskDB.php";
require "php/sessionManager.php";

anonymousAccess();
JoueursTable()->insert(new Joueur($_POST));
redirect('newJoueurForm.php');