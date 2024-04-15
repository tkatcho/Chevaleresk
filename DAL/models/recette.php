<?php

include_once 'DAL/models/record.php';

class Recette extends Record
{
    public $idPotion;
    public $idElement;
    public function __construct($recordData = null)
    {
        $this->idPotion = 0;
        $this->idElement = 0;
        parent::__construct($recordData);
    }
    public function setIdPotion($idPotion)
    {
        $this->idPotion = $idPotion;
    }
    public function setIdElement($idElement)
    {
        $this->idElement = $idElement;
    }
}
