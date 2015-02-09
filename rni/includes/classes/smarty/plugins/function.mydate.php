<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {html_options} function plugin
 *
 * Type:     function<br>
 * Name:     mydate<br>
 * Input:<br>
 *           - value      
 *           - in_type   Input Date Type Ymd or mdy etc
 *           - out_type  Output Date Type mdy or dmy etc
 * Purpose:  Prints Date in mentioned format
 * @link http://smarty.php.net/manual/en/language.function.html.options.php {html_image}
 *      (Smarty online manual)
 * @param array
 * @param Smarty
 * @return string
 * @uses smarty_function_escape_special_chars()
 */
function smarty_function_mydate($params, &$smarty)
{
//	echo $params;
//	var_dump($params);
	$value			= null;
	$in_type		= null;
	$out_type		= null;
	//Default Input Separator

    foreach($params as $_key => $_val)
	{
        switch($_key) 
		{
            case 'value':
				$$_key = $_val;
                break;
            case 'in_type':
                $$_key = $_val;
                break;
            case 'out_type':
                $$_key = $_val;
                break;
		}//End of Switch
	}//End of For Each

	//Default Input Date Separator
	if( $in_separator == "" )
	{
		$in_separator	= "-";
	}

	//Default Input Date Type
	if( $in_type == "")
	{
		$in_type	= 'Ymd';
	}
	//Default Output Date Type
	if( $out_type == "")
	{
		$out_type	= 'mdy';
	}
	
	$out_separator	= "/";
	
	if( $in_type == 'Ymd' )
	{
		
		$value			= substr($value,0,10);

		$fromArr		= explode($in_separator,$value);
		$fromDt			= $fromArr[2];
		$fromMon		= $fromArr[1];
		$fromFullYr		= $fromArr[0];
		$fromShortYr	= substr($fromArr[0],2,2);
	}

	switch($out_type)
	{
		case 'mdy':
			$ReturnDate = $fromMon.$out_separator.$fromDt.$out_separator.$fromShortYr;
			break;
		case 'mdY':			
			$ReturnDate = $fromMon.$out_separator.$fromDt.$out_separator.$fromFullYr;
			break;
		case 'dmy':
			$ReturnDate = $fromDt.$out_separator.$fromMon.$out_separator.$fromShortYr;
			break;
		case 'dmy':		
			$ReturnDate	= $fromDt.$out_separator.$fromMon.$out_separator.$fromShortYr;
	}//End of Switch
		
	return $ReturnDate;
}//End of Function


?>
