<?php

require "../utils/Auth.php";
session_start();
$logout = new Auth();
$logout->logout();
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>