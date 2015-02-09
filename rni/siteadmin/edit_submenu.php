<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");
require_once("checkadmin.php");

$objAdmin = new Admin();
$objAdmin->setLeftMenu();
$objCommon = new Common();

$objSmarty->assign("Ident",$_REQUEST["Ident"]);

switch($_REQUEST["hdAction"]){
	case "Update":
		$objSmarty->assign("Update", 1);
		$Ident= $_REQUEST['Ident'];
		$objCommon->UpdateInfoToDB($_REQUEST,"txt","tbl_Admin_Menu"," where Ident = '$Ident'");
		$objAdmin->getMenuEdit($_REQUEST["Ident"]);
		$objSmarty->assign("strMsg", "Your Menu has been Updated Successfully");
		header("location:menu_list.php?Edit=1");
		break;	
}
$objAdmin->getSubMenuEdit($_REQUEST["Ident"]);
$objSmarty->assign("InnerTpl","edit_submenu.tpl");
$objSmarty->display("main.tpl");
?>