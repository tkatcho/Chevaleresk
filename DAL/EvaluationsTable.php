<?php

include_once 'DAL/models/evaluation.php';
include_once "DAL/MySQLDataBase.php";

final class EvaluationsTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Evaluation());
    }
    public function insert($evaluation)
    {
        parent::insert($evaluation);
    }
    public function update($evaluation)
    {
        $evaluationToUpdate = $this->get($evaluation->Id);
        if ($evaluationToUpdate != null) {
            parent::update($evaluation);
        }
    }
    public function delete($id)
    {
        $evaluationToRemove = $this->get($id);
        if ($evaluationToRemove != null) {
            return parent::delete($id);
        }
        return false;
    }
}