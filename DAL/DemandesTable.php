<?php

include_once 'DAL/models/demande.php';
include_once "DAL/MySQLDataBase.php";

final class DemandesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Demande());
    }
    public function insert($test)
    {
        parent::insert($test);
    }
    public function update($test)
    {
        $userToUpdate = $this->get($test->Id);
        if ($test->Password == "")
            $test->Password = $userToUpdate->Password;
        if ($userToUpdate != null) {
            parent::update($test);
        }
    }
    public function delete($id)
    {
        $userToRemove = $this->get($id);
        if ($userToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}