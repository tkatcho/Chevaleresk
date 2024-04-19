<?php

include_once 'DAL/models/reponse.php';
include_once "DAL/MySQLDataBase.php";

final class ReponsesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Reponse());
    }
    public function insert($reponse)
    {
        parent::insert($reponse);
    }
    public function update($reponse)
    {
        $reponseToUpdate = $this->get($reponse->Id);
        if ($reponseToUpdate != null) {
            parent::update($reponse);
        }
    }
    public function delete($id)
    {
        $reponseToRemove = $this->get($id);
        if ($reponseToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}