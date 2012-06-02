<?php
session_start();
$_SESSION['id']="";
$_SESSION['authlevel']="";
header('location: login.php');
?>
