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
function smarty_function_mycat($params, &$smarty)
{
	$objDB	= new extendsClassDB();
//	echo $params;
//	var_dump($params);
	$prodid			= null;
	
    foreach($params as $_key => $_val)
	{
        switch($_key) 
		{
            case 'prodid':
				$$_key = $_val;
                break;
		}//End of Switch
	}//End of For Each

	$ProdSql	= "select * from Tbl_Products where Ident=".$prodid;	
	$objDB->dbSetQuery($ProdSql,"select");
	$objDB->dbExecuteQuery();
	$ProdRec	= $objDB->dbSelectQuery();

	$CatSql	= "select * from Tbl_Category where Ident=".$ProdRec[0]["CategoryId"];	
	$objDB->dbSetQuery($CatSql,"select");
	$objDB->dbExecuteQuery();
	$CatRec	= $objDB->dbSelectQuery();
	return $CatRec[0]["CategoryName"];
	
}//End of Function


?>
