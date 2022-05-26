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
    $sql = "insert into lend (idUser, idSkis, idSkiBoots, idSkiPole, idHelmet, dateLend, dateReturn) 
    value($idUser,$skis,$skiBoots,$skiPole,$helmet,'". time() ."', '$dataReturn');";
    include "lend.php";
    echo "<p>Zamówienie zostało dodane</p>";
}
else{
    header("Location: lend.php");
}