<?php
session_start();
$_SESSION['id'] = null;
$_SESSION['role'] = null;

setcookie("email", "" ,1);
setcookie("password", "" ,1);

header("Location: login.html");

