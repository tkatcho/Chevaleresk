<?php

include_once 'DAL/MySQLDataBase.php';
include_once 'DAL/JoueursTable.php';
function DB()
{
    return MySQLDataBase::getInstance('chevalresk');
}
function JoueursTable()
{
    return new JoueursTable();
}
function DemandesTable()
{
    return new DemandesTable();
}
function QuetesTable()
{
    return new QuetesTable();
}
function EnigmesTable()
{
    return new EnigmesTable();
}
function EvaluationsTable()
{
    return new EvaluationsTable();
}
function InventairesTable()
{
    return new InventairesTable();
}
function PaniersTable()
{
    return new PaniersTable();
}
function ItemsTable()
{
    return new ItemsTable();
}
function ElementsTable()
{
    return new ElementsTable();
}
function PotionsTable()
{
    return new PotionsTable();
}
function RecettesTable()
{
    return new RecettesTable();
}
function PotionsConcoctesTable()
{
    return new PotionsConcoctesTable();
}
function ArmesTable()
{
    return new ArmesTable();
}
function ArmuresTable()
{
    return new ArmuresTable();
}