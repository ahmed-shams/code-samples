<?
	/**
	 * Project:    Main-Street-Pub : Configuration File
	 * File:       Config.php
	 *
	 * @link http://www.Main-Street-Pub.com/
	 * @copyright 2007-2010 Main-Street-Pub,.
	 * @package Main-Street-Pub
	 * @version 1.0.0
	 */

    ob_start();
	header("ETag: PUB" . time());
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()-10) . " GMT");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 5) . " GMT");
	header("Pragma: no-cache");
	//header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
	session_cache_limiter("nocache");
	session_start();
	
	if (!defined( "MAIN_INCLUDE_PATH" )) {
        define( "MAIN_INCLUDE_PATH", dirname(__FILE__)."/");
    }
	ini_set('memory_limit', '1024M');
	
	define("ABSOLUTE_PATH",			str_replace("includes/","",MAIN_INCLUDE_PATH));
	define("MAIN_CLASS_PATH",		MAIN_INCLUDE_PATH."classes/");		
	define("MAIN_MODULES_PATH",		MAIN_INCLUDE_PATH."modules/");
	define("MAIN_DATACLASS_PATH",	MAIN_CLASS_PATH."Data/");
	
	
	require_once(MAIN_INCLUDE_PATH."config.php");
	require_once(MAIN_INCLUDE_PATH."functions.php");	
	require_once(MAIN_CLASS_PATH."smarty/Smarty.class.php");			//Carries Smarty Library
	require_once MAIN_CLASS_PATH.'database/db_class.php';				//Carries Database Functions
	require_once MAIN_CLASS_PATH.'database/db_gen_class.php';			//Carries Database Functions
	require_once MAIN_CLASS_PATH.'common/class.Common.php';				//Carries Common Functions
	//require_once(MAIN_MODULES_PATH."controller/class.MainController.php");
	require MAIN_CLASS_PATH.'common/class.perpage.php';
	
	
	
	$objCommon = new Common();
	$ContentTimeStart 	= getmicrotime(); //Time start of the Page functionalities
	

	define("SITEGLOBALPATH",  	$global_config["SiteGlobalPath"]);
	
	if(isset($HTTP_POST_VARS)) 		$_POST    = ($HTTP_POST_VARS); 
	if(isset($HTTP_GET_VARS))  		$_GET     = ($HTTP_GET_VARS);
	if(isset($HTTP_SESSION_VARS))   $_SESSION = ($HTTP_SESSION_VARS);
	
	if(isset($_POST) && is_array($_POST))
	{
		foreach ($_POST as $key => $val)
			$$key = $val;
	}
	
	if(isset($_GET) && is_array($_GET))
	{
		foreach ($_GET as $key => $val)
			$$key = $val;
	}
	
	if(isset($_SESSION) && is_array($_SESSION))
	{
		foreach ($_SESSION as $key => $val)
			$$key = $val;
	}
	
	function dateFormat($strDate,$strFormat)
	{
		if($strDate=="")
			$strDate = date("Y-m-d H:i:s");
		switch($strFormat)
		{
			case 1:
				return date("Y-m-d",strtotime($strDate));
				break;
			case 2:
				return date("Y-m-d H:i:s",strtotime($strDate));
				break;
			case 3:
				return date("F j,Y",strtotime($strDate));
				break;
			case 4:
				return date("F j,Y H:i:s",strtotime($strDate));
				break;
			case 5:
				return date("F j,Y H:i",strtotime($strDate));
				break;
			case 6:
				return date("m/d/Y",strtotime($strDate));
				break;
			case 9:
				return date("F Y",strtotime($strDate));
				break;
			case 10:
				return date("d/m/Y",strtotime($strDate));
				break;
			case 11:
					return date("l",strtotime($strDate));
					break;
		}
	}
	
	$objSmarty = new Smarty;
	$objCommon->getMainMenus();
	$objSmarty->register_modifier("sslash","stripslashes");
	$objSmarty->assign("AdminPage",$AdminPage);
	setGlobalConfigForTemplate();

	
	function printObject($obj)
	{
		global $global_config;
		if($global_config["debug_mode"] == "1"){
			if(is_object($obj)) {
				print "<PRE>";
				print_r($obj);
				print "</PRE>";
			}
		}	
	}
	
	function Debug_Print($var){
		global $global_config;
		if($global_config["debug_mode"] == "1"){
			print $var. " <br>";
		}
	}
	
?>