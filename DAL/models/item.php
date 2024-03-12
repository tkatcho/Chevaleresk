<?php

include_once 'DAL/models/record.php';

class Item extends Record
{
    public $Nom;
    public $Type;
    public $QuantiteStock;
    public $Prix;
    public $Photo;
    public function __construct($recordData = null)
    {
        $this->Nom = "";
        $this->Type = "";
        $this->QuantiteStock = 0;
        $this->Prix = 0;
        $this->Photo = "";
        parent::__construct($recordData);
    }
    public function setNom($nom)
    {
        $this->Nom = $nom;
    }
    public function setType($type)
    {
        $this->Type = $type;
    }
    public function setQuantiteStock($quantite)
    {
        $this->QuantiteStock = $quantite;
    }
    public function setPrix($prix)
    {
        $this->Prix = $prix;
    }
    public function setPhoto($photo)
    {
        $this->Photo = $photo;
    }
}
