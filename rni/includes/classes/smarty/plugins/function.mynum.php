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
 *           - dec   Input Date Type Ymd or mdy etc
 *           - sep   Output Date Type mdy or dmy etc
 * Purpose:  Prints Date in mentioned format
 * @link http://smarty.php.net/manual/en/language.function.html.options.php {html_image}
 *      (Smarty online manual)
 * @param array
 * @param Smarty
 * @return string
 * @uses smarty_function_escape_special_chars()
 */
function smarty_function_mynum($params, &$smarty)
{
//	echo $params;
//	var_dump($params);
	$value			= null;
	$dec			= null;
	$sep			= null;
	
    foreach($params as $_key => $_val)
	{
        switch($_key) 
		{
            case 'value':
				$$_key = $_val;
                break;
			case 'dec_pt':
				$$_key = $_val;
                break;
            case 'dec_cnt':
                $$_key = $_val;
                break;
            case 'sep':
                $$_key = $_val;
                break;
		}//End of Switch
	}//End of For Each

	if($dec_pt == "")
	{
		$dec_pt		= ".";
	}
	if( $dec_cnt == "" )
	{
		$dec_cnt	= 2;
	}
	if( $sep == "" )
	{
		$sep	= ',';
	}
	
	if( trim($value) != "" )
	{
		return number_format($value,$dec_cnt,$dec_pt,$sep);		
	}

}//End of Function


?>
