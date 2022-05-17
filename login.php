<?php

if (isset($_POST['e-mail']) && isset($_POST['password'])) {
    $email = $_POST['e-mail'];
    $password = $_POST['password'];
    include 'database.php';
    echo $sql = "select * from Users where email = '$email' and password = '$password';";
    /** @noinspection PhpUndefinedVariableInspection */
    $query = $database->query($sql) or die('Nie udał się wyciągnąć z bazy danych id użytkownika.<br>' . $database->error);
    $num_rows = $query->num_rows or die('Nie udało się policzyć ilu jest użytkowników o podanych danych<br>' . $database->error);
    $database->close() or die('Nie udało się poprawnie zamknąć połączenia z bazą danych<br>' . $database->error);
    if ($num_rows == 1) {
        session_start();
        $_SESSION['id'] = $query->fetch_array()['id'] or die('Nie udał się przypisać id użytkownika do sesji.<br>');
        $_SESSION['role'] = $query->fetch_array()['role'] or die('Nie udał się przypisać id użytkownika do sesji.<br>');
        if (isset($_POST['ogin-remember'])){
            setcookie("email", $email, strtotime('+ 1 year'));
            setcookie("password", $password, strtotime('+ 1 year', $secure = true));
        }
        header("Location: main.html");
    } else {
        include 'login.html';
        echo '<p>E-mail lub hasło są nie poprawne.</p>';
    }
} else {
    include 'login.html';
    echo '<p>Nie podano żadnych danych do logowania.</p>';
}