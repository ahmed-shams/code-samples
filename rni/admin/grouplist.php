<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");
require_once("../includes/modules/gallery/class.gallery.php");
 require_once(MAIN_CLASS_PATH."email/class.EMail.php");
 require_once("checkadmin.php");
 $_SESSION["S_AToZLetter"] = "";
//require_once("../includes/modules/controller/class.Options.php");

$objAdmin = new Admin();
$objAdmin->setLeftMenu();
$id= $_REQUEST['id'];
$objSmarty->assign("id", $id);
switch($_REQUEST["hdAction"]){
	case "Delete":
		$objAdmin->DeleteGroupList($_REQUEST,"tbl_groups");
		$objSmarty->assign("strMsg","Selected Genre Deleted Successfully!");
		break;
	case "Search":
		$char=$_REQUEST["hSAction"];
		if($_REQUEST['ResetOffset'])
		$_REQUEST["offset"]=0;
		$_SESSION["S_AToZLetter"] = $char;
		$objAdmin->getAlphabetsearch();
		if($char)   
			$objAdmin->getGroupList($char);
		else{
			$objAdmin->getGroupList($char='');
		}
		$objSmarty->assign("char",$_REQUEST["hSAction"]);
		$objSmarty->assign("InnerTpl","grouplist.tpl");
		$objSmarty->display("main.tpl");
		exit;
		break;
		
	case "Active":
		//$objCommon->ActivateInfoFromDB($_REQUEST,"tbl_users");
		$objCommon->ActivateUserInfoFromDB($_REQUEST,"tbl_users");

			/*$objMail  = new EMail();
			$Email=$_REQUEST['txtemail'];
			$UserLogin =  $_REQUEST['txtusername'];
			$Password  = $_REQUEST['txtpassword'];
			$objMail->MailFields["UserLogin"]  = $UserLogin;
			$objMail->MailFields["Password"]  = $Password;
			//$objMail   = new EMail();
			$objMail->Send($Email,"ACTIVATE");*/
		break;
	case "Inactive":
	  	//$objCommon->DeActivateInfoFromDB($_REQUEST,"tbl_users");
		$objCommon->DeActivateUserInfoFromDB($_REQUEST,"tbl_users");
		break;
    case "DeleteSelected":
		$id= $_REQUEST['id'];
		$objSmarty->assign("Delete", 1);
		$objAdmin->DeleteGroup($id);
		$objSmarty->assign("strMsg","Selected Record Deleted Successfully!");
		$Template = "grouplist.tpl";
		break;
}
if($_REQUEST['Add']==1){
		$objSmarty->assign("Add",$_REQUEST['Add']);
		$objSmarty->assign("strMsg","Account Created Successfully!...");
}	

if($_REQUEST['Edit']==1){
		$objSmarty->assign("Edit",$_REQUEST['Edit']);
		$objSmarty->assign("strMsg","Account Updated successfully!...");
}	

$objAdmin->getAlphabetsearch();
$objAdmin->getGroupList($char='');

$objSmarty->assign("InnerTpl","grouplist.tpl");
$objSmarty->display("main.tpl");
?>