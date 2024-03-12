<?php

include_once 'DAL/models/test.php';
include_once "DAL/MySQLDataBase.php";

final class JoueursTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Joueur());//test
    }
    public function aliasExist($alias)
    {
        $user = $this->selectWhere("alias = '$alias'");
        return isset($user[0]);
    }
    public function findByAlias($alias)
    {
        $user = $this->selectWhere("alias = '$alias'");
        if (isset($user[0]))
            return $user[0];
        return null;
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