<?php

include_once "DAL/models/item.php";
include_once "DAL/MySQLDataBase.php";
include_once "php/imageFiles.php";

const photosPath = "images/items";

final class ItemsTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Item());
    }
    public function insert($item)
    {
        $item->setPhoto(saveImage(photosPath, $item->Photo));
        parent::insert($item);
    }
    public function update($item)
    {
        $itemToUpdate = $this->get($item->Id);
        if ($itemToUpdate != null) {
            $item->setPhoto(saveImage(photosPath, $itemToUpdate->Photo));
            parent::update($item);
        }
    }
    public function delete($id)
    {
        $itemToRemove = $this->get($id);
        if ($itemToRemove != null) {
            unlink($itemToRemove->Photo);
            return parent::delete($id);
        }
        return false;
    }
}
