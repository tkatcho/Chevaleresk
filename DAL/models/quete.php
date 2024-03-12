<?php

include_once 'DAL/models/record.php';

class Quete extends Record
{
    public $idJoueur;
    public $idEnigme;
    public $Reussi;
    public function __construct($recordData = null)
    {
        $this->idJoueur = 0;
        $this->idEnigme = 0;
        $this->Reussi = 0;
        parent::__construct($recordData);
    }
    public function setReussi($reussi)
    {
        if ($reussi == 0 || $reussi == 1)
        {
            $this->Reussi = (int) $reussi;
        }
    }
}
