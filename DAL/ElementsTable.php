<?php

include_once 'DAL/models/element.php';
include_once "DAL/MySQLDataBase.php";

final class ElementsTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Element());
    }
    public function insert($element)
    {
        return parent::insert($element);
    }
    public function update($element)
    {
        $elementToUpdate = $this->get($element->Id);
        if ($elementToUpdate != null) {
            parent::update($element);
        }
    }
    public function delete($id)
    {
        $elementToRemove = $this->get($id);
        if ($elementToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}