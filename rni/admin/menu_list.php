<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");
//require_once("../includes/modules/broker/class.broker.php");
require_once("checkadmin.php");

session_unregister("S_Broker_v");
session_unregister("sesLocation");

$objAdmin = new Admin();
$objAdmin->setLeftMenu();

switch($_REQUEST["hdAction"]){
	case "Delete":
		$objAdmin->DeleteMenuList($_REQUEST,"tbl_Admin_Menu ");
		$objSmarty->assign("strMsg","Selected Record(s) Deleted Successfully!");
		break;
	case "Active":
		$objCommon->ActivateMenuInfoFromDB($_REQUEST,"tbl_Admin_Menu ");
		break;
	case "Inactive":
	   $objCommon->DeActivateMenuInfoFromDB($_REQUEST,"tbl_Admin_Menu ");
		break;
    case "DeleteSelected":
		$Ident= $_REQUEST['Ident'];
		$objSmarty->assign("Delete", 1);
		$objAdmin->DeleteMenu($_REQUEST["Ident"]);
		$objSmarty->assign("strMsg","Selected Record Deleted Successfully!");
		$Template = "menu_list.tpl";
		break;
}

$objCommon   = new Common();
//$objMenu	= new Menu();

	switch($haction)
	{
		case 1:
			$UpdateMenuOrderList 	= $objMenu->UpadateMenuOrderList($_POST);
			break;
		case 3:
			$objMenu->DeleteMenu($MenuId,'0');
			$strCommonError 		= $msg_Menu_deleted_successfully;
			break;
	}
//$objBroker = new Broker();
if($_REQUEST['Edit']==1){
		$objSmarty->assign("Edit",$_REQUEST['Edit']);
		$objSmarty->assign("strMsg","Menu Details Updated successfully!...");
}	

$objAdmin->getAllMenu();
$objAdmin->getMenuList();

$objSmarty->assign("MainMenus",$MainMenus);
$objSmarty->assign("InnerTpl","menu_list.tpl");
$objSmarty->display("main.tpl");
?>