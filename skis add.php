<?php
session_start();
$id = $_SESSION["id"];
$role = $_SESSION["role"];
$brand = $_GET["brand"];
$model = $_GET["model"];
$length = $_GET["length"];
if (isset($brand) && isset($model) && isset($length) && $role == "administrator"){
    include "database.php";
    $sql = "insert into Skis (brand, model, length) values ('$brand', '$model', '$length');";
    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql);
    $database->close();
}
include "skis add.html";