<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");
require_once("checkadmin.php");

$objAdmin = new Admin();
$objCommon   = new Common();
$objAdmin->setLeftMenu();

switch($_REQUEST["SubMenuType"])
{
	case "SubMenu":
	$Ident = $_REQUEST["Ident"];
	$objAdmin->getSubMenu($Ident);
	break;
}

switch($_REQUEST["hdAction"])
{
	case "Edit":
	$Ident = $_REQUEST["Ident"];
	$objAdmin->getSubMenuEdit($Ident);
	header("location:edit_submenu.tpl");
	break;
}

$objSmarty->assign("InnerTpl","Submenu.tpl");
$objSmarty->display("main.tpl");
?>