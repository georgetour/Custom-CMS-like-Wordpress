<?php
      include 'db_connect.php';
      include '../functions.php';

session_start();

$_SESSION['username'] = null;
$_SESSION['user_first_name'] = null;
$_SESSION['user_last_name'] = null;
$_SESSION['user_role'] = null;

header("Location: ../index.php");



?>