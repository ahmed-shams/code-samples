<?
	/**
	 * Project:    internationalfundingsolutions : Controller for Different Options Displaying in Pages
	 * File:       class.Options.php
	 *
	 * @link http://www.Everthinghair.com/
	 * @copyright 2007 internationalfundingsolutions,.
	 * @package internationalfundingsolutions
	 * @version 1.0.0
	 */
	class Options extends Common 
	{
		function Options()
		{
			global $global_config,$_SESSION,$_REQUEST,$objSmarty,$_COOKIE;
			$this->Common();
			
			///////////////// color /////////////////////
			
			$strSql     = "select * from tbl_Options where option_name='color' order by ID";
			$opt_color  = $this->getSelectByQuery($strSql);	
			for($i=0;$i<count($opt_color);$i++)
			{
			$opt_ColorId[$i]    = $opt_color[$i]["option_value"];
			$opt_ColorValue[$i] = $opt_color[$i]["display_title"];
			}
			$objSmarty->assign('opt_ColorId',    $opt_ColorId);
			$objSmarty->assign('opt_ColorValue', $opt_ColorValue);
			
			///////////////// color /////////////////////
			
			///////////////// texture /////////////////////
			
			$strSql     = "select * from tbl_Options where option_name='texture' order by ID";
			$opt_texture  = $this->getSelectByQuery($strSql);	
			for($i=0;$i<count($opt_texture);$i++)
			{
			$opt_TextureId[$i]    = $opt_texture[$i]["option_value"];
			$opt_TextureValue[$i] = $opt_texture[$i]["display_title"];
			}
			$objSmarty->assign('opt_TextureId',    $opt_TextureId);
			$objSmarty->assign('opt_TextureValue', $opt_TextureValue);
			
			///////////////// texture /////////////////////
			
			/////////////////  style /////////////////////
			
			$strSql     = "select * from tbl_Options where option_name='style' order by ID";
			$opt_style  = $this->getSelectByQuery($strSql);	
			for($i=0;$i<count($opt_style);$i++)
			{
			$opt_StyleId[$i]    = $opt_style[$i]["option_value"];
			$opt_StyleValue[$i] = $opt_style[$i]["display_title"];
			}
			$objSmarty->assign('opt_StyleId',    $opt_StyleId);
			$objSmarty->assign('opt_StyleValue', $opt_StyleValue);
			
			/////////////////  style /////////////////////
			
			/////////////////  celebrities /////////////////////
			
			$strSql     = "select * from tbl_Options where option_name='celebrities' order by ID";
			$opt_celebrities  = $this->getSelectByQuery($strSql);	
			for($i=0;$i<count($opt_celebrities);$i++)
			{
				$opt_CelebritiesId[$i]    = $opt_celebrities[$i]["option_value"];
				$opt_CelebritiesValue[$i] = $opt_celebrities[$i]["display_title"];
			}
			$objSmarty->assign('opt_CelebritiesId',    $opt_CelebritiesId);
			$objSmarty->assign('opt_CelebritiesValue', $opt_CelebritiesValue);
			
			/////////////////  celebrities /////////////////////
			

			/////////////////  length /////////////////////
			
			$strSql     = "select * from tbl_Options where option_name='length' order by ID";
			$opt_length  = $this->getSelectByQuery($strSql);	
			for($i=0;$i<count($opt_length);$i++)
			{
			$opt_LengthId[$i]    = $opt_length[$i]["option_value"];
			$opt_LengthValue[$i] = $opt_length[$i]["display_title"];
			}
			$objSmarty->assign('opt_LengthId',    $opt_LengthId);
			$objSmarty->assign('opt_LengthValue', $opt_LengthValue);
			
			///////////////// length /////////////////////
			
			///////////////// gender ////////////////////
			
			$strSql     = "select * from tbl_Options where option_name='gender' order by display_title ASC";
			$opt_gender  = $this->getSelectByQuery($strSql);	
			for($i=0;$i<count($opt_gender);$i++)
			{
			$opt_GenderId[$i]    = $opt_gender[$i]["option_value"];
			$opt_GenderValue[$i] = $opt_gender[$i]["display_title"];
			}
			$objSmarty->assign('opt_GenderId',    $opt_GenderId);
			$objSmarty->assign('opt_GenderValue', $opt_GenderValue);
			
			///////////////// gender /////////////////////
			
			
			/////////////////face shape/////////////////////
			
			$strSql     = "select * from tbl_Options where option_name='face_shape' order by option_value ASC";
			$opt_face_shape  = $this->getSelectByQuery($strSql);	
			for($i=0;$i<count($opt_face_shape);$i++)
			{
			$opt_face_shapeId[$i]    = $opt_face_shape[$i]["option_value"];
			$opt_face_shapeValue[$i] = $opt_face_shape[$i]["display_title"];
			}
			$objSmarty->assign('opt_face_shapeId',    $opt_face_shapeId);
			$objSmarty->assign('opt_face_shapeValue', $opt_face_shapeValue);
			
			/////////////////face shape/////////////////////
			
			
			///////////////// sorting /////////////////////
			
			$strSql     = "select * from tbl_Options where option_name='sorting' order by option_value ASC";
			$opt_sorting  = $this->getSelectByQuery($strSql);	
			for($i=0;$i<count($opt_sorting);$i++)
			{
			$opt_sortingId[$i]    = $opt_sorting[$i]["option_value"];
			$opt_sortingValue[$i] = $opt_sorting[$i]["display_title"];
			}
			$objSmarty->assign('opt_sortingId',    $opt_sortingId);
			$objSmarty->assign('opt_sortingValue', $opt_sortingValue);
			
			/////////////////Archive Min Amount/////////////////////
			
			
			/*
			
			
			for($i=1;$i<=31;$i++)
			{
			$datearray[$i]=$i;
			}
			$objSmarty->assign('totaldates',$datearray);
			
			$montharrayid[1]=1;
			$montharrayvalue[1]='Jan';
			$montharrayid[2]=2;
			$montharrayvalue[2]='Feb';
			$montharrayid[3]=3;
			$montharrayvalue[3]='Mar';
			$montharrayid[4]=4;
			$montharrayvalue[4]='Apr';
			$montharrayid[5]=5;
			$montharrayvalue[5]='May';
			$montharrayid[6]=6;
			$montharrayvalue[6]='Jun';
			$montharrayid[7]=7;
			$montharrayvalue[7]='Jul';
			$montharrayid[8]=8;
			$montharrayvalue[8]='Aug';
			$montharrayid[9]=9;
			$montharrayvalue[9]='Sep';
			$montharrayid[10]=10;
			$montharrayvalue[10]='Oct';
			$montharrayid[11]=11;
			$montharrayvalue[11]='Nov';
			$montharrayid[12]=12;
			$montharrayvalue[12]='Dec';
			$objSmarty->assign('montharrayid',    $montharrayid);
			$objSmarty->assign('montharrayvalue', $montharrayvalue);
			
			for($i=2007;$i<=2500;$i++)
			{
			$yeararray[$i]=$i;
			}
			$objSmarty->assign('yeararray', $yeararray);
			for($i=1900;$i<=date("Y");$i++)
			{
			$dobyeararray[$i]=$i;
			}
			$objSmarty->assign('dobyeararray', $dobyeararray);
*/


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
	$objSmarty->assign('AlphaCount', 25);	

	$browserType=$this->getBrowserType();
	$browserVersion=$this->getBrowserVersion();
	$objSmarty->assign('browserType', $browserType);
	$objSmarty->assign('browserVersion', $browserVersion);
	//printarray($Gallery);
	}
	

	function GalleryOptions() {
	$Gallery=array();
	$Gallery[0]=array('GID'=>1,'type'=>'color','style'=>'1');
	$Gallery[1]=array('GID'=>2,'type'=>'color','style'=>'2');
	$Gallery[2]=array('GID'=>3,'type'=>'color','style'=>'3');
	$Gallery[3]=array('GID'=>4,'type'=>'color','style'=>'4');
	$Gallery[4]=array('GID'=>5,'type'=>'color','style'=>'5');
	$Gallery[5]=array('GID'=>6,'type'=>'color','style'=>'6');
	$Gallery[6]=array('GID'=>7,'type'=>'color','style'=>'7');
	$Gallery[8]=array('GID'=>8,'type'=>'color','style'=>'8');

	$Gallery[9]=array('GID'=>9,'type'=>'texture','style'=>'1');
	$Gallery[10]=array('GID'=>10,'type'=>'texture','style'=>'2');
	$Gallery[11]=array('GID'=>10,'type'=>'texture','style'=>'3');
	$Gallery[12]=array('GID'=>11,'type'=>'texture','style'=>'4');
	$Gallery[13]=array('GID'=>12,'type'=>'texture','style'=>'5');
	$Gallery[14]=array('GID'=>13,'type'=>'texture','style'=>'6');
	$Gallery[15]=array('GID'=>14,'type'=>'texture','style'=>'7');
	
	$Gallery[16]=array('GID'=>15,'type'=>'style','style'=>'1');
	$Gallery[17]=array('GID'=>16,'type'=>'style','style'=>'2');
	$Gallery[18]=array('GID'=>17,'type'=>'style','style'=>'3');
	$Gallery[19]=array('GID'=>18,'type'=>'style','style'=>'4');
	$Gallery[20]=array('GID'=>19,'type'=>'style','style'=>'5');
	$Gallery[21]=array('GID'=>20,'type'=>'style','style'=>'6');
	$Gallery[22]=array('GID'=>21,'type'=>'style','style'=>'7');

	$Gallery[23]=array('GID'=>22,'type'=>'gender','style'=>'1');
	$Gallery[24]=array('GID'=>23,'type'=>'gender','style'=>'2');
	
	$Gallery[25]=array('GID'=>24,'type'=>'length','style'=>'1');
	$Gallery[26]=array('GID'=>25,'type'=>'length','style'=>'3');
	$Gallery[27]=array('GID'=>26,'type'=>'length','style'=>'2');
	$Gallery[28]=array('GID'=>27,'type'=>'length','style'=>'4');
	$Gallery[29]=array('GID'=>28,'type'=>'length','style'=>'5');
	$Gallery[30]=array('GID'=>29,'type'=>'length','style'=>'6');
	$Gallery[31]=array('GID'=>30,'type'=>'length','style'=>'7');
	
	$Gallery[31]=array('GID'=>29,'type'=>'celebrities','style'=>'1');
	$Gallery[32]=array('GID'=>30,'type'=>'celebrities','style'=>'2');

	return $Gallery;
	}
	
	
	
}

?>
