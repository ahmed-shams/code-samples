<?
ob_start();
session_start();

$_SESSION['username'] = "";
header("location:index.php");
?>