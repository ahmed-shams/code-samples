<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");

$objAdmin = new Admin();
$objAdmin->AdminLogin();

$objSmarty->assign("InnerTpl","content.tpl");
$objSmarty->display("index.tpl");
?>