<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");
require_once("checkadmin.php");
$objAdmin = new Admin();

$objAdmin->setLeftMenu();
$objAdmin->getUserList();
$objAdmin->getdocumentList();
$objAdmin->getGroupList($char='');

$objSmarty->assign("InnerTpl","content.tpl");
$objSmarty->display("main.tpl");
?>