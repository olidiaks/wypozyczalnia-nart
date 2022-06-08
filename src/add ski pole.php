<?php
session_start();
$id = $_SESSION["id"];
$role = $_SESSION["role"];
$brand = $_GET["brand"];
$model = $_GET["model"];
$high = $_GET["high"];

if (isset($id) && $role == "administrator" && isset($brand) && isset($model) && isset($high)){
    include "database.php";
    $sql = sprintf("INSERT INTO ski_pole (brand, model, high) VALUE ('%s', '%s', '%s');",
        $database->real_escape_string($brand),
        $database->real_escape_string($model),
        $database->real_escape_string($high));
    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql);
    $database->close();
    include "add ski pole.html";
    echo "<p>Kijki zostały dodane do bazy danych.</p>";
}
else{
    header('Location: main.php');
}