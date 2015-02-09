<?
	/**
	 * Project:     Everythinghair.com: EMail Template Class
	 * File:       class.EMailTemplate.php
	 *
	 * @link http://www.Everythinghair.com/
	 * @copyright 2001-2005 Everythinghair.com,.
	 * @package Everythinghair
	 * @version 1.0.0
	 */

	/* $Id: config.php,v 1.514 2006/06/21 18:21:06 messju Exp $ */
 	
	class EMailTemplate extends Common {
		
		function EMailTemplate() {
			$this->Common();
			$this->EMailTemplateTable  	= $this->tblPrefix."EMail_Template_Files";
			$this->MailsTable			= $this->tblPrefix."Mails";
			$this->MailLinksTable		= $this->tblPrefix."MailLinks";
		}
		
		function getContent($strFile){
			if($strFile == "")
				return "";
			$strFile = MAILS_LOCAL_PATH.$strFile;
			if(!file_exists($strFile))
				return "";
			$filecontents	= @file($strFile);
			if(is_array($filecontents))
			{
				foreach($filecontents as $content){
					$strContent = $strContent.$content;
				}
			} 
			$strContent = str_replace("\r\n",chr(13),$strContent);
			return $strContent;
		}
		
		function getTemplate($strTemplateCode) {
			$strSQL = "SELECT * FROM ".$this->EMailTemplateTable." where TemplateCode = '".$strTemplateCode."'";
			$rsTemplate = $this->getSelectByQuery($strSQL);
			return $rsTemplate[0];
		}
		
		function insertMailDetails($ToEmail,$MailContent,$Status,$FromMail,$strSubject){
			$UpdateQry[0]["Field"]		= "ToAddress";
			$UpdateQry[0]["Value"]		= $ToEmail;
			$UpdateQry[1]["Field"]		= "Message";
			$UpdateQry[1]["Value"]		= $MailContent;
			$UpdateQry[2]["Field"]		= "Status";
			$UpdateQry[2]["Value"]		= $Status;
			$UpdateQry[3]["Field"]		= "FromAddress";
			$UpdateQry[3]["Value"]		= $FromMail;
			$UpdateQry[4]["Field"]		= "Subject";
			$UpdateQry[4]["Value"]		= $strSubject;
			$UpdateQry[5]["Field"]		= "SentDate";
			$UpdateQry[5]["Value"]		= date("Y-m-d G:i:s");
			//$Id = $this->doInsert($this->MailsTable,$UpdateQry);
			
			$UpdateQry1[1]["Field"]		= "MailContent ";
			$UpdateQry1[1]["Value"]		= $MailContent;
			$UpdateQry1[2]["Field"]		= "Status";
			$UpdateQry1[2]["Value"]		= "Active";
			$UpdateQry1[3]["Field"]		= "FromAddress";
			$UpdateQry1[3]["Value"]		= $FromMail;
			$UpdateQry1[4]["Field"]		= "Subject";
			$UpdateQry1[4]["Value"]		= $strSubject;
			$UpdateQry1[5]["Field"]		= "AddedDate";
			$UpdateQry1[5]["Value"]		= date("Y-m-d G:i:s");
			//$Id = $this->doInsert($this->EMailTemplateTable,$UpdateQry1);
			return $Id; 
		}
		
		function insertMails($strTemplateCode){
			$rsTemplate = $this->getTemplate($strTemplateCode);
			$InsertQry[0]["Field"] = "TemplateCode";
			$InsertQry[0]["Value"] = $strTemplateCode;
			$InsertQry[1]["Field"] = "FromAddress";
			$InsertQry[1]["Value"] = $rsTemplate["FromAddress"];
			$InsertQry[2]["Field"] = "Subject";
			$InsertQry[2]["Value"] = $rsTemplate["Subject"];
			$InsertQry[3]["Field"] = "SentDate";
			$InsertQry[3]["Value"] = date("Y-m-d G:i:s");
			if($strTemplateCode!='')
				//$Id = $this->doInsert($this->MailsTable,$InsertQry);
			return $Id;
		}
		
		function updateMails($ToEmail,$MailContent,$Status,$FromMail,$strSubject){
			$strSQL = "SELECT MAX(MailId) FROM ".$this->MailsTable."";
			$rsMails = $this->getSelectByQuery($strSQL);
			$UpdateQry[0]["Field"]		= "ToAddress";
			$UpdateQry[0]["Value"]		= $ToEmail;
			$UpdateQry[1]["Field"]		= "Message";
			$UpdateQry[1]["Value"]		= $MailContent;
			$UpdateQry[2]["Field"]		= "Status";
			$UpdateQry[2]["Value"]		= $Status;
			$UpdateQry[3]["Field"]		= "FromAddress";
			$UpdateQry[3]["Value"]		= $FromMail;
			$UpdateQry[4]["Field"]		= "Subject";
			$UpdateQry[4]["Value"]		= $strSubject;
			$UpdateQry[5]["Field"]		= "SentDate";
			$UpdateQry[5]["Value"]		= date("Y-m-d G:i:s");
			$strWhereClause = " WHERE MailId = '".$rsMails[0][0]."'";
			if($rsMails[0][0]!='')
				//$this->doUpdate($this->MailsTable,$UpdateQry,$strWhereClause);
			return true; 
		}
		
		function insertMailLinks($strNewMailLinks,$strMailLinks){
			$strSQL = "SELECT MAX(MailId) FROM ".$this->MailsTable;
			$rsMails = $this->getSelectByQuery($strSQL);
			$InsertQry[0]["Field"] = "MailId";
			$InsertQry[0]["Value"] = $rsMails[0][0];
			$InsertQry[1]["Field"] = "SiteMailLinks";
			$InsertQry[1]["Value"] = $strNewMailLinks;
			$InsertQry[2]["Field"] = "NewMailLinks";
			$InsertQry[2]["Value"] = $strMailLinks;
			$InsertQry[3]["Field"] = "AddedDate";
			$InsertQry[3]["Value"] = date("Y-m-d G:i:s");
			if($rsMails[0][0]!='')
				//$this->doInsert($this->MailLinksTable,$InsertQry);
			return true;
		}
		
		function getMailContent($strTemplateCode) {
			$rsTemplate = $this->getTemplate($strTemplateCode);
			$strContent = stripslashes($rsTemplate["MailContent"]);
			return $strContent;
			/*if($rsTemplate != "")
			{
				if($rsTemplate["HTMLFormat"] == 'Yes')
				{
					$strHeader  = $this->getContent($rsTemplate["HTMLHeaderFile"]);
					$strFooter  = $this->getContent($rsTemplate["HTMLFooterFile"]);
					$strContent = $strHeader.$this->getContent($rsTemplate["HTMLTemplateFile"]).$strFooter;
				}
				else
				{
					$strContent = $this->getContent($rsTemplate["TEXTTemplateFile"]);
				}
				
			}
			else
				return "";*/
		}
		
		function getMailLinks($strMailLinks,$isHTMLFormat){
			if(is_array($strMailLinks))
			{
				foreach($strMailLinks as $key=>$value)
				{
					$getLoginId = md5($key.date("ymdgis"));
					if($isHTMLFormat == 'No')
						$strNewMailLinks[$key] =SITEGLOBALPATH."links.php?rel=".$getLoginId;
					else
						$strNewMailLinks[$key] = "<a href='".SITEGLOBALPATH."links.php?rel=".$getLoginId."' target='_blank'>".SITEGLOBALPATH."links.php?rel=".$getLoginId."</a>";
					$this->insertMailLinks($getLoginId,$strMailLinks[$key]);
				}
			}
			return $strNewMailLinks;
		}
		
		
		function ParseContent($strContent,$strFields){
			global $global_config;
			if($strFields == "")
				return $strContent;
			$strFields["SiteName"] 			= $global_config["SiteName"];
			$strFields["SiteUrl"] 			= $global_config["SiteUrl"];
			$strFields["SupportMail"]		= $global_config["SupportMail"];
			$strFields["SiteDomainName"]	= $global_config["SiteDomainName"];
			
			foreach ($strFields as $Key=>$Value) { 
				$strContent =  ereg_replace('\$' . $Key . '\$', $Value, $strContent); }
			//$strContent = getHTMLFormat($strContent);
			return $strContent;
		}
		
		function getSiteLinks($siteLinks){
			$strSQL = "SELECT * FROM ".$this->MailLinksTable." where SiteMailLinks = '".$siteLinks."'";
			$rsLinks = $this->getSelectByQuery($strSQL);
			$updateSql = "UPDATE ".$this->MailLinksTable." SET LinkStatus  = 'InActive' WHERE SiteMailLinks = '".$siteLinks."'";
			$this->getSelectByQuery($updateSql);
			return $rsLinks[0];
		}
		
		function getRedirectPath($strRedirectValue){
			$getSitePath = $this->getSiteLinks($strRedirectValue);
			if($getSitePath["NewMailLinks"]!='' && $getSitePath["LinkStatus"] == 'Active') {
				$EmailLink = str_replace("&amp;","&",$getSitePath["NewMailLinks"]);
				$this->Redirect($EmailLink); 
			}
			else
				$this->Redirect("index.php");
		}
	}
?>