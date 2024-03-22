<?php

include_once 'DAL/models/record.php';

class Element extends Record
{
    public $idItem;
    public $Type;
    public $Rarete;
    public $Dangerosite;
    public function __construct($recordData = null)
    {
        $this->idItem = 0;
        $this->Type = "";
        $this->Rarete = "";
        $this->Dangerosite = "";
        parent::__construct($recordData);
    }
    public function setType($type)
    {
        $this->Type = $type;
    }
    public function setRarete($rarete)
    {
        $this->Rarete = $rarete;
    }
    public function setDangerosite($dangerosite)
    {
        $this->Dangerosite = $dangerosite;
    }
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;
    }
}
