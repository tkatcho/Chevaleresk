<?php

include_once 'DAL/models/record.php';

class Armure extends Record
{
    public $idItem;
    public $Matiere;
    public $Taille;
    public function __construct($recordData = null)
    {
        $this->idItem = 0;
        $this->Matiere = "";
        $this->Taille = "";
        parent::__construct($recordData);
    }
    public function setMatiere($matiere)
    {
        $this->Matiere = $matiere;
    }
    public function setTaille($taille)
    {
        $this->Taille = $taille;
    }
}
