<?
ob_start();
session_start();
require_once("../includes/common.php");
require_once("../includes/modules/admin/class.admin.php");
require_once("../includes/modules/main/class.main.php");
require_once("checkadmin.php");

$objAdmin = new Admin();
$objAdmin->setLeftMenu();
$objCommon = new Common();
$objMain = new Main();
$daysList=$objCommon->daysGet();
$yearList=$objCommon->yearsGet();
$monthsList=$objCommon->monthsGet();
$objAdmin->getStateList();

$objSmarty->assign("daysList",$daysList);
$objSmarty->assign("monthsList",$monthsList);
$objSmarty->assign("yearList",$yearList);
$objSmarty->assign("id",$_REQUEST["id"]);

$txtgrouplist = $_REQUEST["txtgrouplist"];
$newtxtGenre="";
if ($txtgrouplist){
	 foreach ($txtgrouplist as $Group){
	 	$newtxtGenre .= $Group."|";
	 }
}
$_REQUEST["txtgrouplist"] = $newtxtGenre;


switch($_REQUEST["hdAction"]){
	case "Add":
		$Add=$objAdmin->addUser($_REQUEST);
		if($Add==1){
			header("location:userlist.php?Add=1");
		}elseif($Add==2){
			$objSmarty->assign("strMsg","User Name Alreay Exist...");
		}	
		break;	
	//default:
		//$Template = "userlist.tpl";
}

$objAdmin->getGroupListforlistbox();

//$objAdmin->getUserEdit($_REQUEST["id"]);
$objSmarty->assign("InnerTpl","add_member.tpl");
$objSmarty->display("main.tpl");
?>