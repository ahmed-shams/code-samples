<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     xslt
 * Purpose:  Parse XML with XSLT to produce output.
 * Parameters:
 * 	xml: xml document (string format) to parse
 *  xsl: xslt document (string format) to parse
 *  xmlfile: filename of the xml document to use
 *  xslfile: filename of the xslt document to use
 * 	base: XSLT base for URLS
 * 
 * You can use either xml or xmlfile, and xsl or xslfile, but
 * the string will be used instead of the file if you include them both.
 * 
 * -------------------------------------------------------------
 */
function smarty_function_xslt($params, &$this)
{
	/*
	COMMENTED BECAUSE ITS NOT WORKING FOR NEW VERSION (PHP 5.0.4)
	$xh = xslt_create();
	
	$arguments = array();
	if (isset($params["xml"]))
	{
		$arguments["/_xml"] = $params["xml"];
		$xmlfile = "arg:/_xml";
	}
	else
	{
		$xmlfile = $params["xmlfile"];
	}
	
	if (isset($params["xsl"]))
	{
		$arguments["/_xsl"] = $params["xsl"];
		$xslfile = "arg:/_xsl";
	}
	else
	{
		$xslfile = $params["xslfile"];
	}
	
	if (isset($params["base"]))
	{
		xslt_set_base ( $xh, $params["base"] );
	}
    echo xslt_process($xh, $xmlfile, $xslfile, NULL, $arguments,$params["parameters"]);
	xslt_free($xh);*/
	
	$objXSLT = new XsltProcessor();
	
	// create a DOM document and load the XSL stylesheet
	$objXSLDoc = new DomDocument;
	$objXSLDoc->load($params["xslfile"]);
	
	// import the XSL styelsheet into the XSLT process
	$objXSLT->importStylesheet($objXSLDoc);
	
	// create a DOM document and load the XML datat
	$objXMLDoc = new DomDocument;
	$objXMLDoc->load($params["xmlfile"]);
	if(is_array($params["parameters"]))
		foreach($params["parameters"] as $key=>$value)
			$objXSLT->setParameter('', $key, $value);
	// transform the XML into HTML using the XSL file
	if ($strHTML = $objXSLT->transformToXML($objXMLDoc)) {
		return $strHTML;
	} else {
		return $this->getErrorFormat("Sorry! Unexpected error found. <br>There is Some error in this Category");
	} // if 
		
}
?>
