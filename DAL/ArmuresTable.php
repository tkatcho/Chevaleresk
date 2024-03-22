<?php

include_once 'DAL/models/armure.php';
include_once "DAL/MySQLDataBase.php";

final class ArmuresTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Armure());
    }
    public function insert($armure)
    {
        return parent::insert($armure);
    }
    public function update($armure)
    {
        $armureToUpdate = $this->get($armure->Id);
        if ($armureToUpdate != null) {
            parent::update($armure);
        }
    }
    public function delete($id)
    {
        $armureToRemove = $this->get($id);
        if ($armureToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}
