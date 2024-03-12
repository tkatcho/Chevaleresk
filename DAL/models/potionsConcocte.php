<?php

include_once 'DAL/models/record.php';

class potionsConcocte extends Record
{
    public $idJoueur;
    public $idPotion;
    public function __construct($recordData = null)
    {
        $this->idJoueur = 0;
        $this->idPotion = 0;
        parent::__construct($recordData);
    }
}
