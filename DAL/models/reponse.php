<?php

include_once 'DAL/models/record.php';

class Reponse extends Record
{
    
    public $IdEnigme;
    public $Reponse;
    public $EstBonne;
    public function __construct($recordData = null)
    {
      
        $this->IdEnigme = 0;
        $this->EstBonne=0;
        $this->Reponse="";
        parent::__construct($recordData);
    }
   
}