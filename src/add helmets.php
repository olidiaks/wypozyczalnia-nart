<?php
session_start();
$id = $_SESSION["id"];
$role = $_SESSION["role"];
$brand = $_GET["brand"];
$model = $_GET["model"];
$size = $_GET["size"];

if (isset($id) && isset($brand) && isset($model) && isset($size) && $role == "administrator"){
    include "database.php";
    $sql = sprintf("INSERT INTO helmet (brand, model, size) VALUE ('%s', '%s', '%s')",
        $database->real_escape_string($brand),
        $database->real_escape_string($model),
        $database->real_escape_string($size));
    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql);
    $database->close();
    include "add helmets.html";
    echo "<p>Z powodzeniem dodano kask do bazy danych</p>";
}
else{
    header("Location: main.php");
}