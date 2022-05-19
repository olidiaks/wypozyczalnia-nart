<?php
session_start();
$id = $_SESSION["id"];
$role = $_SESSION["role"];
$brand = $_GET["brand"];
$model = $_GET["model"];
$high = $_GET["high"];

if (isset($id) && $role == "administrator" && isset($brand) && isset($model) && isset($high)){
    include "database.php";
    $sql = "INSERT INTO ski_pole (brand, model, high) VALUE ('$brand', '$model', '$high');";
    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql);
    include "add ski pole.html";
    echo "<p>Kijki zostały dodane do bazy danych.</p>";
}
else{
    header('Location: main.html');
}