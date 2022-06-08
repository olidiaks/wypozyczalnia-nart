<?php
session_start();
$idUser = $_SESSION['id'];
$skiBoots = $_GET["ski_boots"];
$skis = $_GET["skis"];
$skiPole = $_GET["ski_pole"];
$helmet = $_GET["helmet"];
$dataReturn = $_GET["dataReturn"];
if (isset($idUser) &&isset($skiBoots) && isset($skis) && isset($skiPole) && isset($helmet) && isset($dataReturn)){
    include "database.php";
    $sql = sprintf("insert into lend (idUser, idSkis, idSkiBoots, idSkiPole, idHelmet, dateLend, dateReturn) 
    value(%s,%s,%s,%s,%s, CURRENT_DATE, '%s');",
    $database->real_escape_string($idUser),
    $database->real_escape_string($skis),
    $database->real_escape_string($skiBoots),
    $database->real_escape_string($skiPole),
    $database->real_escape_string($helmet),
    $database->real_escape_string($dataReturn),
    );
    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql) or die("Nie udało się dodać danych do bazy danych");
    $database->close();
    include "lend.php";
    echo "<p>Zamówienie zostało dodane</p>";
}
else{
    header("Location: lend.php");
}