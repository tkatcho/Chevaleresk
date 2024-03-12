<?php

// TEST DE FONCTIONNEMENT!!!!

require "DAL/ChevalereskDB.php";

if (password_verify($_POST['motDePasse'], JoueursTable()->findByAlias($_POST['alias'])->MotDePasse))
{
    echo "oui";
}
else
{
    echo "non";
}
var_dump($_POST['motDePasse']);
var_dump(JoueursTable()->findByAlias($_POST['alias'])->MotDePasse);