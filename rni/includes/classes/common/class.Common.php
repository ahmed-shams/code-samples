<?
	/**
	 * Project:    Everythinghair.com : Common Class
	 * File:       class.Common.php
	 *
	 * @link http://www.Everythinghair.com/
	 * @copyright 2001-2005 Everythinghair.com,.
	 * @package Everythinghair
	 * @version 1.0.0
	 */

	class Common extends extendsClassDB{
		var $Request;
		var $Task;
		var $fAction;
		function Common() {
			$this->Request 	= array();
			$this->Task 	= "";
			$this->fAction	= "";
			$this->Limit    = "10";	
			$this->extendsClassDB();
		}
		
		function loadClassFile($strClassName, $strClassFile) {
			if(!class_exists($strClassName))
				include_once($strClassFile);
		}
		
		function setVariable($strVariable,$strValue) {
			global $objSmarty;
			$objSmarty->assign($strVariable,$strValue);
		}
		
		
		function setTemplate($strTemplateFile) {
			global $objSmarty,$objQueryStrings;
			$strCurrentUrl = $this->getCurrentUrl();
			$this->setVariable("strMainUrl",$strCurrentUrl);
			$i = 0;
			if(is_array($objQueryStrings))
			{
				foreach($objQueryStrings as $Key => $Value)
				{
					if($i == 0)
						$strCurrentUrl = $strCurrentUrl."?";
					else
						$strCurrentUrl = $strCurrentUrl."&";
					$strCurrentUrl = $strCurrentUrl.$Key."=".$Value;
					$i++;
				}
			}
			if($i==0)
				$strQSeperator = "?";
			else
				$strQSeperator = "&";
			$this->setVariable("strQSeperator",$strQSeperator);
			$this->setVariable("strCurrentUrl",$strCurrentUrl);
			$this->setVariable("S_Members",$S_Members);
			if($strTemplateFile != "")
				$objSmarty->display($strTemplateFile);
			else
				$objSmarty->display("index.tpl");
			exit();	
		}
		
		function getSelectByQuery($strSQL,$uSelect=0,$queryType=false){
				$this->dbSetQuery($strSQL,"select",$uSelect);
				$this->dbExecuteQuery();
				return $this->dbSelectQuery();
			
		}
		
		function ExecuteQry($strSQL,$strSQLType = "update")
		{
			$this->dbSetQuery($strSQL,$strSQLType);
			$this->dbExecuteQuery();
		}
		
				
		function doInsert($strTableName,$objFieldsArray)
		{
			global $objSmarty;
			if(is_array($objFieldsArray))
			{
				$strInsertFields = "";
				$strInsertValues = "";
				for($i=0;$i<count($objFieldsArray);$i++)
				{
					$strInsertFields.= $objFieldsArray[$i]["Field"];
					$strInsertValues.= "'".addslashes($objFieldsArray[$i]["Value"])."'";
					if($i<count($objFieldsArray)-1)
					{
						if($objFieldsArray[$i]["Field"]!=""){
						$strInsertFields.=", ";
						$strInsertValues.=", ";
						}
					}
				}
				$strInsertQry = "INSERT INTO $strTableName($strInsertFields) VALUES($strInsertValues)";
				//echo $strInsertQry;
				$this->ExecuteQry($strInsertQry);
				$InsertId = mysql_insert_id();
				return $InsertId;
			}
			else
			{
				$objSmarty->assign("strErrorMsg","Error while adding new Data, Fields array is empty");
				return false;
			}
		}
		
		function doUpdateData($objArray,$strTableName,$strWhereClause) {
			$i=0;
			foreach($objArray as $Key=>$Value)
			{
				if(substr($Key,0,2) == "X_")
				{
					$UpdateFields[$i]["Field"] = substr($Key,2);
					$UpdateFields[$i]["Value"] = $Value;
					$i++;
				}
			}
			if($strWhereClause != "")
				$strWhereClause = " WHERE ".$strWhereClause;
			if($UpdateFields == "" || count($UpdateFields) == 0)
				return;
			$this->doUpdate($strTableName,$UpdateFields,$strWhereClause);
		}
		
		function doUpdate($strTableName,$objFieldsArray,$WhereClause)
		{
			global $objSmarty;
			if(is_array($objFieldsArray))
			{
				$strUpdateFields = "";
				
				for($i=0;$i<count($objFieldsArray);$i++)
				{
					$strUpdateFields.= $objFieldsArray[$i]["Field"]."="."'".addslashes($objFieldsArray[$i]["Value"])."'";
					if($i<count($objFieldsArray)-1)
					{
						if($objFieldsArray[$i]["Field"]!=""){
						$strUpdateFields.=", ";
						}
					}
				}
				$strUpdateQry = "UPDATE $strTableName SET $strUpdateFields $WhereClause";
				//print $strUpdateQry."<br>";
				//exit;
				//exit;
				
				$this->ExecuteQry($strUpdateQry);
				return true;
			}
			else
			{
				$objSmarty->assign("strMsg","Error while updating new Data, Fields array is empty");
				return false;
			}
			
		}
		
		function Redirect($strURL)
		{
			header("location:".$strURL);
			exit();
		}
		
		function setBreadCrumb($objArray = "") {
			$strSeperator 	= " <font size='-2'>&gt;</font> ";
	   		$strText 		= "<a href='main.php' class='FontLink'>Home</a>";
			for($i=0;$i<count($objArray);$i++)
			{
				$strText.= $strSeperator;
				if($objArray[$i]["Link"] == "")
					$strText.= $objArray[$i]["Text"];
				else
					$strText.= "<a href='".$objArray[$i]["Link"]."' class='FontLink'>". $objArray[$i]["Text"] ."</a>";
			}
			$this->setVariable("BreadCrumbText",$strText);
		}
		
		function getCurrentUrl() {
			if($_SERVER["HTTPS"] == "on")
				$strHTTP = "https://";
			else
				$strHTTP = "http://";
			$strUrl = $strHTTP.$_SERVER["HTTP_HOST"].$_SERVER['SCRIPT_NAME'];
			return $strUrl;
		}
	
		function xmlParserArray($strArray){
			$p = xml_parser_create();
			xml_parse_into_struct($p,$strArray,$vals,$index);
			xml_parser_free($p);
			for($i=0;$i<count($vals);$i++){
				$ValueSingle .= stripslashes($vals[$i]['value'])." ";
			}
			return $ValueSingle;
		}
		
		function perPage($offset)
		{
			$this->offset = $offset;

			if(!isset($this->offset) || empty($this->offset)) $this->offset = 0;
		}
		
		function showPerPage_MemberList($objArray,$row,$QRY='')
		{
			global $objSmarty;
			if($row!="")
				$row = $row;
			else
				$row = $this->Limit;
			$QueryString = $_SERVER['QUERY_STRING'];
			
			$printperpage = recordsetNav_MemberList($QRY,$PHP_SELF,$this->offset,$row,'100%',1,"order=".$this->order."&RowDisplay=".$row."&sort=".$objArray['sort']."&type=".$objArray['type']."&UserName=".$objArray['UserName']."&UserType=".$objArray['UserType']."&hSAction=".$objArray['hSAction']."&hdAction=".$objArray['hdAction'] . "&menu_types=" . $objArray['menu_types']);
			$objSmarty->assign("printperpage",$printperpage);
			$objSmarty->assign("offset",$printperpage[0]);
			$objSmarty->assign("printperpage",$printperpage[1]);
		}
		
		function showPerPage_VendorList($objArray,$row,$QRY='')
		{
		
			global $objSmarty;
			if($row!="")
				$row = $row;
			else
				$row = $this->Limit;
				
			$QueryString = $_SERVER['QUERY_STRING'];
				
			$printperpage = recordsetNav_VendorList($QRY,$PHP_SELF,$this->offset,$row,'100%',1,"order=".$this->order."&RowDisplay=".$row."&sort=".$objArray['sort']."&type=".$objArray['type']."&UserName=".$objArray['UserName']."&UserType=".$objArray['UserType']."&hSAction=".$objArray['hSAction']."&hdAction=".$objArray['hdAction'] . "&menu_types=" . $objArray['menu_types']. "&cat_id=" . $objArray['cat_id']. "&id=" . $objArray['id']);
			$objSmarty->assign("printperpage",$printperpage);
			$objSmarty->assign("offset",$printperpage[0]);
			$objSmarty->assign("printperpage",$printperpage[1]);
		}
		
		function showPerPage_Tutorials($objArray,$row,$QRY='',$op='',$admin_var='',$category_id='',$MainCategoryName='')
		{
			global $objSmarty,$global_config;
			if($row!="")
				$row = $row;
			else
				$row = $this->Limit;
			
			
			$url=$_SERVER['HTTP_REFERER'];
			$QueryString = $_SERVER['QUERY_STRING'];
			if($admin_var<>"")
			{
			$printperpage = recordsetNav_ajax($QRY,$url,$this->offset,$row,'100%',1,$category_id,$objArray['sort'],$objArray["type"]);
			}
			else if($MainCategoryName!=""){
			$printperpage = recordsetNav_tutorials($QRY,$pageurl,$this->offset,$row,'100%',1,"order=".$this->order."&RowDisplay=".$row."&sort=".$objArray['sort']."&fAction=".$objArray["fAction"]."&AdvertisersName=".$objArray["AdvertisersName"]."&selStatus=".$objArray["selStatus"]."&hdStep=".$objArray["hdStep"]."&type=".$objArray["type"]."&op=".$objArray["op"]."&mon=".$objArray["mon"]."&yr=".$objArray["yr"]."&shDate=".$objArray["shDate"],'','',$MainCategoryName);
			}
			else
			{
			//General Tutorial Display for front end
			if($global_config["SiteModRewrite"]=="No"){
				if($objArray['maincat']) $exturl="maincat=".$objArray['maincat'];
				if($objArray['subcat']) $exturl=$exturl."&subcat=".$objArray['subcat'];
			}
			else{
				if($objArray['maincat']){
					if(!is_numeric($objArray['maincat'])){
					 $exturl=$objArray['maincat'];
					//	print $exturl."1"; 
					} else {
					//	print "2";
					}
				}
				if($objArray['subcat']) {
					if(!is_numeric($objArray['subcat']) && $exturl!=""){
						$exturl=$exturl."/".$objArray['subcat'];
					} else {
						$exturl=$objArray['subcat'];
					}
				}
			}

			
			$printperpage = recordsetNav_tutorials($objArray[tutorialType],$category_id,$QueryString,$objArray[op],$objArray[per],$QRY,$PHP_SELF,$this->offset,$row,'100%',1,$exturl);
			}
			$objSmarty->assign("printperpage",$printperpage);
			$objSmarty->assign("offset",$printperpage[0]);
			$objSmarty->assign("printperpage",$printperpage[1]);
		}
		
		function searchPerPage_Tutorials($objArray,$row,$QRY='',$op='')
		{
			global $objSmarty;
			if($row!="")
				$row = $row;
			else
				$row = $this->Limit;
			
			
			$url=$_SERVER['HTTP_REFERER'];

			$QueryString = $_SERVER['QUERY_STRING'];
			
			//General Tutorial Display for front end
			$printperpage = recordsetsearch($op,$objArray[per],$QRY,$PHP_SELF,$this->offset,$row,'100%',1,"order=".$this->order."&RowDisplay=".$row."&sort=".$objArray['sort']."&fAction=".$objArray["fAction"]."&AdvertisersName=".$objArray["AdvertisersName"]."&selStatus=".$objArray["selStatus"]."&hdStep=".$objArray["hdStep"]."&type=".$objArray["type"]."&op=".$objArray["op"]."&mon=".$objArray["mon"]."&yr=".$objArray["yr"]."&shDate=".$objArray["shDate"],$_REQUEST[search_field],$_REQUEST[Search_Category],$_REQUEST[RemoteAddress],$_REQUEST[option],$_REQUEST[hdTutorialId]);
			
			$objSmarty->assign("printperpage",$printperpage);
			$objSmarty->assign("offset",$printperpage[0]);
			$objSmarty->assign("printperpage",$printperpage[1]);
		}
		
		function show_MyTutorials($objArray,$row,$QRY='',$op='',$admin_var='',$category_id='')
		{
			global $objSmarty,$global_config;
;
			if($row!="")
				$row = $row;
			else
				$row = $this->Limit;
			
			
			$url=$_SERVER['HTTP_REFERER'];

			$QueryString = $_SERVER['QUERY_STRING'];
			if($admin_var<>"")
			{
			$printperpage = recordsetNav_ajax($QRY,$url,$this->offset,$row,'100%',1,$category_id,$objArray['sort'],$objArray["type"]);
			}
			else
			{
				if($global_config["SiteModRewrite"]=="No"){
				if($objArray['id']) $exturl="id=".$objArray['id'];
				$printperpage = record_mytutorials($op,$objArray[per],$_REQUEST[hdTutorialId],$QRY,$url,$this->offset,$row,'100%',1,$exturl);
				}
				else{
				if($objArray['id']) $exturl=$objArray['id'];
				$printperpage = record_mytutorials($op,$objArray[per],$_REQUEST[hdTutorialId],$QRY,$url,$this->offset,$row,'100%',1,$exturl);
				}
			}
			$objSmarty->assign("printperpage",$printperpage);
			$objSmarty->assign("offset",$printperpage[0]);
			$objSmarty->assign("printperpage",$printperpage[1]);
		}
		
		function showcategory_ajax($char,$objArray,$row,$QRY='')
		{
			global $objSmarty;
			if($row!="")
				$row = $row;
			else
				$row = $this->Limit;
			
			$url=$_SERVER['HTTP_REFERER'];
			
			$QueryString = $_SERVER['QUERY_STRING'];
						
			//General Tutorial Display for front end
			$printperpage = record_category_ajax($char,$objArray['sort'],$objArray['type'],$QRY,$url,$this->offset,$row,'100%',1);
			$objSmarty->assign("printperpage",$printperpage);
			$objSmarty->assign("offset",$printperpage[0]);
			$objSmarty->assign("printperpage",$printperpage[1]);
		}
		
	
		function showPerPage($objArray,$row,$QRY='')
		{
			global $objSmarty;
			if($row!="")
				$row = $row;
			else
				$row = $this->Limit;
				//printArray($objArray);
				
			 $QueryString = $_SERVER['QUERY_STRING'];
			$printperpage = recordsetNav($QRY,$PHP_SELF,$this->offset,$row,'100%',1,"order=".$this->order."&RowDisplay=".$row."&hdAction=".$objArray["hdAction"]."&op=".$objArray["op"]."&strWhereClause=".$objArray["strWhereClause"]."&Odrderby=".$objArray["Odrderby"]."&GID=".$objArray["GID"]."&stylename=".$objArray["stylename"]."&salon=".$objArray["salon"]."&Stylist=".$objArray["Stylist"]."&Specialty=".$objArray["Specialty"]);
//			printArray($printperpage);
			
			$objSmarty->assign("printperpage",$printperpage);
			$objSmarty->assign("offset",$printperpage[0]);
			$objSmarty->assign("printperpage",$printperpage[1]);
		}
	function showPerPage_ajax($objArray,$row,$QRY='')
	{
		global $objSmarty;
		if($row!="")
			$row = $row;
		else
			$row = $this->Limit;
		$QueryString = $_SERVER['QUERY_STRING'];
		$printperpage = recordsetNav_ajax($QRY,$PHP_SELF,$this->offset,$row,'100%',1,"order=".$this->order."&RowDisplay=".$row,$objArray);
		//printArray($printperpage); 	
		
		$objSmarty->assign("printperpage",$printperpage);
		$objSmarty->assign("offset",$printperpage[0]);
		$objSmarty->assign("printperpage",$printperpage[1]);
	}
		
		function showPerPageStyle_ajax($objArray,$row,$QRY='')
		{
			global $objSmarty;
			if($row!="")
				$row = $row;
			else
				$row = $this->Limit;
				//printArray($objArray);
				
			 $QueryString = $_SERVER['QUERY_STRING'];
			$printperpage = recordsetNavStyle_ajax($QRY,$PHP_SELF,$this->offset,$row,'100%',1,$objArray["GID"],$objArray["hAction"],$objArray["stylename"]);
//			printArray($printperpage);
			
			$objSmarty->assign("printperpage",$printperpage);
			$objSmarty->assign("offset",$printperpage[0]);
			$objSmarty->assign("printperpage",$printperpage[1]);
		}

		function perPageList()
		{
			global $objSmarty,$gl_PerPageOptions;
			$objSmarty->assign('dso_n_m_perpage',$gl_PerPageOptions);
			$objSmarty->assign('dso_n_m_perpage_selected', $this->PerPageSelected);
		}
		
		function AddInfoToDB($objArray,$Prefix,$TableName){
			$counter = 0;
			foreach($objArray as $key=>$value){
				$pos = strpos($key, $Prefix);
				if (!is_integer($pos)) {
				}else{
					$key = str_replace($Prefix,"",$key);
					$insertArray[$counter]["Field"] = $key;
					$insertArray[$counter]["Value"] = $value;
					$counter++;
				}
			}
//			printArray($insertArray);
			$InsertedId=$this->doInsert($TableName,$insertArray);
			return($InsertedId);

		}
		function UpdateInfoToDB($objArray,$Prefix,$TableName,$Where){
			$counter = 0;
		//	printArray($Prefix);
			foreach($objArray as $key=>$value){
				$pos = strpos($key, $Prefix);
				if (!is_integer($pos)) {
				}else{
					$key = str_replace($Prefix,"",$key);
					$UpdateArray[$counter]["Field"] = $key;
					$UpdateArray[$counter]["Value"] = $value;
					$counter++;
				}
			}
			//printArray($UpdateArray); //exit;
			
			$this->doUpdate($TableName,$UpdateArray,$Where);
		}
		function UpdateInfoToDBAd($objArray,$Prefix,$TableName){
			$counter = 0;
			foreach($objArray as $key=>$value){
				$pos = strpos($key, $Prefix);
				if (!is_integer($pos)) {
				}else{
					$key = str_replace($Prefix,"",$key);
					$UpdateArray[$counter]["Field"] = $key;
					$UpdateArray[$counter]["Value"] = $value;
					$counter++;
				}
			}
			$this->doUpdate($TableName,$UpdateArray,$Where);
		}
		function getInfoFromDB($TableName,$Where,$AssignToVariable){
			global $objSmarty;
			$strSQL = "select * from $TableName ".$Where;
			$this->dbSetQuery($strSQL,"select",$uSelect);
			$this->dbExecuteQuery();
			$ArrayResult = $this->dbSelectQuery();
			$objSmarty->assign($AssignToVariable,$ArrayResult);
		}
		
		function DeleteInfoFromDB($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$DelQry = "delete  from $TableName where id = '$DelId'";
					$this->dbSetQuery($DelQry,"delete");
					$this->dbExecuteQuery();
				}
			}
		}
		
		function ActivateInfoFromDB($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where Vendor_Id = '$DelId'";
					$UpdateArray[0]["Field"] = "Status";
					$UpdateArray[0]["Value"] = "Active";
					$this->doUpdate($TableName,$UpdateArray,$Where);
				}
			}
		}
		
		function ActivateMenuInfoFromDB($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where Ident = '$DelId'";
					$UpdateArray[0]["Field"] = "Status";
					$UpdateArray[0]["Value"] = "Active";
					$this->doUpdate($TableName,$UpdateArray,$Where);
				}
			}
		}

		function ActivateUserInfoFromDB($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
			$sendmail='';
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$strSql      = "select * from ". $TableName ." where id=" . $DelId;
					$UserList  = $this->getSelectByQuery($strSql);
					$UserLists[$i]['Status']=$UserList[0]['Status'];
					$UserLists[$i]['username']=$UserList[0]['username'];
					$UserLists[$i]['password']=$UserList[0]['password'];
					$UserLists[$i]['email']=$UserList[0]['email'];
					$Where = " where id = '$DelId'";
					$UpdateArray[0]["Field"] = "Status";
					$UpdateArray[0]["Value"] = "Active";
					$this->doUpdate($TableName,$UpdateArray,$Where);
						
				}
			}
			if($UserLists){
			 $cnt=count($UserLists);
				for($i=0;$i<$cnt;$i++){
						if($UserLists[$i]['Status']=='Inactive'){
							$objMail  = new EMail();
							 $Email=$UserLists[$i]['email'];
							 $UserLogin =  $UserLists[$i]['username'];
							 $Password  = $UserLists[$i]['password'];
							$objMail->MailFields["UserLogin"]  = $UserLogin;
							$objMail->MailFields["Password"]  = $Password;
							$objMail->MailFields["path"] 	     	 = $global_config["SiteGlobalPath"];
							$objMail->Send($Email,"ACTIVATE");		
					}
				}
			}	
			header("location:userlist.php");
			exit;
		}
		function DeActivateUserInfoFromDB($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
			$sendmail='';
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$strSql      = "select * from ". $TableName ." where id=" . $DelId;
					$UserList  = $this->getSelectByQuery($strSql);
					$UserLists[$i]['Status']=$UserList[0]['Status'];
					$UserLists[$i]['username']=$UserList[0]['username'];
					$UserLists[$i]['password']=$UserList[0]['password'];
					$UserLists[$i]['email']=$UserList[0]['email'];
					$Where = " where id = '$DelId'";
					$UpdateArray[0]["Field"] = "Status";
					$UpdateArray[0]["Value"] = "Inactive";
					$this->doUpdate($TableName,$UpdateArray,$Where);
						
				}
			}
			if($UserLists){
			 $cnt=count($UserLists);
				for($i=0;$i<$cnt;$i++){
						if($UserLists[$i]['Status']=='Active'){
							$objMail  = new EMail();
							 $Email=$UserLists[$i]['email'];
							 $UserLogin =  $UserLists[$i]['username'];
							 $Password  = $UserLists[$i]['password'];
							$objMail->MailFields["UserLogin"]  = $UserLogin;
							$objMail->MailFields["Password"]  = $Password;
							$objMail->MailFields["path"] 	     	 = $global_config["SiteGlobalPath"];
							$objMail->Send($Email,"DEACTIVATE");		
					}
				}
			}	
			header("location:userlist.php");
			exit;
		}


		function ActivateTutInfoFromDB($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where Ident = '$DelId'";
					$UpdateArray[0]["Field"] = "Tutorial_Status";
					$UpdateArray[0]["Value"] = "Active";
					$this->doUpdate($TableName,$UpdateArray,$Where);
					
					//send mail - activate tutorial
					$strSql      = "select * from tbl_tutorials where Ident=" . $DelId;
					$TutorialList  = $this->getSelectByQuery($strSql);
					$TutorialCount = $this->dbQueryNumRows;
					
					$strSql      = "select * from tbl_members where Ident='" . $TutorialList[0]["Member_id"] . "'";
					$NewUserList  = $this->getSelectByQuery($strSql);
					$NewUserCount = $this->dbQueryNumRows;
					
					$strSql      = "select * from tbl_categories where Ident='" . $TutorialList[0]["Category_id"] . "'";
					$CategoryList  = $this->getSelectByQuery($strSql);
					$CategoryCount = $this->dbQueryNumRows;
					
					
					if($NewUserList[0][Tutorial_Status]<>"Active"){
					$Email    = $NewUserList[0]["email"];
					$TutorialTitle = $TutorialList[0]["Tutorial_Title"];
					$CategoryName =$CategoryList[0]["Category_Name"];
					
					$objMail  = new EMail();
					$objMail->MailFields["TutorialTitle"]  = $TutorialTitle;
					$objMail->MailFields["CategoryName"]  = $CategoryName;
					$objMail->MailFields["path"] 	     	 = $global_config["SiteGlobalPath"];

					$objMail->Send($Email,"ACTIVE TUTORIAL");
					
		}
				}
			}
		}
		function ActivateInfoFromDBase($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where Ident = '$DelId'";
					$UpdateArray[0]["Field"] = "approval_status";
					$UpdateArray[0]["Value"] = "Active";
					$this->doUpdate($TableName,$UpdateArray,$Where);
				}
			}
		}
		function DeActivateInfoFromDB($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where Vendor_Id = '$DelId'";
					$UpdateArray[0]["Field"] = "Status";
					$UpdateArray[0]["Value"] = "Inactive";
					$this->doUpdate($TableName,$UpdateArray,$Where);
				}
			}
		}
		function DeActivateMenuInfoFromDB($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where Ident = '$DelId'";
					$UpdateArray[0]["Field"] = "Status";
					$UpdateArray[0]["Value"] = "Inactive";
					$this->doUpdate($TableName,$UpdateArray,$Where);
				}
			}
		}
		function DeActivateTutInfoFromDB($objArray,$TableName){
		//printArray($objArray);
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			printArray($_REQUEST);
			
			for($i=0;$i<$Count;$i++){
				//$DelId  = ;
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where Ident = '$DelId'";
					$UpdateArray[0]["Field"] = "Tutorial_Status";
					$UpdateArray[0]["Value"] = "Inactive";
					printArray($UpdateArray);
					$this->doUpdate($TableName,$UpdateArray,$Where);
					
					//send mail - Deactivate tutorial
					$strSql      = "select * from tbl_tutorials where Ident=" . $DelId;
					$TutorialList  = $this->getSelectByQuery($strSql);
					$TutorialCount = $this->dbQueryNumRows;
					
					$strSql      = "select * from tbl_members where Ident='" . $TutorialList[0]["Member_id"] . "'";
					$NewUserList  = $this->getSelectByQuery($strSql);
					$NewUserCount = $this->dbQueryNumRows;
					
					$strSql      = "select * from tbl_categories where Ident='" . $TutorialList[0]["Category_id"] . "'";
					$CategoryList  = $this->getSelectByQuery($strSql);
					$CategoryCount = $this->dbQueryNumRows;
					
					
					if($NewUserList[0][Tutorial_Status]<>"InActive"){
					$Email    = $NewUserList[0]["email"];
					$TutorialTitle = $TutorialList[0]["Tutorial_Title"];
					$CategoryName =$CategoryList[0]["Category_Name"];
					
					$objMail  = new EMail();
					$objMail->MailFields["TutorialTitle"]  = $TutorialTitle;
					$objMail->MailFields["CategoryName"]  = $CategoryName;
					$objMail->MailFields["path"] 	     	 = $global_config["SiteGlobalPath"];

					$objMail->Send($Email,"DEACTIVATE TUTORIAL");
					}
				}
			}
		}
		function DeActivateInfoFromDBase($objArray,$TableName){
		
			$Count  = count($_REQUEST["chk"]);
			$Ary    = $_REQUEST["chk"];
			for($i=0;$i<$Count;$i++){
				
				if($Ary[$i]!=""){
					$DelId = $Ary[$i];
					$Where = " where Ident = '$DelId'";
					$UpdateArray[0]["Field"] = "approval_status";
					$UpdateArray[0]["Value"] = "Inactive";
					
					$this->doUpdate($TableName,$UpdateArray,$Where);
				}
			}
		}
		function getFinalValue(){
			global $objSmarty;
			global $_REQUEST;
			
			foreach($_REQUEST as $key=>$value)	{
				if(!is_integer($key))	{
					$$key = $value;
					$objSmarty->assign($key,$value);
				}
			}	
		}
		function Chk_Number($value){
			$ValidChararr=array('0','1','2','3','4','5','6','7','8','9');
			$strlength=strlen(trim($value));
			for($i = 0; $i < $strlength; $i++){
				$onestr=substr($value,$i,1);
				if(!(in_array($onestr,$ValidChararr)))
					return 0;
			}
			return 1;
	   	}
		function getAlphabets(){
			global $objSmarty,$_SESSION,$S_AToZLetter;
			$Alphabets = array();
			$strAlphabets = "<table width = \"90%\" border=\"0\" align = \"center\"><tr>";
						$strAlphabets.="<td align = \"center\" class= \"AtoZLinkHover1\" style=\"cursor:pointer;\"><span onclick=\"getCategory('',0,'','')\"><b>All</b></span></td>";
			//else
				//$strAlphabets.="<td align = \"center\" class= \"AtoZLink1\" style=\"cursor:pointer;\"><span onclick=\"location.href='".$ATOZFileName."?txtSearchkey=".$strSearchText."&searchFld=".$strSearchFld."'\" >All</span></td>";
			if($this->Chk_Number($_SESSION["S_AToZLetter"]) == 1 && $_SESSION["S_AToZLetter"]!="")
				$strAlphabets.="<td align = \"center\" class= \"AtoZLinkHover1\"><B>0-91</B></td>";
			elseif($NumbericValues == "No")
				$strAlphabets.="<td align = \"center\" class= \"AtoZLink\">0-92</td>";
			//else
			//	$strAlphabets.="<td align = \"center\"  class= \"AtoZLink1\"  onMouseOver=\"this.className = 'AtoZLinkHover'\" onMouseOut=\"this.className='AtoZLink1'\" style=\"cursor:pointer;\"><span onclick=\"location.href='".$ATOZFileName."?al=0&txtSearchkey=".$strSearchText."&searchFld=".$strSearchFld."'\" id=\"AtoZ\" >0-9</span></td>";
			
			for ($i=65;$i<=90;$i++){
				$Char = chr($i);
				if($_SESSION["S_AToZLetter"] == $Char)
					$strAlphabets.= "<td class= \"AtoZLinkHover1\" align = \"center\"><B>$Char</B></td>";
				else{
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

		function getAlphabetsearch(){
			global $objSmarty,$_SESSION,$S_AToZLetter;
			$Alphabets = array();
			$strAlphabets = "<table width = \"90%\" border=\"0\" align = \"center\"><tr>";
			$strAlphabets.="<td align = \"center\" class= \"AtoZLinkHover1\" style=\"cursor:pointer;\"><span onclick=\"getCategory('',0,'','')\"><b>All</b></span></td>";
			
			if($this->Chk_Number($_SESSION["S_AToZLetter"]) == 1 && $_SESSION["S_AToZLetter"]!="")
				$strAlphabets.="<td align = \"center\" class= \"AtoZLinkHover1\"><B>0-91</B></td>";
			elseif($NumbericValues == "No")
				$strAlphabets.="<td align = \"center\" class= \"AtoZLink\">0-92</td>";
			//else
			//	$strAlphabets.="<td align = \"center\"  class= \"AtoZLink1\"  onMouseOver=\"this.className = 'AtoZLinkHover'\" onMouseOut=\"this.className='AtoZLink1'\" style=\"cursor:pointer;\"><span onclick=\"location.href='".$ATOZFileName."?al=0&txtSearchkey=".$strSearchText."&searchFld=".$strSearchFld."'\" id=\"AtoZ\" >0-9</span></td>";
			
			for ($i=65;$i<=90;$i++){
				$Char = chr($i);
				if($_SESSION["S_AToZLetter"] == $Char)
					$strAlphabets.= "<td class= \"AtoZLinkHover1\" align = \"center\"><B>$Char</B></td>";
				else{
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

		function getCategoryList(){
			$strSQL = "select * from tbl_categories where Parent_Category='0'";
			$this->dbSetQuery($strSQL,"select");
			$this->dbExecuteQuery();
			$ArrayResult = $this->dbSelectQuery();
			return($ArrayResult);
		}
        function getMemberList(){
			$strSQL = "select * from tbl_members ";
			$this->dbSetQuery($strSQL,"select");
			$this->dbExecuteQuery();
			$ArrayResult = $this->dbSelectQuery();
			return($ArrayResult);
		}
		function getMainMenus(){
			global $objSmarty,$AdmGeneral,$AdmCategory,$AdmMembers,$AdmTutorials,$AdmVideo,$AdmMaintainance;
			$MainArray  = array("General","Categories","Members","Free Tutorials","Video Tutorials","Course Tutorials");
			$FileArray  = array("main.php","managecategory.php","membersearch.php","free_tutorials.php","video_tutorials.php","professional_tutorials.php");
			$StyleArray = array("AdmGeneral","AdmCategory","AdmMembers","AdmTutorials","AdmVideo","AdmMaintainance");

			for($i=0;$i<count($MainArray);$i++){
				if($$StyleArray[$i]==1)
				$MainStyleArray[$i] = "BlackMenuFont";
				else
				$MainStyleArray[$i] = "BlueMenuFont";
			}
			$objSmarty->assign("MainStyleArray",$MainStyleArray);
			$objSmarty->assign("MainArray",     $MainArray);
			$objSmarty->assign("FileArray",     $FileArray);
		}
		
		function setInvalidCodeError(){
			global $objSmarty;
			$strErrorString = "<SCRIPT>\n";
			$strErrorString.= "var strErrorString = '';\n";
			$strErrorString.= "strErrorString+='____________________________________________________________________\\n\\n';\n";
			$strErrorString.= "strErrorString+='Your registration has not been submitted because of the following Problem(s).\\n';\n";
			$strErrorString.= "strErrorString+='____________________________________________________________________\\n\\n';\n";
			$strErrorString.= "strErrorString+='You have entered an invalid verification code!\\nPlease re-enter the verification code correctly.';\n";
			$strErrorString.= "\nalert(strErrorString);\n";
			$strErrorString.= "</SCRIPT>";
			$objSmarty->assign("JS_ExtraScript",$strErrorString);
			return $strErrorString;
		}
		
		function prePopulateForm(){
			global $objSmarty,$globalVal,$_REQUEST;
				foreach($_REQUEST as $key=>$value)	{
					if(!is_integer($key))	{
						$$key = $value;
						 $globalVal[$key] = $value;
						$objSmarty->assign($key,$value);	
					}
				}	
		}


		function getDuplicateList(){
             global $_REQUEST,$objSmarty;
			$sort = $_REQUEST["sort"];
			$type = $_REQUEST["type"];
			
			$objSmarty->assign("sort",$sort);
			$objSmarty->assign("type",$type);
			if($sort!="" && $type!=""){
			$OrderBy = " order by $sort $type";
			}
			###################################3
			if($RowDisplay == '') $RowDisplay=15;
			$strSql      = "select * from ".$this->Tutorials." where Tutorial_Status='InActive'"; 
			
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage($_REQUEST,$RowDisplay,$strSql);
			$this->perPageList($RowDisplay);
			#######################################
			
			$strSql      = "select * from ".$this->Tutorials." where Tutorial_Status='InActive'".$Qry_limit;
			$TutorialsList  = $this->getSelectByQuery($strSql);
			$TutorialsCount = $this->dbQueryNumRows;
			$j=0;
			for($i=0;$i<$TutorialsCount;$i++){
					$URL   = $TutorialsList[$i]["Destination"];
					$Count = $this->checkforDuplicateURL($URL);
					if($Count>1){
						$strTutorialList[$j]["Tutorial_Title"] = $TutorialsList[$i]["Tutorial_Title"];
						$strTutorialList[$j]["Destination"]    = $TutorialsList[$i]["Destination"];
						$strTutorialList[$j]["Ident"]          = $TutorialsList[$i]["Ident"];
						$j++;
					}	
			}
			$objSmarty->assign("TutorialsList",$strTutorialList);
			$objSmarty->assign("TutorialsCount",$TutorialsCount);
	}	
	
		function checkforDuplicateURL($URL){
			$strSql      = "select count(*) from ".$this->Tutorials." where Destination='$URL'";
			$TutorialsList  = $this->getSelectByQuery($strSql);
			$TutorialsCount = $this->dbQueryNumRows;
			return($TutorialsList[0][0]);
		}

		function checkforValidLink(){
			  global $_REQUEST,$objSmarty;
			$sort = $_REQUEST["sort"];
			$type = $_REQUEST["type"];
			
			$objSmarty->assign("sort",$sort);
			$objSmarty->assign("type",$type);
			if($sort!="" && $type!=""){
			$OrderBy = " order by $sort $type";
			}
			###################################3
			if($RowDisplay == '') $RowDisplay=15;
			$strSql      = "select * from ".$this->Tutorials." where Tutorial_Status='InActive'"; 
			
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage($_REQUEST,$RowDisplay,$strSql);
			$this->perPageList($RowDisplay);
			#######################################
			
			$strSql      = "select * from ".$this->Tutorials." where Tutorial_Status='InActive'".$Qry_limit;
			$TutorialsList  = $this->getSelectByQuery($strSql);
			$TutorialsCount = $this->dbQueryNumRows;
			$j=0;
			for($i=0;$i<$TutorialsCount;$i++){
					$URL   = $TutorialsList[$i]["Destination"];
					$content = @file_get_contents($URL);
					if(strlen($content) <= "0"){
						$strTutorialList[$j]["Tutorial_Title"] = $TutorialsList[$i]["Tutorial_Title"];
						$strTutorialList[$j]["Destination"]    = $TutorialsList[$i]["Destination"];
						$strTutorialList[$j]["Ident"]          = $TutorialsList[$i]["Ident"];
						$j++;
					}	
			}
			$objSmarty->assign("TutorialsList",$strTutorialList);
			$objSmarty->assign("TutorialsCount",$TutorialsCount);
		}
		function getTutorialIdByTitle($strTitle){
			$strSql      = "select Ident from ".$this->Tutorials." where LOWER(Tutorial_Title)='" . addslashes($strTitle) . "' and Tutorial_Type='video-tutorials'";
			$TutorialsList  = $this->getSelectByQuery($strSql);
			$TutorialsCount = $this->dbQueryNumRows;
			return($TutorialsList[0][0]);
		}
		function daysGet()
		{
			$result = array();
			foreach (range(1,31) as $d) {
				$s = sprintf('%02d', $d);
				$result[$s] = $s;
			} 
			return $result;
		}
		
		function yearsGet()
		{
			$result = array();
			foreach ( range(1950, 2000) as $y) {
				$result[$y] = $y;
			} 
			return $result;
		}
		
		function monthsGet()
		{
			$result = array();
			foreach (range(1, 12) as $m) {
				$s = sprintf('%02d', $m);
				$result[$s] = $s;
			} 
			return $result;
		}	
			
		function getBrowserType() {
			$ua = $_SERVER[HTTP_USER_AGENT]; 
		
			if (strpos($ua,'MSIE')>0)
			{
			  $B_Name="MSIE";
			  $B_Name1=1;
		
			}else if (strpos($ua,'Netscape')>0)
			{
			  $B_Name="Netscape";
			  $B_Name1=2;
			}else
			{
			  $B_Name="Firefox";
			  $B_Name1=2;
			}
		
			return $B_Name;
		}
			
		function getBrowserVersion() {
			$ua = $_SERVER[HTTP_USER_AGENT]; 
		
			if (strpos($ua,'MSIE')>0)
			{
				$pos = strrpos($ua, "MSIE");
				$pos=$pos+5;
				$B_Version=substr($ua,$pos,1);
				return $B_Version;
			}
			
		}
		function common_Update($strTable,$strUpdateArray,$strPrimaryField,$strPrimaryValue,$debugMode=0)	{ 
			global $global_config,$global_log;
			if($this->VFPMode) {
				$obj_Select = new extendsClassOdbtpDB();
			} else {
				$obj_Select = new extendsClassDB();
			}
			
			for($i=0;$i<count($strUpdateArray);$i++)	{
				$strQuery.= $strUpdateArray[$i][0]."="."'".addslashes($strUpdateArray[$i][1])."'";
				if($i<count($strUpdateArray)-1)		
					$strQuery.=", ";
			}
			if($this->VFPMode)
			{
			$QryUpdate = "Update ".$strTable." set ".$strQuery." where ".$strPrimaryField ."= '".$strPrimaryValue."'";
			}
			else
			{
			$QryUpdate = "Update ".$global_config["table_prefix"].$strTable." set ".$strQuery." where ".$strPrimaryField ."= '".$strPrimaryValue."'";
			}
			
			if($debugMode!=0 && $global_config["debug_mode"] == "1"){
				echo $QryUpdate."<BR>";
			}	
			$obj_Select->dbSetQuery($QryUpdate,"update");  
			$obj_Select->dbExecuteQuery();
			
			$this->VFPMode = "";
			
			if($obj_Select->dbQueryNumRows==0){
				$this->ErrorStatus=1;
				return false;
			}			
		}

		function strib($strData) {
			$strData = ltrim($strData);
			$strData = rtrim($strData);
			$strData = stripslashes($strData);
			$strData = strip_tags($strData);			
			$strData = htmlspecialchars($strData);
			$special = array('Â','Ã','±','&','&gt;','"',"'",'©','“','€','™','amp;nbsp;','Acirc;','”','amp;','nbsp;','acirc;','†','’','cent;','‡','','—','ž','•','œ','ƒ'); 
			$strData = str_replace($special,'-',$strData);
			$strData = str_replace("'",'-',$strData);
			$strData = str_replace("/",'-',$strData);
			$strData = str_replace('"','-',$strData);
			$strData = str_replace(' ','-',$strData);
			return $strData;
			
		}
		function stribData($strData) {
			$strData = ltrim($strData);
			$strData = rtrim($strData);
			$strData = stripslashes($strData);
			$strData = strip_tags($strData);			
			$strData = htmlspecialchars($strData);
			$strData = str_replace("'",'-',$strData);
			return $strData;
			
		}
		function unStribData($strData) {
			$strData = ltrim($strData);
			$strData = rtrim($strData);
			$strData = stripslashes($strData);
			$strData = strip_tags($strData);			
			$strData = htmlspecialchars($strData);
			$strData = str_replace("-","'",$strData);
			return $strData;
			
		}
		
		function getTodaysDate()	{
			$current_date = date("d-m-Y");
			$date_array   = split("-", $current_date);
			$current_date = $date_array[2] . "-" . $date_array[1] . "-" . $date_array[0];	
			return ($current_date);				
		}
		
	}
?>