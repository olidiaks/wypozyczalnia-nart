<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Co jest aktualnie wypożyczone?</title>
</head>
<body>
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
            helmet.brand, helmet.model, helmet.size
            from lend, helmet, ski_pole, ski_boots, Skis, Users
            where idSkis = Skis.id
            and idHelmet = helmet.id
            and idSkiBoots = ski_boots.id
            and idSkiPole = ski_pole.id
            and idUser = Users.id
            and current_date < lend.dateReturn";
    if ($role == "user") {
        $sql .= " and idUser = $id";
    }

    $sql .= " ORDER BY email";

    /** @noinspection PhpUndefinedVariableInspection */
    $query = $database->query($sql);
    while ($row = $query->fetch_row()) {
        echo "
             <p>e-mail użytkownika: $row[0]</p>
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
             <hr>
             ";
    }
} else {
    header("Location: login.html");
}

?>
</body>
</html>