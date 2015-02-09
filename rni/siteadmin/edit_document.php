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
$objSmarty->assign("Today",date("Y-m-d H:i:s"));

$objSmarty->assign("id",$_REQUEST["id"]);

$txt2_grouplist = $_REQUEST["txt2_grouplist"];
$newtxtGenre="";
if ($txt2_grouplist){
	 foreach ($txt2_grouplist as $Group){
	 	$newtxtGenre .= $Group."|";
	 }
}
$_REQUEST["txt2_grouplist"] = $newtxtGenre;

$txt2_userlist = $_REQUEST["txt2_userlist"];
$newtxtuser="";
if ($txt2_userlist){
	 foreach ($txt2_userlist as $user){
	 	$newtxtuser .= $user."|";
	 }
}
$_REQUEST["txt2_userlist"] = $newtxtuser;


switch($_REQUEST["hdAction"]){
	case "Update":
		$objSmarty->assign("Update", 1);
		$Ident= $_REQUEST['id'];
		$objCommon->UpdateInfoToDB($_REQUEST,"txt2_","tbl_documents"," where id = '$Ident'");
		if ($_FILES["txt2_doc_filename"]["name"] != "") {
			$objAdmin->Adddocumentfiles($_REQUEST,$Ident);
		}
		header("location:documentlist.php?Edit=1");
		break;	
	default:
		$Template = "documentlist.tpl";
}

$objAdmin->getGroupListforlistbox();
$objAdmin->getuserListforlistbox();
$objAdmin->getDocumentEdit($_REQUEST["id"]);


$objSmarty->assign("InnerTpl","edit_document.tpl");
$objSmarty->display("main.tpl");
?>