<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");
require_once("checkadmin.php");
require_once("../includes/modules/controller/class.Options.php");

$objAdmin = new Admin();
$objAdmin->setLeftMenu();
$objCommon = new Common();
//$objOptions = new Options();
$objSmarty->assign("Today",date("Y-m-d H:i:s"));
$Ident=$_REQUEST["Ident"];

$txt2_grouplist = $_REQUEST["txt2_grouplist"];
$txtGroup="";
if ($txt2_grouplist){
	 foreach ($txt2_grouplist as $Group){
	 	$txtGroup .= $Group."|";
	 }
}
$_REQUEST["txt2_grouplist"] = $txtGenre;

$txt2_userlist = $_REQUEST["txt2_userlist"];
$newtxtuser="";
if ($txt2_userlist){
	 foreach ($txt2_userlist as $user){
	 	$newtxtuser .= $user."|";
	 }
}
$_REQUEST["txt2_userlist"] = $newtxtuser;

	
	
if($_REQUEST["hdAction1"]=='Add'){
		if(!$_REQUEST["Ident"])
			$Ident=$objCommon->AddInfoToDB($_REQUEST,"txt2_","tbl_documents");			
			$objAdmin->Adddocumentfiles($_REQUEST,$Ident);
			$objSmarty->assign("Ident",$Ident);
			header("location:documentlist.php?Add=1");			
}

$objAdmin->getGroupListforlistbox();
$objAdmin->getuserListforlistbox();


$objSmarty->assign("InnerTpl","adddocument.tpl");
$objSmarty->display("main.tpl");
?>