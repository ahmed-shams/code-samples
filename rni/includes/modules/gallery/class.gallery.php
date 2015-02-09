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
	class Gallery extends Common {
		function Gallery() {
			$this->Common();
			$this->User 				= "tbl_users";
			$this->Country 				= "tbl_Country";
			$this->States 				= "tblStates";
			$this->Pictures		  		= "tbl_Pictures";
			$this->Gallery		  		= "tbl_Gallery";
			$this->Galleries		  	= "tbl_galleries";
			$this->stylegallery		  	= "tbl_stylegallery";
			$this->Rate		  			= "tbl_Rate";
			$this->Views		  		= "tbl_Views";
			$this->Options				= "tbl_Options";
		}
		
		function getsearchImages($objArray){
		 	global $objSmarty,$_REQUEST,$global_config;
			$Prefix="src_";
			$strWhereClause='';
			foreach($objArray as $key=>$value){
				$pos = strpos($key, $Prefix);
					if (!is_integer($pos)) {
						// not found...
					}
					else
					{
						$key = str_replace("src_","",$key);
						if($value != "" && $value != "Any")
						{
						
							$value=trim($value);
							// This Block Forming Condition to Check Primary Customer Name
							if($key=="color" )
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any"){
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									$strWhereClause.="color = '$value'";
									$query_string .="color=$value";
								}
								
								
							}
							elseif($key=="gender") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any"){
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									
									$strWhereClause.="(gender = '$value')";
									$query_string .="gender=$value";
								}
							}
							elseif($key=="length") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any")	{
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									$strWhereClause.="(length = '$value')";
									$query_string .="length=$value";
								}
							}
							elseif($key=="texture") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any")	{
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									
									$strWhereClause.="(texture = '$value')";
									$query_string .="texture=$value";
								}
							}
							elseif($key=="style") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any")	{
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									$strWhereClause.="(style like '%$value%')";
									$query_string .="style like \'%$value%\'";
								}
							}
							elseif($key=="face_shape") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any")	{
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									$strWhereClause.="(face_shape  = '$value')";
									$query_string .="face_shape=$value";
								}
							}
							elseif($key=="celebrities") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any"){	
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
										
									if($value == 3)
										 $value=1;

									$strWhereClause.= "(celebrities  = '$value') ";
									$query_string .="celebrities=$value";
								}
							}
							elseif($key=="sorting" && $value != "Style #") 
							{
								if($value == "Recent_first"){ 
								 $Odrderby= " ORDER BY created_on DESC ";
								} elseif($value == "Most_popular") {
									$Odrderby= " ORDER BY views DESC";
								} elseif($value == "Top-rated_first") {
									$Odrderby= " ORDER BY rate DESC";
								}	
							}
							
						}
					}
				}

			if($_REQUEST["strWhereClause"]=='')
				$_REQUEST["strWhereClause"].= trim($query_string);
			else
				$strWhereClause = stripslashes($_REQUEST["strWhereClause"]);
				// $_REQUEST["strWhereClause"];
				
			if($_REQUEST["Odrderby"]=='')
				$_REQUEST["Odrderby"].= $Odrderby;
			else
				$Odrderby = $_REQUEST["Odrderby"];
			 
			if( $strWhereClause!='')
				  $strWhereClause= " WHERE ". $strWhereClause. " ";
				  
			 $strSql1      = "select * from ".$this->Pictures .$strWhereClause  ;
			
			$Images1    = $this->getSelectByQuery($strSql1);
			
			$ImagesCount1 = $this->dbQueryNumRows;
			//$RowDisplay=8;
			if($RowDisplay == '') $RowDisplay =$global_config["RowDisplay"];
			
			 $this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage_ajax($_REQUEST,$RowDisplay,$strSql1);
			$this->perPageList($RowDisplay);
			#######################################

			$strSql      = "select * from ".$this->Pictures .$strWhereClause . $Odrderby .$Qry_limit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			
			for($i=0;$i<$ImagesCount;$i++){
				 $Images[$i]['rating']=$this->rateCount($Images[$i]['id']);
			}
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("TotalCount",$ImagesCount1);
			$objSmarty->assign("query_string",$query_string);
			$objSmarty->assign("Images",$Images);
		}	
		
		
		function getImages($objArray){
		 	global $objSmarty,$_REQUEST,$global_config;
			$Prefix="txtl_";
			$strWhereClause='';
			foreach($objArray as $key=>$value){
				$pos = strpos($key, $Prefix);
					if (!is_integer($pos)) {
						// not found...
					}
					else
					{
						$key = str_replace("txtl_","",$key);
						if($value != "" && $value != "Any")
						{
						
							$value=trim($value);
							// This Block Forming Condition to Check Primary Customer Name
							if($key=="color" )
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any"){
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									$strWhereClause.="color = '$value'";
									$query_string .="color=$value";
								}
								
								
							}
							elseif($key=="gender") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any"){
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									
									$strWhereClause.="(gender = '$value')";
									$query_string .="gender=$value";
								}
							}
							elseif($key=="length") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any")	{
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									$strWhereClause.="(length = '$value')";
									$query_string .="length=$value";
								}
							}
							elseif($key=="texture") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any")	{
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									
									$strWhereClause.="(texture = '$value')";
									$query_string .="texture=$value";
								}
							}
							elseif($key=="style") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any")	{
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									$strWhereClause.="(style like '%$value%')";
									$query_string .="style=$value";
								}
							}
							elseif($key=="face_shape") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any")	{
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
									$strWhereClause.="(face_shape  = '$value')";
									$query_string .="face_shape=$value";
								}
							}
							elseif($key=="celebrities") 
							{
								if($query_string !='')
								$query_string.= '&';

								if($value != "Any"){	
									if ($strWhereClause != "")
										$strWhereClause.=" and ";
										
									if($value == 3)
										 $value=1;

									$strWhereClause.= "(celebrities  = '$value') ";
									$query_string .="celebrities=$value";
								}
							}
							elseif($key=="sorting" && $value != "Style #") 
							{
								if($value == "Recent_first"){ 
								 $Odrderby= " ORDER BY created_on DESC ";
								} elseif($value == "Most_popular") {
									$Odrderby= " ORDER BY views DESC";
								} elseif($value == "Top-rated_first") {
									$Odrderby= " ORDER BY votes DESC";
								}	
							}
							
						}
					}
				}

			if($_REQUEST["strWhereClause"]=='')
				$_REQUEST["strWhereClause"].= trim($query_string);
			else
				 $strWhereClause = $_REQUEST["strWhereClause"];
				
			if($_REQUEST["Odrderby"]=='')
				$_REQUEST["Odrderby"].= $Odrderby;
			else
				$Odrderby = $_REQUEST["Odrderby"];
			 
			if( $strWhereClause!='')
				  $strWhereClause= " WHERE ". $strWhereClause. " ";
				  
			$strSql1      = "select * from ".$this->Pictures .$strWhereClause  ;
			$Images1    = $this->getSelectByQuery($strSql1);
			$ImagesCount1 = $this->dbQueryNumRows;
			//$RowDisplay=8;
			if($RowDisplay == '') $RowDisplay =$global_config["RowDisplay"];
			
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage($_REQUEST,$RowDisplay,$strSql1);
			$this->perPageList($RowDisplay);
			#######################################

			$strSql      = "select * from ".$this->Pictures .$strWhereClause . $Odrderby .$Qry_limit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			
			for($i=0;$i<$ImagesCount;$i++){
				 $Images[$i]['rating']=$this->rateCount($Images[$i]['id']);
			}
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("TotalCount",$ImagesCount1);
			$objSmarty->assign("query_string",$query_string);
			$objSmarty->assign("Images",$Images);
		}	
		
		function getImagesbyId($id=''){
		 	global $objSmarty,$_REQUEST;
			if($id)
				$Ident=$id;
			else
				$Ident=$_REQUEST['id'];
				
				if($Ident)
					 $strWhereClause= " WHERE id=$Ident ";
				else
					$strWhereClause ='';
					

			$strSql      = "select * from ".$this->Pictures .$strWhereClause;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount1 = $this->dbQueryNumRows;
			
			$pic_Id=$Images[0]['id'];
			$name=$Images[0]['name'];
			$this->updateViews($pic_Id);
			
			$strWhere= " WHERE name='$name' ";
			$strSql      = "select * from ".$this->Pictures . $strWhere;
			$ExtraImages    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			
			$rating=$this->rates_vote($Ident);
			$Images=$this->options($Images);
			
			$objSmarty->assign("rates",$rating);
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("Images",$Images);
			$objSmarty->assign("ExtraImages",$ExtraImages);
		}			
		
		function getImagesbyName($name){
		 	global $objSmarty,$_REQUEST;
			//printArray($_REQUEST);
				$Name=str_replace('-', ' ', $name);
				if($Name)
					  $strWhere= " WHERE name='$Name' ";
				else
					$strWhere ='';
					
			if($_REQUEST['ID']){
				$ident= $_REQUEST['ID'];
				$strWhereClause =$strWhere . " AND id = $ident " ;
			}else{
				$strWhereClause =$strWhere;
			}
					
			$strSql2      = "select * from ".$this->Pictures . $strWhereClause;
			$Images2    = $this->getSelectByQuery($strSql2);
			
			$pic_Id=$Images2[0]['id'];
			$this->updateViews($pic_Id);
			
			$strSql1      = "select * from ".$this->Pictures . $strWhereClause;
			$Images    = $this->getSelectByQuery($strSql1);
			
			$strSql      = "select * from ".$this->Pictures . $strWhere;
			$ExtraImages    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$Images=$this->options($Images);
			$rating=$this->rates_vote($pic_Id);

			$objSmarty->assign("ExtraImages",$ExtraImages);
			$objSmarty->assign("Images",$Images);

			$objSmarty->assign("rates",$rating);
			return $Images ;
		}			
			
		function vote($Ident,$name,$urls,$rate){
		 	global $objSmarty,$_REQUEST;
			$url= $urls;
			$ip=$_SERVER['REMOTE_ADDR'];
			$browser= $_SERVER[HTTP_USER_AGENT];//$this->getBrowserType()
			
			if($Ident)
				 $strWhereClause= " WHERE pic_id=$Ident and ip = '$ip' and browser = '$browser'";
			if($Ident && $_SESSION['sesUserId']!='')
					 $strWhereClause.= " and user_id = ". $_SESSION['sesUserId'] ;

			$strSql      = "select * from ".$this->Rate .$strWhereClause;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			
			if($Images[0]['pic_id'] != $Ident){
				$InsertArray[0]["Field"] = "votes";
				$InsertArray[0]["Value"] = 1;
				$InsertArray[1]["Field"] = "ip";
				$InsertArray[1]["Value"] = $ip;
				$InsertArray[2]["Field"] = "rating";
				$InsertArray[2]["Value"] = $rate;
				$InsertArray[3]["Field"] = "browser";
				$InsertArray[3]["Value"] = $browser;
				$InsertArray[4]["Field"] = "pic_id";
				$InsertArray[4]["Value"] = $Ident;
				if($_SESSION['sesUserId']!=''){
						$InsertArray[5]["Field"] = "user_id";
						$InsertArray[5]["Value"] = $_SESSION['sesUserId'];
					}	
				$this->doInsert($this->Rate,$InsertArray);
				
				$strWhere=" WHERE pic_id=$Ident";
				$strSql  = "select sum(votes) as votes from ".$this->Rate .$strWhere;
				$Images    = $this->getSelectByQuery($strSql);
				
				$vote=$Images[0]['votes'];
				$id = $Images[0]['pic_id'];
				$Where = " WHERE id = $Ident ";
				$UpdateArray[0]["Field"] = "votes";
				$UpdateArray[0]["Value"] = $vote;
				$this->doUpdate($this->Pictures,$UpdateArray,$Where);

			}else{
				$err='You have already voted <br />for this Hairstyle.';
				$objSmarty->assign("err", $err);
			}

			
			if($Ident=='')
			 $Ident=$_REQUEST['pic_Id'];
			if($Ident)
			 $this->updateViews($Ident);
			 
			$rating=$this->rates_vote($Ident);
			$objSmarty->assign("rates",$rating);

			$strWhereClause= " WHERE id=$Ident ";
			$strSql1      = "select * from ".$this->Pictures . $strWhereClause;
			$Images    = $this->getSelectByQuery($strSql1);
			
			$names=$Images[0]['name'];
			$strWhere=" WHERE name='$names'";
			$strSql      = "select * from ".$this->Pictures . $strWhere;
			$ExtraImages    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			
			$Images=$this->options($Images);
			$objSmarty->assign("Images",$Images);
			$objSmarty->assign("ExtraImages",$ExtraImages);
			$objSmarty->assign("ImagesCount",$ImagesCount);
			
		}			

		function getImagesbystyle($objarray){
		 	global $objSmarty,$_REQUEST, $global_config;
				$Ident=$_REQUEST['GID'];
				if($Ident)
					 $strWhereClause= " gallery_id=$Ident ";
				else
					$strWhereClause ='';
					
			if($_REQUEST["strWhereClause"]=='')
				$_REQUEST["strWhereClause"].= trim($query_string);
			else
				$strWhereClause = $_REQUEST["strWhereClause"];
				
			 
			if( $strWhereClause!='')
				  $strWhereClause= " WHERE ". $strWhereClause. " ";
				  
			$strSql1      = "select * from ".$this->Gallery .$strWhereClause  ;
			$Images1    = $this->getSelectByQuery($strSql1);
			$ImagesCount1 = $this->dbQueryNumRows;

			if($RowDisplay == '') $RowDisplay =$global_config["RowDisplay"];
			
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPage($_REQUEST,$RowDisplay,$strSql1);
			$this->perPageList($RowDisplay);
			#######################################

			$strSql      = "select * from ".$this->Gallery .$strWhereClause.$Qry_limit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			
			for($i=0;$i<$ImagesCount;$i++){
				if($Images[$i]!=""){
					$id = $Images[$i]['pic_id'];
					$Where = " WHERE gallery_id = $id ";
					$strSql2      = "select * from ".$this->Pictures .$strWhereClause;
					$Images2    = $this->getSelectByQuery($strSql2);
					$Images[$i]['color']=$Images2[0]['color'];
					$Images[$i]['texture']=$Images2[0]['texture'];
					$Images[$i]['style']=$Images2[0]['style'];
					$Images[$i]['celebrities']=$Images2[0]['celebrities'];
					$Images[$i]['length']=$Images2[0]['length'];
					$Images[$i]['gender']=$Images2[0]['gender'];
					$Images[$i]['face_shape']=$Images2[0]['face_shape'];
					$Images[$i]['id']=$Images2[0]['id'];
					$Images[$i]['path']=$Images2[0]['path'];
					$Images[$i]['title']=$Images2[0]['title'];
					$Images[$i]['name']=$Images2[0]['name'];
					$Images[$i]['votes']=$Images2[0]['votes'];
					$Images[$i]['views']=$Images2[0]['views'];
					$Images[$i]['created_on']=$Images2[0]['created_on'];
				}
			}
			$Images=$this->options($Images);
			$objSmarty->assign("rates",$rates);
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("TotalCount",$ImagesCount1);
			$objSmarty->assign("Images",$Images);
		}		
		
		function getImagesbyGalleryStyle($objarray){
		 	global $objSmarty,$_REQUEST, $global_config;
			$objOptions = new Options();
				$Ident=$_REQUEST['GID'];
				if($Ident)
					 $strWhereClause= " gallery_id=$Ident ";
				else
					$strWhereClause ='';

			$gallery = $objOptions->GalleryOptions();
					
		 	$Pic_id=$this->galleryOptions($gallery,$_REQUEST);
			$PicCount=count($Pic_id);
			for($i=0;$i<$PicCount;$i++){
			$picId[]=$Pic_id[$i]['id'];
			}
				if(is_array($Pic_id)){
					  $Ident = implode(",",array_values($picId));
					$whereSQL .= " WHERE id IN (" . $Ident . ")";			
				}else{
					$whereSQL .= " WHERE id  ='" . $Ident . "'";			
				}

			 
				  
			$strSql1      = "select * from ".$this->Pictures .$whereSQL  ;
			$Images1    = $this->getSelectByQuery($strSql1);
			$ImagesCount1 = $this->dbQueryNumRows;
			if($RowDisplay == '') $RowDisplay =$global_config["RowDisplay"];
			
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPageStyle_ajax($_REQUEST,$RowDisplay,$strSql1);
			$this->perPageList($RowDisplay);
			#######################################

			$strSql      = "select * from ".$this->Pictures .$whereSQL.$Qry_limit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			for($i=0;$i<$ImagesCount;$i++){
				 $Images[$i]['rating']=$this->rateCount($Images[$i]['id']);
			}

			$Images=$this->options($Images);
			$objSmarty->assign("rates",$rates);
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("TotalCount",$ImagesCount1);
			$objSmarty->assign("Images",$Images);
		}	
		
		function getImagesbyGallery($objarray){
		 	global $objSmarty,$_REQUEST, $global_config;
			$objOptions = new Options();
				$Ident=$_REQUEST['GID'];
				
		 	//$Pic_id=$this->galleryStyleOptions($_REQUEST);
			$whereSQL=$this->galleryStyleOptions($_REQUEST);
			/*
			$PicCount=count($Pic_id);
			for($i=0;$i<$PicCount;$i++){
			$picId[]=$Pic_id[$i]['id'];
			}
				if(is_array($Pic_id)){
					  $Ident = implode(",",array_values($picId));
					$whereSQL .= " WHERE id IN (" . $Ident . ")";			
				}else{
					$whereSQL .= " WHERE id  ='" . $Ident . "'";			
				}

			 */
				  
			$strSql1      = "select * from ".$this->Pictures .$whereSQL  ;
			$Images1    = $this->getSelectByQuery($strSql1);
			$ImagesCount1 = $this->dbQueryNumRows;
			if($RowDisplay == '') $RowDisplay =$global_config["RowDisplay"];
			
			$this->offset = $_REQUEST["offset"];
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPageStyle_ajax($_REQUEST,$RowDisplay,$strSql1);
			$this->perPageList($RowDisplay);
			#######################################

			$strSql      = "select * from ".$this->Pictures .$whereSQL.$Qry_limit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			for($i=0;$i<$ImagesCount;$i++){
				 $Images[$i]['rating']=$this->rateCount($Images[$i]['id']);
			}
			$Images=$this->options($Images);
			$objSmarty->assign("rates",$rates);
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("TotalCount",$ImagesCount1);
			$objSmarty->assign("Images",$Images);
		}	

		function getImagesbyPhoto($objarray){
		 	global $objSmarty,$_REQUEST, $global_config;
			$objOptions = new Options();
				$Ident=$_REQUEST['GID'];
				if($Ident)
					 $strWhereClause= " WHERE photographer = 'DaileCeleb.com' ";
					 
				if($Ident==100)
					$strWhereClause=$strWhereClause. " AND gender=1 ";
				else if($Ident==101)	
					$strWhereClause= $strWhereClause. " AND gender=2 ";
			 
				  
			 $strSql1      = "select * from ".$this->Pictures .$strWhereClause  ;
			$Images1    = $this->getSelectByQuery($strSql1);
			$ImagesCount1 = $this->dbQueryNumRows;
			if($RowDisplay == '') $RowDisplay =$global_config["RowDisplay"];
			
			 $this->offset = $_REQUEST["offset"];
			
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPageStyle_ajax($_REQUEST,$RowDisplay,$strSql1);
			$this->perPageList($RowDisplay);
			#######################################

			 $strSql      = "select * from ".$this->Pictures .$strWhereClause.$Qry_limit;
			//exit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			for($i=0;$i<$ImagesCount;$i++){
				 $Images[$i]['rating']=$this->rateCount($Images[$i]['id']);
			}
			$Images=$this->options($Images);
			$objSmarty->assign("rates",$rates);
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("TotalCount",$ImagesCount1);
			$objSmarty->assign("Images",$Images);
		}	
		function getImagesbyGalleryPhoto($objarray){
		 	global $objSmarty,$_REQUEST, $global_config;
			$objOptions = new Options();
				$Ident=$_REQUEST['GID'];
				$stylename=$_REQUEST['stylename'];
				
				$strSqlphoto      = "select photographer from ".$this->Pictures;
				$photo    = $this->getSelectByQuery($strSqlphoto);
				$photoCount = $this->dbQueryNumRows;
				for($i=0;$i<$photoCount;$i++){
					if($photo[$i]['photographer']){
					if($str_opt=stristr($stylename,$photo[$i]['photographer'])){
						$photographer=$photo[$i]['photographer'];
							break;
						}
					}	
						
				}		
				
				if($photographer)
					 $strWhereClause= " WHERE photographer = '$photographer' ";
					 
				if( $str_opt=stristr($stylename,'Women')){
					   $strWhereClause= $strWhereClause. " AND   gender =1 ";
				 }else if( $str_opt=stristr($stylename,'men')){
					  $strWhereClause= $strWhereClause . " AND   gender = 2 ";
					 
				}
				if($photographer=='') {
					$objSmarty->assign("ImagesCount",$ImagesCount);
					$objSmarty->assign("TotalCount",$ImagesCount1);
					$objSmarty->assign("Images",$Images);
					return; 
				}
				
 				/*
				if($Ident==100)
					$strWhereClause=$strWhereClause. " AND gender=1 ";
				else if($Ident==101)	
					$strWhereClause= $strWhereClause. " AND gender=2 ";*/
			 
				  
			$strSql1      = "select * from ".$this->Pictures .$strWhereClause  ;
			$Images1    = $this->getSelectByQuery($strSql1);
			$ImagesCount1 = $this->dbQueryNumRows;
			if($RowDisplay == '') $RowDisplay =$global_config["RowDisplay"];
			
			 $this->offset = $_REQUEST["offset"];
			
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPageStyle_ajax($_REQUEST,$RowDisplay,$strSql1);
			$this->perPageList($RowDisplay);
			#######################################

			 $strSql      = "select * from ".$this->Pictures .$strWhereClause.$Qry_limit;
			//exit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			for($i=0;$i<$ImagesCount;$i++){
				 $Images[$i]['rating']=$this->rateCount($Images[$i]['id']);
			}
			$Images=$this->options($Images);
			$objSmarty->assign("rates",$rates);
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("TotalCount",$ImagesCount1);
			$objSmarty->assign("Images",$Images);
		}	
		function getImagesbyGallerySalon($objarray){
		 	global $objSmarty,$_REQUEST, $global_config;
			$objOptions = new Options();
				$Ident=$_REQUEST['GID'];
				$stylename=$_REQUEST['stylename'];
				//if($Ident)
					 //$strWhereClause= " WHERE photographer = 'DaileCeleb.com' ";
				
				$strSqlSalon      = "select Salon from ".$this->Pictures;
				$Salon    = $this->getSelectByQuery($strSqlSalon);
				$SalonCount = $this->dbQueryNumRows;
				for($i=0;$i<$SalonCount;$i++){
					if($Salon[$i]['Salon']){
					if($str_opt=stristr($stylename,$Salon[$i]['Salon'])){
						$Salon=$Salon[$i]['Salon'];
							break;
						}
					}	
						
				}		
				
				if($Salon)
					 $strWhereClause= " WHERE Salon = '$Salon' ";
			 	else
				 {
					$objSmarty->assign("ImagesCount",$ImagesCount);
					$objSmarty->assign("TotalCount",$ImagesCount1);
					$objSmarty->assign("Images",$Images);
				return; 
				 }
	/*
				if($Ident==102 || $Ident==104)
					$strWhereClause=" WHERE Salon = 'Miki Sharon' ";
				else if($Ident==103)	
					$strWhereClause=" WHERE Salon = 'Henry Amador' ";
			 	else
				 {
					$objSmarty->assign("ImagesCount",$ImagesCount);
					$objSmarty->assign("TotalCount",$ImagesCount1);
					$objSmarty->assign("Images",$Images);
				return; 
				 }*/
				  
			 $strSql1      = "select * from ".$this->Pictures .$strWhereClause  ;
			$Images1    = $this->getSelectByQuery($strSql1);
			$ImagesCount1 = $this->dbQueryNumRows;
			if($RowDisplay == '') $RowDisplay =$global_config["RowDisplay"];
			
			 $this->offset = $_REQUEST["offset"];
			
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPageStyle_ajax($_REQUEST,$RowDisplay,$strSql1);
			$this->perPageList($RowDisplay);
			#######################################

			 $strSql      = "select * from ".$this->Pictures .$strWhereClause.$Qry_limit;
			//exit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			for($i=0;$i<$ImagesCount;$i++){
				 $Images[$i]['rating']=$this->rateCount($Images[$i]['id']);
			}
			$Images=$this->options($Images);
			$objSmarty->assign("rates",$rates);
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("TotalCount",$ImagesCount1);
			$objSmarty->assign("Images",$Images);
		}	
		function getImagesbyGallerySpecial($objarray){
		 	global $objSmarty,$_REQUEST, $global_config;
			$objOptions = new Options();
			$Ident=$_REQUEST['GID'];
			$stylename=$_REQUEST['stylename'];
				
			$strSqlSpecial      = "select Specialty from ".$this->Pictures;
			$Special    = $this->getSelectByQuery($strSqlSpecial);
			$SpecialCount = $this->dbQueryNumRows;
			for($i=0;$i<$SpecialCount;$i++){
				if($Special[$i]['Specialty']){
				if($str_opt=stristr($stylename,$Special[$i]['Specialty'])){
					$Specialty=$Special[$i]['Specialty'];
						break;
					}
				}	
					
			}		
			if($Specialty)
				 $strWhereClause= " WHERE Specialty = '$Specialty' ";
			else
			 {
				$objSmarty->assign("ImagesCount",$ImagesCount);
				$objSmarty->assign("TotalCount",$ImagesCount1);
				$objSmarty->assign("Images",$Images);
				return; 
			 }
				/*if($Ident==107)
					$strWhereClause=" WHERE Specialty = 'Goldwell' ";
			 	else
				 {
					$objSmarty->assign("ImagesCount",$ImagesCount);
					$objSmarty->assign("TotalCount",$ImagesCount1);
					$objSmarty->assign("Images",$Images);
				return; 
				 }*/
				  
			$strSql1      = "select * from ".$this->Pictures .$strWhereClause  ;
			$Images1    = $this->getSelectByQuery($strSql1);
			$ImagesCount1 = $this->dbQueryNumRows;
			if($RowDisplay == '') $RowDisplay =$global_config["RowDisplay"];
			
			 $this->offset = $_REQUEST["offset"];
			
			if($this->offset==""){
				$this->offset = 0;
			}
			if(!empty($RowDisplay))
				$Qry_limit = " LIMIT ".$this->offset.",".$RowDisplay;
			else
				$Qry_limit = '';
				
			$this->showPerPageStyle_ajax($_REQUEST,$RowDisplay,$strSql1);
			$this->perPageList($RowDisplay);
			#######################################

			 $strSql      = "select * from ".$this->Pictures .$strWhereClause.$Qry_limit;
			//exit;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			for($i=0;$i<$ImagesCount;$i++){
				 $Images[$i]['rating']=$this->rateCount($Images[$i]['id']);
			}
			$Images=$this->options($Images);
			$objSmarty->assign("rates",$rates);
			$objSmarty->assign("ImagesCount",$ImagesCount);
			$objSmarty->assign("TotalCount",$ImagesCount1);
			$objSmarty->assign("Images",$Images);
		}	

		function galleryOptions($galArray,$objArray){
			$Ident=$objArray['GID'];
			$strWhereClause='';
			$GalCount=count($galArray);
			for($i=0;$i<$GalCount+1;$i++){
				if($galArray[$i]['GID']==$Ident){
					  $type=$galArray[$i]['type'];
					 $option=$galArray[$i]['style'];
					 if($strWhereClause=='')
						$strWhereClause = " WHERE  $type = $option ";
					else
						$strWhereClause= $strWhereClause. " OR   $type = $option ";
				}
			}
			
			$strSql      = "select id from ".$this->Pictures .$strWhereClause;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			
			if($Images){
				foreach ($Images as $r) {
					 $pid = $r['id'];
				   $picIds[]['id'] = $pid;
				}
			}
			return $picIds ;
		}
		function galleryStyleOptions($objArray){
			$Ident=$objArray['GID'];
			$stylename=$objArray['stylename'];
			$strWhereClause='';
			$count=0;
			//$GalCount=count($galArray);
			$strSql      = "select * from ".$this->Galleries;
			$galArray    = $this->getSelectByQuery($strSql);
			$GalCount = $this->dbQueryNumRows;
			for($i=0;$i<$GalCount;$i++){
				if($galArray[$i]["styles_id"]==$Ident){
					$count=$count+1;
					$strWhere=" WHERE  id = $Ident";
					$strSql      = "select * from ".$this->Options . $strWhere ;
					$styleArray    = $this->getSelectByQuery($strSql);
					$styleCount = $this->dbQueryNumRows;
					 $type=$styleArray[0]['option_name'];
					 $option=$styleArray[0]['option_value'];
					
						if($type != "sorting"){ 
							 if($strWhereClause=='')
								 $strWhereClause = " WHERE  $type = $option ";
							//else
								//$strWhereClause= $strWhereClause. " OR   $type = $option ";
								
								if($type=='celebrities'){
									 $pos=strpos($stylename,'Female');
									 if( $str_opt=stristr($stylename,'Female')){
										   $strWhereClause= $strWhereClause. " AND   gender =1 ";
									 }else if( $str_opt=stristr($stylename,'male')){
										  $strWhereClause= $strWhereClause . " AND   gender = 2 ";
										 
									}
								} 
								
						}else {
							if($option == "Recent_first"){ 
							 $Odrderby= " ORDER BY created_on DESC ";
							} elseif($option == "Most_popular") {
								$Odrderby= " ORDER BY views DESC";
							} elseif($option == "Top-rated_first") {
								$Odrderby= " ORDER BY rate DESC";
							}	
	
						}	
					
				}
				
			}
			/*
			$strSql      = "select id from ".$this->Pictures .$strWhereClause . $Odrderby;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			
			if($Images){
				foreach ($Images as $r) {
					 $pid = $r['id'];
				   $picIds[]['id'] = $pid;
				}
			}*/
			//return $picIds ;
			return $strWhereClause;
		}
		function updateViews($pic_Id=''){
		 	global $objSmarty,$_REQUEST;
			if($pic_Id)
				 $Ident=$pic_Id;
			else
				$Ident=$_REQUEST['id'];
			$ip=$_SERVER['REMOTE_ADDR'];
			$browser= $_SERVER[HTTP_USER_AGENT];
			$Today=date("Y-m-d");
			
			if($Ident)
				  $strWhereClause= " WHERE pic_id=$Ident and ip = '$ip' and browser = '$browser' and created_when='$Today' ";
			if($Ident && $_SESSION['sesUserId']!='')
					 $strWhereClause.= " and user_id = ". $_SESSION['sesUserId'] ;

			$strSql      = "select pic_id from ".$this->Views .$strWhereClause;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
				
			if($Images[0]['pic_id'] != $Ident){
				$InsertArray[0]["Field"] = "views";
				$InsertArray[0]["Value"] = 1;
				$InsertArray[1]["Field"] = "ip";
				$InsertArray[1]["Value"] = $ip;
				$InsertArray[2]["Field"] = "code";
				$InsertArray[2]["Value"] = 'PICV';
				$InsertArray[3]["Field"] = "created_when";
				$InsertArray[3]["Value"] = date("Y-m-d");
				$InsertArray[4]["Field"] = "browser";
				$InsertArray[4]["Value"] = $browser;
				$InsertArray[5]["Field"] = "pic_id";
				$InsertArray[5]["Value"] = $Ident;
				if($_SESSION['sesUserId']!=''){
						$InsertArray[6]["Field"] = "user_id";
						$InsertArray[6]["Value"] = $_SESSION['sesUserId'];
					}	
				$this->doInsert($this->Views,$InsertArray);
				
				$strWhere=" WHERE pic_id=$Ident";
				$strSql  = "select sum(views) as views from ".$this->Views .$strWhere;
				
				$Images    = $this->getSelectByQuery($strSql);
				
				$views=$Images[0]['views'];
				$id = $Images[0]['pic_id'];
				$Where = " WHERE id = $Ident ";
				$UpdateArray[0]["Field"] = "views";
				$UpdateArray[0]["Value"] = $views;
				$this->doUpdate($this->Pictures,$UpdateArray,$Where);
			}
			if($Ident)
				$rate=$this->updateRating($Ident);
			
		}
		
		function updateRating($Ident){
				$strWhere=" WHERE pic_id=$Ident";
				$strSql  = "select sum(rating) as rating  from ".$this->Rate .$strWhere;
				$Images    = $this->getSelectByQuery($strSql);
				$strSql1 = "select  sum(views) as views  from ".$this->Views .$strWhere;
				$Images1   = $this->getSelectByQuery($strSql1);
				
				$id = $Images[0]['pic_id'];
				$views=$Images1[0]['views'];
				$rating=$Images[0]['rating'];
				if($rating >0){
					$rate=$rating / $views;
					
					$Where = " WHERE id = $Ident ";
					$UpdateArray[0]["Field"] = "rate";
					$UpdateArray[0]["Value"] = $rate;
					$this->doUpdate($this->Pictures,$UpdateArray,$Where);
				}
		}
		
		function updateDate(){
		 	global $objSmarty,$_REQUEST;
			
			$strSql      = "select * from ".$this->Pictures .$strWhereClause;
			$Images    = $this->getSelectByQuery($strSql);
			$ImagesCount = $this->dbQueryNumRows;
			for($i=0;$i<$ImagesCount;$i++){
				if($Images[$i]!=""){
					$id = $Images[$i]['id'];
					$Where = " WHERE id = $id ";
					//$UpdateArray[0]["Field"] = "created_on";
					//$UpdateArray[0]["Value"] = date("Y-m-d H:i:s");
					//$UpdateArray[0]["Field"] = "photographer";
					//$UpdateArray[0]["Value"] = "DaileCeleb.com";
					//$UpdateArray[0]["Field"] = "image_info";
					//$UpdateArray[0]["Value"] = $image_info;
					//$this->doUpdate($this->Pictures,$UpdateArray,$Where);
				}
			}
			
		}	
		function options($objArray){
		
		 $color=$objArray[0]['color'];
		 $strSql1     = "select display_title from tbl_Options where option_name= 'color' AND option_value='$color'";
		 $opt_color  = $this->getSelectByQuery($strSql1);	
		 $objArray[0]['color']  = $opt_color[0]["display_title"];
		 
		 $texture=$objArray[0]['texture'];
		 $strSql1     = "select display_title from tbl_Options where option_name= 'texture' AND option_value='$texture'";
		 $opt_color  = $this->getSelectByQuery($strSql1);	
		 $objArray[0]['texture']  = $opt_color[0]["display_title"];
		 
		/* $style=$objArray[0]['style'];
		 $strSql1     = "select display_title from tbl_Options where option_name= 'style' AND option_value='$style'";
		 $opt_color  = $this->getSelectByQuery($strSql1);	
		 $objArray[0]['style']  = $opt_color[0]["display_title"];*/
		 
		  $style=$objArray[0]['style'];
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
		 $objArray[0]['style']= $styles;

		 $celebrities=$objArray[0]['celebrities'];
		 $strSql1     = "select display_title from tbl_Options where option_name= 'celebrities' AND option_value='$celebrities'";
		 $opt_color  = $this->getSelectByQuery($strSql1);	
		 $objArray[0]['celebrities']  = $opt_color[0]["display_title"];
		 
		 $length=$objArray[0]['length'];
		 $strSql1     = "select display_title from tbl_Options where option_name= 'length' AND option_value='$length'";
		 $opt_color  = $this->getSelectByQuery($strSql1);	
		 $objArray[0]['length']  = $opt_color[0]["display_title"];
		 
		 $gender=$objArray[0]['gender'];
		 $strSql1     = "select display_title from tbl_Options where option_name= 'gender' AND option_value='$gender'";
		 $opt_color  = $this->getSelectByQuery($strSql1);	
		 $objArray[0]['gender']  = $opt_color[0]["display_title"];
		 
		 $face_shape=$objArray[0]['face_shape'];
		 $strSql1     = "select display_title from tbl_Options where option_name= 'face_shape' AND option_value='$face_shape'";
		 $opt_color  = $this->getSelectByQuery($strSql1);	
		 $objArray[0]['face_shape']  = $opt_color[0]["display_title"];
		 

		return $objArray;
		}		
		
		function rateCount($Ident){
			global $objSmarty;
				$strWhere=" WHERE id=$Ident";
				$strSql      = "select * from ".$this->Pictures . $strWhere;
				$Images    = $this->getSelectByQuery($strSql);
				if ((int)$Images[0]["rate"] == 0) {
					if($Images[0]["rate"]>0)
						$rating  .= "<img src=\"images/star_half_small.gif\" border=\"0\" ></a>\n";
					else
						$rating  = '';
				  }
				  else
					{
					$i = 0;
					 $rate=round($Images[0]["rate"] , 2);
	
				  $half=0;
				  if( $rate!=round($rate) && floor($rate) == round( $rate))
				  {
					 $bellow=floor($rate);
					 $half=1;
				  }
				  else
				  {
					$bellow=ceil($rate);
					$half=0;
				  }
						  
				While (++$i <= $bellow) {
				   $rating .= "<img src=\"images/star_small.gif\" border=\"0\" ></a>\n";
				}
			
				if($half==1)
					 $rating  .= "<img src=\"images/star_half_small.gif\" border=\"0\" ></a>\n";
				
				}
				
			return $rating ;
				
		}
		
		function rates_vote($Ident){
			global $objSmarty;
			$strWhere=" WHERE id=$Ident";
			$strSql      = "select * from ".$this->Pictures . $strWhere;
			$Rates    = $this->getSelectByQuery($strSql);

		 	if ((int)$Rates[0]["rate"] == 0) {
				if($Rates[0]["rate"]>0)
					$rating  .= "<img src=\"images/star_half.gif\" border=\"0\" ></a>\n";
				else
					$rating  = '';
			  }
			  else
				{
				$i = 0;
				$rate=round($Rates[0]["rate"] , 2);

			  $half=0;
			  if( $rate!=round($rate) && floor($rate) == round( $rate))
			  {
				 $bellow=floor($rate);
				 $half=1;
			  }
			  else
			  {
				$bellow=ceil($rate);
				$half=0;
			  }
					  
			While (++$i <= $bellow) {
			   $rating .= "<img src=\"images/star.gif\" border=\"0\" ></a>\n";
			}
		
			if($half)
				 $rating  .= "<img src=\"images/star_half.gif\" border=\"0\" ></a>\n";
			}
			
			return $rating ;
		}
}

?>