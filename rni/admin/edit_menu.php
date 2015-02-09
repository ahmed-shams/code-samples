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
	case "Delete":
		$objAdmin->DeleteMenulist($_REQUEST,"tbl_Admin_Menu");
		$objSmarty->assign("strMsg","Selected Record(s) Deleted Successfully!");
		break;
	case "Active":
		$objCommon->ActivateInfoFromDB($_REQUEST,"tbl_Admin_Menu");
		$objAdmin->ActivateUserInfoFromDB($_REQUEST,"tbl_User","Menu");
		break;
	case "Inactive":
	   $objCommon->DeActivateInfoFromDB($_REQUEST,"tbl_Admin_Menu");
		$objAdmin->DeActivateUserInfoFromDB($_REQUEST,"tbl_User","Menu");
		break;
 
	
	case "Update":
		
		$objSmarty->assign("Update", 1);
		$Ident= $_REQUEST['Ident'];
		$objCommon->UpdateInfoToDB($_REQUEST,"txt","tbl_Admin_Menu"," where Ident = '$Ident'");
		header("location:menu_list.php?Edit=1&menu_types=" . $_REQUEST['menu_types']);
		break;	
	default:
		$Template = "memberlist.tpl";
}
$objAdmin->getMenuEdit($_REQUEST["Ident"]);
$objSmarty->assign("InnerTpl","edit_menu.tpl");
$objSmarty->display("main.tpl");
?>