<?
ob_start();
session_start();
include "includes/common.php";
require_once("includes/modules/admin/class.admin.php");
require_once("includes/modules/controller/class.MainController.php");
require_once("includes/modules/main/class.main.php");

require_once("includes/classes/common/class.Common.php");

$objController 	= new MainController();
$objMain 	   	= new Main();
$objAdmin 	   	= new Admin();
$objAdmin->getStateList();

$objSmarty->assign("SiteScriptFolder",$global_config["SiteScriptFolder"]);
$objSmarty->assign("SiteStylesFolder",$global_config["SiteStylesFolder"]);
$objSmarty->assign("SiteGlobalPath",$global_config["SiteGlobalPath"]);

$objSmarty->assign("SEO_URL",$global_config["SEO_URL"]);

//printArray($_REQUEST);
//printArray($_SESSION);

switch ($_REQUEST["op"]) {
	case "Sign Out":
	case "Loginpage":	
		$objSmarty->assign("pagename",'signin');
		$objSmarty->assign("signintxt","Sign In");		
		$objSmarty->display("Index.tpl");
		unset($_SESSION['visitorname']);
		unset($_SESSION['sesUserId']);
		break;	
	case "Sign In":
		$objSmarty->assign("pagename",'signin');
		$objSmarty->assign("signintxt","Sign In");		
		$objSmarty->display("Index.tpl");
		break;
	case "forgetpwd":
		$objSmarty->assign("pagename",'forgotpwd');
		$objSmarty->assign("signintxt","Sign In");
		$objSmarty->assign("InnerTpl","forgetpwd.tpl");				
		$objSmarty->display("Index.tpl"); 
		break;
}

if ($_SESSION["visitorname"] != "") {
	$objSmarty->assign("signintxt","Sign Out");
	$userid = $_SESSION["sesUserId"];
	$objSmarty->assign("userid",$userid);
//	$_REQUEST["op"] = 'listdocs';
	$userlist = $objController->getUserdetailsByIdent($_REQUEST);
} else {
	$objSmarty->assign("LoggedIn","0");
	$objSmarty->assign("signintxt","Sign In");
}	

$objSmarty->assign("sesUserId",$_SESSION["sesUserId"]);

$objController->doAction($_REQUEST);



if ($_REQUEST["op"] == "") { 
	$objSmarty->assign("pagename",'signin');
	$objSmarty->assign("signintxt","Sign In");	
	$objSmarty->display("Index.tpl"); 
}
?>