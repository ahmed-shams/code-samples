<?
ob_start();
session_start();
include "includes/common.php";

	$objSmarty->assign("pagename",'register');

	$objSmarty->display("register.tpl");
	
?>