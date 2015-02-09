<?
	/**
	 * Project:    Everythinghair.com : MainController Class
	 * File:       class.MainController.php
	 *
	 * @link http://www.everythinghair.com/
	 * @copyright 2001-2005 everythinghair,.
	 * @package everythinghair
	 * @version 1.0.0
	 */
	 
	class MainController extends Common {
		
		function MainController() {
			global $global_config;
			$this->Common();
			$this->AdminTable     = "tbl_Admin_Menu";
			$this->Admin		  = "tbl_Admin";
			$this->User 		  = "tbl_users";
			$this->documents 	  = "tbl_documents";
			$this->documentStatus = "tbl_documentStatus";
			$this->LocalFilePath = $global_config["SiteLocalPath"];		
		}
		
		function DefaultAction() {
		global $objSmarty;
		//$this->setVariable("InnerTpl","content.tpl");
		}
		
		
		/*Add Member Infornation to DB*/
		function AddMemberInfo()	{
		//printArray($_REQUEST);
			if($_REQUEST['hdAction']=="register") {
				if($_REQUEST["RVerification"] != $_SESSION['captcha_code']){
				if($_REQUEST["RVerification"]!=''){
					$objCommon->setInvalidCodeError();
					}
					$objCommon->prePopulateForm();
				} else {					
				$objMain->addUsers($_REQUEST); 
				}
			}
		}
		
		
		/*get User details By Ident*/
		function getUserdetailsByIdent($objArray) {
			global $_SESSION,$objSmarty;
//			printArray();

			
			if($_SESSION['sesUserId']){
				$strSql        = "select * from ".$this->User. " where id='" . $_SESSION['sesUserId']."'" ;
				$UserList      = $this->getSelectByQuery($strSql);
				$objSmarty->assign("UserList",$UserList);		
					
				if ($objArray["hdAction"] != "" and $objArray["hdAction"] == 'ReadDoc')
					$objSmarty->assign("DocStatus","Read");		
				if ($objArray["hdAction"] != "" and $objArray["hdAction"] == 'UnReadDoc')
					$objSmarty->assign("DocStatus","UnRead");		 
				
				$this->getdocumentsuserlistByUserId($_SESSION['sesUserId']);
				
				/*$grouplist = $UserList[0]["grouplist"];
				$grouplist = split('[|]', $grouplist);					
				
				for ($i=0;$i<count($grouplist);$i++) {
					if ($grouplist[$i] != "") {
						$this->getdocumentsuserlistByUserId($grouplist[$i]);
					}
					
				
				}						*/	
				return $UserList;
			}			
		}
		
		/*get document Count list By doc Ident*/
		function getdocumentCountlistByIdent($docIdent) {
			global $_SESSION;
			$strSql        = "select count(*) from ".$this->documentStatus. " where doc_id = '".$docIdent."' and user_id='" . $_SESSION['sesUserId']."'" ;
			$docCountList      = $this->getSelectByQuery($strSql);
			return ($docCountList[0][0]);
		}
		
		/*get documents user list By UserId*/
		function getdocumentsuserlistByUserId($Ident) {
			global $objSmarty;
			$strSql = "SELECT *,LOCATE( '".$Ident."', ".$this->documents.".userlist ) FROM ".$this->documents." where LOCATE( '".$Ident."', ".$this->documents.".userlist ) != 0 ORDER BY id" ;
			$documentsList      = $this->getSelectByQuery($strSql);
			$UsersdocCount     = $this->dbQueryNumRows; 

			$read_doc = $unread_doc = 0;
			$Unreaddoclist = "";
			//printArray($documentsList);
			for ($i=0;$i<$UsersdocCount;$i++) {
				$docId = $documentsList[$i]["id"];	
				$count = $this->getdocumentCountlistByIdent($docId);
				($count > 0) ? $read_doc = $read_doc + 1 			 : $unread_doc = $unread_doc + 1;
				($count > 0) ? $documentsList[$i]["Status"] = "Read" : $documentsList[$i]["Status"] = "UnRead";
				($count > 0) ?  $f = ""		 			 			 : $Unreaddoclist .= "<img src='images/arrow.gif'> ".$documentsList[$i]["documentname"]."<br>";
				
		}			
			$Unreaddoclist = substr($Unreaddoclist,0,strlen($Unreaddoclist)-2);
			$objSmarty->assign("Unreaddoclist",$Unreaddoclist);
			$objSmarty->assign("documentsList",$documentsList);
			$objSmarty->assign("UsersdocCount",$UsersdocCount);
			$objSmarty->assign("read_doc",$read_doc);
			$objSmarty->assign("unread_doc",$unread_doc);
		}
		
		function getdocumentdetailsBydocIdent($Ident)	{
				global $objSmarty;
				$strSql        = "select * from ".$this->documents. " where id='" . $Ident ."'" ;
				$documentlist      = $this->getSelectByQuery($strSql);
				$count = $this->getdocumentCountlistByIdent($Ident);
				($count > 0) ? $documentlist[0]["Status"] = "Read" : $documentlist[0]["Status"] = "UnRead";
				$objSmarty->assign("documentlist",$documentlist);	
				return ($documentlist);							
		}
		
		
		/**
		 * Function to DownLoad a single document 
		 * @param $objArray Array contains $_REQUEST
		 * @return $URL string url of the document file
		 */ 
		function DownLoad_document($objArray){
		global $global_config;
		$rsdocument = $this->getdocumentdetailsBydocIdent($objArray["docIdent"]);
		$Path     = $this->LocalFilePath . "resources/documents/";
		//$Path     = "resources/documents/";
		$docName = $rsdocument[0]["doc_filename"];
		$URL = $Path."org".$docName;
		$docOriginalName = $rsdocument[0]["doc_OriginalName"];
		$URL = $URL."||".$docOriginalName;
		return($URL);
		}
		
		function UpdateDocReadStatus($objArray) {
			$objArray["txt_doc_id"] = $objArray["hddocid"];
			$objArray["txt_user_id"] = $objArray["hdUserid"];
			$objArray["txt_Status"] = "Read";
			$this->AddInfoToDB($objArray,"txt_",$this->documentStatus);
		}
		
		function UpdateDocumentStatusByIdent($objArray) {
			global $objSmarty;
			
			
			$Ident = $_REQUEST["txtid"];
			if ($_REQUEST["txtStatus"] == "UnRead") {
				$Where = " where doc_id = '$Ident' and user_id = '".$_SESSION["sesUserId"]."' ";
				$DelQry = "delete  from $this->documentStatus $Where";
				$this->dbSetQuery($DelQry,"delete");
				$this->dbExecuteQuery();
			}
			

/*			$count = $this->getdocumentCountlistByIdent($Ident);
			($count > 0) ? $read_doc = $read_doc + 1 			 : $unread_doc = $unread_doc + 1;
			($count > 0) ? $documentsList[$i]["Status"] = "Read" : $documentsList[$i]["Status"] = "UnRead";

			
			$objSmarty->assign("read_doc",$read_doc);
			$objSmarty->assign("unread_doc",$unread_doc);*/
			
			$this->getUserdetailsByIdent($_REQUEST);
			
			$objSmarty->assign("InnerTpl","content.tpl");	
			$objSmarty->display("Index.tpl"); 					
		}
		
		function getSearchDocumentList($objArray) {
			global $objSmarty;
			$strSql        = "select * from ".$this->documents. " WHERE documentname LIKE '%".$objArray["textfield"]."%' or doc_description LIKE '%".$objArray["textfield"]."%'  " ;
			$documentsearchlist      = $this->getSelectByQuery($strSql);
			$objSmarty->assign("documentsearchlist",$documentsearchlist);	
			$objSmarty->assign("textfield",$objArray["textfield"]);	
		}
		
		function doAction($objRequest = "") {
			global $global_config,$_SESSION,$_REQUEST,$objSmarty,$_COOKIE;			
			$objCommon = new Common();
			$url=$this->getCurrentUrl();
			$this->setVariable("url",$url);
			if($_REQUEST["op"]) $op=$_REQUEST["op"];
			
			switch($op)	{
				case "UpdateStatus":
					$this->UpdateDocumentStatusByIdent($_REQUEST);
					break;
				case "search":
					$this->getSearchDocumentList($_REQUEST);
					$objSmarty->assign("InnerTpl","searchresult.tpl");	
					$objSmarty->display("Index.tpl"); 														
					break;
				case "listdocs":
					$this->getUserdetailsByIdent($_REQUEST);
					//$this->getdocumentsuserlistByUserId($_REQUEST["hdUserid"]);
				//	$this->setVariable("InnerTpl","listdocumentsgridview.tpl");
					$objSmarty->assign("InnerTpl","listdocumentsgridview.tpl");	
					$objSmarty->display("Index.tpl"); 					
					break;
				case "UpdatePassword":
					$Ident = $_REQUEST["hdUserid"];
					
					$objCommon->UpdateInfoToDB($_REQUEST,"txt_","tbl_users"," where id = '$Ident'");
					//$this->setVariable("InnerTpl","loginpage.tpl");	
					$objSmarty->assign("InnerTpl","loginpage.tpl");	
					$objSmarty->display("Index.tpl"); 										
					break;
				case "listdetaileddocs":
					$this->UpdateDocReadStatus($_REQUEST);
					$this->getdocumentdetailsBydocIdent($_REQUEST["hddocid"]);
					//$this->getdocumentsuserlistByUserId($_REQUEST["hdUserid"]);
					//$this->setVariable("InnerTpl","documentdetailview.tpl");
					$objSmarty->assign("InnerTpl","documentdetailview.tpl");	
					$objSmarty->display("Index.tpl"); 					
					break;
				case "home":
					$this->getUserdetailsByIdent($_SESSION["sesUserId"]);
					$objSmarty->assign("InnerTpl","content.tpl");				
					$objSmarty->display("Index.tpl"); 
					break;				
				case "login":
					require_once(MAIN_MODULES_PATH."main/class.main.php");
					$objSmarty->assign("signintxt","Sign Out");
					$objMain=new Main();			
					$user = $objMain->Login($_REQUEST); 
					switch ($user)	{
						case "1":
							$this->getUserdetailsByIdent($_REQUEST);
							$objSmarty->assign("InnerTpl","content.tpl");				
							$objSmarty->display("Index.tpl"); 
							break;
						case "2":
							//$this->setVariable("InnerTpl","loginpage.tpl");
							$objSmarty->display("Index.tpl"); 
							break;
						case "3":							
							//$objSmarty->assign("InnerTpl","content.tpl");				
							$objSmarty->display("Index.tpl"); 
							break;
						case "4":
							$objSmarty->assign("InnerTpl","changepwd.tpl");				
							$objSmarty->display("Index.tpl"); 						
							break;
					}		
					break;								
				case "forgetpwd":
					if($_REQUEST['hdAction']=="forgot"){
						require_once(MAIN_MODULES_PATH."main/class.main.php");
						$objMain=new Main();
						$objMain->getforgetUserName();
					} else {
						$this->setVariable("InnerTpl","forgetpwd.tpl");
					}
					break;	
				case "register":
					//$this->AddMemberInfo($_REQUEST);

				/*	if($_REQUEST['hdAction']=="register") {
						$objMain=new Main();				
						$objMain->addUsers($_REQUEST); 
					}*/
					
					if($_REQUEST['hdAction']=="register") {
						if($_REQUEST["RVerification"] != $_SESSION['captcha_code']){
						if($_REQUEST["RVerification"]!=''){ 
							$objCommon->setInvalidCodeError();
							}
							$objCommon->prePopulateForm();
						} else {				
						$objMain=new Main();				
						$objMain->addUsers($_REQUEST); 
						}
					}
					$objSmarty->assign("pagename",'register');
					$objSmarty->display("register.tpl");
					break;
				case "Login_Succ":
					$this->setVariable("InnerTpl","thankyou_register.tpl");		
					break;
				case "aboutus":
					$this->setVariable("InnerTpl","Aboutus.tpl");		
					break;
				case "contactus":
					$this->setVariable("InnerTpl","contactus.tpl");		
					break;
				case "privacy":
					$this->setVariable("InnerTpl","privacy.tpl");		
					break;
				case "Loginpage":
					$this->setVariable("InnerTpl","loginpage.tpl");
					break;
				default:				
					$this->DefaultAction();
					break;
			}
			
			//$objSmarty->display("Index.tpl"); 		
			//$this->setTemplate("index.tpl");
		}
		
}
?>