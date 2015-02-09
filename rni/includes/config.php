<?php
	/**
	 * Project:    Main-Street-Pub : Configuration File
	 * File:       Config.php
	 *
	 * @link http://www.Main-Street-Pub.com/
	 * @copyright 2007-2010 Main-Street-Pub,.
	 * @package Main-Street-Pub
	 * @version 1.0.0
	 */
	 
	/* $Id: config.php,v 1.514 2006/06/21 18:21:06 messju Exp $ */
	$global_config = array();
	 
	// **************************************************
	// Commn Site Details				- Prefix : Site
	// **************************************************
	//192.168.1.24
	$global_config["SiteTitle"]						= "Read & Initial System";
	$global_config["SiteGlobalPath"] 				= "http://www.alzangee3.com/rni/";
	$global_config["SiteScriptFolder"]				= $global_config["SiteGlobalPath"]."javascript/";
	$global_config["SiteStylesFolder"]				= $global_config["SiteGlobalPath"]."styles/";
	$global_config["SiteLocalPath"] 				= "/home/zangee3/public_html/solution/initialsystem/";
	$global_config["SiteImagePath"]					= "";
	$global_config["ADMIN_URL"]						= "http://www.alzangee3.com/admin/";
	$global_config["SiteScriptFolder"]				= $global_config["SiteGlobalPath"]."javascript/";
	$global_config["SiteStylesFolder"]				= $global_config["SiteGlobalPath"]."styles/";
	$global_config["SiteMainStyles"]				= $global_config["SiteStylesFolder"]."style.css";
	$global_config["SiteModRewrite"]				= "No";	
	
	//$global_config["SiteImagePath"]				= "/";
	
	$global_config["debug_mode"] 					= 0;  // 1 = ON , 0 = OFF
	// **************************************************
	// Database Details					- Prefix : DB	
	//***************************************************
	$global_config["DBHost"]			= "localhost";
	$global_config["DBUserName"]  		= "";
	$global_config["DBPassword"]		= "";
	$global_config["DBDatabaseName"]	= ""; 
	$global_config["DBTablePrefix"]		= "tbl_";
	
	// ***************************************************
	// Variable Settings				
	// ***************************************************

	
	if($_SERVER['REMOTE_ADDR']=='68.193.134.219') {
		$global_config["debug_mode"] = 1;
	} 
?>