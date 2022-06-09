<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Co jest aktualnie wypożyczone?</title>
    <link href="../src/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="whats actually landed.php" method="get" id="alanded">
    <label for="sortByDate">Posortuj po dacie:</label>
    <select id="sortByDate" name="sortByDate">
        <option value="1">wypożyczenia</option>
        <option value="2">zwrotu</option>
    </select>
    <button type="submit">Posortuj</button>
</form>
<hr>
<?php
session_start();
$id = $_SESSION["id"];
$role = $_SESSION["role"];
if (isset($id)) {
    include "database.php";
    $sql = "select email,
            Skis.brand, Skis.model, Skis.length,
            ski_boots.brand, ski_boots.model, ski_boots.size,
            ski_pole.brand, ski_pole.model, ski_pole.high,
            helmet.brand, helmet.model, helmet.size,
            dateLend, dateReturn
            from lend, helmet, ski_pole, ski_boots, Skis, Users
            where idSkis = Skis.id
            and idHelmet = helmet.id
            and idSkiBoots = ski_boots.id
            and idSkiPole = ski_pole.id
            and idUser = Users.id";
    if ($_GET["isActually"] ?? $_SESSION["isActually"] ?? 0) {
        $sql .= " and current_date < lend.dateReturn";
        $_SESSION["isActually"] = $_GET["isActually"];
    }
    if ($role == "user") {
        $sql .= " and idUser = $id";
    }

    $sql .= " ORDER BY email";

    switch ($_GET["sortByDate"] ?? 1) {
        case 1:
            $sql .= ", lend.dateLend, lend.dateReturn";
            break;
        case 2:
            $sql .= ", lend.dateReturn, lend.dateLend";
            break;
    }


    /** @noinspection PhpUndefinedVariableInspection */
    $query = $database->query($sql);
    while ($row = $query->fetch_row()) {
        echo "<div class='paddingDiv'>
             <p>e-mail użytkownika: $row[0]</p>
             <p>Data:</p> 
             <ul>
                 <li>Wypożyczenia: $row[13]</li>
                 <li>Zwrotu: $row[14]</li>
            </ul>
             <p>Natry:</p>
             <ul>
                <li>
                    Marka: $row[1]
                </li>
                <li>
                    Model: $row[2]
                </li>
                <li>
                    Długość: $row[3]cm
                </li>
             </ul>
             <p>Buty narciarskie:</p>
             <ul>
                <li>
                    Marka: $row[4]
                </li>
                <li>
                    Model: $row[5]
                </li>
                <li>
                    Rozmiar: $row[6]
                </li>
             </ul>
             <p>Kijki narciarskie:</p>
             <ul>
                <li>
                    Marka: $row[7]
                </li>
                <li>
                    Model: $row[8]
                </li>
                <li>
                    Długość: $row[9]cm
                </li>
             </ul>
             <p>Kaski narciarskie:</p>
             <ul>
                <li>
                    Marka: $row[10]
                </li>
                <li>
                    Model: $row[11]
                </li>
                <li>
                    Rozmiar: $row[12]
                </li>
             </ul>
             </div>
             <hr>
             ";
    }
} else {
    header("Location: login.html");
}

?>
<script src="whats%20actually%20landed.js"></script>
</body>
</html>