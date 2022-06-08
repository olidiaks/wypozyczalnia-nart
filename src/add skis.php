<?php
session_start();
$id = $_SESSION["id"];
$role = $_SESSION["role"];
$brand = $_GET["brand"];
$model = $_GET["model"];
$length = $_GET["length"];
if (isset($id) && isset($brand) && isset($model) && isset($length) && $role == "administrator"){
    include "database.php";
    $sql = sprintf("insert into Skis (brand, model, length) values ('%s', '%s', '%s');",
        $database->real_escape_string($brand),
        $database->real_escape_string($model),
        $database->real_escape_string($length));
    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql);
    $database->close();
    include "add skis.html";
    echo "<p>Narty zostały dodane do bazy danych.</p>";
}
else{
    header("Location: main.php");
}