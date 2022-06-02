<?php
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])){
    header("Location: dist/login.php");
}
else{
    header("Location: dist/login.html");
}
