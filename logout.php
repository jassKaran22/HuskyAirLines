<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['id']);
unset($_SESSION['login']);
session_destroy();

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/");
exit;
?>
