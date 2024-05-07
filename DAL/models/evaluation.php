<?php

include_once 'DAL/models/record.php';

class Evaluation extends Record
{
    public $idItem;
    public $idJoueur;
    public $Etoile;
    public $Commentaire;
    public function __construct($recordData = null)
    {
        $this->idJoueur = 0;
        $this->idItem = 0;
        $this->Etoile = 0;
        $this->Commentaire = "";
        parent::__construct($recordData);
    }
    public function setIdItem($idItem) {
        $this->idItem = $idItem;
    }
    public function setIdJoueur($idJoueur) {
        $this->idJoueur = $idJoueur;
    }
    public function setEtoile($etoile)
    {
        if ($etoile >= 0 && $etoile <= 5)
        {
            $this->Etoile = $etoile;   
        }
    }
    public function setCommentaire($commentaire)
    {
        $this->Commentaire = $commentaire;
    }
}