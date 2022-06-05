<?php

if ((isset($_POST['e-mail']) && isset($_POST['password'])) ||
    (isset($_COOKIE['email']) && isset($_COOKIE['password']))) {
    $email = $_POST['e-mail'] ?? $_COOKIE['email'];
    $password = $_POST['password'] ?? $_COOKIE['password'];
    include 'database.php';
    $sql = "select * from Users where email = '$email' and password = '$password';";
    /** @noinspection PhpUndefinedVariableInspection */
    $query = $database->query($sql) or die('Nie udał się wyciągnąć z bazy danych id użytkownika.<br>' . $database->error);
    $database->close() or die('Nie udało się poprawnie zamknąć połączenia z bazą danych<br>' . $database->error);
    if ($query->num_rows == 1) {
        session_start();
        $row = $query->fetch_array();
        $_SESSION['id'] = $row['id'] or die('Nie udał się przypisać id użytkownika do sesji.<br>');
        $_SESSION['role'] = $row['role'] or die('Nie udał się przypisać id użytkownika do sesji.<br>');
        if (isset($_POST['remember'])){
            setcookie("email", $email, strtotime('+ 1 year'));
            setcookie("password", $password, strtotime('+ 1 year',));
        }
        header("Location: main.php");
    } else {
        include 'login.html';
        echo '<p>E-mail lub hasło są nie poprawne.</p>';
    }
} else {
    include 'login.html';
    echo '<p>Nie podano żadnych danych do logowania.</p>';
}