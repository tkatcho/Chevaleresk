<?php

// TEST DE FONCTIONNEMENT!!!!

require "DAL/ChevalereskDB.php";
require "php/sessionManager.php";

anonymousAccess();

// Hashing du mot de passe
$_POST['motDePasse'] = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);

JoueursTable()->insert(new Joueur($_POST));
redirect('newJoueurForm.php');