<?php

include_once 'DAL/MySQLDataBase.php';
include_once 'DAL/TestsTable.php';
function DB()
{
    return MySQLDataBase::getInstance('dbchevalersk16');
}
function TestsTable()
{
    return new TestsTable();
}