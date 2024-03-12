<?php

include_once 'DAL/models/panier.php';
include_once "DAL/MySQLDataBase.php";

final class PaniersTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Panier());
    }
    public function insert($panier)
    {
        parent::insert($panier);
    }
    public function update($panier)
    {
        $panierToUpdate = $this->get($panier->Id);
        if ($panierToUpdate != null) {
            parent::update($panier);
        }
    }
    public function delete($id)
    {
        $panierToRemove = $this->get($id);
        if ($panierToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}