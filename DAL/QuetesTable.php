<?php

include_once 'DAL/models/quete.php';
include_once "DAL/MySQLDataBase.php";

final class QuetesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Inventaire());
    }
    public function insert($quete)
    {
        parent::insert($quete);
    }
    public function update($quete)
    {
        $queteToUpdate = $this->get($quete->Id);
        if ($queteToUpdate != null) {
            parent::update($quete);
        }
    }
    public function delete($id)
    {
        $queteToRemove = $this->get($id);
        if ($queteToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}