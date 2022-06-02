<?php
session_start();
$id = $_SESSION["id"];
$role = $_SESSION["role"];
$brand = $_GET["brand"];
$model = $_GET["model"];
$size = $_GET["size"];

if (isset($id) && isset($brand) && isset($model) && isset($size) && $role == "administrator"){
    include "database.php";
    $sql = "INSERT INTO helmet (brand, model, size) VALUE ('$brand', '$model', '$size')";
    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql);
    $database->close();
    include "add helmets.html";
    echo "<p>Z powodzeniem dodano kask do bazy danych</p>";
}
else{
    header("Location: main.html");
}