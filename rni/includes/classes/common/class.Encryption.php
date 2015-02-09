<?
	/**
	 * Project:    Everythinghair.com : Encryption Class
	 * File:       class.Encryption.php
	 *
	 * @link http://www.Everythinghair.com/
	 * @copyright 2001-2005 Everythinghair.com,.
	 * @package Everythinghair
	 * @version 1.0.0
	 */
	
	class Encryption
	{
		var $strKeyAr1;
		var $strKeyAr2;
		var $strKeyAr3;
		
		function Encryption()
		{
			$this->strKeyAr1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$this->strKeyAr2 = "zyxwvutsrqponmlkjihgfedbca";
			$this->strKeyAr3 = "01234567899876543210";
		}
		
		function keyED($strText,$strEncryptKey) { 
			$intCounter=0; 
			$strTemp = ""; 
			for ($i=0;$i<strlen($strText);$i++) { 
				 if ($intCounter==strlen($strEncryptKey)) $intCounter=0; 
				 $strTemp.= substr($strText,$i,1) ^ substr($strEncryptKey,$intCounter,1); 
				 $intCounter++; 
			} 
			return $strTemp; 
		} 
		
		function Encrypt($strText,$strKeyAr) { 
			srand((double)microtime()*1000000);
			$strEncryptKey = md5(rand(0,32000));
			$intCounter=0;
			$strTemp = "";
			for ($i=0;$i<strlen($strText);$i++) {
				 if ($intCounter==strlen($strEncryptKey)) $intCounter=0;
				 $strTemp.= substr($strEncryptKey,$intCounter,1).(substr($strText,$i,1) ^ substr($strEncryptKey,$intCounter,1));
				 $intCounter++; 
			} 
			return $this->keyED($strTemp,$strKeyAr);
		}
		
		function Decrypt($strText,$strKeyAr) { 
			$strText = $this->keyED($strText,$strKeyAr); 
			$strTemp = ""; 
			for ($i=0;$i<strlen($strText);$i++) { 
				 $md5 = substr($strText,$i,1); 
				 $i++; 
				 $strTemp.= (substr($strText,$i,1) ^ $md5); 
			} 
			return $strTemp; 
		} 
		
		function getEncrypt($strPlainText,$strKeyAr1="",$strKeyAr2="",$strKeyAr3="") {
			if($strKeyAr1 == "") $strKeyAr1 = $this->strKeyAr1;
			if($strKeyAr2 == "") $strKeyAr2 = $this->strKeyAr2;
			if($strKeyAr3 == "") $strKeyAr3 = $this->strKeyAr3;
			return base64_encode($this->keyED($this->Encrypt($this->keyED($strPlainText,$strKeyAr1),$strKeyAr2),$strKeyAr3)); 
		}
		
		function getDecrypt($strEncryptedText,$strKeyAr1="",$strKeyAr2="",$strKeyAr3="") {
			if($strKeyAr1 == "") $strKeyAr1 = $this->strKeyAr1;
			if($strKeyAr2 == "") $strKeyAr2 = $this->strKeyAr2;
			if($strKeyAr3 == "") $strKeyAr3 = $this->strKeyAr3;
			return $this->keyED($this->Decrypt($this->keyED(base64_decode($strEncryptedText),$strKeyAr3),$strKeyAr2),$strKeyAr1);
		}
		
		
	}
?>