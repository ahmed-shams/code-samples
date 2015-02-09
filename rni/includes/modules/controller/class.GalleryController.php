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
	 
	class GalleryController extends Common {
		
		function GalleryController() {
			$this->Common();
			$this->AdminTable     = "tbl_Admin_Menu";
			$this->Pictures		  = "tbl_Pictures";
			$this->Admin		  = "tbl_Admin";
			$this->Sub_Category   = "tbl_sub_category";
			$this->Category 	  = "tbl_categories";
			$this->Tutorials  = "tbl_tutorials";
			$this->Favorites  = "tbl_favorites ";
			$this->Member = "tbl_members";
			$this->Settings 	  = "tbl_settings";	
			$this->Tutorial_Type = "tbl_Tutorial_Type";
		}
		
		function DefaultAction() {
		global $objSmarty;
		$objMain=new Main();
			$objMain->getImages($limit='3');
			$objSmarty->assign("left_tpl", '');
			$this->setVariable("InnerTpl","home.tpl");
		}
		

		function doAction($objRequest = "") {
			global $global_config,$_SESSION,$_REQUEST,$objSmarty,$_COOKIE;
			
			$objMain = new Main();
			$objCommon = new Common();
			
			if($_REQUEST["op"]) $op=$_REQUEST["op"];

			switch($op)	{
				case "celebrity":
					switch($_REQUEST["type"])
					{
					case "name":
							$objMain=new Main();
							$objMain->getImagesbyName();
							$this->setVariable("InnerTpl","details.tpl");
							break;	
					default:
							$objMain=new Main();
							$objMain->getImages();
							$this->setVariable("InnerTpl","hairstyle.tpl");
							break;
					}	
					$objSmarty->assign("left_tpl", 1);
					break;
				case "details":
				
							$objGallery=new Gallery();
							$objGallery->updateViews();
							$objGallery->getImagesbyId();
							$this->setVariable("InnerTpl","details.tpl");
							$this->setVariable("leftTpl","left_rate_panel.tpl");
							$objSmarty->assign("left_tpl", 1);
							break;	
				case "vote":
							$objGallery=new Gallery();
							//$objGallery->voteCast();
							$this->setVariable("InnerTpl","details.tpl");
							$this->setVariable("leftTpl","left_rate_panel.tpl");
							$objSmarty->assign("left_tpl", 1);
							break;	
				case "search":
							$objGallery=new Gallery();
							$objGallery->getImages($_REQUEST);
							$this->setVariable("InnerTpl","gal_result.tpl");
							$objSmarty->assign("left_tpl", 1);
							break;	
				default:
					$this->DefaultAction();
					break;
			}
			if($op!='details')
			$this->setVariable("leftTpl","left_panel.tpl");
			$this->setTemplate("index.tpl");
		}
		
	
		function setIndexLeftMenu(){
			global $objSmarty;
			$LeftMenuType = $_REQUEST["op"];
			
			if($LeftMenuType == "")
			{
				$strSql     = "select * from ".$this->AdminTable." where MenuType='Home' and Status='Active' and order_id !=''".$Orderby;
			}
			else
			{
				$strSql     = "select * from ".$this->AdminTable." where MenuType='$LeftMenuType' and Status='Active'".$Orderby;
			}
			$AdminMenu  = $this->getSelectByQuery($strSql);
			$AdminCount = $this->dbQueryNumRows;
			$PreferenceDetails       = "";
	  	    $PreferenceDetails.="var IndexMenu = new Array();\n";
			for($i=0;$i<$AdminCount;$i++){
				$AdminSubMenuExp = explode(",",$AdminMenu[$i]["SubMenu"]);
				$AdminSubLinkExp = explode(",",$AdminMenu[$i]["MenuLink"]);
				$AdminMenu[$i]["SubMenucount"] = count($AdminSubMenuExp);
					for($j=0;$j<count($AdminSubMenuExp);$j++){
						$AdminMenu[$i]["SubMenus"][$j] = $AdminSubMenuExp[$j];
						$AdminMenu[$i]["SubLinks"][$j] = $AdminSubLinkExp[$j];
					}
			}			
			$objSmarty->assign("PreferenceDetails",$PreferenceDetails);
			$objSmarty->assign("BrokerMenuCount",       $AdminCount);
			$objSmarty->assign("BrokerMenu",        $AdminMenu);
		}
}
?>