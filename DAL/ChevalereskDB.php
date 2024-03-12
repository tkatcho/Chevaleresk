<?php

include_once 'DAL/MySQLDataBase.php';
include_once 'DAL/TestsTable.php';
function DB()
{
    return MySQLDataBase::getInstance('chevalresk');
}
function TestsTable()
{
    return new TestsTable();
}