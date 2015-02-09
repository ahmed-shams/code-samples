<?
	/**
	 * Project:    Everythinghair.com : MainController Class
	 * File:       class.MainController.php
	 *
	 * @link http://www.Everythinghair.com./
	 * @copyright 2001-2005 Everythinghair.com,.
	 * @package Everythinghair
	 * @version 1.0.0
	 */
define('PICTURE_TYPE_GIF', 1);
define('PICTURE_TYPE_JPG', 2);
define('PICTURE_TYPE_PNG', 3);


    require_once(MAIN_CLASS_PATH."email/class.EMail.php");
	class Admin extends Common {
		function Admin() {
			$this->Common();
			$this->AdminTable   	= "tbl_Admin_Menu";
			$this->Admin			= "tbl_admin";
			$this->MenuList       	= "tbl_Admin_Menu";
			$this->User 		  	= "tbl_users";
			$this->Group 			= "tbl_groups";
			$this->documents		= "tbl_documents";
			$this->documentStatus	= "tbl_documentStatus";
		}
		
		
		/** -------------------------Document Add/Edit Functions START-----------------------------------------*/
		
		
		
		
		/*Get the document details for editing*/
		function getDocumentEdit($Ident){
			global $_REQUEST,$objSmarty;
			$strSql           = "select * from ".$this->documents." where id = '".$Ident."'";
			$documentList    = $this->getSelectByQuery($strSql);
			$documentList = $this->getRemoveSlashes($documentList);
		
			$grouplist = explode('|',$documentList[0]["grouplist"]);
			$objSmarty->assign("grouplist",$grouplist);

			$userlist = explode('|',$documentList[0]["userlist"]);
			$objSmarty->assign("userlist",$userlist);

			$objSmarty->assign("documentList", $documentList);
		}
		
		/*get Document details By Ident*/
		function getDocumentdetailsByIdent($Ident) {
			$strSql           = "select * from ".$this->documents." where id = '".$Ident."'";
			$documentList    = $this->getSelectByQuery($strSql);
			return ($documentList);
		}
		
		/**Delete the document from DB and resources directory*/
		function DeleteDocument($Ident){
			$documentList = $this->getDocumentdetailsByIdent($Ident);
			
			if ($documentList[0]["doc_filename"] != "") {
				$docname="../resources/documents/org".$documentList[0]["doc_filename"];			
				if (file_exists($docname)) @unlink($docname);								
			}
			
			$DelQry1 = "delete  from ".$this->documents." where id = '$Ident'";
			$this->dbSetQuery($DelQry1,"delete");
			$this->dbExecuteQuery();
		}
		
		/*Delete all selected documents*/
		function DeleteDocumentList($objArray,$TableName){
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				if($Ary[$i]!=""){
					$Ident = $Ary[$i];
					$this->DeleteDocument($Ident);
				}
			}
		}
		

		
		/*Add document temporary/original name to the DB and copy the doc to resources directory*/
		function Adddocumentfiles($objArray,$Ident){
			$InsertId = $Ident;
			$name1="";

 			if($_FILES["txt2_doc_filename"]["name"])
						{					
							$SourcePath	=$_FILES["txt2_doc_filename"]["tmp_name"];
							$name=$_FILES["txt2_doc_filename"]["name"];
							$extAry=explode(".",$name);
							$ext = $extAry[1];
							$name = $InsertId.".".$ext;
							$nameOrg = "org".$InsertId.".".$ext;
							$nameOrg1="../resources/documents/".$nameOrg;
							copy($SourcePath,$nameOrg1);
						}
			$Where = " where id =" . $InsertId;
			$UpdateArray[0]["Field"] = "doc_filename";
			$UpdateArray[0]["Value"] = $name;
			
			$UpdateArray[1]["Field"] = "doc_OriginalName";
			$UpdateArray[1]["Value"] = $_FILES["txt2_doc_filename"]["name"];
			
			$this->doUpdate($this->documents,$UpdateArray,$Where);	
		}
		
		function getdocumentList() {
			global $_REQUEST,$objSmarty, $global_config;

			$sort = $_REQUEST["sort"];
			$type = $_REQUEST["type"];
			
			$objSmarty->assign("sort",$sort);
			$objSmarty->assign("type",$type);

			if($sort!="" && $type!=""){
				$OrderBy = " order by $sort $type";
			}
			else
				$OrderBy = " order by id desc";
			
				
			#######################################
			if($RowDisplay == '') $RowDisplay =$global_config["AdminRowDisplay"];
			$strSql      = "select * from ".$this->documents ; 
			$UserList1  = $this->getSelectByQuery($strSql);
			$UserCount1 = $this->dbQueryNumRows;
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage_MemberList($_REQUEST,$RowDisplay,$strSql);
			$this->perPageList($RowDisplay);
			#######################################
			$strSql      = "select * from ".$this->documents .$OrderBy. $Qry_limit;
			
			$documentList  = $this->getSelectByQuery($strSql);
			$documentCount = $this->dbQueryNumRows;
			
			//printArray($documentList);
			
			
			$objSmarty->assign("documentList", $documentList);
			$objSmarty->assign("documentCount", $documentCount);
			$objSmarty->assign("documentCount1", $documentCount);
			return($documentList);
		}
		
		
		/*get Document wise Status List*/
		function getDocumentwiseStatusList() {
			global $_REQUEST,$objSmarty, $global_config;
			$strSql      = "select * from ".$this->documents." ";			
			$docsList  = $this->getSelectByQuery($strSql);
			$docsCount = $this->dbQueryNumRows;
			for ($i=0;$i<$docsCount;$i++) {
				$docIdent = $docsList[$i]["id"];
				$Userlist = array_unique(explode("|",$docsList[$i]["userlist"]));
				$UserfullName = $ReadUserfullName = $UnreadUserfullName = "";
				for ($j=0;$j<count($Userlist);$j++) {
					if ($Userlist[$j] != "")	{
						$UsersName = $this->getUserNameByIdent($Userlist[$j]);						
						$fullName = $UsersName[0]["firstname"]." ".$UsersName[0]["lastname"]."<br>";
						$UserfullName .= $fullName;

						/*Get Users who read this document*/
						$DocreadStatus = $this->getDocumentreadstatusByDocId($docIdent,$Userlist[$j]);	
						($DocreadStatus[0][0] > 0) ? $ReadUserfullName .= $fullName : $UnreadUserfullName .= $fullName;
					}
				}
				
				$docsList[$i]["UserName"] = substr($UserfullName,0,strlen($UserfullName)-4);
				$docsList[$i]["ReadUserfullName"] = substr($ReadUserfullName,0,strlen($ReadUserfullName)-4);
				$docsList[$i]["UnreadUserfullName"] = substr($UnreadUserfullName,0,strlen($UnreadUserfullName)-4);
			}
			$objSmarty->assign("docsList", $docsList);
//			printArray($docsList);				
		}
		
		
		
		
		/*get Group wise User List*/
		function getGroupwiseUserList() {
			global $_REQUEST,$objSmarty, $global_config;
			$strSql      = "select * from ".$this->Group." ";			
			$GroupList  = $this->getSelectByQuery($strSql);
			$GrpsCount = $this->dbQueryNumRows;
			for ($i=0;$i<$GrpsCount;$i++) { /*Group Array*/
				$UserDetails = $this->getUsersByGroupIdent($GroupList[$i]["id"]);
				$fullname = $FuserDetails = "";
				for ($j=0;$j<count($UserDetails);$j++)	{ /*User of the Group*/
					$UserIdent  = $UserDetails[$j]["id"];	
					$usename = $UserDetails[$j]["firstname"]." ".$UserDetails[$j]["lastname"];
					
					$DocumentDetails = $this->getDocumentsAssignedByUserIdent($UserIdent);					
					$documentsAssigned = $readdocumentslist = $unreaddocumentslist = "";
					if ($UserIdent != "")	{
						for ($k=0;$k<count($DocumentDetails);$k++) { /*User document*/
							$documentsAssigned .= $DocumentDetails[$k]["doc_OriginalName"]."<br>";
							$documentsread = $this->getDocumentreadstatusByDocId($DocumentDetails[$k]["id"],$UserIdent);
							if ($documentsread[0][0] > 0) {
								$readdocumentslist .= $DocumentDetails[$k]["doc_OriginalName"]."<br>";
							} else {
								$unreaddocumentslist .= $DocumentDetails[$k]["doc_OriginalName"]."<br>";
							}				
						}	
					}	else {
						$documentsAssigned = $readdocumentslist = $unreaddocumentslist = $usename = "";
					}
					
					
					$FuserDetails[$j]["Name"] 				= $usename;
					$FuserDetails[$j]["documentsAssigned"] 	= $documentsAssigned;
					$FuserDetails[$j]["readdocumentslist"] 	= $readdocumentslist;
					$FuserDetails[$j]["unreaddocumentslist"] = $unreaddocumentslist;
					
					
				}	
			$documentsAssigned = $readdocumentslist = $unreaddocumentslist = "";
			$GroupList[$i]["Userlist"] = $FuserDetails; // trim(substr($fullname,0,strlen($fullname)-4));
		
			}
		//	printArray($GroupList[0]["Userlist"]);			
			
			$objSmarty->assign("GroupList", $GroupList);			
		}
		
		/*get Users By Group Ident*/
		function getUsersByGroupIdent($Ident) {
			$strSql = "SELECT id,firstname,lastname,email,created_on,Status,FIND_IN_SET('".$Ident."',REPLACE(".$this->User.".grouplist, '|', ',')) as docset FROM ".$this->User." where FIND_IN_SET('".$Ident."',REPLACE(".$this->User.".grouplist, '|', ','))!= 0";
			$UserDetails    = $this->getSelectByQuery($strSql);
			$UsersCount     = $this->dbQueryNumRows; 	
			return ($UserDetails);
		}
		
		/*get User Name By Ident*/
		function getUserNameByIdent($Ident) {
			$strSql      = "select id,firstname,lastname from ".$this->User." WHERE id = ".$Ident." ";		
			$UsersList  = $this->getSelectByQuery($strSql);
			return $UsersList;
		}
		/*get User Document Status List*/
		
		function getUserDocumentStatusList() {
			global $_REQUEST,$objSmarty, $global_config;
			$strSql      = "select * from ".$this->User." ";			
			$usersList  = $this->getSelectByQuery($strSql);
			$usersCount = $this->dbQueryNumRows;
			for ($i=0;$i<$usersCount;$i++) {
				$UserIdent = $usersList[$i]["id"];
				$documentsAssigned = "";
				$readdocumentslist = "";
				$unreaddocumentslist = "";
				$DocumentDetails = $this->getDocumentsAssignedByUserIdent($UserIdent);
				for ($j=0;$j<count($DocumentDetails);$j++) {
					$documentsAssigned .= $DocumentDetails[$j]["doc_OriginalName"]."<br>";
					$documentsread = $this->getDocumentreadstatusByDocId($DocumentDetails[$j]["id"],$UserIdent);
					if ($documentsread[0][0] > 0) {
						$readdocumentslist .= $DocumentDetails[$j]["doc_OriginalName"]."<br>";
					} else {
						$unreaddocumentslist .= $DocumentDetails[$j]["doc_OriginalName"]."<br>";
					}				
				}				
				$usersList[$i]["documentsAssigned"] = substr($documentsAssigned,0,strlen($documentsAssigned)-4);	
				$usersList[$i]["readdocumentslist"] = substr($readdocumentslist,0,strlen($readdocumentslist)-4);	
				$usersList[$i]["unreaddocumentslist"] = substr($unreaddocumentslist,0,strlen($unreaddocumentslist)-4);
//				printArray($DocumentDetails);
			}
			$objSmarty->assign("UserList", $usersList);
//			printArray($usersList);
		}
		
		/*get Documents Assigned By User Ident*/
		function getDocumentsAssignedByUserIdent($Ident) {
			$strSql = "SELECT id,doc_OriginalName,FIND_IN_SET('".$Ident."',REPLACE(".$this->documents.".userlist, '|', ',')) as docset FROM `tbl_documents` where FIND_IN_SET('".$Ident."',REPLACE(".$this->documents.".userlist, '|', ','))!= 0";
			$DocumentDetails    = $this->getSelectByQuery($strSql);
			$docCount     = $this->dbQueryNumRows; 	
			return ($DocumentDetails);
		}
		
		/*ge tDocument read/unread status By DocId*/
		function getDocumentreadstatusByDocId($Ident,$UserIdent)	{
			$strSql           = "select count(*) from ".$this->documentStatus." where doc_id = '".$Ident."' and user_id = '".$UserIdent."' ";
			$documentList    = $this->getSelectByQuery($strSql);
			return ($documentList);
		}
		
		/*get Search documents List*/
		function getSearchdocumentList($char,$Status=''){
            global $_REQUEST,$objSmarty,$global_config;
			//$objAdmin=new Admin();
			
			$Character=trim($char);
			
			if($Character=="all")
			$Character='';

			if($Status!=''){
				$Where= " where Status ='".$Status."' and  ";
			}else{
				$Where=" where";
			}
			
			if($Character!=""){
				if(strlen($Character)>1)
					$Where = $Where." documentname  like  '%$Character%' ";
				else
					$Where = $Where. "  documentname  REGEXP  '^$Character'";
			}
			
			$sort = $_REQUEST["sort"];
			$type = $_REQUEST["type"];
			
			$objSmarty->assign("sort",$sort);
			$objSmarty->assign("type",$type);
			$objSmarty->assign("hdAction",$_REQUEST[hdAction]);
			
			if($sort!="" && $type!=""){
				$OrderBy = " order by $sort $type";
			}
			else
				$OrderBy = " order by id desc";
			#################################
				
			if($RowDisplay == '') $RowDisplay =$global_config["AdminRowDisplay"];
			$strSql      = "select * from ".$this->documents. $Where ; 
			$UserLists  = $this->getSelectByQuery($strSql);
			$UserCount1 = $this->dbQueryNumRows;
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage_MemberList($_REQUEST,$RowDisplay,$strSql);
			$this->perPageList($RowDisplay);
			#######################################
			$strSql      = "select * from ".$this->documents .$Where.$OrderBy. $Qry_limit;
			
			$documentList  = $this->getSelectByQuery($strSql);
			$documentCount = $this->dbQueryNumRows;
			$objSmarty->assign("documentList", $documentList);
			$objSmarty->assign("documentCount", $documentCount);
			$objSmarty->assign("documentCount1", $documentCount);
			return($documentList);
			
		}
		
		function getDocumentListforlistbox()	{
			global $objSmarty;
			
			$strSql      = "select * from ".$this->documents." ";
			$documents   = $this->getSelectByQuery($strSql);
			$documentsCount = $this->dbQueryNumRows;

			for($i=0;$i<$documentsCount;$i++){
				$documentsValue[$i]	=	$documents[$i]['documentname'];
				$documentsId[$i]	=	$documents[$i]['id'];
			}
			
	
			$objSmarty->assign("documentsValue",$documentsValue);
			$objSmarty->assign("documentsId",$documentsId);
			
		}
		
		function AssignDocumentsTousers($ObjArray) {
			$totalDocCount = count($ObjArray["documentslist"]);
			$id = $_REQUEST["id"];
			
			$strSql = "SELECT id,FIND_IN_SET('".$id."',REPLACE(".$this->documents.".userlist, '|', ',')) as docset FROM `tbl_documents` where FIND_IN_SET('".$id."',REPLACE(".$this->documents.".userlist, '|', ','))!= 0";
			$DocumentDetails    = $this->getSelectByQuery($strSql);
			$docCount     = $this->dbQueryNumRows; 

			if ($docCount == 0) {
				for ($i=0;$i<count($ObjArray["documentslist"]);$i++)	{
					$Ident = $ObjArray["documentslist"][$i];
					$doclist = $this->getDocumentdetailsByIdent($Ident);
					$userlist = $doclist[0]["userlist"];
					$userlist = $userlist.$id."|";

					$Where = " where id ='".$Ident."' ";
					$UpdateArray[0]["Field"] = "userlist";
					$UpdateArray[0]["Value"] = $userlist;
					$this->doUpdate($this->documents,$UpdateArray,$Where);				
				}
			} else {

				for ($i=0;$i<$docCount;$i++) {
					$documentlist[$i] = $DocumentDetails[$i]["id"];
				}
				
				$rmuserid  = array_diff($documentlist,$ObjArray["documentslist"]);			
				$Adduserid = array_diff($ObjArray["documentslist"],$documentlist);
	
				if (!empty($Adduserid)) { //Not Emty then
					for ($i=0;$i<$totalDocCount;$i++)	{
						if ($Adduserid[$i] != "")	{
							$docIdent = $Adduserid[$i];
							$docDetails = $this->getDocumentdetailsByIdent($docIdent);  //get Document details By Ident
							$str = $docDetails[0]["userlist"];
							$strAry = split('[|]', $str);	
							$userlist = (in_array($id, $strAry)) ? $str : $docDetails[0]["userlist"].$id."|";
			
							$Where = " where id ='".$docIdent."' ";
							$UpdateArray[0]["Field"] = "userlist";
							$UpdateArray[0]["Value"] = $userlist;
							$this->doUpdate($this->documents,$UpdateArray,$Where);	
						}	
					}						
				}
					
	
				if (!empty($rmuserid)) { //Not Emty then
					for ($i=0;$i<$docCount;$i++)	{
						if ($rmuserid[$i] != "")	{
							$docIdent = $rmuserid[$i];
							$docDetails = $this->getDocumentdetailsByIdent($docIdent);  //get Document details By Ident
							$str = $docDetails[0]["userlist"];
							$strAry = split('[|]', $str);	
							
							foreach($strAry as $key => $value) {
								if($value == $id or $value == "") {
									unset($strAry[$key]);
								} else {
									$userlist .=  $value."|";
								}
							}
							$userlist = (in_array($id, $strAry)) ? $docDetails[0]["userlist"] : $userlist;
	
							$Where = " where id ='".$docIdent."' ";
							$UpdateArray[0]["Field"] = "userlist";
							$UpdateArray[0]["Value"] = $userlist;
							$this->doUpdate($this->documents,$UpdateArray,$Where);	
						}	
					}						
				}
			
			}
		}
		

		
		
		/** -------------------------Document Add/Edit Functions END--------------------------------*/
		
		/** -------------------------Group Functions START-----------------------------------------*/
		
		function getGroupListforlistbox()	{
			global $objSmarty;
			
			$strSql      = "select * from ".$this->Group." ";
			$Group   = $this->getSelectByQuery($strSql);
			$GroupCount = $this->dbQueryNumRows;

			for($i=0;$i<$GroupCount;$i++){
				$GroupValue[$i]	=	$Group[$i]['Value'];
				$GroupId[$i]	=	$Group[$i]['id'];
			}
			
	
			$objSmarty->assign("GroupValue",$GroupValue);
			$objSmarty->assign("GroupId",$GroupId);
			
		}
		
		
		/*Add New Group to the List*/
		function AddNewGroupInfo($objArray)	{
			$this->AddInfoToDB($_REQUEST,"txt2_","tbl_groups");		
		}
		
		/*Delete Group from the List*/
		function DeleteGroupList($objArray,$TableName){
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where id = '$DelId'";
					$DelQry = "delete  from $TableName where id = '$DelId'";
					$this->dbSetQuery($DelQry,"delete");
					$this->dbExecuteQuery();
				}
			}
		}
		
		
		
		/*Update Group List*/
		function UpdateGroup($objArray)	{
			$Where = " where id ='".$objArray["id"]."' ";
			$UpdateArray[0]["Field"] = "Value";
			$UpdateArray[0]["Value"] = $objArray["Value"];
			//printArray($UpdateArray);
			$this->doUpdate($this->Group,$UpdateArray,$Where);				
		}		
		
		/*Get Group List*/
		function getGroupList($char){
            global $_REQUEST,$objSmarty,$global_config;
			//$objAdmin=new Admin();
			
			 $Character=trim($char);
			
			if($Character=="all")
			 $Character='';

			
			if($Character!=""){
				if(strlen($Character)>1)
					$Where = " where Value  like  '%$Character%' ";
				else
					$Where = " where Value  REGEXP '^$Character' ";
			}

			$sort = $_REQUEST["sort"];
			$type = $_REQUEST["type"];
			
			$objSmarty->assign("sort",$sort);
			$objSmarty->assign("type",$type);

			if($sort!="" && $type!=""){
				$OrderBy = " order by $sort $type";
			}
			else
				$OrderBy = " order by id desc";
			
				
			#######################################
			if($RowDisplay == '') $RowDisplay =$global_config["AdminRowDisplay"];
			$strSql      = "select * from ".$this->Group." " . $Where; 
			$GroupList1  = $this->getSelectByQuery($strSql);
			$GenreCount1 = $this->dbQueryNumRows;
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage_MemberList($_REQUEST,$RowDisplay,$strSql);
			$this->perPageList($RowDisplay);
			#######################################
			$strSql      = "select * from ".$this->Group .$Where .$OrderBy. $Qry_limit ;
			
			$GroupList  = $this->getSelectByQuery($strSql);
			$GroupCount = $this->dbQueryNumRows;
			$objSmarty->assign("GroupList", $GroupList);
			$objSmarty->assign("GroupCount", $GroupCount);
			$objSmarty->assign("GenreCount1", $GroupCount);
			return($GroupList);
		}
		
		function DeleteGroup($Ident){
			$DelQry1 = "delete  from ".$this->Group." where id = '$Ident'";
			$this->dbSetQuery($DelQry1,"delete");
			$this->dbExecuteQuery();
		}
		
		
		
		/** -------------------------Group Functions END-----------------------------------------*/
		
		/** -------------------------New User Functions START-----------------------------------------*/
		
		function getSearchUserList($char,$Status=''){
            global $_REQUEST,$objSmarty,$global_config;
			//$objAdmin=new Admin();
			
			$Character=trim($char);
			
			if($Character=="all")
			$Character='';

			if($Status!=''){
				$Where= " where Status ='".$Status."' and  ";
			}else{
				$Where=" where";
			}
			
			if($Character!=""){
				if(strlen($Character)>1)
					$Where = $Where." username  like  '%$Character%' ";
				else
					$Where = $Where. "  username  REGEXP  '^$Character'";
			}
			
			$sort = $_REQUEST["sort"];
			$type = $_REQUEST["type"];
			
			$objSmarty->assign("sort",$sort);
			$objSmarty->assign("type",$type);
			$objSmarty->assign("hdAction",$_REQUEST[hdAction]);
			
			if($sort!="" && $type!=""){
				$OrderBy = " order by $sort $type";
			}
			else
				$OrderBy = " order by id desc";
			#################################
				
			if($RowDisplay == '') $RowDisplay =$global_config["AdminRowDisplay"];
			$strSql      = "select * from ".$this->User. $Where ; 
			$UserLists  = $this->getSelectByQuery($strSql);
			$UserCount1 = $this->dbQueryNumRows;
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage_MemberList($_REQUEST,$RowDisplay,$strSql);
			$this->perPageList($RowDisplay);
			#######################################
			$strSql      = "select * from ".$this->User .$Where.$OrderBy. $Qry_limit;
			
			$UserList  = $this->getSelectByQuery($strSql);
			$UserCount = $this->dbQueryNumRows;
			$objSmarty->assign("UserList", $UserList);
			$objSmarty->assign("UserCount", $UserCount);
			$objSmarty->assign("UserCount1", $UserCount1);
			return($UserList);
			
		}
		
		function SendRemainderToUserIdent($Ident) {
			$UserDetails = $this->getUserDetailsByIdent($Ident);

			$username = $UserDetails[0]["username"];
			$password = $UserDetails[0]["password"];
			$Email     = $UserDetails[0]["email"];

			$objMail   = new EMail();
	
			$objMail->MailFields["path"] 	   = $global_config["SiteGlobalPath"];
			$objMail->MailFields["UserLogin"]  = $username;	
			$objMail->MailFields["Password"]   = $password;	

			//$objMail->MailFields["code"] = "Your account is not approved by admin. After approving your account, a mail will be sent to you with login information.";
				
			 $objMail->Send($Email,"SENDREMAINDER");

		}
		
		function getUserDetailsByIdent($Ident) {
			$strSql           = "select * from ".$this->User." where id = '".$Ident."'";
			$UserDetails    = $this->getSelectByQuery($strSql);
			return ($UserDetails);
		}

		function addUser($objArray){
	
			global $_REQUEST,$objSmarty,$global_config;
	
			$current_date = date("d-m-Y");
			$date_array   = split("-", $current_date);
			$current_date = $date_array[2] . "-" . $date_array[1] . "-" . $date_array[0];			
			
			$objArray["txtcreated_on"]=date("Y-m-d H:i:s");
			
			$objArray["txtdob"] = $objArray["year"] . "-" . $objArray["month"] . "-" . $objArray["day"];
			
			 $UserCount = $this->UserCheck();
			
			if($UserCount==0)
			{			
			$current_id = $this->AddInfoToDB($objArray,"txt",$this->User);
			
			
			$Email     = $objArray["txtemail"];
			$UserLogin = $objArray["txtusername"];
			$Password  = $objArray["txtpassword"];
			
			$objMail   = new EMail();
	
			$objMail->MailFields["path"] 	   = $global_config["SiteGlobalPath"];
			$objMail->MailFields["UserLogin"]  = $UserLogin;	
			$objMail->MailFields["Password"]   = $Password;	

			//$objMail->MailFields["code"] = "Your account is not approved by admin. After approving your account, a mail will be sent to you with login information.";
				
			 $objMail->Send($Email,"REGISTER");
			 $objSmarty->assign("strMsg","Account Created Successfully!!!");
			 $add=1;
			 return $add;
			//header("Location:index.php?op=thank-registration");
			}
			else
			{
			 $this->prePopulateForm();
			 $objSmarty->assign("strMsg","User Name Alreay Exist");
			  return $add;
			}
						
		}

		function UserCheck(){
			global $_REQUEST,$objSmarty;
			$user_Name = $_REQUEST['txtusername'];
			
			 $strSql    = "select * from ".$this->User." where username ='". $user_Name . "'" ;
	
			$UserList  = $this->getSelectByQuery($strSql);
			$UserCount = $this->dbQueryNumRows;
			return $UserCount;
			}
			
		/*get Group wise Member List*/
		function getGroupwiseMemberList() {
			global $_REQUEST,$objSmarty, $global_config;
			$strSql      = "select * from ".$this->Group." ";			
			$GroupList  = $this->getSelectByQuery($strSql);
			$GrpsCount = $this->dbQueryNumRows;
			for ($i=0;$i<$GrpsCount;$i++) { /*Group Array*/
				$UserDetails = $this->getUsersByGroupIdent($GroupList[$i]["id"]);
				$fullname = $FuserDetails = "";
				for ($j=0;$j<count($UserDetails);$j++)	{ /*User of the Group*/
					$UserIdent  = $UserDetails[$j]["id"];	
					$usename = $UserDetails[$j]["firstname"]." ".$UserDetails[$j]["lastname"];
					$email  = $UserDetails[$j]["email"];
					$created_on  = $UserDetails[$j]["created_on"];
					$Status  = $UserDetails[$j]["Status"];	
					$id = $UserDetails[$j]["id"];	
					
					/*$DocumentDetails = $this->getDocumentsAssignedByUserIdent($UserIdent);					
					$documentsAssigned = $readdocumentslist = $unreaddocumentslist = "";

					
					if ($UserIdent != "")	{ 
						for ($k=0;$k<count($DocumentDetails);$k++) { //User document
							$documentsAssigned .= $DocumentDetails[$k]["doc_OriginalName"]."<br>";
							$documentsread = $this->getDocumentreadstatusByDocId($DocumentDetails[$k]["id"],$UserIdent);
							if ($documentsread[0][0] > 0) {
								$readdocumentslist .= $DocumentDetails[$k]["doc_OriginalName"]."<br>";
							} else {
								$unreaddocumentslist .= $DocumentDetails[$k]["doc_OriginalName"]."<br>";
							}				
						}	
					}	else {
						$documentsAssigned = $readdocumentslist = $unreaddocumentslist = $usename = "";
					}*/
					
					$FuserDetails[$j]["id"] 			    = $id;	
					$FuserDetails[$j]["Name"] 				= $usename;
					$FuserDetails[$j]["email"] 				= $email;
					$FuserDetails[$j]["created_on"] 		= $created_on;
					$FuserDetails[$j]["Status"] 			= $Status;
					
					
				}	
			
			$GroupList[$i]["Userlist"] = $FuserDetails; // trim(substr($fullname,0,strlen($fullname)-4));		
			}
		//	printArray($GroupList);			
			
			$objSmarty->assign("GroupList", $GroupList);			
		}
			

		function getUserList(){
			global $_REQUEST,$objSmarty, $global_config;

			
			$sort = $_REQUEST["sort"];
			$type = $_REQUEST["type"];
			
			$objSmarty->assign("sort",$sort);
			$objSmarty->assign("type",$type);

			if($sort!="" && $type!=""){
				$OrderBy = " order by $sort $type";
			}
			else
				$OrderBy = " order by id desc";
				
			if ($_REQUEST["account_status"] != "" )	 $where = " where Status = '".$_REQUEST["account_status"]."' ";
			
			
				
			#######################################
			if($RowDisplay == '') $RowDisplay =$global_config["AdminRowDisplay"];
			$strSql      = "select * from ".$this->User . $where; 
			$UserList1  = $this->getSelectByQuery($strSql);
			$UserCount1 = $this->dbQueryNumRows;
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage_MemberList($_REQUEST,$RowDisplay,$strSql);
			$this->perPageList($RowDisplay);
			#######################################
			$strSql      = "select * from ".$this->User . $where . $OrderBy. $Qry_limit;
			
			
			$UserList  = $this->getSelectByQuery($strSql);
			$UserCount = $this->dbQueryNumRows;
			
			$ActiveUserlistCount = $this->getActiveMembersList();
			$objSmarty->assign("ActiveUserlistCount", $ActiveUserlistCount); 
			
			$InActiveUserlistCount = $this->getInActiveMembersList();
			$objSmarty->assign("InActiveUserlistCount", $InActiveUserlistCount); 

			
			
			$objSmarty->assign("UserList", $UserList);
			$objSmarty->assign("UserCount", $UserCount);
			$objSmarty->assign("UserCount1", $UserCount1);
			return($HairstyleList);
		}
		
		/*get Active Members List*/
	    function getActiveMembersList() {
			$strSql      = "select * from ".$this->User." where Status = 'Active' ";
			$ActiveUserlist   = $this->getSelectByQuery($strSql);
			$ActiveUserlistCount = $this->dbQueryNumRows;
			return ($ActiveUserlistCount);
		}	
		
		/*get InActive Members List*/
	    function getInActiveMembersList() {
			$strSql      = "select * from ".$this->User." where Status = 'InActive' ";
			$InActiveUserlist   = $this->getSelectByQuery($strSql);
			$InActiveUserlistCount = $this->dbQueryNumRows;
			return ($InActiveUserlistCount);
		}	

		function getUserEdit($Ident){
			global $_REQUEST,$objSmarty;
			$strSql           = "select * from ".$this->User." where id = '".$Ident."'";
			$ReviewDetails    = $this->getSelectByQuery($strSql);
			$UserValue = $this->getRemoveSlashes($ReviewDetails);
			$daysList = $this->daysGet();
			$monthsList = $this->monthsGet();
			$yearList = $this->yearsGet();
			
			$dobAry = split("-",$UserValue[0]["dob"]);
			$UserValue[0]["year"] = $dobAry[0];
			$UserValue[0]["month"] = $dobAry[1];
			$UserValue[0]["day"] = $dobAry[2];
			
			$this->setVariable("daysList",$daysList);
			$this->setVariable("monthsList",$monthsList);
			$this->setVariable("yearList",$yearList);
			
			$grouplist = explode('|',$UserValue[0]["grouplist"]);
			$objSmarty->assign("grouplist",$grouplist);


			$strSql = "SELECT id,FIND_IN_SET('".$Ident."',REPLACE(".$this->documents.".userlist, '|', ',')) FROM `tbl_documents` where FIND_IN_SET('".$Ident."',REPLACE(".$this->documents.".userlist, '|', ','))!= 0";
			$DocumentDetails    = $this->getSelectByQuery($strSql);
			$docCount     = $this->dbQueryNumRows; 

			for ($i=0;$i<$docCount;$i++) {
				$documentlist[$i] = $DocumentDetails[$i]["id"];
			}
			
			$objSmarty->assign("documentlist",$documentlist);

			
			
			$objSmarty->assign("UserValue",$UserValue);
		}

		function DeleteUser($Ident){
			$DelQry1 = "delete  from ".$this->User." where id = '$Ident'";
			$this->dbSetQuery($DelQry1,"delete");
			$this->dbExecuteQuery();
		}
			
		
		function DeleteUserList($objArray,$TableName){
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where id = '$DelId'";
					$DelQry = "delete  from $TableName where id = '$DelId'";
					$this->dbSetQuery($DelQry,"delete");
					$this->dbExecuteQuery();
				}
			}
		}
		
		/*get user List for list box*/
		function getuserListforlistbox()	{
			global $objSmarty;
			
			$strSql      = "select * from ".$this->User." ";
			$User   = $this->getSelectByQuery($strSql);
			$UserCount = $this->dbQueryNumRows;

			for($i=0;$i<$UserCount;$i++){
				$userlistValue[$i]	=	$User[$i]['username'];
				$userlistId[$i]		=	$User[$i]['id'];
			}
			
			$objSmarty->assign("userlistValue",$userlistValue);
			$objSmarty->assign("userlistId",$userlistId);
		}
		
		
		/** -------------------------New User Functions END-----------------------------------------*/
		
		
		/** MENU START Don't Alter*/
		function setLeftMenu(){
			global $objSmarty;
			$strSql     = "select * from ".$this->AdminTable." where MenuType='Admin' and Status='Active' order by Order_id";
			$AdminMenu  = $this->getSelectByQuery($strSql);
			$AdminCount = $this->dbQueryNumRows;
			
			$PreferenceDetails       = "";
	  	    $PreferenceDetails.="var PreferenceDetails = new Array();\n";
			for($i=0;$i<$AdminCount;$i++){
				$AdminSubMenuExp = explode(",",$AdminMenu[$i]["SubMenu"]);
				$AdminSubLinkExp = explode(",",$AdminMenu[$i]["MenuLink"]);
				$AdminMenu[$i]["SubMenucount"] = count($AdminSubMenuExp);
				
				$PreferenceDetails.= "PreferenceDetails[".$i."] = \"".$AdminMenu[$i]["CurrentPReference"]."\";\n";
				
					for($j=0;$j<count($AdminSubMenuExp);$j++){
						$AdminMenu[$i]["SubMenus"][$j] = $AdminSubMenuExp[$j];
						$AdminMenu[$i]["SubLinks"][$j] = $AdminSubLinkExp[$j];
					}
			}			
			$objSmarty->assign("PreferenceDetails",$PreferenceDetails);
			$objSmarty->assign("AdminCount",       $AdminCount);
			$objSmarty->assign("AdminMenu",        $AdminMenu);
		}
		
		function SavePreference($Preference){
			$PrefExplode = explode(",",$Preference);
			$PrefIdentExplode = explode(",",$_REQUEST["PrefIdentArray"]);
			
			$strSql          = "select * from ".$this->AdminTable;
			$PreferenceList  = $this->getSelectByQuery($strSql);
			$PreferenceCount = $this->dbQueryNumRows;
			for($j=0;$j<$PreferenceCount;$j++){
				$Ident = $PreferenceList[$j]["Ident"];
				$UpdateArray[$j]["Field"] = "PreviousPreference";
				$UpdateArray[$j]["Value"] = $PreferenceList[$j]["CurrentPReference"];
				$Where = " where Ident='$Ident'";
				$this->doUpdate($this->AdminTable,$UpdateArray,$Where);
			}
			//printArray($PreferenceList);
			for($i=0;$i<count($PrefExplode);$i++){
				//$Incr = $i+1;
				$updateQry = $Incr = "";
				//$Incr = $PreferenceList[$i]["Ident"];
				/*$UpdateArray[$i]["Field"] = "CurrentPReference";
				$UpdateArray[$i]["Value"] = $PrefExplode[$i];
				$Where = " where Ident='$Incr'";*/
				$updateQry = "update ".$this->AdminTable." set CurrentPReference = '".$PrefExplode[$i]."' where Ident = '".$PrefIdentExplode[$i]."' " ;
				$this->ExecuteQry($updateQry);
				
//				$this->doUpdate($this->AdminTable,$UpdateArray,$Where);
			//print count($PrefExplode);
		//print $Where;
			}
			
		}
		
		function RevertPreference(){
			$strSql          = "select * from ".$this->AdminTable;
			$PreferenceList  = $this->getSelectByQuery($strSql);
			$PreferenceCount = $this->dbQueryNumRows;
			$Pref = "";
			for($j=0;$j<$PreferenceCount;$j++){
				$Ident = $PreferenceList[$j]["Ident"];
				$UpdateArray[$j]["Field"] = "CurrentPReference";
				$UpdateArray[$j]["Value"] = $PreferenceList[$j]["PreviousPreference"];
				$Where = " where Ident='$Ident'";
				if($Pref==""){
					$Pref = $PreferenceList[$j]["PreviousPreference"];
				} else {
					$Pref.=  ",".$PreferenceList[$j]["PreviousPreference"];
				}
				$this->doUpdate($this->AdminTable,$UpdateArray,$Where);
			}
			return($Pref);
		}
		
		function AdminLogin()
		{
			global $_REQUEST,$objSmarty;
			$username = $_POST['username'];
			$password = $_POST['password'];
			if($_POST["login"])
			{
			$strSql      = "select * from "."$this->Admin"." where username='$username' and password='$password'";
			$AdminValue  = $this->getSelectByQuery($strSql);
			//print_r($AdminValue);
			if($AdminValue !="")
				{
				 $_SESSION['username'] = $username;
				 header("location:main.php");
				}
				else
				{
				$ErrMsg = "Your Username and Password is Incorrect.";
				$objSmarty->assign("ErrMsg", $ErrMsg);
				}
			}
		}
		function getAllMenu()
		{
			global $objSmarty;
			$QrySelect = "Select DISTINCT MenuType from ".$this->MenuList . " where Status  = 'Active'";
			$this->dbSetQuery($QrySelect,"select");
			$Result = $this->dbSelectQuery();
			for($i=0;$i<count($Result);$i++)
			{
				$strMenuValuesAry[] 	= $Result[$i]["MenuType"];
				$strMenuTypesAry[]	= $Result[$i]["MenuType"];
			}
			$objSmarty->assign("strMenuValues",$strMenuValuesAry);
			$objSmarty->assign("strMenuTypes",$strMenuTypesAry);
		}
		function getMenuList(){
            global $_REQUEST,$objSmarty,$global_config;
			$sort = $_REQUEST["sort"];
			$type = $_REQUEST["type"];
			
			$objSmarty->assign("sort",$sort);
			$objSmarty->assign("type",$type);

			if($sort!="" && $type!=""){
				$OrderBy = " order by $sort $type";
			}
			else
				$OrderBy = " order by Ident";
			
			if ($_REQUEST[menu_types]) 
				$menu_types=$_REQUEST[menu_types];
			else 
				$menu_types="Admin";
				
			$objSmarty->assign("selected_menu",$menu_types);
			#######################################
			if($RowDisplay == '') $RowDisplay =$global_config["AdminRowDisplay"];
			$strSql      = "select * from ".$this->MenuList."  where MenuType='" . $menu_types . "' order by Order_id"; 
			$MenuList  = $this->getSelectByQuery($strSql);
			$MenuListCount1 = $this->dbQueryNumRows;
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage_MemberList($_REQUEST,$RowDisplay,$strSql);
			$this->perPageList($RowDisplay);
			#######################################
			$strSql      = "select * from ".$this->MenuList." where MenuType='" . $menu_types . "' order by Order_id".$Qry_limit;
			$MenuList  = $this->getSelectByQuery($strSql);
			$MenuListCount = $this->dbQueryNumRows;
			$objSmarty->assign("MenuListCount", $MenuListCount1);
			$objSmarty->assign("MenuList", $MenuList);
			return($MenuList);
		}
		function getMenuEdit($Ident){
			global $_REQUEST,$objSmarty;
			$strSql           = "select * from ".$this->AdminTable." where Ident = '".$Ident."'";
			$MenuDetails    = $this->getSelectByQuery($strSql);
			$MenuValue = $this->getRemoveSlashes($MenuDetails);
			$objSmarty->assign("MenuValue",$MenuValue);
		}
		function getRemoveSlashes($array_string){
			for($i=0;$i<count($array_string);$i++){
				@array_walk($array_string[$i],array($this, 'arraywalk'));
			}
			return $array_string;
		}
		function getSubMenu($Ident)
		{
			global $objSmarty;
			$Ident = $_REQUEST['Ident'];
			$strSql = "Select * from ".$this->MenuList." where Ident='$Ident'";
			$SubMenuList  = $this->getSelectByQuery($strSql);
			$SubMenuCount = $this->dbQueryNumRows;
			$SubMenuValue = explode(",",$SubMenuList[0][SubMenu]);
			$SubMenuCount = count($SubMenuValue);
			$MainMenu   = array();
			$MainMenuId = array();
			for($i=0;$i<$SubMenuCount;$i++)
			{
			 $MainMenu[$i]   = $SubMenuList[0]["MainMenu"];
			 $MainMenuId[$i] = $SubMenuList[0]["Ident"];
			}
			
			$objSmarty->assign("SubMenuList",$SubMenuValue);
			$objSmarty->assign("MainMenu",$MainMenu);
			$objSmarty->assign("MainMenuId",$MainMenuId);
			
		}
		function getSubMenuEdit($Ident){
			global $_REQUEST,$objSmarty;
			$strSql           = "select * from ".$this->AdminTable." where Ident = '".$Ident."'";
			$SubMenuDetails    = $this->getSelectByQuery($strSql);
			$SubMenuValue = $this->getRemoveSlashes($SubMenuDetails);
			$objSmarty->assign("SubMenuValue",$SubMenuValue);
		}
		function DeleteMenu($Ident){
			$DelQry = "delete  from ".$this->AdminTable." where Ident = '$Ident'";
	
			$this->dbSetQuery($DelQry,"delete");
			$this->dbExecuteQuery();
		}
		function DeleteMenuList($objArray,$TableName){
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where Ident = '$DelId'";
					$UpdateArray[0]["Field"] = "Status";
					$UpdateArray[0]["Value"] = "Deleted";
					$this->doUpdate($TableName,$UpdateArray,$Where);
				}
			}
		}
		
		/**MRNU END*/
		
	
		function getStateList(){
			global $_REQUEST,$objSmarty,$global_config;
			$strSql     = "select * from tbl_State where Status='Active'";
			$StateList  = $this->getSelectByQuery($strSql);
			$StateCount = $this->dbQueryNumRows;
			for($i=0;$i<$StateCount;$i++){
				$StateCode[$i]		=	$StateList[$i]['StateCode'];
				$StateName[$i]		=	$StateList[$i]['Name'];
			}
			
			$objSmarty->assign("StateCode",$StateCode);
			$objSmarty->assign("StateName",$StateName);
		}
		
		function getAlphabetsearch(){
			global $objSmarty,$_SESSION,$S_AToZLetter;
			$Alphabets = array();
			$strAlphabets = "<table width = \"100%\" border=\"0\" align = \"center\"><tr>";

			if ($_SESSION["S_AToZLetter"] == "")
				$strAlphabets.="<td align = \"center\" class= \"AtoZLinkHover1\" style=\"cursor:pointer;\"><span onclick=\"getCategory('',0,'','')\"><b>All</b></span></td>";
			else
				$strAlphabets.="<td align = \"center\" class= \"AtoZLinkHover1\" style=\"cursor:pointer;\"><span onclick=\"getCategory('',0,'','')\">All</span></td>";
				
			
			if($this->Chk_Number($_SESSION["S_AToZLetter"]) == 1 && $_SESSION["S_AToZLetter"]!="")
				$strAlphabets.="<td align = \"center\" class= \"AtoZLinkHover1\"><B>0-91</B></td>";
			elseif($NumbericValues == "No")
				$strAlphabets.="<td align = \"center\" class= \"AtoZLink\">0-92</td>";
			//else
			//	$strAlphabets.="<td align = \"center\"  class= \"AtoZLink1\"  onMouseOver=\"this.className = 'AtoZLinkHover'\" onMouseOut=\"this.className='AtoZLink1'\" style=\"cursor:pointer;\"><span onclick=\"location.href='".$ATOZFileName."?al=0&txtSearchkey=".$strSearchText."&searchFld=".$strSearchFld."'\" id=\"AtoZ\" >0-9</span></td>";
			
			for ($i=65;$i<=90;$i++){
				$Char = chr($i);		
				if($_SESSION["S_AToZLetter"] == $Char)	{					
					$strAlphabets.= "<td class= \"AtoZLinkHover1\" align = \"center\"><b>$Char</b></td>";
				} else{
					if(in_array($Char, $Alphabets))
						$strAlphabets.="<td class= \"AtoZLink1\" align = \"center\" onMouseOver=\"this.className = 'AtoZLinkHover'\" onMouseOut=\"this.className='AtoZLink1'\" style=\"cursor:pointer;\"><span onclick=\"location.href='".$ATOZFileName."?al=".$Char."&txtSearchkey=".$strSearchText."&searchFld=".$strSearchFld."'\">".$Char."</span></td>";	
					else
						$strAlphabets.= "<td class= \"AtoZLink1\"  onMouseOver=\"this.className = 'AtoZLinkHover'\" onMouseOut=\"this.className='AtoZLink1'\" align = \"center\" style=\"cursor:hand\" onclick=\"getCategory('".$Char."',0,'','')\">".$Char."</td>";
				}
			}
			$strAlphabets.="</tr></table>";
			$objSmarty->assign("Alphabets",$strAlphabets);
			return $strAlphabets;
		}
		
		function styleoptions($objArray,$aryCount){
		for($i=0;$i<$aryCount;$i++){
		 $styles='';
			 $color=$objArray[$i]['color'];
			 $strSql1     = "select display_title from tbl_Options where option_name= 'color' AND option_value='$color'";
			 $opt_color  = $this->getSelectByQuery($strSql1);	
			 $objArray[$i]['color']  = $opt_color[0]["display_title"];
			 
			 $texture=$objArray[$i]['texture'];
			 $strSql1     = "select display_title from tbl_Options where option_name= 'texture' AND option_value='$texture'";
			 $opt_color  = $this->getSelectByQuery($strSql1);	
			 $objArray[$i]['texture']  = $opt_color[0]["display_title"];
			 
			 $style=$objArray[$i]['style'];
			//if(in_array(',',$style)){
				 $styleAry=explode(",",$style);
				for($j=0;$j<count($styleAry);$j++) {
					$style = $styleAry[$j];
					 $strSql1     = "select display_title from tbl_Options where option_name= 'style' AND option_value='$style'";
					 $opt_color  = $this->getSelectByQuery($strSql1);
					 if($styles == '')
						$styles  = $opt_color[0]["display_title"];
					 else	
						 $styles  = $styles .", " .$opt_color[0]["display_title"];
				}	
					 $objArray[$i]['style']= $styles;
				/*}	else{
			 $style=$objArray[$i]['style'];
			 $strSql1     = "select display_title from tbl_Options where option_name= 'style' AND option_value='$style'";
			 $opt_color  = $this->getSelectByQuery($strSql1);	
			 $objArray[$i]['style']  = $opt_color[0]["display_title"];
			}*/
			 
			/*
			 $strSql1     = "select display_title from tbl_Options where option_name= 'style' AND option_value='$style'";
			 $opt_color  = $this->getSelectByQuery($strSql1);	
			 $objArray[$i]['style']  = $opt_color[0]["display_title"];*/
			 
			 $celebrities=$objArray[$i]['celebrities'];
			 $strSql1     = "select display_title from tbl_Options where option_name= 'celebrities' AND option_value='$celebrities'";
			 $opt_color  = $this->getSelectByQuery($strSql1);	
			 $objArray[$i]['celebrities']  = $opt_color[0]["display_title"];
			 
			 $length=$objArray[$i]['length'];
			 $strSql1     = "select display_title from tbl_Options where option_name= 'length' AND option_value='$length'";
			 $opt_color  = $this->getSelectByQuery($strSql1);	
			 $objArray[$i]['length']  = $opt_color[0]["display_title"];
			 
			 $gender=$objArray[$i]['gender'];
			 $strSql1     = "select display_title from tbl_Options where option_name= 'gender' AND option_value='$gender'";
			 $opt_color  = $this->getSelectByQuery($strSql1);	
			 $objArray[$i]['gender']  = $opt_color[0]["display_title"];
			 
			 $face_shape=$objArray[$i]['face_shape'];
			 $strSql1     = "select display_title from tbl_Options where option_name= 'face_shape' AND option_value='$face_shape'";
			 $opt_color  = $this->getSelectByQuery($strSql1);	
			 $objArray[$i]['face_shape']  = $opt_color[0]["display_title"];
		 
			}
			//printarray($objArray);
		return $objArray;
		}	
		
	
function getUploadedFile($name)
{
	$result = array();
	if ($_FILES && isset($_FILES[$name])) {
		if(($_FILES[$name]['size'] > 0) && ($_FILES[$name]['size'] <= 2097152)) {
			$name1=$_FILES[$name]['name'];
			$extAry=explode(".",$name1);
			$ExtArray = $extAry[1];
			$FileAry=explode(".",$name1);
			$FileAryCount=count($FileAry);
			if(in_array(strtolower($FileAry[$FileAryCount-1]),$ExtArray)){
				$f = $_FILES[$name];
				if ($f['tmp_name'] && $f['size']) {
					$result = array( 
					'name' => $f['name'],
					'path' => $f['tmp_name'],
					'size' => $f['size'],
					);
				}
			} 
			else
				$result=INVALID_FILE;
		}
		else
			$result=MAX_IMAGEFILE_SIZE;
	}

    return $result;
}

    function pictureThumbCalcDims($originalDims, $thumbWidth)
    {
            $width  = $originalDims[0];
            $height = $originalDims[1];

            $th_w = 0.0 + $thumbWidth;

            $result_w = $width;
            $result_h = $height;

            $factor = 0;

            if ($width > $thumbWidth) {
                $factor = sprintf('%.02f', $th_w / $width);
                $th_h = ($th_w * $height) / $width;
                $result_h = sprintf('%.0f', $th_h);
                $result_w = sprintf('%.0f', $th_w);
            }
            return array($result_w, $result_h, $factor);
    }
    function picturelargeThumbCalcDims($originalDims, $thumbWidth)
    {
            $width  = $originalDims[0];
            $height = $originalDims[1];

            $th_w = 0.0 + $thumbWidth;

            $result_w = $width;
            $result_h = $height;

            $factor = 0;

            if ($width > $thumbWidth) {
                $factor = sprintf('%.02f', $th_w / $width);
                $th_h = ($th_w * $height) / $width;
                $result_h = sprintf('%.0f', $th_h);
                $result_w = sprintf('%.0f', $th_w);
            }
            return array($result_w, $result_h, $factor);
    }


	function pictureGetInfo($path)
    {
        $result = array('error' => '');
        if (!@is_file($path)) {
            $result['error'] = ERR_FILE_NOT_FOUND;
        } else {
            $info = @getimagesize($path);
            if ($info) {
                list($type,$subtype) = explode('/', $info['mime']);
                if (strtolower($type) == 'image') {
                    $imageType = strtolower($subtype);
                    $extensions = $this->picturesGetValidTypes();
                    if (isset($extensions[$imageType])) {
                        $filesize = filesize($path);
                        $result = array(
                            'error'     => '',
                            'width'     => $info[0],
                            'height'    => $info[1],
                            'type'      => $imageType,
                            'extension' => $extensions[$imageType],
                            'size'      => $filesize,
                            'sizeKB'      => round( ($filesize / 1024.0), 2),
                        );
                    } else {
                        $result['error'] = ERR_IMG_UNSUPPORTED;
                    }
                }
            } else {
                $result['error'] = ERR_IMG_CORRUPTED;
            }
        }
		
        return $result;
    }
    function picturesGetValidTypes()
    {
        return array (
            'jpeg' => 'jpg',
            'jpg'  => 'jpg',
            'gif'  => 'gif',
            'png'  => 'png',
        );
    }
	
    function pictureScale($srcPath, $dstPath, $out_w, $out_h)
    {
        $result = 0;
        $img_in  = null;
        $img_out = null;

        list($width, $height, $type, $attr) = getimagesize($srcPath);
        if ($width && $height && $out_w && $out_h) {
            $imageTypes = array(
                PICTURE_TYPE_GIF => array('imagecreatefromgif',
                                          'imagegif'),
                PICTURE_TYPE_PNG => array('imagecreatefrompng',
                                          'imagepng'),
                PICTURE_TYPE_JPG => array('imagecreatefromjpeg',
                                          'imagejpeg'),
            );
            if (isset($imageTypes[$type])) {

                list($createF,$writeF) = $imageTypes[$type];
                $img_in  = $createF($srcPath);
                $img_out = imagecreatetruecolor($out_w, $out_h);
                imagecopyresampled($img_out,$img_in, 0, 0, 0, 0,
                                   $out_w,$out_h,$width,$height);
                if ($img_in) {
                    imageDestroy($img_in);
                    $img_in = null;
                }

                if (! @$writeF($img_out, $dstPath)) {
                    $result = ERR_FILE_WRITE;
                }
                if ($img_out)
                    imageDestroy($img_out);
            }

        }

        return $result;
    }
	
		function ImportPageTags($file,$columnheadings,$delimiter,$enclosure){
			$rows   = array();
		    $handle = fopen($file, 'r');
			$k=0;
			while (($data = fgetcsv($handle, 1000, $delimiter, $enclosure )) !== FALSE) {
			   if ($k!=0) {
				$headingTexts = $data;
			    $rows[] = $data;
				$TagTitle   	= $data[0];
				$TagUrl    		= $data[1];
				$Folder    		= $data[2];
				
					$InsertArray[0]["Field"] = "BookmarkTitle";
					$InsertArray[0]["Value"] = $TagTitle;
					$InsertArray[1]["Field"] = "BookmarkUrl";
					$InsertArray[1]["Value"] = $TagUrl;
					$InsertArray[2]["Field"] = "Description";
					$InsertArray[2]["Value"] = $Folder;
					$InsertArray[3]["Field"] = "AddedDate";
					$InsertArray[3]["Value"] = date("Y-m-d H:i:s");
					$InsertArray[4]["Field"] = "MemberId";
					$InsertArray[4]["Value"] = $_SESSION["S_MemberId"];	
					if($TagTitle!="" && $TagUrl!=""){					
						$this->doInsert($this->Favourites,$InsertArray);
					}
				}//if
				$k++;
			}//while
		}

		function ImportCSVBookMarks()	{
			global $objSmarty;
			$FileName   = $_FILES["ImportTag"]["tmp_name"];
			$strContent = file($FileName);
			$this->ImportPageTags($FileName,true,',', "\"");
			$rsFolderDetails	= $this->getFolderDetails();
			$objSmarty->assign("FolderDetails",$rsFolderDetails);	
		}
	
	/* code end for uploading images and thumb creation */
	}

?>