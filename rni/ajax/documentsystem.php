<?php


	/**
	* Document read and initial system
	* 
	* PHP version 5
	*
	* Copyright (c) 2006-2010 Securenext Softwares Pvt Ltd
	*
	* Common Functions For Retailers
	* This file contains functions required to process Enterprise user catagory for documentinitialsystem
	* @project documentinitialsystem
	* @version 1.0
	* @copyright  	2006-2010 Securenext Softwares Pvt Ltd
	*	
	* @package documentinitialsystem
	* @subpackage Includes
	* @filesource
	*/

	require_once("../includes/common.php");
	require_once("../includes/modules/controller/class.MainController.php");
	$objController = new MainController();

	if ($_REQUEST["op"] == "SaveEditGroup") {
		require_once("../includes/modules/admin/class.admin.php");
		$objAdmin = new admin();
		$objAdmin->UpdateGroup($_REQUEST);		
	}
	if ($_REQUEST["op"] == "SaveAddGroup") {
		require_once("../includes/modules/admin/class.admin.php");
		$objAdmin = new admin();
		$objAdmin->AddNewGroupInfo($_REQUEST);		
	}
	
	$objController->doAction($_REQUEST);

?>
