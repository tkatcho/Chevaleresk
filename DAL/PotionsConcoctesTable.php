<?php

include_once 'DAL/models/potionsConcocte.php';
include_once "DAL/MySQLDataBase.php";

final class PotionsConcoctesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new potionsConcocte());
    }
    public function insert($potionsConcocte)
    {
        parent::insert($potionsConcocte);
    }
    public function update($potionsConcocte)
    {
        $potionsConcocteToUpdate = $this->get($potionsConcocte->Id);
        if ($potionsConcocteToUpdate != null) {
            parent::update($potionsConcocte);
        }
    }
    public function delete($id)
    {
        $potionsConcocteToRemove = $this->get($id);
        if ($potionsConcocteToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}