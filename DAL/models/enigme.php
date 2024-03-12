<?php

include_once 'DAL/models/record.php';

class Enigme extends Record
{
    public $Enigme;
    public $Difficulte;
    public $Reponse;
    public function __construct($recordData = null)
    {
        $this->Enigme = "";
        $this->Difficulte = "";
        $this->Reponse = "";
        parent::__construct($recordData);
    }
    public function setEnigme($enigme)
    {
        $this->Enigme = $enigme;
    }
    public function setDifficulte($difficulte)
    {
        $this->Difficulte = $difficulte;
    }
    public function setReponse($reponse)
    {
        $this->Reponse = $reponse;
    }
}
