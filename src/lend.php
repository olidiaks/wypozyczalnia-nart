<?php
/**
 * @param mysqli $database
 * @param string $sql
 * @param string $name
 * @return void
 */
function show_with_size(mysqli $database, string $sql, string $name): void
{
    $query = $database->query($sql);
    while ($row = $query->fetch_array()) {
        echo "<input type='radio' name='$name' value='{$row["id"]}'>
              Marka: {$row["brand"]}, Model: {$row["model"]}, rozmiar: {$row["size"]}
              <br>";
    }
}

/**
 * @param mysqli $database
 * @param string $sql
 * @param string $name
 * @return void
 */
function show_with_length(mysqli $database, string $sql, string $name): void
{
    $query = $database->query($sql);
    while ($row = $query->fetch_array()) {
        echo "<input type='radio' name='$name' value='{$row["id"]}'>
             Marka: {$row["brand"]}, Model: {$row["model"]}, Długość: {$row["length"]} cm
             <br>";
    }
}

/**
 * @param mysqli $database
 * @param string $sql
 * @param string $name
 * @return void
 */
function show_with_high(mysqli $database, string $sql, string $name): void
{
    $query = $database->query($sql);
    while ($row = $query->fetch_array()) {
        echo "<input type='radio' name='$name' value='{$row["id"]}'>
              Marka: {$row["brand"]}, Model: {$row["model"]}, wysokość: {$row["high"]} cm
              <br>";
    }
}

?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../src/style.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
<form action="lend backend.php" method="get" id="land">
    <?php
    include "database.php";

    echo "<p>Narty:</p>";
    $sql = "SELECT * FROM Skis ORDER BY brand, model, length ";
    /** @noinspection PhpUndefinedVariableInspection */
    show_with_length($database, $sql, "skis");

    echo "<p>Buty narciarskie:</p>";
    $sql = "SELECT * FROM ski_boots ORDER BY brand, model, size";
    show_with_size($database, $sql, "ski_boots");

    echo "<p>Kijki narciarskie</p>";
    $sql = "SELECT * FROM ski_pole ORDER BY brand, model, high";
    show_with_high($database, $sql, "ski_pole");

    echo "<p>Kaski:</p>";
    $sql = "SELECT * FROM helmet ORDER BY brand, model, size";
    show_with_size($database, $sql, "helmet");

    $database->close();
    ?>
    <label for="lend-data-return"></label>
    <input type="date" name="dataReturn" id="lend-data-return">
    <button type="submit">Wypożycz!</button>
</form>
<div id="footer">
    <a href="main.php">Powrót do strony głównej.</a>
</div>
<script src="lend.js"></script>
</body>
</html>