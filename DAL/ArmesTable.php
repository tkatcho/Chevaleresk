<?php

include_once 'DAL/models/arme.php';
include_once "DAL/MySQLDataBase.php";

final class ArmesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Arme());
    }
    public function insert($arme)
    {
        parent::insert($arme);
    }
    public function update($arme)
    {
        $armeToUpdate = $this->get($arme->Id);
        if ($armeToUpdate != null) {
            parent::update($arme);
        }
    }
    public function delete($id)
    {
        $armeToRemove = $this->get($id);
        if ($armeToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}