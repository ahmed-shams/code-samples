<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");
require_once("checkadmin.php");

$objAdmin = new Admin();
$objAdmin->setLeftMenu();
$objCommon = new Common();
$objAdmin->getStateList();

$objSmarty->assign("id",$_REQUEST["id"]);

$txtgrouplist = $_REQUEST["txtgrouplist"];
$newtxtGenre="";
if ($txtgrouplist){
	 foreach ($txtgrouplist as $Group){
	 	$newtxtGenre .= $Group."|";
	 }
}
$_REQUEST["txtgrouplist"] = $newtxtGenre;


$txtdocumentslist = $_REQUEST["documentslist"];
$newtxtdoc="";
if ($txtdocumentslist){
	 foreach ($txtdocumentslist as $doc){
	 	$newtxtdoc .= $doc."|";
	 }
}
$_REQUEST["Newdocumentslist"] = $newtxtdoc;



switch($_REQUEST["hdAction"]){
	case "Update":
		$objSmarty->assign("Update", 1);
		$Ident= $_REQUEST['id'];
		$objAdmin->AssignDocumentsTousers($_REQUEST);
		$objCommon->UpdateInfoToDB($_REQUEST,"txt","tbl_users"," where id = '$Ident'");
		if($_REQUEST['prev_status']!=$_REQUEST['txtStatus'])
		{
							$objMail  = new EMail();
							$Email=$_REQUEST['txtemail'];
							$UserLogin =  $_REQUEST['txtusername'];
							$Password  = $_REQUEST['txtpassword'];
							$objMail->MailFields["UserLogin"]  = $UserLogin;
							$objMail->MailFields["Password"]  = $Password;
							if($_REQUEST['prev_status']=='Active')
								$objMail->Send($Email,"DEACTIVATE");		
							if($_REQUEST['prev_status']=='Inactive')
								$objMail->Send($Email,"ACTIVATE");	
		
		}
		header("location:userlist.php?Edit=1");
		break;	
	default:
		$Template = "userlist.tpl";
}

$objAdmin->getGroupListforlistbox();
$objAdmin->getDocumentListforlistbox();
$objAdmin->getUserEdit($_REQUEST["id"]);
$objSmarty->assign("InnerTpl","edit_user.tpl");
$objSmarty->display("main.tpl");
?>