<?
	/**
	 * Project:    Main-Street-Pub : Functions File
	 * File:       Functions.php
	 *
	 * @link http://www.Main-Street-Pub.com/
	 * @copyright 2001-2005 Main-Street-Pub,.
	 * @package Main-Street-Pub
	 * @version 1.0.0
	 */
	
	function printArray($objArray)
	{
		print "<PRE>";
		print_r($objArray);
		print "</PRE>";
	}

	function setGlobalConfigForTemplate()
	{
		global $objSmarty,$global_config,$config;
		foreach($global_config as $key => $val)
			$objSmarty->assign($key,$val);
	}

	function Redirect($strPath) {
		header("location:$strPath");
	}
	
	function getmicrotime(){ 
		list($usec, $sec) = explode(" ",microtime()); 
		return ((float)$usec + (float)$sec); 
		} 

	function findExecutedTime($isExit=false)
	{
		global $ContentTimeStart;
		$ContentTimeEnd	= getmicrotime();
		$ContentTimeDiff	= round($ContentTimeEnd-$ContentTimeStart,2);
		//print $ContentTimeDiff."<br>";
		if($isExit) exit();
	}
	
	function getExecutedTime()
	{
		global $ContentTimeStart;
		$ContentTimeEnd	= getmicrotime();
		$ContentTimeDiff	= round($ContentTimeEnd-$ContentTimeStart,2);
		if($ContentTimeDiff < 0.01)
			$ContentTimeDiff = 0.03;
		return $ContentTimeDiff;
	}
	
	function doPrint($strText) {
		print $strText."<br>";
	}
	
	function dateDiff($endDate, $beginDate)
	{
		$date_parts1	= explode("-", $beginDate);
		$date_parts2	= explode("-", $endDate);
		$start_date		= @gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
		$end_date		= @gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
		if($start_date != "" && $end_date != "")
			return $end_date - $start_date;
		else
			return "";
	}
	
	function findAge($DOB)
	{
		$intAge = floor(dateDiff(date("m-d-Y"), date("m-d-Y",strtotime($DOB)))/365);
		if($intAge<=0)
			return "";
		else
			return $intAge;
	}

	function year_foundation(){
	  $year=array();
	  $j= 0;
	  $currentYear = date("Y");
	  $EndYear     = $currentYear - 30;
		for($i=$EndYear; $i <= $currentYear; $i++)
		{
		 $year[$j]=$i;
		 $j++;
		}
		return $year;
	}
?>