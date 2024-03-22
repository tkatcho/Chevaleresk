<?php

include_once 'DAL/models/potion.php';
include_once "DAL/MySQLDataBase.php";

final class PotionsTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Potion());
    }
    public function insert($potion)
    {
        return parent::insert($potion);
    }
    public function update($potion)
    {
        $potionToUpdate = $this->get($potion->Id);
        if ($potionToUpdate != null) {
            parent::update($potion);
        }
    }
    public function delete($id)
    {
        $potionToRemove = $this->get($id);
        if ($potionToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}