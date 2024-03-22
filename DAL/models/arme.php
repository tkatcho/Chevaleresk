<?php

include_once 'DAL/models/record.php';

class Arme extends Record
{
    public $idItem;
    public $Efficacite;
    public $Genre;
    public $Description;
    public function __construct($recordData = null)
    {
        $this->idItem = 0;
        $this->Efficacite = "";
        $this->Genre = "";
        $this->Description = "";
        parent::__construct($recordData);
    }
    public function setEfficacite($efficacite)
    {
        $this->Efficacite = $efficacite;
    }
    public function setGenre($genre)
    {
        $this->Genre = $genre;
    }
    public function setDescription($description)
    {
        $this->Description = $description;
    }
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;
    }
}
