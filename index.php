<?php
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])){
    header("Location: login.php");
}
else{
    header("Location: login.html");
}
