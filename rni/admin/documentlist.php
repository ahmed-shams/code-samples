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
		$objAdmin->DeleteDocumentList($_REQUEST,"tbl_documents");
		$objSmarty->assign("strMsg","Selected documents Deleted Successfully!");
		break;
	case "Search":
		$char=$_REQUEST["hSAction"];
		if($_REQUEST['ResetOffset'])
		$_REQUEST["offset"]=0;
		$_SESSION["S_AToZLetter"] = $char;
		$objAdmin->getAlphabetsearch();
		if($char)   
			$objAdmin->getSearchdocumentList($char);
		else{
			$objAdmin->getUserList();
		}
		$objSmarty->assign("char",$_REQUEST["hSAction"]);
		$objSmarty->assign("InnerTpl","documentlist.tpl");
		$objSmarty->display("main.tpl");
		exit;
		break;
		
    case "DeleteSelected":
		$id= $_REQUEST['id'];
		$objSmarty->assign("Delete", 1);		
		$objAdmin->DeleteDocument($id);
		$objSmarty->assign("strMsg","Selected Record Deleted Successfully!");
		$Template = "documentlist.tpl";
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
$objAdmin->getdocumentList();

$objSmarty->assign("InnerTpl","documentlist.tpl");
$objSmarty->display("main.tpl");
?>