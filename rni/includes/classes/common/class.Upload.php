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
	 
	 class Upload extends Common {
	 	var $Files;
	 	function Upload() {
			$this->Common();
			$this->Files = "";
			$this->ProfileTable = $this->tblPrefix."MembersProfile";
		}
		
		function doUpload() {
			if($this->Files == "") {
				return;
			} else {
			
				$S_Members 	= $this->getSession("S_Members");
				$MemberId	= $S_Members["Ident"];	
//				printArray($S_Members);

				$Gender = $this->getGender($MemberId);
				
				if($Gender == "Male") {
					$strPhotoPath = PHOTO_GLOBAL_PATH."male/";
				} else {
					$strPhotoPath = PHOTO_GLOBAL_PATH."female/";
				}
				
				$extarray  = explode(".",$this->Files["flPhoto"]["name"]);
				$ext  = $extarray[1];
				$uImageName[0]  = $MemberId.".".$ext;
				
				// Update Photo
				$objArray["X_Photos"] = serialize($uImageName);
				$this->doUpdateData($objArray,$this->ProfileTable,"MemberId = '". $MemberId ."'");
				
				// UpLoad Photo
				$ImageName = $uImageName[0];
				@copy($this->Files["flPhoto"]["tmp_name"],$strPhotoPath.stripslashes($ImageName));
				
				require_once MAIN_CLASS_PATH.'Common/class.Thumbnail.php';

				// Thumbing Photo
				$objThumb = new ThumbNail();
				$objThumb->CreateThumb("thumb_".$ImageName,$strPhotoPath.$ImageName,$strPhotoPath,90,100,$ver,true);
				$objThumb->CreateThumb("normal_".$ImageName,$strPhotoPath.$ImageName,$strPhotoPath,140,160,$ver,true);
			}
//			printArray($this->Files);
		}
		
		function getGender($MemberId) {
			$strSQL 	= "SELECT Gender FROM ".$this->ProfileTable." WHERE MemberId ='".$MemberId."'";
			$rsMembers 	= $this->getSelectByQuery($strSQL);
			return $rsMembers[0][0];
		}

	 }
?>