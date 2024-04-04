<?php

include_once 'DAL/models/record.php';

class Joueur extends Record
{
    public $Alias;
    public $Nom;
    public $Prenom;
    public $MotDePasse;
    public $Solde;
    public $Niveau;
    public $estAlchimiste;
    public $estAdmin = 0; // user => 0 , admin => 1
    public function __construct($recordData = null)
    {
        $this->Alias = "";
        $this->Nom = "";
        $this->Prenom = "";
        $this->MotDePasse = "";
        $this->Solde = 0;
        $this->Niveau = "aucun";
        $this->estAlchimiste = 0;
        $this->estAdmin = 0;
        parent::__construct($recordData);
    }
    public function setAlias($alias)
    {
        $this->Alias = $alias;
    }
    public function setNom($prenom)
    {
        $this->Prenom = $prenom;
    }
    public function setPrenom($nom)
    {
        $this->Nom = $nom;
    }
    public function setMotDePasse($motDePasse)
    {
        $this->MotDePasse = $motDePasse;
    }
    public function setSolde($solde)
    {
        $this->Solde = $solde;
    }
    public function setNiveau($niveau)
    {
        $this->Niveau = $niveau;
    }
    public function setEstAlchimiste($estAlchimiste)
    {
        if ($estAlchimiste == 0 || $estAlchimiste == 1)
        {
            $this->estAlchimiste = (int) $estAlchimiste;
        }
    }
    public function setEstAdmin($accessType)
    {
        if ($accessType == 0 || $accessType == 1)
        {
            $this->estAdmin = (int) $accessType;
        }
    }
    public function isAdmin()
    {
        return $this->estAdmin == 1;
    }
}
