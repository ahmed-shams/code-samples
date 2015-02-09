<?
/***********************************************************************************************************\
*	SCRIPT TYPE: Class  																					*											
*	SCRIPT NAME: Menu																						*	
*	DESCRIPTION: General Class to manipulate top and left menus in all the pages							*		
*	AUTHOR: Uma																								*			
*	WRITTEN ON: 28-Dec-2004																					*	
*	LAST MODIFIED ON:																						*	
/***********************************************************************************************************/

$pathToCodeFiles = $global_config["SiteBackPath"].'common/javascript/';  // The www root to where the menu code files are located
// You can use relative or absolute paths

if($_SESSION["LanguageCode"] == "2") {
	/// The following is only changed if the name of the menu code files have been changed.
	$menuVars						= array();
	$menuVars["pathToCodeFiles"]	= $pathToCodeFiles;
	$menuVars["file_milonicsrc"]	= "milonic_src.js";
	$menuVars["file_mmenudom"]		= "mmenudom_arabic.js";
	$menuVars["file_mmenuns4"]		= "mmenuns4.js";
	$menuVars["menuCloseDelay"]		= 500;
	$menuVars["menuOpenDelay"]		= 150;
	$menuVars["subOffsetTop"]		= 0;
	$menuVars["subOffsetLeft"]		= 0;
	$menuData						= "";

} else {
	/// The following is only changed if the name of the menu code files have been changed.
	$menuVars						= array();
	$menuVars["pathToCodeFiles"]	= $pathToCodeFiles;
	$menuVars["file_milonicsrc"]	= "milonic_src.js";
	$menuVars["file_mmenudom"]		= "mmenudom.js";
	$menuVars["file_mmenuns4"]		= "mmenuns4.js";
	$menuVars["menuCloseDelay"]		= 500;
	$menuVars["menuOpenDelay"]		= 150;
	$menuVars["subOffsetTop"]		= 0;
	$menuVars["subOffsetLeft"]		= 0;
	$menuData						= "";

}

// Class Start
class Menu extends Common {
	var $AccessPageListForGroup;
	var $AdditionalWhereCondition;
	
    // constructor
	function Menu() {
		$this->DefTextArray ="";
	}
	
	function reset(){
		$this->DefTextArray = array();
		$this->DefLinkArray = array();
	}
	function setMenuLinks($myArray) {
		$this->ArrCount=count($myArray);	
		$j=0;
		for($i=0; $i<count($myArray); $i++)	{		
			$this->MenuTextArray[$i]  = $myArray[$i][0];
			$this->MenuTextAry[$i]    = $myArray[$i][0];
			$this->MenuLinksArray[$i] = $myArray[$i][1];
			$this->MenuClassArray[$i] = $myArray[$i][2];
			$this->MenuIconArray[$i]  = $myArray[$i][3];
			$this->MenuIndexArray[$i] = $myArray[$i][5];
			if($myArray[$i][5]!=0){
				$this->MenuIndexCount[$i] = $j++;
			}
			if($myArray[$i][2]==1) {
				$this->MenuTxt   = $myArray[$i][0];			
				$this->StrUrl   = $myArray[$i][1];
			}
		}
	}
	 /**
     * Sets .  
     * @param
     * @return void
     */
	function setLeftMenu($leftArray) {
	   //printArray($leftArray);
	   for($i=0; $i<count($leftArray); $i++)
	   {
			$this->LeftTextArray[$i]	= $leftArray[$i][0];
			$this->LeftLinksArray[$i]	= $leftArray[$i][1];		
		}
	}
	// function to get left menu
	function getLeftMenuList($ParentId='', $url='', $MenuGroup)
	{
		global $objSmarty, $NotIncludeLeftMMenuArray;
		
		$objTables 			= array("menus A");
		if($url == '')
		{
			if ($ParentId != '')
			{
				$strWhereClause 	= "A.Parent_ID = '$ParentId' AND A.Status = 'Active' AND A.Menu_Type = 'Left' AND A.Menu_Group = '$MenuGroup'";
				if ($this->AdditionalWhereCondition != '')
					$strWhereClause 	.= $this->AdditionalWhereCondition;
				$strOrderClause		= "ORDER BY A.Menu_Order_ID ASC";
				$QryResult      	= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
				$LeftMenuCount		= $this->RecCount;
				
				$AccessMenuList		= array();
				//printArray($this->AccessPageListForGroup);
				if ($_SESSION["AccessChkFlag"] == 1)
				{
					$objFields2 		= array("A.Parent_ID,A.Menu_Url,A.OptionalMenu_URL1,A.OptionalMenu_URL2,A.OptionalMenu_URL3,A.OptionalMenu_URL4,A.OptionalMenu_URL5");
					$strWhereClause2 	= "A.Status = 'Active' AND A.Menu_Type = 'Left' AND A.Menu_Group = '$MenuGroup'";
					if ($ParentId > 0)
						$strWhereClause2 	.= " AND A.Parent_ID = '$ParentId'";
					$strOrderClause2	= "ORDER BY A.Parent_ID ASC,A.Menu_Order_ID ASC";
					$QryResult2			= $this->SelectQry($objTables,$objFields2,'',$strWhereClause2,$strOrderClause2,'','',0);
					$TotalURL			= $this->RecCount;
					$ALLURLList = array();
					$k = 0;
					for ($j=0;$j<$TotalURL;$j++)
					{
						$ParentId1					= $QryResult2[$j]["Parent_ID"];
						$ALLURLList[$ParentId1][$k]	= $QryResult2[$j];
						if ($ParentId1 == $QryResult2[$j+1]["Parent_ID"])
							$k++;
						else
							$k = 0;
					}
					//printArray($ALLURLList);
					for ($i=0;$i<$LeftMenuCount;$i++)
					{
						if($_SESSION["LanguageCode"]=="2")
							$QryResult[$i]["Menu_Title"]	= $QryResult[$i]["Menu_Title_Arabic"];
						else
							$QryResult[$i]["Menu_Title"]	= $QryResult[$i]["Menu_Title"];
						$exists = $this->CheckSubMenuExists($QryResult[$i]["MenuId"]);
						if($exists) {
							$QryResult[$i]["SubMenuExists"] = "Exists";
						} else {
							$QryResult[$i]["SubMenuExists"] = "";
						}
						$MenuId			= $QryResult[$i]["MenuId"];
						$chkcount		= count($ALLURLList[$MenuId]);
						//print "<br>".$MenuId." - ".$QryResult[$i]["Menu_Title"]." Total =====================> ".$chkcount."<br>";
						
						if ($chkcount > 0)
						{
							for ($chk=0;$chk<$chkcount;$chk++)
							{
								$MenuURL			= $ALLURLList[$MenuId][$chk]["Menu_Url"];
								$OptionalMenuURL1	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL1"];
								$OptionalMenuURL2	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL2"];
								$OptionalMenuURL3	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL3"];
								$OptionalMenuURL4	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL4"];
								$OptionalMenuURL5	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL5"];
								//print "<br>".$QryResult[$i]["Menu_Url"];
								if (in_array($MenuURL, $this->AccessPageListForGroup) || in_array($OptionalMenuURL1, $this->AccessPageListForGroup) 
								|| in_array($OptionalMenuURL2, $this->AccessPageListForGroup) || in_array($OptionalMenuURL3, $this->AccessPageListForGroup) 
								|| in_array($OptionalMenuURL4, $this->AccessPageListForGroup) || in_array($OptionalMenuURL5, $this->AccessPageListForGroup))
								{
									//print " Yes You have Access for this page <br>";
									if (!in_array($QryResult[$i], $AccessMenuList))
										$AccessMenuList[]	= $QryResult[$i];
								}
							}
						}
						else
						{
							$MenuURL			= $QryResult[$i]["Menu_Url"];
							$OptionalMenuURL1	= $QryResult[$i]["OptionalMenu_URL1"];
							$OptionalMenuURL2	= $QryResult[$i]["OptionalMenu_URL2"];
							$OptionalMenuURL3	= $QryResult[$i]["OptionalMenu_URL3"];
							$OptionalMenuURL4	= $QryResult[$i]["OptionalMenu_URL4"];
							$OptionalMenuURL5	= $QryResult[$i]["OptionalMenu_URL5"];
							if (in_array($MenuURL, $this->AccessPageListForGroup) || in_array($OptionalMenuURL1, $this->AccessPageListForGroup) 
							|| in_array($OptionalMenuURL2, $this->AccessPageListForGroup) || in_array($OptionalMenuURL3, $this->AccessPageListForGroup) 
							|| in_array($OptionalMenuURL4, $this->AccessPageListForGroup) || in_array($OptionalMenuURL5, $this->AccessPageListForGroup))
							{
								//print " Yes You have Access for this page <br>";
								if (!in_array($QryResult[$i], $AccessMenuList))
									$AccessMenuList[]	= $QryResult[$i];
							}
						}
					}
				}
				else 
				{
					//printArray($NotIncludeLeftMMenuArray);
					$QryResult2 = array();
					for ($i=0;$i<$LeftMenuCount;$i++)
					{
						if($_SESSION["LanguageCode"]=="2")
							$QryResult[$i]["Menu_Title"]	= $QryResult[$i]["Menu_Title_Arabic"];
						else
							$QryResult[$i]["Menu_Title"]	= $QryResult[$i]["Menu_Title"];
						$LMMenuChkFlag = 1;
						if($_SESSION["NotIncludeMenuChkFlag"] == 1)
						{
							if(!in_array($QryResult[$i]["Menu_Title"], $NotIncludeLeftMMenuArray))
								$LMMenuChkFlag = 1;
							else
								$LMMenuChkFlag = 0;
						}
						if($LMMenuChkFlag == 1)
						{
							$exists = $this->CheckSubMenuExists($QryResult[$i]["MenuId"]);
							if($exists) {
								$QryResult[$i]["SubMenuExists"] = "Exists";
							} else {
								$QryResult[$i]["SubMenuExists"] = "";
							}
							$QryResult2[] = $QryResult[$i];
						}
					}
					$AccessMenuList	= $QryResult2;
				}
				//printArray($AccessMenuList);
				if($ParentId==0) {
					$objSmarty->assign("LeftMainMenu",$AccessMenuList);
				} else {
					$objSmarty->assign("LeftMainSubMenu",$AccessMenuList);
				}
				return($QryResult);
			}
		}
		else
		{
			$objFields 		= array("A.MenuId,Menu_Title,A.Menu_Title_Arabic,A.Parent_ID");
			$strWhereClause = "(A.Menu_Url = '$url' OR A.OptionalMenu_URL1 = '$url' OR A.OptionalMenu_URL2 = '$url' OR ";
			$strWhereClause.= "A.OptionalMenu_URL3 = '$url' OR A.OptionalMenu_URL4 = '$url' OR A.OptionalMenu_URL5 = '$url') AND A.Status = 'Active' AND A.Menu_Type = 'Left' AND A.Menu_Group = '$MenuGroup'";
			$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
			$QryResult      = $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
			if($_SESSION["LanguageCode"]=="2")
				$QryResult[0]["Menu_Title"]	= $QryResult[0]["Menu_Title_Arabic"];
			else
				$QryResult[0]["Menu_Title"]	= $QryResult[0]["Menu_Title"];
			if ($QryResult[0]["Parent_ID"] == 0)
			{
				$MainMenuId		= $QryResult[0]["MenuId"];
				$MenuParentId	= $QryResult[0]["MenuId"];
			}	else 	{
				$MainMenuId		= $QryResult[0]["Parent_ID"];
				$MenuParentId	= $QryResult[0]["Parent_ID"];
				$MainSubMenuId	= $QryResult[0]["MenuId"];
			}
			$objSmarty->assign("SelLeftMainMenuId",$MainMenuId);
			$objSmarty->assign("SelLeftMenuTitle",$QryResult[0]["Menu_Title"]);
			$objSmarty->assign("SelLeftMainSubMenuId",$MainSubMenuId);
			return($MenuParentId);
		}
		
	}
	
	function CheckSubMenuExists($MenuId) 
	{
		global $objSmarty;
		
		$objTables		= array("menus A");
		$objFields		= array("COUNT(*)");
		$strWhereClause = "A.Parent_ID = '$MenuId' and A.Status = 'Active'";
		$strOrderClause	= "";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
		return $QryResult[0][0];
	}
	
	// function to get top menu
	function getTopMenuList($ParentId='', $url='', $MenuGroup)
	{
		global $objSmarty;
		
		$objTables 			= array("menus A");
		if($url=='')
		{
			if ($ParentId != '')
			{
				$strWhereClause 	= "A.Parent_ID = '$ParentId' AND A.Status = 'Active' AND A.Menu_Type = 'Top' AND A.Menu_Group = '$MenuGroup'";
				if ($this->AdditionalWhereCondition != '')
					$strWhereClause 	.= $this->AdditionalWhereCondition;
				$strOrderClause		= "ORDER BY A.Menu_Order_ID ASC";
				$QryResult      	= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
				$TopMenuCount		= $this->RecCount;
				
				$AccessMenuList		= array();
				//printArray($this->AccessPageListForGroup);
				if ($_SESSION["AccessChkFlag"] == 1)
				{
					$objFields2 		= array("A.Parent_ID,A.Menu_Url,A.OptionalMenu_URL1,A.OptionalMenu_URL2,A.OptionalMenu_URL3,A.OptionalMenu_URL4,A.OptionalMenu_URL5");
					$strWhereClause2 	= "A.Status = 'Active' AND A.Menu_Type = 'Top' AND A.Menu_Group = '$MenuGroup'";
					if ($ParentId > 0)
						$strWhereClause2 	.= " AND A.Parent_ID = '$ParentId'";
					$strOrderClause2	= "ORDER BY A.Parent_ID ASC,A.Menu_Order_ID ASC";
					$QryResult2			= $this->SelectQry($objTables,$objFields2,'',$strWhereClause2,$strOrderClause2,'','',0);
					$TotalURL			= $this->RecCount;
					$ALLURLList = array();
					$k = 0;
					for ($j=0;$j<$TotalURL;$j++)
					{
						$ParentId1					= $QryResult2[$j]["Parent_ID"];
						$ALLURLList[$ParentId1][$k]	= $QryResult2[$j];
						if ($ParentId1 == $QryResult2[$j+1]["Parent_ID"])
							$k++;
						else
							$k = 0;
					}
					//printArray($ALLURLList);
					for ($i=0;$i<$TopMenuCount;$i++)
					{
						if($_SESSION["LanguageCode"]=="2")
							$QryResult[$i]["Menu_Title"]	= $QryResult[$i]["Menu_Title_Arabic"];
						else
							$QryResult[$i]["Menu_Title"]	= $QryResult[$i]["Menu_Title"];
						$exists = $this->CheckSubMenuExists($QryResult[$i]["MenuId"]);
						if($exists) {
							$QryResult[$i]["SubMenuExists"] = "Exists";
						} else {
							$QryResult[$i]["SubMenuExists"] = "";
						}
					
						$MenuId			= $QryResult[$i]["MenuId"];
						$chkcount		= count($ALLURLList[$MenuId]);
						//print "<br>".$MenuId." - ".$QryResult[$i]["Menu_Title"]." Total =====================> ".$chkcount."<br>";
						if ($chkcount > 0)
						{
							for ($chk=0;$chk<$chkcount;$chk++)
							{
								$MenuURL			= $ALLURLList[$MenuId][$chk]["Menu_Url"];
								$OptionalMenuURL1	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL1"];
								$OptionalMenuURL2	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL2"];
								$OptionalMenuURL3	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL3"];
								$OptionalMenuURL4	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL4"];
								$OptionalMenuURL5	= $ALLURLList[$MenuId][$chk]["OptionalMenu_URL5"];
								//print "<br>".$QryResult[$i]["Menu_Url"];
								if (in_array($MenuURL, $this->AccessPageListForGroup) || in_array($OptionalMenuURL1, $this->AccessPageListForGroup) 
								|| in_array($OptionalMenuURL2, $this->AccessPageListForGroup) || in_array($OptionalMenuURL3, $this->AccessPageListForGroup) 
								|| in_array($OptionalMenuURL4, $this->AccessPageListForGroup) || in_array($OptionalMenuURL5, $this->AccessPageListForGroup))
								{
									//print " Yes You have Access for this page <br>";
									if (!in_array($QryResult[$i], $AccessMenuList))
										$AccessMenuList[]	= $QryResult[$i];
								}
							}
						}
						else
						{
							$MenuURL			= $QryResult[$i]["Menu_Url"];
							$OptionalMenuURL1	= $QryResult[$i]["OptionalMenu_URL1"];
							$OptionalMenuURL2	= $QryResult[$i]["OptionalMenu_URL2"];
							$OptionalMenuURL3	= $QryResult[$i]["OptionalMenu_URL3"];
							$OptionalMenuURL4	= $QryResult[$i]["OptionalMenu_URL4"];
							$OptionalMenuURL5	= $QryResult[$i]["OptionalMenu_URL5"];
							if (in_array($MenuURL, $this->AccessPageListForGroup) || in_array($OptionalMenuURL1, $this->AccessPageListForGroup) 
							|| in_array($OptionalMenuURL2, $this->AccessPageListForGroup) || in_array($OptionalMenuURL3, $this->AccessPageListForGroup) 
							|| in_array($OptionalMenuURL4, $this->AccessPageListForGroup) || in_array($OptionalMenuURL5, $this->AccessPageListForGroup))
							{
								//print " Yes You have Access for this page <br>";
								if (!in_array($QryResult[$i], $AccessMenuList))
									$AccessMenuList[]	= $QryResult[$i];
							}
						}
					}
				}
				else 
				{
					for ($i=0;$i<$TopMenuCount;$i++)
					{
						if($_SESSION["LanguageCode"]=="2")
							$QryResult[$i]["Menu_Title"]	= $QryResult[$i]["Menu_Title_Arabic"];
						else
							$QryResult[$i]["Menu_Title"]	= $QryResult[$i]["Menu_Title"];
						$exists = $this->CheckSubMenuExists($QryResult[$i]["MenuId"]);
						if($exists) {
							$QryResult[$i]["SubMenuExists"] = "Exists";
						} else {
							$QryResult[$i]["SubMenuExists"] = "";
						}
					}
					$AccessMenuList	= $QryResult;
				}
				if (count($AccessMenuList) > 0)
					$TopETabWidth		= 100 / count($AccessMenuList);
				//printArray($AccessMenuList);
				if($ParentId==0) {
					$objSmarty->assign("TopMainMenu",$AccessMenuList);
					$objSmarty->assign("TopETabWidth",round($TopETabWidth));
				} else {
					$objSmarty->assign("TopMainSubMenu",$AccessMenuList);
				}
				return($QryResult);
			}
		}
		else
		{
			$objFields 		= array("A.MenuId,Menu_Title,A.Menu_Title_Arabic,A.Parent_ID");
			$strWhereClause = "(A.Menu_Url = '$url' OR A.OptionalMenu_URL1 = '$url' OR A.OptionalMenu_URL2 = '$url' OR ";
			$strWhereClause.= "A.OptionalMenu_URL3 = '$url' OR A.OptionalMenu_URL4 = '$url' OR A.OptionalMenu_URL5 = '$url') AND Status = 'Active' AND A.Menu_Type = 'Top' AND A.Menu_Group = '$MenuGroup'";
			$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
			$QryResult      = $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
			if($_SESSION["LanguageCode"]=="2")
				$QryResult[0]["Menu_Title"]	= $QryResult[0]["Menu_Title_Arabic"];
			else
				$QryResult[0]["Menu_Title"]	= $QryResult[0]["Menu_Title"];
			if ($QryResult[0]["Parent_ID"] == 0)
			{
				$MainMenuId		= $QryResult[0]["MenuId"];
				$MenuParentId	= $QryResult[0]["MenuId"];
			}	else 	{
				$MainMenuId		= $QryResult[0]["Parent_ID"];
				$MenuParentId	= $QryResult[0]["Parent_ID"];
				$MainSubMenuId	= $QryResult[0]["MenuId"];
			}
			$objSmarty->assign("SelTopMainMenuId",$MainMenuId);
			$objSmarty->assign("SelTopMenuTitle",$QryResult[0]["Menu_Title"]);
			$objSmarty->assign("SelTopMainSubMenuId",$MainSubMenuId);
			return($MenuParentId);
		}
		
	}
	function getMainMenuList($ManuType, $MenuGroupType='')
	{
		global $objSmarty;
		
		$objTables		= array("menus A");
		$objFields		= array("*");
		$strWhereClause = "A.Parent_ID = 0 AND A.Menu_Type = '$ManuType'";
		if ($MenuGroupType == '')
			$strWhereClause .= " AND A.Menu_Group = 'system'";
		else
			$strWhereClause .= " AND A.Menu_Group = '$MenuGroupType'";
		$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
		$MainMenuCount	= $this->RecCount;
		for($i=0;$i<$MainMenuCount;$i++)
		{
			$strMainMenuIdsAry[]	= $QryResult[$i]["MenuId"];
			$strMainMenuNamesAry[]	= $QryResult[$i]["Menu_Title"];
			$QryResult[$i]["RowColour"]	   = $this->getRowColorForStatus($QryResult[$i]["Status"]);
			$QryResult[$i]["StatusString"] = $this->getConvertString($QryResult[$i]["Status"], $QryResult[$i]["Status"]);
		}
		
		$objSmarty->assign("strMainMenuIdsAry",$strMainMenuIdsAry);
		$objSmarty->assign("strMainMenuNamesAry",$strMainMenuNamesAry);
		return($QryResult);
	}
	
	// function to list menu in manu management 
	function getMenuList($ParentId=0, $MenuType, $MenuGroupType='')
	{
		global $objSmarty;
		
		$objTables		= array("menus A","menus B");
		$objFields		= array("A.*,B.Menu_Title AS MainMenuTitle");
		if($ParentId != 0 || $ParentId == '')
		{
			$strWhereClause = "A.Parent_ID = '$ParentId' AND A.Parent_ID = B.MenuId and A.Menu_Type = '$MenuType'";
			$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
		} else {
			$strWhereClause = "A.Parent_ID != '$ParentId' AND A.Parent_ID = B.MenuId and A.Menu_Type = '$MenuType'";
			$strOrderClause	= "ORDER BY A.Parent_ID ASC, A.Menu_Order_ID ASC";
		}
		if ($MenuGroupType == '')
			$strWhereClause .= " AND A.Menu_Group = 'system'";
		else
			$strWhereClause .= " AND A.Menu_Group = '$MenuGroupType'";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
		$MenuCount		= $this->RecCount;
		for($i=0;$i<$MenuCount;$i++)
		{
			$QryResult[$i]["RowColour"]	   = $this->getRowColorForStatus($QryResult[$i]["Status"]);
		}
		
		return($QryResult);
	}
	function getParentName($ParentId=0,$MenuType)
	{
		global $objSmarty;
		$objTables		= array("menus A");
		$objFields		= array("A.Menu_Title");
		if($ParentId == '')
			$ParentId = 0;
		$strWhereClause = "A.MenuId = '$ParentId' and A.Menu_Type = '$MenuType' ";
		$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
		return($QryResult[0][0]);
	}
	
	// function to update menu order lsit
	function UpadateMenuOrderList($objArray)
	{
		$KeyId			= $objArray["KeyId"];
		$CurrMenuId		= $objArray["hdId"];
		$NextMenuId		= $objArray["NextMenuId"];
		$PreviousMenuId = $objArray["PreviousMenuId"];
		$OrderId		= $objArray["OrderId"];
		if($KeyId == "up")
		{
			$ChangeMenuId	= $PreviousMenuId;
			$OrderId1		= $OrderId - 1;
			$InsertArray = array(
								array("Order_id",$OrderId1)
								);
			$InsertArray1 = array(
									array("Order_id",$OrderId)
								);
		} 
		else
		{
			$ChangeMenuId	= $NextMenuId;
			$OrderId1		= $OrderId + 1;
			$InsertArray 	= array(
									array("Order_id",$OrderId1)
									);
			$InsertArray1 	= array(
									array("Order_id",$OrderId)
									);
		}
		$this->common_Update("tbl_Admin_Menu",$InsertArray,'Ident',$CurrMenuId,0);
		$this->common_Update("tbl_Admin_Menu",$InsertArray1,'Ident',$ChangeMenuId,0);
	}
	// function to update menu order lsit
	function MoveMenusToMenu($objArray)
	{
		$FromMainMenus			= $objArray["MainMenus"];
		$ToMainMenus			= $objArray["ToMainMenus"];
		$ToMenuLastMenuOrderId	= $this->getLastMenuOrderIdByParentId($ToMainMenus);
		$MovingMenuIds			= array();
		foreach($objArray as $key=>$value)
		{
			$pos = strpos($key, "MoveMenuIds_");
			if (is_integer($pos))
			{
				$ToMenuLastMenuOrderId 		= $ToMenuLastMenuOrderId + 1;
				list($ParentId, $MenuId)	= split('_', $value);
				$UpdateArray = array(
									array("Parent_ID",		$ToMainMenus),
									array("Menu_Order_ID",	$ToMenuLastMenuOrderId)
									);
				$this->common_Update("menus",$UpdateArray,'MenuId',$MenuId,0);
				if ($FromMainMenus == 0)
					array_push($MovingMenuIds, $ParentId);
				else
					$MovingMenuIds			= array($ParentId);
			}
		}
		$MoveMenuCount	= count($MovingMenuIds);
		for ($j=0;$j<$MoveMenuCount;$j++)
		{
			$MovingParentId	= $MovingMenuIds[$j];
			$OrderId		= 0;
			$objTables		= array("menus A");
			$objFields		= array("*");
			$strWhereClause	= "A.Parent_ID = '$MovingParentId'";
			$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
			$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
			$Count			= $this->RecCount;
			//print "<br>Curr Menu ID ".$CurrMenuId;
			for ($i=0;$i<$Count;$i++)
			{
				$OrderId		= $OrderId + 1;
				$MenuId2		= $QryResult[$i]["MenuId"];
				$UpdateArray2	= array(
										array("Menu_Order_ID",$OrderId)
										);
				//print "<br>Sequence Menu IDs ".$MenuId;
				$this->common_Update("menus",$UpdateArray2,'MenuId',$MenuId2,0);
			}
		}
	}
	function getMenuDetailsByMenuId($MenuId, $MenuGroupType='')
	{
		global $objSmarty;
		
		$objTables		= array("menus A");
		$objFields		= array("A.*");
		$strWhereClause	= "A.MenuID = '$MenuId'";
		if ($MenuGroupType == '')
			$strWhereClause .= " AND A.Menu_Group = 'system'";
		else
			$strWhereClause .= " AND A.Menu_Group = '$MenuGroupType'";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,'','','',0);
		$MenuOrderId	= $QryResult[0]["Menu_Order_ID"];
		if ($MenuOrderId == 1)
		{
			$QryResult[0]["Menu_Order_ID"] = $MenuOrderId + 1;
			$objSmarty->assign("SelBefore", '1');
		}
		else
			$QryResult[0]["Menu_Order_ID"] = $MenuOrderId - 1;
		//printArray($QryResult);
		$objSmarty->assign("MenuDetails", $QryResult[0]);
		return($QryResult[0]);
	}
	function getLastMenuOrderIdByParentId($ParentId)
	{
		$objTables		= array("menus A");
		$objFields		= array("A.Menu_Order_ID");
		$strWhereClause	= "A.Parent_ID = '$ParentId'";
		$strOrderClause	= "ORDER BY A.Menu_Order_ID DESC LIMIT 0,1";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
		
		return($QryResult[0]["Menu_Order_ID"]);
	}	
	function getMenuPositionMenuGroupTypes()
	{
		global $objSmarty;
		
		$MenuPositionTypes	= array(
									'Left'	=> 'Left',
									'Top'	=> 'Top'
									);
		$MenuGroupTypes		= array(
									'system' 		=> 'system',
									'employer'  	=> 'employer',
									'organization'	=> 'organization',
									'recruiter'  	=> 'recruiter',
									'applicant' 	=> 'applicant',
									'employee'  	=> 'employee'
									);
		$MenuStatusTypes	= array(
									'Active'	=> 'Active',
									'Inactive'	=> 'Inactive'
									);
		
		$objSmarty->assign('MenuPositionTypes', $MenuPositionTypes);
		$objSmarty->assign('MenuGroupTypes', $MenuGroupTypes);
		$objSmarty->assign('MenuStatusTypes', $MenuStatusTypes);
	}
	function UpdateMenuDetailsByMenuId($objArray)
	{
		global $_FILES;
		
		$MenuId			= $objArray["MenuId"];
		$UpdateArray	= array(
								array("Menu_Title",			$objArray["Menu_Title"]),
								array("Menu_Title_Arabic",	$objArray["Menu_Title_Arabic"]),
								array("Menu_Description",	$objArray["Menu_Description"]),
								array("Menu_Url",			$objArray["Menu_Url"]),
								array("OptionalMenu_URL1",	$objArray["OptionalMenu_URL1"]),
								array("OptionalMenu_URL2",	$objArray["OptionalMenu_URL2"]),
								array("OptionalMenu_URL3",	$objArray["OptionalMenu_URL3"]),
								array("OptionalMenu_URL4",	$objArray["OptionalMenu_URL4"]),
								array("OptionalMenu_URL5",	$objArray["OptionalMenu_URL5"]),
								array("Menu_Type",			$objArray["MenuType"]),
								array("Status",				$objArray["MenuStatusType"])
								);
										
		//printArray($UpdateArray);
		$this->common_Update("menus",$UpdateArray,'MenuId',$MenuId,0);
		if($objArray["MenuStatusType"] == 'Inactive')
		{
			$UpdateArray1	= array(
									array("Status",			$objArray["MenuStatusType"])
									);
			$this->common_Update("menus",$UpdateArray1,'Parent_ID',$MenuId,0);
		}
		//$MenuId = $this->strInsertedId;
		$this->UpdateMenuOrders2($MenuId, $objArray);
		if ($_FILES["Menu_Icon"]["name"] != '')
		{
			$this->CopyIconImageFile($MenuId);
		}
	}
	function CopyIconImageFile($MenuId)
	{
		global $_FILES, $global_config;
		
		if(file_exists($_FILES['Menu_Icon']["tmp_name"]))
		{
			$filename		= $_FILES['Menu_Icon']["name"];
			$filenameary	= explode(".",$filename);
			$ext			= $filenameary[1];
			$IconImageFile	= "menuicon_".$MenuId.".".$ext;
			@copy($_FILES['Menu_Icon']["tmp_name"], $global_config["path"]."images/menuicons/".$IconImageFile);
			$UpdateArray = array(
								array("Menu_Icon", $IconImageFile)
								);
			$this->common_Update("menus",$UpdateArray,'MenuId',$MenuId,0);
		}
	}
	function getJSHighlightedMenus($MenuType, $MenuGroupType)
	{
		global $objSmarty;
		
		$objTables		= array("menus A");
		$objFields		= array("*");
		$strWhereClause = "A.Parent_ID = 0 and A.Status = 'Active'"; // and A.Menu_Type = '$MenuType' 
		if ($MenuGroupType == '')
			$strWhereClause .= " AND A.Menu_Group = 'system'";
		else
			$strWhereClause .= " AND A.Menu_Group = '$MenuGroupType'";
		$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
		$MainMenuCount	= $this->RecCount;
		
		$strHighlightMenusJSAry = "var HighlightMenus = new Array();\n";
		$strHighlightMenusJSAry.= "HighlightMenus[0] = new Array();\n";
		$strHighlightMenusJSAry.= "HighlightMenus[0][\"LeftId\"] = new Array();\n";
		$strHighlightMenusJSAry.= "HighlightMenus[0][\"LeftTitle\"] = new Array();\n";
		$strHighlightMenusJSAry.= "HighlightMenus[0][\"LeftOrder\"] = new Array();\n";
		$strHighlightMenusJSAry.= "HighlightMenus[0][\"TopId\"] = new Array();\n";
		$strHighlightMenusJSAry.= "HighlightMenus[0][\"TopTitle\"] = new Array();\n";
		$strHighlightMenusJSAry.= "HighlightMenus[0][\"TopOrder\"] = new Array();\n";
		$LCount = 0;
		$TCount = 0;
		for($i=0;$i<$MainMenuCount;$i++)
		{
			$MenuId			= $QryResult[$i]["MenuId"];
			$Menu_Title		= $QryResult[$i]["Menu_Title"];
			$MenuOrderId	= $QryResult[$i]["Menu_Order_ID"];
			$MenuType		= $QryResult[$i]["Menu_Type"];
			if ($MenuType == "Left")
			{
				$k = $LCount++;
			}
			else
			{
				$k = $TCount++;
			}
			$strMainMenuIdsAry[]	= $MenuId;
			$strMainMenuNamesAry[]	= $Menu_Title;
			$strHighlightMenusJSAry.= "HighlightMenus[".$MenuId."] = new Array();\n";
			
			$objTables2			= array("menus A");
			$objFields2			= array("*");
			$strWhereClause2	= "A.Parent_ID = '$MenuId' and A.Status = 'Active'";
			$strOrderClause2	= "ORDER BY A.Menu_Order_ID ASC";
			$QryResult2			= $this->SelectQry($objTables2,$objFields2,'',$strWhereClause2,$strOrderClause2,'','',0);
			$MainSubMenuCount	= $this->RecCount;
			$strHighlightMenusJSAry.= "HighlightMenus[".$MenuId."][\"Id\"] = new Array();\n";
			$strHighlightMenusJSAry.= "HighlightMenus[".$MenuId."][\"Title\"] = new Array();\n";
			$strHighlightMenusJSAry.= "HighlightMenus[".$MenuId."][\"Order\"] = new Array();\n";
			for($j=0;$j<$MainSubMenuCount;$j++)
			{
				$SubMenuId			= $QryResult2[$j]["MenuId"];
				$SubMenuTitle		= $QryResult2[$j]["Menu_Title"];
				$SubMenuOrderId		= $QryResult2[$j]["Menu_Order_ID"];
				$strHighlightMenusJSAry .= "HighlightMenus[".$MenuId."][\"Id\"][".$j."] = \"".$SubMenuId."\";\n";
				$strHighlightMenusJSAry .= "HighlightMenus[".$MenuId."][\"Title\"][".$j."] = \"".$SubMenuTitle."\";\n";
				$strHighlightMenusJSAry .= "HighlightMenus[".$MenuId."][\"Order\"][".$j."] = \"".$SubMenuOrderId."\";\n";
			}
			$strHighlightMenusJSAry .= "HighlightMenus[0][\"".$MenuType."Id\"][".$k."] = \"".$MenuId."\";\n";
			$strHighlightMenusJSAry .= "HighlightMenus[0][\"".$MenuType."Title\"][".$k."] = \"".$Menu_Title."\";\n";
			$strHighlightMenusJSAry .= "HighlightMenus[0][\"".$MenuType."Order\"][".$k."] = \"".$MenuOrderId."\";\n";
		}
		
		$objSmarty->assign("strHighlightMenusJSAry",$strHighlightMenusJSAry);
		$objSmarty->assign("strMainMenuIdsAry",$strMainMenuIdsAry);
		$objSmarty->assign("strMainMenuNamesAry",$strMainMenuNamesAry);
	}
	function AddMenuDetails($objArray)
	{
		global $_FILES;
		
		$InsertArray	= array(
								array("Parent_ID",			$objArray["MainMenus"]),
								array("Menu_Title",			$objArray["Menu_Title"]),
								array("Menu_Title_Arabic",	$objArray["Menu_Title_Arabic"]),
								array("Menu_Description",	$objArray["Menu_Description"]),
								array("Menu_Url",			$objArray["Menu_Url"]),
								array("OptionalMenu_URL1",	$objArray["OptionalMenu_URL1"]),
								array("OptionalMenu_URL2",	$objArray["OptionalMenu_URL2"]),
								array("OptionalMenu_URL3",	$objArray["OptionalMenu_URL3"]),
								array("OptionalMenu_URL4",	$objArray["OptionalMenu_URL4"]),
								array("OptionalMenu_URL5",	$objArray["OptionalMenu_URL5"]),
								array("Menu_Type",			$objArray["MenuType"]),
								array("Status",				$objArray["MenuStatusType"]),
								array("Menu_Group",			$objArray["MenuGroupType"])
								);
		//printArray($InsertArray);
		$this->common_Insert("menus",$InsertArray,'','',0);
		$MenuId = $this->strInsertedId;
		$this->UpdateMenuOrders($MenuId, $objArray);
		if ($_FILES["Menu_Icon"]["name"] != '')
		{
			$this->CopyIconImageFile($MenuId);
		}
		return($objArray["MenuType"]);
	}
	function UpdateMenuOrders($MenuId, $objArray)
	{
		//if ($objArray["MenuOrder"] == '')
		$MenuOrderPosition	= $objArray["MenuOrderPosition"];
		if ($MenuOrderPosition == 0)
		{
			$StartMenuOrder = $objArray["MenuOrder"];
		}
		else
		{
			$StartMenuOrder = $objArray["MenuOrder"] + 1;
		}
		$UpdateMenuOrder= $StartMenuOrder;
		$objTables		= array("menus A");
		$objFields		= array("*");
		$strWhereClause	= "A.Parent_ID = '".$objArray["MainMenus"]."' AND A.Menu_Order_ID >= $StartMenuOrder AND A.Menu_Type = '".$objArray["MenuType"]."' AND A.Menu_Group = '".$objArray["MenuGroupType"]."'";
		$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
		$Count			= $this->RecCount;
		//print "<br>Curr Menu ID ".$CurrMenuId;
		for ($i=0;$i<$Count;$i++)
		{
			$StartMenuOrder	= $StartMenuOrder + 1;
			$MenuId2		= $QryResult[$i]["MenuId"];
			$UpdateArray2	= array(
									array("Menu_Order_ID",$StartMenuOrder)
									);
			//print "<br>Sequence Menu IDs ".$MenuId;
			$this->common_Update("menus",$UpdateArray2,'MenuId',$MenuId2,0);
		}
		$UpdateArray3	= array(
								array("Menu_Order_ID",$UpdateMenuOrder)
								);
		//print "<br>Sequence Menu IDs ".$MenuId;
		$this->common_Update("menus",$UpdateArray3,'MenuId',$MenuId,0);
	}
	function UpdateMenuOrders2($MenuId, $objArray)
	{
		$MenuOrderPosition	= $objArray["MenuOrderPosition"];
		if ($MenuOrderPosition == 0)
			$InsertMenuOrder = $objArray["MenuOrder"];
		else
			$InsertMenuOrder = $objArray["MenuOrder"];
		
		$objTables		= array("menus A");
		$objFields		= array("*");
		$strWhereClause	= "A.Parent_ID = '".$objArray["MainMenus"]."' AND A.Menu_Type = '".$objArray["MenuType"]."' AND A.Menu_Group = '".$objArray["MenuGroupType"]."'";
		$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
		$Count			= $this->RecCount;
		$MenuOrdersAry	= array();
		for ($i=0;$i<$Count;$i++)
		{
			$MenuId2		= $QryResult[$i]["MenuId"];
			$MenuOrderId	= $QryResult[$i]["Menu_Order_ID"];
			//print $InsertMenuOrder." == ".$MenuOrderId."<br>";
			if ($InsertMenuOrder == $MenuOrderId && $MenuOrderPosition == 0)
				$MenuOrdersAry[] = $MenuId;
			//print $MenuId." != ".$MenuId2."<br>";
			if ($MenuId != $MenuId2)
				$MenuOrdersAry[] = $MenuId2;
			if ($InsertMenuOrder == $MenuOrderId && $MenuOrderPosition == 1)
				$MenuOrdersAry[] = $MenuId;
		}
		//printArray($MenuOrdersAry);
		//print "<br>Curr Menu ID ".$CurrMenuId;
		$StartMenuOrder	= 0;
		for ($j=0;$j<count($MenuOrdersAry);$j++)
		{
			$StartMenuOrder	= $StartMenuOrder + 1;
			$MenuId3		= $MenuOrdersAry[$j];
			$UpdateArray2	= array(
									array("Menu_Order_ID",$StartMenuOrder)
									);
			//print "<br>Sequence Menu IDs ".$MenuId;
			$this->common_Update("menus",$UpdateArray2,'MenuId',$MenuId3,0);
		}
	}
	function CheckForDuplicateMenuByURL($objArray, $MenuId='')
	{
		$url			= $objArray["Menu_Url"];
		$MenuGroup		= $objArray["MenuGroupType"];
		
		$objTables		= array("menus A");
		$objFields 		= array("COUNT(A.MenuId)");
		$strWhereClause = "(A.Menu_Url = '$url' OR A.OptionalMenu_URL1 = '$url' OR A.OptionalMenu_URL2 = '$url' OR ";
		$strWhereClause.= "A.OptionalMenu_URL3 = '$url' OR A.OptionalMenu_URL4 = '$url' OR A.OptionalMenu_URL5 = '$url') AND A.Menu_Group = '$MenuGroup'";
		if ($MenuId != '')
			$strWhereClause.= " AND A.MenuId != '$MenuId'";
		$QryResultTOT   = $this->SelectQry($objTables,$objFields,'',$strWhereClause,'','','',0);
		
		return($QryResultTOT[0][0]);
	}	
	function DeleteMenu($MenuId,$MainMenuId)
	{
		$UpdateArray = array(
							array("Status",	'Inactive')
							);
		// MainMenuId = 1 -- Sub Menu
		if($MainMenuId == 1)
		{
			$this->common_Update("menus",$UpdateArray,'MenuId',$MenuId,0);
		} else {
			$this->common_Update("menus",$UpdateArray,'MenuId',$MenuId,0);
			$this->common_Update("menus",$UpdateArray,'Parent_ID',$MenuId,0);
		}
		return true;
	}
	/*
		To get ALL Page URLs which are all pages have access to browse(view) for that user group
	*/
	function getUserAccessURLsByGroupId($GroupId)
	{
		$objTables		= array("forms A", "access B");
		$objFields		= array("A.Form_File_Name");
		$strWhereClause	= "A.Form_ID = B.Form_ID AND B.Group_ID = '".$GroupId."' GROUP BY B.Form_ID";
		//$strOrderClause	= "ORDER BY A.Menu_Order_ID ASC";
		$QryResult		= $this->SelectQry($objTables,$objFields,'',$strWhereClause,$strOrderClause,'','',0);
		$AccessCount	= $this->RecCount;
		$this->AccessPageListForGroup = array();
		for($i=0;$i<$AccessCount;$i++)
		{
			$this->AccessPageListForGroup[] = $QryResult[$i]["Form_File_Name"];
		}
		//printArray($this->AccessPageListForGroup);
		return $this->AccessPageListForGroup;
	}
	function AddingSystemInternalUserLeftMenusURLs()
	{
		global $InterUserLeftMenusURLsAry, $sesUserAccessURLsList;
		
		$InterUserLeftMenusURLsAry	= array(
											"system/myactivity/default.php",
											"system/myactivity/sm_myactivitylist.php",
											"system/myactivity/sm_myactivitylist_suspended.php",
											"system/myactivity/sm_myactivitylist_rejected.php",
											"system/myactivity/sm_activitydetailform_rejected.php",
											"system/myactivity/sm_myactivitylist_completed.php",
											"system/myactivity/sm_activitydetailform_completed.php",
											"system/myactivity/sm_activitydetailform.php",
											"system/myactivity/sm_allactivitylist.php",
											"system/myactivity/sm_view_all_activities.php",
											"system/myactivity/email/mailbox.php"
											);
		//printArray($InterUserLeftMenusURLsAry);
		$n	= count($InterUserLeftMenusURLsAry);
		for($i=0;$i<$n;$i++)
		{
			$this->AccessPageListForGroup[] = $InterUserLeftMenusURLsAry[$i];
			$sesUserAccessURLsList[]		= $InterUserLeftMenusURLsAry[$i];
		}
	}
	function AddingEmployerInternalUserLeftMenusURLs()
	{
		global $InterUserLeftMenusURLsAry, $sesUserAccessURLsList;
		
		$InterUserLeftMenusURLsAry	= array(
											"employer/myactivity/default.php",
											"employer/myactivity/sm_myactivitylist.php",
											"employer/myactivity/sm_myactivitylist_suspended.php",
											"employer/myactivity/sm_myactivitylist_rejected.php",
											"employer/myactivity/sm_activitydetailform_rejected.php",
											"employer/myactivity/sm_myactivitylist_completed.php",
											"employer/myactivity/sm_activitydetailform_completed.php",
											"employer/myactivity/sm_activitydetailform.php",
											"employer/myactivity/sm_allactivitylist.php",
											"employer/myactivity/sm_view_all_activities.php",
											"employer/myactivity/email/mailbox.php"
											);
		//printArray($InterUserLeftMenusURLsAry);
		$n	= count($InterUserLeftMenusURLsAry);
		for($i=0;$i<$n;$i++)
		{
			$this->AccessPageListForGroup[] = $InterUserLeftMenusURLsAry[$i];
			$sesUserAccessURLsList[]		= $InterUserLeftMenusURLsAry[$i];
		}
	}
	
	function mmenuStyleInitialize()
	{
		global $global_config,$_SESSION;
		
		if($_SESSION["LanguageCode"] == "2") {
			$this->MenuGlobalSettins = array(
										"bordercolor"		=> "#52AD91",
										"borderstyle"		=> "solid",
										"borderwidth"		=> 1,
										"fontfamily"		=> "Arial",
										"fontsize"			=> "11px",
										"fontstyle"			=> "normal",
										"headerbgcolor"		=> "#ffffff",
										"headercolor"		=> "#000000",
										"offbgcolor"		=> "#CFFFF0",
										"offcolor"			=> "#000000",
										"onbgcolor"			=> "#92EDD1",
										"oncolor"			=> "#000000",
										"outfilter"			=> "randomdissolve(duration=0.5)",
										"overfilter"		=> "Fade(duration=0.2);Alpha(opacity=95);Shadow(color=#777777', Direction=135, Strength=2)",
										"padding"			=> 4,
										"pagebgcolor"		=> "#92EDD1",
										"pagecolor"			=> "#000000",
										"separatorcolor"	=> "#59B498",
										"separatorsize"		=> 1,
										"subimage"			=> $global_config["SiteImagePath"]."/arrow4.gif",
										"subimagepadding"	=> 2
									   );
		} else {
			$this->MenuGlobalSettins = array(
										"bordercolor"		=> "#52AD91",
										"borderstyle"		=> "solid",
										"borderwidth"		=> 1,
										"fontfamily"		=> "Arial",
										"fontsize"			=> "11px",
										"fontstyle"			=> "normal",
										"headerbgcolor"		=> "#ffffff",
										"headercolor"		=> "#000000",
										"offbgcolor"		=> "#CFFFF0",
										"offcolor"			=> "#000000",
										"onbgcolor"			=> "#92EDD1",
										"oncolor"			=> "#000000",
										"outfilter"			=> "randomdissolve(duration=0.5)",
										"overfilter"		=> "Fade(duration=0.2);Alpha(opacity=90);Shadow(color=#777777', Direction=135, Strength=3)",
										"padding"			=> 4,
										"pagebgcolor"		=> "#92EDD1",
										"pagecolor"			=> "#000000",
										"separatorcolor"	=> "#59B498",
										"separatorsize"		=> 1,
										"subimage"			=> $global_config["SiteImagePath"]."/arrow4.gif",
										"subimagepadding"	=> 2
									   );
		}
		$this->createMenuStyle("menuStyle");
	}
	function createMenuStyle($styleName)
	{
		global $menuData;
		$styleArray = $this->MenuGlobalSettins;
		//printArray($styleArray);
		$menuData.="with($styleName=new mm_style()){\n";
		foreach ($styleArray as $k => $v) 
		{
			if(ereg("color",$k))
			{
				if(substr($v,0,1)!="#")$v="#".$v;
			}
			$menuData.= "$k=\"$v\";\n";
		}
		$menuData.= "}\n\n";
	}

	function mMenuInitialize()
	{
		$this->style			="menuStyle";
		$this->alwaysvisible	= "true";
		$this->orientation		= "horizontal";
		$this->left				= 10;
		$this->top				= 10;
	}
	function createMenu($menuName)
	{
		global $menuData;
		
		$menuArray1 = array("style" => "menuStyle", "overflow" => "scroll");
		if($this->menuItems != '')
		{
			$menuArray2 = array("menuItems" => $this->menuItems);
			$menuArray3 = array_merge($menuArray1, $menuArray2);
		}
		else
			$menuArray3 = $menuArray1;
		
		$menuArray = $menuArray3;
		//printArray($menuArray);
		
		$menuData.= "with(milonic=new menuname(\"$menuName\")){\n";
		$tempMenuItems="";
		foreach ($menuArray as $k => $v) 
		{
			global $menuData;
			if($k!="menuItems")
			{
				if($k=="style")
				{
					$menuData.= "$k=$v;\n";
				}
				else
				{
					$menuData.= "$k=\"$v\";\n";
				}
			}
			else
			{
				if($k=="menuItems")$tempMenuItems=$v;
			}
		}
   		$menuData.= $tempMenuItems."\n";
		$menuData.= "}\n\n";
	}

	function strPad($strString){
		$strWidth = 75;
		if(strlen($strString)< $strWidth) {
			$strDiff = $strWidth - strlen($strString);
			return (str_pad($strString,$strDiff," ",STR_PAD_RIGHT));
		}
		
	}
	function addItemFromText($itemText)
	{
		global $menuData;
		$this->menuItems.="aI(\"".$itemText . "\");\n";	
	}
}
// Class End

function CreateTopSubMenus($MenuGroup)
{
	global $objCommon, $global_config,$_SESSION;
	
	$objTables 		= array("menus A");
	$objFields 		= array("A.*");
	$strWhereClause = "A.Parent_ID = '0' AND A.Status = 'Active' AND A.Menu_Type = 'Top' AND A.Menu_Group = '$MenuGroup' ORDER BY A.Menu_Order_ID ASC";
	$QryResult      = $objCommon->SelectQry($objTables,$objFields,'',$strWhereClause,'','','',0);
	$TopMenuCount	= $objCommon->RecCount;
	//print "TopMenuCount".$TopMenuCount;
	for ($i=0;$i<$TopMenuCount;$i++)
	{	
		$MenuId1			= $QryResult[$i]["MenuId"];
		$objTables2			= array("menus A");
		$objFields2 		= array("A.*");
		$strWhereClause2	= "A.Parent_ID = '$MenuId1' AND A.Status = 'Active' ORDER BY A.Menu_Order_ID ASC";
		$QryResult2			= $objCommon->SelectQry($objTables2,$objFields2,'',$strWhereClause2,'','','',0);
		$TopSubMenuCount	= $objCommon->RecCount;
		
		$objMenu	= new Menu();
		$objMenu->style		= "menuStyle";
		$objMenu->overflow	= "scroll";
		//$objMenu->AddingSystemInternalUserLeftMenusURLs();
		//print $TopSubMenuCount;
		for ($j=0;$j<$TopSubMenuCount;$j++)
		{
			$MenuURL2		= $QryResult2[$j]["Menu_Url"];

			if($_SESSION["LanguageCode"]=="2")
			$MenuTitle2		= $QryResult2[$j]["Menu_Title_Arabic"];
			else
			$MenuTitle2		= $QryResult2[$j]["Menu_Title"];
			
			//print "<br>======> ".$MenuTitle2."<br>";
			$MenuIcon2		= $QryResult2[$j]["Menu_Icon"];
			
			if ($_SESSION["sesUserAccessURLsList"] != '' && isset($_SESSION["sesUserAccessURLsList"]))
			{
				//printArray($_SESSION["sesUserAccessURLsList"]);
				$tempsesUserAccessURLsList = $_SESSION["sesUserAccessURLsList"];
				$OptionalMenuURL1	= $QryResult2[$j]["OptionalMenu_URL1"];
				$OptionalMenuURL2	= $QryResult2[$j]["OptionalMenu_URL2"];
				$OptionalMenuURL3	= $QryResult2[$j]["OptionalMenu_URL3"];
				$OptionalMenuURL4	= $QryResult2[$j]["OptionalMenu_URL4"];
				$OptionalMenuURL5	= $QryResult2[$j]["OptionalMenu_URL5"];
				if (in_array($MenuURL2, $tempsesUserAccessURLsList) || in_array($OptionalMenuURL1, $tempsesUserAccessURLsList) 
				|| in_array($OptionalMenuURL2, $tempsesUserAccessURLsList) || in_array($OptionalMenuURL3, $tempsesUserAccessURLsList) 
				|| in_array($OptionalMenuURL4, $tempsesUserAccessURLsList) || in_array($OptionalMenuURL5, $tempsesUserAccessURLsList))
				{
					//print " Yes You have Access for this page <br>";
					$objMenu->addItemFromText("image=".$global_config["SiteImagePath"]."/menuicons/".$MenuIcon2.";text=".$objMenu->strPad($MenuTitle2).";url=".$global_config["site_url"].$MenuURL2.";");
				}
			}
			else
			{
				$objMenu->addItemFromText("image=".$global_config["SiteImagePath"]."/menuicons/".$MenuIcon2.";text=".$objMenu->strPad($MenuTitle2).";url=".$global_config["site_url"].$MenuURL2.";");
			}
		}
		$objMenu->createMenu("SubMenuList".$MenuId1);
	}
	
	commitMenus();
}

function CreateLeftSubMenus($MenuGroup)
{
	global $objCommon, $global_config, $NotIncludeLeftMMenuArray, $NotIncludeLeftSMenuArray;
	
	$objTables 		= array("menus A");
	$objFields 		= array("A.*");
	$strWhereClause = "A.Parent_ID = '0' AND A.Status = 'Active' AND A.Menu_Type = 'Left' and A.Menu_Group = '$MenuGroup' ORDER BY A.Menu_Order_ID ASC";
	$QryResult      = $objCommon->SelectQry($objTables,$objFields,'',$strWhereClause,'','','',0);
	$TopMenuCount	= $objCommon->RecCount;
	//print "TopMenuCount".$TopMenuCount;
	for ($i=0;$i<$TopMenuCount;$i++)
	{
		$MenuId1			= $QryResult[$i]["MenuId"];
		$MMenuChkFlag = 1;
		//printArray($NotIncludeLeftMMenuArray);
		if($_SESSION["NotIncludeMenuChkFlag"] == 1)
		{
			if(!in_array($QryResult[$i]["Menu_Title"], $NotIncludeLeftMMenuArray))
				$MMenuChkFlag = 1;
			else
				$MMenuChkFlag = 0;
		}
		if($MMenuChkFlag == 1)
		{
			$objTables2			= array("menus A");
			$objFields2 		= array("A.*");
			$strWhereClause2	= "A.Parent_ID = '$MenuId1' AND A.Status = 'Active' ORDER BY A.Menu_Order_ID ASC";
			$QryResult2			= $objCommon->SelectQry($objTables2,$objFields2,'',$strWhereClause2,'','','',0);
			$LeftSubMenuCount	= $objCommon->RecCount;
			
			$objMenu	= new Menu();
			$objMenu->style		= "menuStyle";
			$objMenu->overflow	= "scroll";
			//$objMenu->AddingSystemInternalUserLeftMenusURLs();
			//printArray($objMenu->AccessPageListForGroup);
			
			for ($j=0;$j<$LeftSubMenuCount;$j++)
			{
				$MenuURL2		= $QryResult2[$j]["Menu_Url"];
				if($_SESSION["LanguageCode"]=="2")
					$MenuTitle2	= $QryResult2[$j]["Menu_Title_Arabic"];
				else
					$MenuTitle2	= $QryResult2[$j]["Menu_Title"];
				
				//print "<br> $MenuURL2 ======> ".$MenuTitle2."<br>";
				$MenuIcon2		= $QryResult2[$j]["Menu_Icon"];
				$SMenuChkFlag = 1;
				if($_SESSION["NotIncludeMenuChkFlag"] == 1)
				{
					if(!in_array($QryResult2[$j]["Menu_Title"], $NotIncludeLeftSMenuArray))
						$SMenuChkFlag = 1;
					else
						$SMenuChkFlag = 0;
				}
				if($SMenuChkFlag == 1)
				{
					if ($_SESSION["sesUserAccessURLsList"] != '' && isset($_SESSION["sesUserAccessURLsList"]))
					{
						$tempsesUserAccessURLsList = $_SESSION["sesUserAccessURLsList"];
						//printArray($tempsesUserAccessURLsList);
						$OptionalMenuURL1	= $QryResult2[$j]["OptionalMenu_URL1"];
						$OptionalMenuURL2	= $QryResult2[$j]["OptionalMenu_URL2"];
						$OptionalMenuURL3	= $QryResult2[$j]["OptionalMenu_URL3"];
						$OptionalMenuURL4	= $QryResult2[$j]["OptionalMenu_URL4"];
						$OptionalMenuURL5	= $QryResult2[$j]["OptionalMenu_URL5"];
						if (in_array($MenuURL2, $tempsesUserAccessURLsList) || in_array($OptionalMenuURL1, $tempsesUserAccessURLsList) 
						|| in_array($OptionalMenuURL2, $tempsesUserAccessURLsList) || in_array($OptionalMenuURL3, $tempsesUserAccessURLsList) 
						|| in_array($OptionalMenuURL4, $tempsesUserAccessURLsList) || in_array($OptionalMenuURL5, $tempsesUserAccessURLsList))
						{
							//print " Yes You have Access for this page <br>";
							$objMenu->addItemFromText("image=".$global_config["SiteImagePath"]."/menuicons/".$MenuIcon2.";text=".$objMenu->strPad($MenuTitle2).";url=".$global_config["site_url"].$MenuURL2.";");
						}
					}
					else
					{
						$objMenu->addItemFromText("image=".$global_config["SiteImagePath"]."/menuicons/".$MenuIcon2.";text=".$objMenu->strPad($MenuTitle2).";url=".$global_config["site_url"].$MenuURL2.";");
					}
				}
			}
			$objMenu->createMenu("LeftSubMenuList".$MenuId1);
		}
	}
	
	commitMenus();
}

function drawMenuCode()
{
	global $menuVars,$menuCodeDrawn;
	if($menuCodeDrawn==0)
	{
		echo "
			<script language=\"JavaScript\" src=\"$menuVars[pathToCodeFiles]$menuVars[file_milonicsrc]\" type=\"text/javascript\"></script>	
			<script language=\"JavaScript\">
			if(ns4)_d.write(\"<scr\"+\"ipt language=JavaScript src=$menuVars[pathToCodeFiles]$menuVars[file_mmenuns4]><\/scr\"+\"ipt>\");		
			  else _d.write(\"<scr\"+\"ipt language=JavaScript src=$menuVars[pathToCodeFiles]$menuVars[file_mmenudom]><\/scr\"+\"ipt>\"); 
			</script>
			";
	}
	flush();
	$menuCodeDrawn++;
}
$drawCount		= 0;
$menuCodeDrawn	= 0;
function drawMenus()
{
	global $menuData, $menuVars, $drawCount, $menuCodeDrawn, $mmMenu;
	if($menuCodeDrawn==0)drawMenuCode();
	echo "<script>\n";
	if($drawCount==0)
	{
		echo "
			_menuCloseDelay=$menuVars[menuCloseDelay];
			_menuOpenDelay=$menuVars[menuOpenDelay];
			_subOffsetTop=$menuVars[subOffsetTop];
			_subOffsetLeft=$menuVars[subOffsetLeft]
			";
	}
	echo $menuData;
	echo "drawMenus();\n";
	echo "</script>\n";	
	$drawCount++;
	$menuData="";
	$mmMenu=null;
	flush();
}
function commitMenus()
{
	drawMenuCode();
	drawMenus();
}

?>