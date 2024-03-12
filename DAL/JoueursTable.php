<?php

include_once 'DAL/models/joueur.php';
include_once "DAL/MySQLDataBase.php";

final class JoueursTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Joueur());
    }
    public function aliasExist($alias)
    {
        $joueur = $this->selectWhere("alias = '$alias'");
        return isset($joueur[0]);
    }
    public function findByAlias($alias)
    {
        $joueur = $this->selectWhere("alias = '$alias'");
        if (isset($joueur[0]))
            return $joueur[0];
        return null;
    }
    public function insert($joueur)
    {
        parent::insert($joueur);
    }
    public function update($joueur)
    {
        $joueurToUpdate = $this->get($joueur->Id);
        if ($joueur->Password == "")
            $joueur->Password = $joueurToUpdate->Password;
        if ($joueurToUpdate != null) {
            parent::update($joueur);
        }
    }
    public function delete($id)
    {
        $joueurToRemove = $this->get($id);
        if ($joueurToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}