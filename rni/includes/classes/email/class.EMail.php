<?
	/**
	 * Project:     Everythinghair.com: Mail Class
	 * File:       class.EMail.php
	 *
	 * @link http://www.Everythinghair.com/
	 * @copyright 2001-2005 Everythinghair.com,.
	 * @package Everythinghair
	 * @version 1.0.0
	 */

	/* $Id: config.php,v 1.514 2006/06/21 18:21:06 messju Exp $ */
	require_once(MAIN_CLASS_PATH.'common/class.LibMail.php');
	require_once(MAIN_CLASS_PATH.'email/class.EMailTemplate.php');
	class EMail extends EMailTemplate {
		
		var $ToEmail;
		var $ToName;
		
		var $FromEmail;
		var $FromName;
		
		var $CCEmail;
		var $CCName;
		
		var $BCCEmail;
		var $BCCName;
		
		var $ReplyEmail;
		var $ReplyName;
		
		var $Subject;
		var $Body;
		
		var $MailFields;
		var $MailLinks;
		
		var $AttachFile;
		
		var $TemplateCode;
		
		var $MailFormat;
		
		function EMail() {
			$this->EMailTemplate();
		}

		/*
			strToEmail 		-> To Email Address.
			strTemplateCode	-> Template Code(like ACTIVATION).
			strSubject		-> We can use Subject in two ways. One is use from Table or We can specify as an Arguments.
			strCcMail		->	CCMail we can specify in our arguments.
		*/
		function Send($strToEmail = "", $strTemplateCode = "", $strSubject="", $strCcMail="", $strFromName = "", $strFromMail="", $strMailFields = "", $strMailLinks = "") {
			if($strToEmail != "")
				$this->ToEmail = $strToEmail;
			if($strTemplateCode != "")
				$this->TemplateCode = $strTemplateCode;
			if($strMailFields != "")
				$this->MailFields = $strMailFields;
			if($strMailLinks != "")
				$this->MailLinks = $strMailLinks;				

			if($this->TemplateCode!='')
			{
				$getTemplateDetails = $this->getTemplate($this->TemplateCode);	
				//$LastInsertId = $this->insertMails($this->TemplateCode);
				$this->MailFields["GlobalPath"] = SITEGLOBALPATH;				
				$strMailContent = $this->getMailContent($this->TemplateCode);
				$strMailContent = $this->ParseContent($strMailContent,$this->MailFields);
				//printArray($strMailContent); exit;
				if($this->MailLinks!='')
				{
					//$this->MailLinks = $this->getMailLinks($this->MailLinks,$getTemplateDetails["HTMLFormat"]);
					//$strMailContent = $this->ParseContent($strMailContent,$this->MailLinks);
				}
				//$this->FromEmail	= $getTemplateDetails["FromAddress"];
				$this->ToEmail 		= $this->ToEmail;
				if($strSubject == "") {  //$this->Subject		= $getTemplateDetails["Subject"];
					$this->Subject = $this->ParseContent($getTemplateDetails["Subject"],$this->MailFields); 
				}
				else
					$this->Subject		=  $strSubject;
	
				if($strFromName == "")
					$this->FromName = $this->ParseContent($getTemplateDetails["FromName"],$this->MailFields); 
				else
					$this->FromName		=  $strFromName;
				
				if($strFromMail == "")
					$this->FromEmail = $this->ParseContent($getTemplateDetails["FromAddress"],$this->MailFields); 
				else
					$this->FromEmail		=  $strFromMail;
					
				//if($strMailContent!='' && $this->ToEmail!='')
					//$this->updateMails($this->ToEmail,$strMailContent,'Sent',$this->FromEmail,$this->Subject);			
				$this->HTMLFormat	= $getTemplateDetails["HTMLFormat"];
				$this->MailContent	= $strMailContent;
				$this->Cc = $strCcMail;
				$this->MailSend();
				//print $this->ToEmail."<br>";
				//print $this->Subject."<br>";
				//print $this->FromEmail."<br>";
				//print $this->MailContent;
			}

		}
		
		function SendMail($strToEmail = "", $strMailContent = "", $strSubject="", $strCcMail="", $strFromName = "", $strFromMail="", $strMailFields = "", $strMailLinks = ""){
				$this->ToEmail = $strToEmail;

				$this->MailFields["GlobalPath"] = SITEGLOBALPATH;				
				$strMailContent = $strMailContent;
				$strMailContent = $this->ParseContent($strMailContent,$this->MailFields);

				$this->Subject		=  $strSubject;
	
				$this->FromName		=  $strFromName;
				
				$this->FromEmail		=  $strFromMail;
				$this->HTMLFormat	= "Yes";
				$this->MailContent	= $strMailContent;
				$this->Cc = $strCcMail;
				//print $this->ToEmail."<br>";
				//print $this->Subject."<br>";
				//print $this->FromEmail."<br>";
				//print $this->MailContent;				
				$this->MailSend();

		}
		
		function MailSend()	
		{
			global $global_config;
			$m = new LibMail; // create the mail
			$m->From($this->FromName." <".$this->FromEmail.">");
			$m->To($this->ToEmail);
			$m->Subject($this->Subject);
			$m->Body($this->MailContent);
						
			if($this->Cc != "")
			{
				$m->Cc($this->Cc);	
			}
			$m->Priority(3);
			if($this->HTMLFormat == "No")
				$m->HeaderType = "text/plain";
			else
				$m->HeaderType = "text/html";
			$m->Send();
		}//End of Function
		
		function RedirectPath($strRedirectValue){
			$strPath = $this->getRedirectPath($strRedirectValue);
		}
	}
?>