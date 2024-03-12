<?php

include_once 'DAL/models/record.php';

class Demande extends Record
{
    public $idJoueur;
    public $Statue;
    public function __construct($recordData = null)
    {
        $this->idJoueur = 0;
        $this->Statue = "";
        parent::__construct($recordData);
    }
    public function setStatue($statue)
    {
        $this->Statue = $statue;
    }
}
