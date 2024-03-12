<?php

include_once 'DAL/models/recette.php';
include_once "DAL/MySQLDataBase.php";

final class RecettesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Recette());
    }
    public function insert($recette)
    {
        parent::insert($recette);
    }
    public function update($recette)
    {
        $recetteToUpdate = $this->get($recette->Id);
        if ($recetteToUpdate != null) {
            parent::update($recette);
        }
    }
    public function delete($id)
    {
        $recetteToRemove = $this->get($id);
        if ($recetteToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}