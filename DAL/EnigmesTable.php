<?php

include_once 'DAL/models/enigme.php';
include_once "DAL/MySQLDataBase.php";

final class EnigmesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Enigme());
    }
    public function insert($enigme)
    {
        parent::insert($enigme);
    }
    public function update($enigme)
    {
        $enigmeToUpdate = $this->get($enigme->Id);
        if ($enigmeToUpdate != null) {
            parent::update($enigme);
        }
    }
    public function delete($id)
    {
        $enigmeToRemove = $this->get($id);
        if ($enigmeToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}