<?php

include_once 'DAL/models/record.php';

class Test extends Record
{
    public $Alias;
    public $Prenom;
    public $Nom;
    public $AccessType = 0; // user => 0 , admin => 1
    public function __construct($recordData = null)
    {
        $this->Alias = "";
        $this->Prenom = "";
        $this->Nom = "";
        $this->AccessType = 0;
        parent::__construct($recordData);
    }
    public function setAlias($alias)
    {
        $this->Alias = $alias;
    }
    public function setPrenom($prenom)
    {
        $this->Prenom = $prenom;
    }
    public function setNom($nom)
    {
        $this->Nom = $nom;
    }
    public function setAccessType($accessType)
    {
        $this->AccessType = (int) $accessType;
    }
    public function isAdmin()
    {
        return $this->AccessType == 1;
    }
}