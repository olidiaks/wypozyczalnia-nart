<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Strona główna.</title>
    <link href="../src/style.css" rel="stylesheet" type="text/css">
</head>
<body>


    <div id="header">
        <a href="whats%20actually%20landed.php?isActually=1">Co aktualnie jest wypożyczone.</a>&nbsp;&nbsp;
        <a href="whats%20actually%20landed.php">Co był lub jest wypożyczone.</a>&nbsp;&nbsp;
        <a href="logout.php">Wyloguj się.</a>&nbsp;&nbsp;
    </div>
    <div id="include">
        <?php include("whats actually landed.php") ?>
    </div>

    <div id="footer">
        <a href="add%20skis.html">Dodaj narty</a>&nbsp;&nbsp;
        <a href="add%20helmets.html">Dodaj kaski</a>&nbsp;&nbsp;
        <a href="add%20ski%20pole.html">Dodaj kijki</a>&nbsp;&nbsp;
        <a href="add%20ski%20boots.html">Dodaj buty.</a>&nbsp;&nbsp;
        <a href="lend.php">Wypożycz</a>&nbsp;&nbsp;
    </div>


</body>
<script src="main.js"></script>
</html>