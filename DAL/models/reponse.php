<?php

include_once 'DAL/models/record.php';

class Reponse extends Record
{
    public $id;
    public $idEnigme;
    public $reponse;
    public $estBonne;
    public function __construct($recordData = null)
    {
        $this->Id = 0;
        $this->IdEnigme = 0;
        $this->EstBonne=0;
        $this->Reponse="";
        parent::__construct($recordData);
    }
    public function setId($id)
    {
        $this->Id = $id;
    }
    public function setIdEnigme($idEnigme)
    {
        $this->IdEnigme = $idEnigme;
    }
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }
    public function setEstBonne($estBonne)
    {
        $this->EstBonne = $estBonne;
    }
}