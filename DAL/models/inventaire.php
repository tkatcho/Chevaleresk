<?php

include_once 'DAL/models/record.php';

class Inventaire extends Record
{
    public $idJoueur;
    public $idItem;
    public $Quantite;
    public function __construct($recordData = null)
    {
        $this->idJoueur = 0;
        $this->idItem = 0;
        $this->Quantite = 0;
        parent::__construct($recordData);
    }
    public function setQuantite($quantite)
    {
        $this->Quantite = $quantite;
    }
}
