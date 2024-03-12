<?php

include_once 'DAL/models/inventaire.php';
include_once "DAL/MySQLDataBase.php";

final class inventairesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Inventaire());
    }
    public function insert($inventaire)
    {
        parent::insert($inventaire);
    }
    public function update($inventaire)
    {
        $inventaireToUpdate = $this->get($inventaire->Id);
        if ($inventaireToUpdate != null) {
            parent::update($inventaire);
        }
    }
    public function delete($id)
    {
        $inventaireToRemove = $this->get($id);
        if ($inventaireToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}