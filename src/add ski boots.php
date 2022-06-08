<?php
session_start();
$id = $_SESSION["id"];
$role = $_SESSION["role"];
$brand = $_GET["brand"];
$model = $_GET["model"];
$size = $_GET["size"];
if (isset($id) && $role == "administrator" && isset($brand) && isset($model) && isset($size)) {
    include "database.php";
    $sql = sprintf("INSERT INTO ski_boots (brand, model, size) VALUE ('%s', '%s', '%s')",
        $database->real_escape_string($brand),
        $database->real_escape_string($model),
        $database->real_escape_string($size));

    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql) or die("nie udała się dodać butów do bazy danych");
    $database->close();
    include "add ski boots.html";
    echo "<p>Dodano buty do bazy danych.</p>";
} else {
    header("Location: main.php");
}
