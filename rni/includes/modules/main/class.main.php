<?
	/**
	 * Project:    Everythinghair.com : Main Class
	 * File:       class.main.php
	 *
	 * @link http://www.Everythinghair.com/
	 * @copyright 2001-2005 Everythinghair.com,.
	 * @package Everythinghair
	 * @version 1.0.0
	 */
    require_once(MAIN_CLASS_PATH."email/class.EMail.php");

	class Main extends Common {
		function Main() {
			$this->Common();
			$this->User 		  	= "tbl_users";
			$this->States			= "tbl_State";
		}
		
		function UserCheck(){
			global $_REQUEST,$objSmarty;
			$txt_Email = $_REQUEST['txt_Email'];
			
			$strSql    = "select * from ".$this->User." where email ='". $txt_Email . "'" ;
	
			$UserList  = $this->getSelectByQuery($strSql);
			$UserCount = $this->dbQueryNumRows;
			return $UserCount;
			}

		function CheckLogin()	{		
			global $_REQUEST,$objSmarty,$global_config,$_SESSION;
			$strSql        = "select * from ".$this->User. " where username ='" . $_REQUEST["Username"] . "' and password='" . $_REQUEST["password"] . "'";
			$UserList      = $this->getSelectByQuery($strSql);
			$UserCount     = $this->dbQueryNumRows; 
			$IsLogin	   = "";	
			
			if($UserList[0]["Status"]=="Active")
			 {
			 $_SESSION['visitorname'] = $_REQUEST["Username"];
			 $_SESSION['sesUserId']   = $UserList[0]["id"];
			 $objSmarty->assign("UserId",$_SESSION['sesUserId']);			 
			 $objSmarty->assign("UserList",$UserList);
			 $this->setVariable("InnerTpl","content.tpl");
			// header("Location:../index.php");
			 exit;
			 }
			elseif($UserList[0]["Status"]=="Inactive"){
				 $strMsg = "Your registration status is not activated...";
			 //$objSmarty->assign("strMsg","Your registration status is not activated..."); 
			}else{
				$strMsg = "User Account does not Exist...";
			 //$objSmarty->assign("strMsg","User Account does not Exist..."); 
			} 
			print $strMsg;
			exit;					 
		}
			
		function addUsers($objArray){
	
			global $_REQUEST,$objSmarty,$global_config;
	
			$current_date = date("d-m-Y");
			$date_array   = split("-", $current_date);
			$current_date = $date_array[2] . "-" . $date_array[1] . "-" . $date_array[0];			
			
			$objArray["txt_created_on"]=date("Y-m-d H:i:s");
			
			
			$UserCount = $this->UserCheck();
			
			if($UserCount==0)
			{			
			$current_id = $this->AddInfoToDB($objArray,"txt_",$this->User);
			
			
			$Email     = $objArray["txt_Email"];
			$UserLogin = $objArray["txt_UserName"];
			$Password  = $objArray["txt_Password"];
			
			$objMail   = new EMail();
	
			$objMail->MailFields["UserLogin"] = $UserLogin;
			$objMail->MailFields["path"] 	     	 = $global_config["SiteGlobalPath"];	
			//$objMail->MailFields["code"] = "Your account is not approved by admin. After approving your account, a mail will be sent to you with login information.";
				
			$objMail->Send($Email,"REGISTER");
			$msg = "Subscribed Sucessfully";
			$objSmarty->assign("Errcolor","#009933");
			$objSmarty->assign("strMsg",$msg);
						
			header("Location:index.php");
			}
			else
			{
			$this->prePopulateForm();
			$objSmarty->assign("Errcolor","#FF0000");
			 $objSmarty->assign("strMsg","Email Address Alreay Exist");
			}
						
		}

	function IsLogin(){
		global $_REQUEST,$objSmarty,$global_config,$_SESSION;
		if($_SESSION['sesUserId']){
			$strSql        = "select * from ".$this->User. " where id='" . $_SESSION['sesUserId']."'" ;
			$UserList      = $this->getSelectByQuery($strSql);
			$objSmarty->assign("UserList",$UserList);
			return $UserList;
		}	
		
	}
	function Login()
	{		
		global $_REQUEST,$objSmarty,$global_config,$_SESSION;
		
		$strSql        = "select * from ".$this->User. " where username='" . $_REQUEST["txtusername"] . "' and password='" . $_REQUEST["txtpassword"] . "'";
		$UserList      = $this->getSelectByQuery($strSql);
		$UserCount     = $this->dbQueryNumRows; 
		
		$objSmarty->assign("UserList",$UserList);
		
		if ($UserList[0]["LoggedIn"] == 0 and $UserList[0]["Status"] == "Active") {
					 $objSmarty->assign("strCPMsg","You must change your password while you login first time."); 
					 $user=4;
					 return $user;
		}
		$IsLogin	   = "";			
			 	if($UserList[0]["Status"]=="Active")
				 {
					 $_SESSION['visitorname'] = $_REQUEST["txtusername"];
					 $_SESSION['sesUserId']   = $UserList[0]["id"];
					 $objSmarty->assign("UserId",$_SESSION['sesUserId']);
					 $user=1;
					 return $user;
				 }elseif($UserList[0]["Status"]=="Inactive"){
					 $objSmarty->assign("strMsg","Your registration status is not activated"); 
					 $user=2;
					 return $user;
				 }else{
					 $objSmarty->assign("strMsg","User Account does not exist"); 
					 $user=3;
					 return $user;
				} 
				 
	}
	
	function edit_profile($objArray) {
			global $_REQUEST,$objSmarty,$global_config;
			$current_date = date("d-m-Y");
			$date_array   = split("-", $current_date);
			$current_date = $date_array[2] . "-" . $date_array[1] . "-" . $date_array[0];					
			//$objArray["txtcreated_on"]=$current_date;			
			$objArray["txtdob"] = $objArray["year"] . "-" . $objArray["month"] . "-" . $objArray["day"];	
			
			
			$where = " where id='" . $_SESSION['sesUserId'] . "'";
			$objSmarty->assign(strMsg,"Your Profile has Modified Successfully...");
				$this->UpdateInfoToDB($objArray,"txt",$this->User,$where);		

		
	}
	function getUser($objArray='') {
		global $_REQUEST,$objSmarty,$global_config,$_SESSION;
		$objController = new MainController();
		$objMain       = new Main();		
		$strSql        = "select * from ".$this->User. " where id='" . $_SESSION['sesUserId'] . "'";
		$UserList      = $this->getSelectByQuery($strSql);
		$UserCount     = $this->dbQueryNumRows;		
		
		for($i=0;$i<count($UserCount);$i++) {
		$dobAry = split("-",$UserList[$i]["dob"]);
		$UserList[$i]["year"] = $dobAry[0];
		$UserList[$i]["month"] = $dobAry[1];
		$UserList[$i]["day"] = $dobAry[2];
		}

		if($UserCount<>0) {
			$objSmarty->assign("UserList",$UserList);		
		}	
	}
	function countriesGet()
	{
		global $objSmarty;
		$strSql           = "select * from ". $this->Country ." group by CountryName";
		$CountryName      = $this->getSelectByQuery($strSql);
		$CountryNameCount = $this->dbQueryNumRows;
		for($i=0;$i<$CountryNameCount;$i++)
		{
			$CountryName[$i] = $CountryName[$i]["CountryName"];
		}
		$objSmarty->assign("CountryName",$CountryName);
	}	
	
	function statesGet()
	{
		global $objSmarty;
		$strSql           = "select * from ".$this->States;
		$StatesName       = $this->getSelectByQuery($strSql);
		$StatesNameCount  = $this->dbQueryNumRows;
		for($i=0;$i<$StatesNameCount;$i++)
		{
			$StatesName[$i] = $StatesName[$i]["Name"];
		}
		$objSmarty->assign("StatesName",$StatesName);
	}		

	function getforgetUserName()
	 {
		global $objSmarty;
		$UserName    = $_REQUEST['emailid'];
		$strSql      = "select * from ".$this->User." where email='$UserName' ";
		$LoginValue  = $this->getSelectByQuery($strSql);
		$LoginCount  = $this->dbQueryNumRows;
	
		 if($LoginCount !=0) {
			$this->ForgotPasswordEmail($LoginValue[0]["password"],$LoginValue[0]["email"]);
			$strMsg	= "Mail has Been Sent Successfully";
		 }	else {
			$strMsg	= "Invalid User Name";
		 } 		
		// $this->setVariable("InnerTpl","forgetpwd.tpl");  
		 print $strMsg;	
		 exit;		 
	 }	
	 
	 
		function ForgotPasswordEmail($Password,$Email)
		{ 
			global $global_config;
			$objMail = new EMail();
			$objMail->MailFields["Password"] 	     = $Password;
			$objMail->MailFields["path"] 	     	 = $global_config["SiteGlobalPath"];			
			$objMail->Send($Email,"FORGET_PASSWORD");
		}		

		function getImages($limit=''){
		 	global $objSmarty;
			if($limit){
				$QryLimit=" LIMIT 0," . $limit;
				 $Orederby=" ORDER BY id desc ";
			} 
			else
				$QryLimit=" LIMIT 3,15" ;
				
			$strSql      = "select * from ".$this->Pictures .$Orederby .$QryLimit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("Images",$Images);
		}			
		
		function getImagesName(){
		 	global $objSmarty;
			if($limit)
				 $QryLimit=" LIMIT 0," . $limit;
			else
				$QryLimit=" " ;
				
			$OrderBy= ' GROUP BY name  ORDER BY name ASC ';	
			
			$strWhereClause= " WHERE celebrities='1' ";
				
				$strSql      = "select name from ". $this->Pictures . $strWhereClause . $OrderBy .$QryLimit;
				$Images    = $this->getSelectByQuery($strSql);
				$ImagesCount = $this->dbQueryNumRows;
				
				for($i=0;$i<$ImagesCount;$i++)
				{
					$name= trim($Images[$i]['name']);
					$strWhereClause1= " WHERE name = '$name' "  ;
					$OrderBy1= ' ORDER BY name ASC ';	
					$Images[$i]['names'] = str_replace(' ', '-', $Images[$i]["name"]);//;$Name=str_replace('-', ' ', $name);
						$strSql1     = "select * from ". $this->Pictures . $strWhereClause1 ;
						$Images1    = $this->getSelectByQuery($strSql1);
						$ImagesCount1 = $this->dbQueryNumRows;
						$Images[$i]['count']=$ImagesCount1;
						
				}
			$Alphabets=$this->Alphabets();
				for($i=0;$i<$ImagesCount;$i++)
				{
					for($j=0;$j<25;$j++){
						$char=substr($Images[$i]['name'],0,1);
						if(ucwords($char)==$Alphabets[$j])
							$Images[$i]['char']=$Alphabets[$j];
						if($Images[$i]['char']==$Images[$i-1]['char']){	
							//$Images[$i]['char']='';
						}else{
							$Images[$i]['chars']=$Images[$i]['char'];
						}
					}	

				}	
				
				$objSmarty->assign("ImagesCount",$ImagesCount);
				$objSmarty->assign("Images",$Images);
		}	
		
		function Alphabets(){
		global $objSmarty;
			$Alphabets = array();
			$Alphabets[0]='A';
			$Alphabets[1]='B';
			$Alphabets[2]='C';
			$Alphabets[3]='D';
			$Alphabets[4]='E';
			$Alphabets[5]='F';
			$Alphabets[6]='G';
			$Alphabets[7]='H';
			$Alphabets[8]='I';
			$Alphabets[9]='J';
			$Alphabets[10]='K';
			$Alphabets[11]='L';
			$Alphabets[12]='N';
			$Alphabets[13]='M';
			$Alphabets[14]='O';
			$Alphabets[15]='P';
			$Alphabets[16]='Q';
			$Alphabets[17]='R';
			$Alphabets[18]='S';
			$Alphabets[19]='T';
			$Alphabets[20]='U';
			$Alphabets[21]='V';
			$Alphabets[22]='W';
			$Alphabets[23]='X';
			$Alphabets[24]='Y';
			$Alphabets[25]='Z';
			$objSmarty->assign('Alphabets', $Alphabets);
			return 		$Alphabets;
		}		

		
}

?>