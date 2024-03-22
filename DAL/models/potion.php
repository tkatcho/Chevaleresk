<?php

include_once 'DAL/models/record.php';

class Potion extends Record
{
    public $idItem;
    public $Effet;
    public $Duree;
    public $estAttaque;
    public function __construct($recordData = null)
    {
        $this->idItem = 0;
        $this->Effet = "";
        $this->Duree = 0;
        $this->estAttaque = false;
        parent::__construct($recordData);
    }
    public function setEffet($effet)
    {
        $this->Effet = $effet;
    }
    public function setDuree($duree)
    {
        $this->Duree = $duree;
    }
    public function setEstAttaque($estAttaque)
    {
        if ($estAttaque == 0)
        {
            $this->estAttaque = false;
        }
        else
        {
            $this->estAttaque = true;
        }
    }
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;
    }
}
