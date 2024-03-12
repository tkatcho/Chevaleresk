<?php

include_once 'DAL/models/demande.php';
include_once "DAL/MySQLDataBase.php";

final class DemandesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Demande());
    }
    public function insert($demande)
    {
        parent::insert($demande);
    }
    public function update($demande)
    {
        $demandeToUpdate = $this->get($demande->Id);
        if ($demandeToUpdate != null) {
            parent::update($demande);
        }
    }
    public function delete($id)
    {
        $demandeToRemove = $this->get($id);
        if ($demandeToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}