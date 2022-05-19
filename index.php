<?php
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])){
    echo "<a href='login.php'>Czy zalogować cię na konto: {$_COOKIE["email"]}</a>";
    include "login.html";
}
else{
    header("Location: login.html");
}
