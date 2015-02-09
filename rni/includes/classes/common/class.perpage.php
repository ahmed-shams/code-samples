<? 

function recordsetNav($db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$extraurl='',$blocksize=5,$strCountQry='No')
{
	/*
	EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0,$extraurl,$blocksize);

	&$db_connect is the MySQL connection passed by reference
	$db_query is your entire query string including WHERE criteria and ORDER BY - without the LIMIT statement!
	$page_url will probably be $PHP_SELF
	$tablewidth determines the width of the $navstring table
	$verbiage, by default set to 'true', prints out "page:$pagenumber/$totalpages  total records:$totalrecords"
	$extraurl extra variables passed in the URL e.g. $extraurl="&findfield=$findfield&findvalue=$findvalue"
	$blocksize, by default set to 15, determines how many page links to display
	*/
	global $objSmarty,$global_config;
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;	
	$pagenumber = intval(($offset + $limit) / $limit);
	 $totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table width=\"$tablewidth\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\">";
	
	if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit
	{
		$navstring .= "<tr>";
		$navstring .= "<td align='center' class='fresults-perpage'>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			$navstring .= "<a title='First Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' href='".$page_url."?offset=0$extraurl'> << </a> &nbsp;";;
			$navstring .= "<a title='Previous Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' href='".$page_url."?offset=".$Offset."$extraurl'> < </a> &nbsp;&nbsp;";
		}
		
		if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		
		$blocklimit = $blocksize + $firstpage;
		
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{ 
				$navstring .= "<span class='pagecountactive'>$i</span> "; 
			} else { 
				if ($i <= $totalpages)
				{
					$nextoffset = $limit * ($i-1); 
					$navstring .= "<a title='Page ". $i ." of ". $totalpages ."' class=pagecountinactive onMouseover=this.className='pagecolumnmouseover' onMouseout=this.className='pagecountinactive' href='".$page_url."?offset=".$nextoffset."$extraurl'>$i</a> ";
				}
			} 
		}
				
		if($totalrecords-$offset > $limit)
		{ 
			$navstring .= "&nbsp;<a title='Next Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' href='".$page_url."?offset=".($offset+$limit)."$extraurl'> > </a> &nbsp;"; 
			$navstring .= "<a title='Last Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' href='".$page_url."?offset=".$lastpage."$extraurl'> >> </a>";
		}
		$navstring .= "</td></tr>";
	}	
	
	
	if ($verbiage)
	{
		//$navstring .= "<tr><td align='center' nowrap>";
		//$navstring .= "<span class='paginationfont'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		//$navstring .= "&nbsp;&nbsp; total records: <b>".$totalrecords."</b></span>";
		//$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	$total=$global_config["RowDisplay"]*($pagenumber-1) ; 
	$objSmarty->assign("total",$total);
	$objSmarty->assign("pagenumber",$pagenumber);
	$objSmarty->assign("totalpages",$totalpages);
			//$objSmarty->assign("printperpage",$printperpage[1]);
	return $PerpageArray;
}

function recordsetNav_ajax($db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$extraurl,$objArray,$blocksize=15,$strCountQry='No')
{
	/*
	EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0,$extraurl,$blocksize);

	&$db_connect is the MySQL connection passed by reference
	$db_query is your entire query string including WHERE criteria and ORDER BY - without the LIMIT statement!
	$page_url will probably be $PHP_SELF
	$tablewidth determines the width of the $navstring table
	$verbiage, by default set to 'true', prints out "page:$pagenumber/$totalpages  total records:$totalrecords"
	$extraurl extra variables passed in the URL e.g. $extraurl="&findfield=$findfield&findvalue=$findvalue"
	$blocksize, by default set to 15, determines how many page links to display
	*/
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;
	
	$pagenumber = intval(($offset + $limit) / $limit);
	$totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\">";
	
	if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit
	{
		$navstring .= "<tr>";
		$navstring .= "<td align='left'>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			$navstring .= "<a title='Previous Page' class='paginationfont'  onClick=\"ShowProducts('$objArray[Cat_Id]','$objArray[GenreId]','$Offset','','$objArray[Cat_Name]','pp')\" style=\"cursor:pointer\"><img src=\"images/galleryprev.gif\" border=\"0\">";
		}
		$navstring .= "</td>";
		
		################# NUMBERS ########################
		
		/*if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		
		$blocklimit = $blocksize + $firstpage;
		
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{ 
				$navstring .= "<span class='NavPageFont'>$i</span> "; 
			} else { 
				if ($i <= $totalpages)
				{
					$nextoffset = $limit * ($i-1); 
					$navstring .= "<a title='Page ". $i ." of ". $totalpages ."' class='paginationfont' onClick=\"ListTable('$category_id','','','$sort','$type','$nextoffset')\">$i</a> ";
				}
			} 
		}*/
		
		################# NUMBERS ########################
		
		$navstring .= "<td align='right'>";
				
		if($totalrecords-$offset > $limit)
		{ 
		$Offset=$offset+$limit;
			$navstring .= "&nbsp;<a title='Next Page' class='paginationfont' onClick=\"ShowProducts('$objArray[Cat_Id]','$objArray[GenreId]','$Offset','','$objArray[Cat_Name]','pp')\" style=\"cursor:pointer\"><img src=\"images/gallerynext.gif\" border=\"0\"></a> &nbsp;"; 
			$navstring .= "<a title='Last Page' class='paginationfont' href='".$page_url."?offset=".$lastpage."$extraurl'></a>";
		}
		$navstring .= "</td></tr>";
	}	
	
	
	if ($verbiage)
	{
		$navstring .= "<tr><td align='center' nowrap colspan=2>";
		$navstring .= "<span class='paginationfontnumber'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		$navstring .= "&nbsp;&nbsp; Total records: <b>".$totalrecords."</b></span>";
		$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	return $PerpageArray;
}
function recordsetNavStyle_ajax($db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$GID='',$hAction='',$stylename='',$blocksize=5)
{
	/*
	EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0,$extraurl,$blocksize);

	&$db_connect is the MySQL connection passed by reference
	$db_query is your entire query string including WHERE criteria and ORDER BY - without the LIMIT statement!
	$page_url will probably be $PHP_SELF
	$tablewidth determines the width of the $navstring table
	$verbiage, by default set to 'true', prints out "page:$pagenumber/$totalpages  total records:$totalrecords"
	$extraurl extra variables passed in the URL e.g. $extraurl="&findfield=$findfield&findvalue=$findvalue"
	$blocksize, by default set to 15, determines how many page links to display
	*/
	global $objSmarty,$global_config;
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;	
	$pagenumber = intval(($offset + $limit) / $limit);
	 $totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table width=\"$tablewidth\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\">";
	
	if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit
	{
		$navstring .= "<tr>";
		$navstring .= "<td align='center' class='fresults-perpage'>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			$navstring .= "<a title='First Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' onClick=\"searchHairstyleimages('$hAction','$GID','$stylename','0')\"> << </a> &nbsp;";;
			$navstring .= "<a title='Previous Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' onClick=\"searchHairstyleimages('$hAction','$GID','$stylename','$Offset')\"> < </a> &nbsp;&nbsp;";
		}
		
		if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		
		$blocklimit = $blocksize + $firstpage;
		
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{ 
				$navstring .= "<span class='pagecountactive'>$i</span> "; 
			} else { 
				if ($i <= $totalpages)
				{
					$nextoffset = $limit * ($i-1); 
					$navstring .= "<a title='Page ". $i ." of ". $totalpages ."' class=pagecountinactive onMouseover=this.className='pagecolumnmouseover' onMouseout=this.className='pagecountinactive'  onClick=\"searchHairstyleimages('$hAction','$GID','$stylename','$nextoffset')\">$i</a> ";
				}
			} 
		}
				
		if($totalrecords-$offset > $limit)
		{ 
			$Offset=$offset+$limit;
			$navstring .= "&nbsp;<a title='Next Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' onClick=\"searchHairstyleimages('$hAction','$GID','$stylename','$Offset')\"> > </a> &nbsp;"; 
			$navstring .= "<a title='Last Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' onClick=\"searchHairstyleimages('$hAction','$GID','$stylename','$lastpage')\"> >> </a>";
		}
		$navstring .= "</td></tr>";
	}	
	
	
	if ($verbiage)
	{
		//$navstring .= "<tr><td align='center' nowrap>";
		//$navstring .= "<span class='paginationfont'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		//$navstring .= "&nbsp;&nbsp; total records: <b>".$totalrecords."</b></span>";
		//$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	$total=$global_config["RowDisplay"]*($pagenumber-1) ; 
	$objSmarty->assign("total",$total);
	$objSmarty->assign("pagenumber",$pagenumber);
	$objSmarty->assign("totalpages",$totalpages);
			//$objSmarty->assign("printperpage",$printperpage[1]);
	return $PerpageArray;
}

function recordsetNav_ajaxold($db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$category_id,$sort,$type,$blocksize=15,$strCountQry='No')
{
	/*
	EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0,$extraurl,$blocksize);

	&$db_connect is the MySQL connection passed by reference
	$db_query is your entire query string including WHERE criteria and ORDER BY - without the LIMIT statement!
	$page_url will probably be $PHP_SELF
	$tablewidth determines the width of the $navstring table
	$verbiage, by default set to 'true', prints out "page:$pagenumber/$totalpages  total records:$totalrecords"
	$extraurl extra variables passed in the URL e.g. $extraurl="&findfield=$findfield&findvalue=$findvalue"
	$blocksize, by default set to 15, determines how many page links to display
	*/
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;
	
	$pagenumber = intval(($offset + $limit) / $limit);
	$totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table width=\"$tablewidth\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\">";
	
	if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit
	{
		$navstring .= "<tr>";
		$navstring .= "<td align='center'>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			$navstring .= "<a title='First Page' class='paginationfont' href='".$page_url."?offset=0$extraurl'>";
			$navstring .= "<a title='Previous Page' class='paginationfont' href='".$page_url."?offset=".$Offset."$extraurl'>";
		}
		
		if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		
		$blocklimit = $blocksize + $firstpage;
		
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{ 
				$navstring .= "<span class='NavPageFont'>$i</span> "; 
			} else { 
				if ($i <= $totalpages)
				{
					$nextoffset = $limit * ($i-1); 
					$navstring .= "<a title='Page ". $i ." of ". $totalpages ."' class='paginationfont' onClick=\"ListTable('$category_id','','','$sort','$type','$nextoffset')\">$i</a> ";
				}
			} 
		}
				
		if($totalrecords-$offset > $limit)
		{ 
		$Offset=$offset+$limit;
			$navstring .= "&nbsp;<a title='Next Page' class='paginationfont' onClick=\"ListTable('$category_id','','','$sort','$type','$Offset')\"></a> &nbsp;"; 
			$navstring .= "<a title='Last Page' class='paginationfont' href='".$page_url."?offset=".$lastpage."$extraurl'></a>";
		}
		$navstring .= "</td></tr>";
	}	
	
	
	if ($verbiage)
	{
		$navstring .= "<tr><td align='center' nowrap>";
		$navstring .= "<span class='paginationfont'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		$navstring .= "&nbsp;&nbsp; total records: <b>".$totalrecords."</b></span>";
		$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	return $PerpageArray;
}

function record_category_ajax($char,$sort,$type,$db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$blocksize=15,$strCountQry='No')
{
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;
	
	$pagenumber = intval(($offset + $limit) / $limit);
	$totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table width=\"$tablewidth\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\">";
	
	if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit
	{
		$navstring .= "<tr>";
		$navstring .= "<td align='center'>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			$navstring .= "<a title='First Page' class='paginationfont' href='".$page_url."?offset=0$extraurl'>";
			$navstring .= "&nbsp;<a title='Previous Page' class='paginationfont' onClick=\"getCategory('$char','$Offset','$sort','$type')\">Previous</a> &nbsp;"; 
		}
		
		if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		
		$blocklimit = $blocksize + $firstpage;
		
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{ 
				$navstring .= "<span class='NavPageFont'>$i</span> "; 
			} else { 
				if ($i <= $totalpages)
				{
					$nextoffset = $limit * ($i-1); 
					$navstring .= "<a title='Page ". $i ." of ". $totalpages ."' class='paginationfont' onClick=\"getCategory('$char','$nextoffset','$sort','$type')\">$i</a> ";
				}
			} 
		}
				
		if($totalrecords-$offset > $limit)
		{ 
		$Offset=$offset+$limit;
			$navstring .= "&nbsp;<a title='Next Page' class='paginationfont' onClick=\"getCategory('$char','$Offset','$sort','$type')\">Next</a> &nbsp;"; 
			$navstring .= "<a title='Last Page' class='paginationfont' href='".$page_url."?offset=".$lastpage."$extraurl'></a>";
		}
		$navstring .= "</td></tr>";
	}	
	
	
	if ($verbiage)
	{
		$navstring .= "<tr><td align='center' nowrap>";
		$navstring .= "<span class='paginationfont'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		$navstring .= "&nbsp;&nbsp; total records: <b>".$totalrecords."</b></span>";
		$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	return $PerpageArray;
}


function recordsetNav_tutorials($tutorialsType,$category_id,$QueryString,$op,$page,$db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$extraurl='',$blocksize=3,$strCountQry='No',$MainCategoryName='')
{
global $global_config,$strPerPage;

if(!$category_id || $op=="mytutorials" || $op=="favourites")
$blocksize=15;

if($MainCategoryName==""){
if($offset==0){
	if(($page=="") || (!is_numeric($page))) $page=1;
}
else{
	$page=($offset/$strPerPage)+1;
}
	if($global_config["SiteModRewrite"]=="No"){
				$URLAry=split('[?]',$page_url);
				/*if($urlAry[1]=="") $page_url=$page_url."?op=tutorials";
				$urlAry=split('&',$page_url);
				$page_url=$urlAry[0];*/
				//$page_url=$urlAry[0] . "&per=" . $page;
				
				
				//$page_url=$_SERVER['HTTP_REFERER'];
				if(!$op)
						$page_url=$URLAry[0]."?op=tutorials";
				else
						$page_url=$URLAry[0]."?op=" . $op;
				
				if($extraurl)
				$page_url=$page_url."&".$extraurl;
									
					$URLAry=split("[?&]",$page_url);
											
					for($i=0;$i<count($URLAry);$i++){
						$URLSubAry[$i]=split("=",$URLAry[$i]);
					}
					$error_display=0;
						for($i=0;$i<count($URLAry);$i++){
						for($j=0;$j<count($URLSubAry);$j++){
						if($URLSubAry[$i][$j]=="per")
						$error_display=1;
						}
					}
				
						if($error_display==1)
							{
								$URLAryAlt=split("[&]",$page_url);
								if($URLSubAry[1][0]=="per")
									$page_url=$URLAry[0];
								else
									$page_url=$URLAryAlt[0];
							}
			}
			else
			{
				$URLAry=split('[/]',$page_url);
			
				/*if($urlAry[1]=="") $page_url=$page_url."?op=tutorials";
				$urlAry=split('&',$page_url);
				$page_url=$urlAry[0];*/
				//$page_url=$urlAry[0] . "&per=" . $page;
				
				
				//$page_url=$_SERVER['HTTP_REFERER'];
				if(!$op)
						$page_url=$global_config["SiteGlobalPath"]."tutorials";
				else
						$page_url=$global_config["SiteGlobalPath"].$op;
				

				if($extraurl)
				$page_url=$page_url."/".$extraurl;
				$ExpURL = explode("/",$QueryString);
				$ExpCnt = count($ExpURL);
				

					if(is_numeric($ExpURL[$ExpCnt]))
						$index=1;

				//print $page_url."<br>";
				
			       if($index){
					 $page_url=$page_url."/".$extraurl;
					}

			}			
		}
	
			/*
			EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0,$extraurl,$blocksize);

	&$db_connect is the MySQL connection passed by reference
	$db_query is your entire query string including WHERE criteria and ORDER BY - without the LIMIT statement!
	$page_url will probably be $PHP_SELF
	$tablewidth determines the width of the $navstring table
	$verbiage, by default set to 'true', prints out "page:$pagenumber/$totalpages  total records:$totalrecords"
	$extraurl extra variables passed in the URL e.g. $extraurl="&findfield=$findfield&findvalue=$findvalue"
	$blocksize, by default set to 15, determines how many page links to display
	*/
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;	
	$pagenumber = intval(($offset + $limit) / $limit);
	$totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">";
	
		$navstring .= "<tr>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			//$navstring .= "<input type=hidden name=offset value=" . $Offset . ">";
//			$navstring .= "<a title='First Page' class='linkgray' href='".$page_url."'>";
			if($MainCategoryName<>"")
			{
		$navstring .= "<td><form name='perpagefrm' method='post' action='" . $page_url . "'>";
			$navstring .= "<input type='hidden' name=url value=" . $page_url. "><input type=hidden name=offset value=" . $Offset . "><input type='button' name=check value=Previous class='pagecount_next' onMouseover=this.className='page_column_mouseover1' onMouseout=this.className='pagecount_next'  onClick=\"show_maincat_tutorial('$MainCategoryName','$Offset')\">&nbsp;</form></td>";
			}
			else
			{
				if($category_id || $op=="mytutorials" || $op=="favourites"){
					$navstring .= "<form name='preperpagefrm' id='preperpagefrm' method='post' onSubmit=\"return per_call('$page_url'," . ($page-1) . ",'preperpagefrm')\"><td>&nbsp;<input type='hidden' name=url value=" . $page_url. "><input type='hidden' name='catchain'><input type='hidden' name='current_tutorials'><input type=hidden name=offset value=" . $Offset . "><input type=hidden name=tutorialType value=" . $tutorialsType . "><input type='submit' name=check value=Previous class='pagecount_next' onMouseover=this.className='page_column_mouseover1' onMouseout=this.className='pagecount_next'> &nbsp;</td></form>";
					}
			}
		}
		
		if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		
		if($category_id)
		$blocklimit = $blocksize + $firstpage;
		else{
		$blocklimit=4;
		}
				
		$navstring  .= "<td><table cellspacing=\"1\" cellpadding=\"0\" border=\"0\" align=\"center\"><tr>";
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{ 
				$navstring .= "<td align='center'  class='pagecount_active'>$i</td>"; 
			} else { 
				if ($i <= $totalpages)
				{
					$Offset = $limit * ($i-1); 
					if($MainCategoryName<>"")
					{
					$navstring .= "<form name='perpagefrm' method='post'><td align='center'><input type='hidden' name=url value=" . $page_url. "><input type=hidden name=offset value=" . $Offset . "><input type='button' name=check value=$i class=pagecount_inactive onMouseover=this.className='page_column_mouseover' onMouseout=this.className='pagecount_inactive' onClick=\"show_maincat_tutorial('$MainCategoryName','$Offset')\"></td></form>";
					}
					else
					{
					$navstring .= "<form name='perpagefrm.$i' id='perpagefrm.$i' method='post'  onSubmit=\"return per_call('$page_url'," . $i . ",'perpagefrm.$i')\"><td align='center'><input type='hidden' name=url value=" . $page_url. "><input type='hidden' name='catchain'><input type='hidden' name='current_tutorials'><input type=hidden name=offset value=" . $Offset . "><input type=hidden name=tutorialType value=" . $tutorialsType . "><input type='submit' name=check value=$i class=pagecount_inactive onMouseover=this.className='page_column_mouseover' onMouseout=this.className='pagecount_inactive'></td></form>";
					}
				}
			} 
		}
		$navstring .= "</tr></table></tD>";
				
		if($totalrecords-$offset > $limit)
		{ 
		$Offset=$offset+$limit;
			if($MainCategoryName<>"")
					{
					$navstring .= "<form name='perpagefrm' method='post' action='" . $page_url  . "'>&nbsp;<input type='hidden' name=url value=" . $page_url. "><input type=hidden name=offset value=" . $Offset . "><input type='button' name=check value=Next class='pagecount_next' onMouseover=this.className='page_column_mouseover1' onMouseout=this.className='pagecount_next'  onClick=\"show_maincat_tutorial('$MainCategoryName','$Offset')\">&nbsp;";
					}
			else
					{
				if($category_id || $op=="mytutorials" || $op=="favourites"){
			$navstring .= "<form name='nextperpagefrm' id='nextperpagefrm' method='post' onSubmit=\"return per_call('$page_url'," . ($page+1) . ",'nextperpagefrm')\"><td>&nbsp;<input type='hidden' name=url value=" . $page_url. "><input type='hidden' name='catchain'><input type='hidden' name='current_tutorials'><input type=hidden name=offset value=" . $Offset . "><input type=hidden name=tutorialType value=" . $tutorialsType . "><input type='submit' name=check value=Next class='pagecount_next' onMouseover=this.className='page_column_mouseover1' onMouseout=this.className='pagecount_next'>&nbsp;";
						}
					} 
//			$navstring .= "<a title='Last Page' class='linkgray' href='".$page_url."'></a>";
		}
		$navstring .= "</td></form></tr>";
	
	if ($verbiage)
	{
		//$navstring .= "<tr><td align='center' nowrap>";
		//$navstring .= "<span class='paginationfont'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		//$navstring .= "&nbsp;&nbsp; total records: <b>".$totalrecords."</b></span>";
		//$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	return $PerpageArray;
}

function recordsetsearch($op,$page,$db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$extraurl='',$search_field='',$search_category='',$remote_address='',$option='',$id='',$blocksize=3,$strCountQry='No')
{
global $global_config,$strPerPage,$objSmarty;

if($offset==0){
	if(($page=="") || (!is_numeric($page))) $page=1;
}
else{
	$page=($offset/$strPerPage)+1;
}


if($global_config["SiteModRewrite"]=="No"){
$URLAry=split('[?]',$page_url);
		$page_url=$URLAry[0]."?op=search";
}	
else{
$URLAry=split('[/]',$page_url);
		$page_url=$global_config["SiteGlobalPath"]."search";
}	
		
$objSmarty->assign("PerPage",$page);
		
	/*
	EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0,$extraurl,$blocksize);

	&$db_connect is the MySQL connection passed by reference
	$db_query is your entire query string including WHERE criteria and ORDER BY - without the LIMIT statement!
	$page_url will probably be $PHP_SELF
	$tablewidth determines the width of the $navstring table
	$verbiage, by default set to 'true', prints out "page:$pagenumber/$totalpages  total records:$totalrecords"
	$extraurl extra variables passed in the URL e.g. $extraurl="&findfield=$findfield&findvalue=$findvalue"
	$blocksize, by default set to 15, determines how many page links to display
	*/
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;	
	$pagenumber = intval(($offset + $limit) / $limit);
	$totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table cellspacing=\"4\" cellpadding=\"0\" border=\"0\" align=\"center\">";
	$navstring .= "<input type='hidden' name=url value=" . $page_url. "><input type=hidden name=RemoteAddress value=" . $remote_address . "><input type=hidden name=option value=" . $option . "><input type=hidden name=hdTutorialId value=" . $id . "><input type=hidden name=tutorialType value=" . $op . ">";
		$navstring .= "<tr>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			$navstring  .= "<td><input type='button' name=check value=Previous class='pagecount_next' onMouseover=this.className='page_column_mouseover1' onMouseout=this.className='pagecount_next' onclick=\"return common_per_call('$page_url'," . ($page-1) . ",'perpagefrm'," . $Offset . ")\"></td>";
			
		}
				if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		$blocklimit = $blocksize + $firstpage;
		$navstring  .= "<td><table cellspacing=\"1\" cellpadding=\"0\" border=\"0\" align=\"center\"><tr>";
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{
				$navstring .= "<td align='center'  class='pagecount_active'>$i</td>"; 
			} else { 
				if ($i <= $totalpages)
				{
					$Offset = $limit * ($i-1); 

					$navstring .= "<td align='center'><input type='button' name=check value=$i class=pagecount_inactive onMouseover=this.className='page_column_mouseover' onMouseout=this.className='pagecount_inactive' onClick=\"return common_per_call('$page_url'," . $i . ",'perpagefrm'," . $Offset . ")\"></td>";
				}
			} 
		}
		$navstring .= "</tr></table></tD>";
				
		if($totalrecords-$offset > $limit)
		{ 
		$Offset=$offset+$limit;
					
			$navstring .= "<td><input type='button' name=check value=Next class='pagecount_next' onMouseover=this.className='page_column_mouseover1' onMouseout=this.className='pagecount_next' onClick=\"return common_per_call('$page_url'," . ($page+1) . ",'perpagefrm'," . $Offset . ")\"> &nbsp;";
		}
		$navstring .= "</td></tr>";
	
	if ($verbiage)
	{
		//$navstring .= "<tr><td align='center' nowrap>";
		//$navstring .= "<span class='paginationfont'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		//$navstring .= "&nbsp;&nbsp; total records: <b>".$totalrecords."</b></span>";
		//$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	return $PerpageArray;
}

function record_mytutorials($op,$page,$id='',$db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$extraurl='',$blocksize=3,$strCountQry='No')
{
global $global_config,$strPerPage,$hdMemId_vote,$objSmarty;

//print $page_url;

if($offset==0){
	if(($page=="") || (!is_numeric($page))) $page=1;
}
else{
	$page=($offset/$strPerPage)+1;
	if(!$extraurl){

	if($global_config["SiteModRewrite"]=="No")
	$extraurl="id=".$hdMemId_vote;
	else
	$extraurl=$hdMemId_vote;
	}
}
$objSmarty->assign("PerPage",$page);
if($global_config["SiteModRewrite"]=="No"){
$URLAry=split('[?]',$page_url);

$page_url=$URLAry[0]."?op=members";

if($extraurl)
$page_url=$page_url."&".$extraurl;
					
	$URLAry=split("[?&]",$page_url);
							
	for($i=0;$i<count($URLAry);$i++){
		$URLSubAry[$i]=split("=",$URLAry[$i]);
	}
	$error_display=0;
		for($i=0;$i<count($URLAry);$i++){
		for($j=0;$j<count($URLSubAry);$j++){
		if($URLSubAry[$i][$j]=="per")
		$error_display=1;
		}
	}

		if($error_display==1)
			{
				$URLAryAlt=split("[&]",$page_url);
				if($URLSubAry[1][0]=="per")
					$page_url=$URLAry[0];
				else
					$page_url=$URLAryAlt[0];
			}
}
else{
					$URLAry=split('[/]',$page_url);
				/*if($urlAry[1]=="") $page_url=$page_url."?op=tutorials";
				$urlAry=split('&',$page_url);
				$page_url=$urlAry[0];*/
				//$page_url=$urlAry[0] . "&per=" . $page;
				
				
				//$page_url=$_SERVER['HTTP_REFERER'];
				$page_url=$global_config["SiteGlobalPath"]."members";
				
				if($extraurl)
				$page_url=$page_url."/".$extraurl;
				$ExpURL = explode("/",$QueryString);
				$ExpCnt = count($ExpURL);
				

					if(is_numeric($ExpURL[$ExpCnt]))
						$index=1;

				//print $page_url."<br>";
				
			       if($index){
					 $page_url=$page_url."/".$extraurl;
					}
}			
	/*
	EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0,$extraurl,$blocksize);

	&$db_connect is the MySQL connection passed by reference
	$db_query is your entire query string including WHERE criteria and ORDER BY - without the LIMIT statement!
	$page_url will probably be $PHP_SELF
	$tablewidth determines the width of the $navstring table
	$verbiage, by default set to 'true', prints out "page:$pagenumber/$totalpages  total records:$totalrecords"
	$extraurl extra variables passed in the URL e.g. $extraurl="&findfield=$findfield&findvalue=$findvalue"
	$blocksize, by default set to 15, determines how many page links to display
	*/
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;	
	$pagenumber = intval(($offset + $limit) / $limit);
	$totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">";
	$navstring  .= "<input type='hidden' name=url value=" . $page_url. "><input type='hidden' name='catchain'><input type='hidden' name='tutorialType' value='$op'><input type=hidden name=hdTutorialId value=" . $id . ">";
	
		$navstring .= "<tr>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			$navstring .= "<td><input type='button' name=check value=Previous class='pagecount_next' onMouseover=this.className='page_column_mouseover1' onMouseout=this.className='pagecount_next' onclick=\"return common_per_call('$page_url'," . ($page-1) . ",'perpagefrm'," . $Offset . ")\"> &nbsp;</td>";
		}
		
		if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		
		$blocklimit = $blocksize + $firstpage;
		$navstring .="<td><table cellspacing=\"1\" cellpadding=\"0\" border=\"0\" align='center'><tr>";
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{ 
				$navstring .= "<td align='center'  class='pagecount_active'>$i</td>"; 
			} else { 
				if ($i <= $totalpages)
				{
					$Offset = $limit * ($i-1); 
					
					$navstring .= "<td align='center'><input type='button' name=check value=$i class=pagecount_inactive onMouseover=this.className='page_column_mouseover' onMouseout=this.className='pagecount_inactive' onClick=\"return common_per_call('$page_url'," . $i . ",'perpagefrm'," . $Offset . ")\"></td>";
				}
			} 
		}
		$navstring .= "</tr></table></tD>";
				
		if($totalrecords-$offset > $limit)
		{ 
		$Offset=$offset+$limit;
					
			$navstring .= "<td>&nbsp;<input type='button' name=check value=Next class='pagecount_next' onMouseover=this.className='page_column_mouseover1'  onMouseout=this.className='pagecount_next' onClick=\"return common_per_call('$page_url'," . ($page+1) . ",'perpagefrm'," . $Offset . ")\">&nbsp;";
		}
		$navstring .= "</td></tr>";
	
	if ($verbiage)
	{
		//$navstring .= "<tr><td align='center' nowrap>";
		//$navstring .= "<span class='paginationfont'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		//$navstring .= "&nbsp;&nbsp; total records: <b>".$totalrecords."</b></span>";
		//$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	return $PerpageArray;
}

function searchPerPage($db_query,$page_url,$offset=0,$limit=0,$tablewidth='100%',$verbiage=1,$extraurl='',$blocksize=3)
{
	global $_SESSION;
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	$totalrecords  = $objDB->dbQueryNumRows;
	$pagenumber = intval(($offset + $limit) / $limit);
	$totalpages = intval($totalrecords/$limit);
	
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} 
	else 
		$lastpage = ($totalpages - 1) * $limit;
		
	if($extraurl != '')
		$extraurl = '&'.$extraurl;
		
	$navstring  = "<table width=\"$tablewidth\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\">";
	$navstring .= "<tr>";
	$navstring .= "<td align='left'><span class='SearchNavHead'>Results:</span>&nbsp;";
	if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit
	{
		if ($offset != 0)
		{
			$navstring .= "<a title='Previous Page' class='perPageLink' href='".$page_url."&offset=".($offset-$limit)."$extraurl'><b>Prev</a></b>&nbsp;&nbsp;";
		}
		
		if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 0;//1;
		}
		elseif ($pagenumber > $blocksize) 
			$firstpage = ($pagenumber-$blocksize) + 1;
		elseif ($pagenumber == $blocksize) 
			$firstpage = 1;
		else
			$firstpage = 0;
		$blocklimit = $blocksize + $firstpage;//*$limit ." to ".$i*$limit + $limit
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == ($pagenumber-1))
			{	
				$start = $i*$limit+1;
				$end   = $i*$limit + $limit;
				$navstring .= "<span class='txtorg'>".$start ."-". $end ." </span> "; 
			}
			else 
			{ 
				if ($i < $totalpages)
				{
					$start = $i*$limit+1;
					$end   = $i*$limit + $limit;
					//$nextoffset = $limit * ($i-1); 
					$nextoffset = $limit * $i; 
					$navstring .= "<a title='Page ". $i ." of ". $totalpages ."' class='perPageLink' href='".$page_url."&offset=".$nextoffset."$extraurl'>".$start ."-". $end ."</a> ";
				}
			} 
		}
		if($totalrecords-$offset > $limit)
			$navstring .= "&nbsp;<a title='Next Page' class='perPageLink' href='".$page_url."&offset=".($offset+$limit)."$extraurl'><b>Next</b></a> &nbsp;"; 
	}
	else
	{
		$start = $offset*$limit+1;
		$end   = $offset*$limit + $limit;
		$navstring .= "<span class='txtorg'>".$start ."-". $end ." </span> "; 
	}
	$navstring .= " <span class='SearchNavHead'>Total Dealers: $totalrecords</span></td></tr>";
	$navstring .= "</table>";
	return $navstring;
}
	/*
		Perpage number display coding
	*/
	function PerPage($total,$page_url,$offset=0,$limit=0,$tablewidth='100%',$verbiage=1,$extraurl='',$blocksize=3)
	{
		global $_SESSION;
		
		if ($total > 0)
		{
			$totalrecords  = $total;
			$pagenumber = intval(($offset + $limit) / $limit);
			$totalpages = intval($totalrecords/$limit);
			
			if ($totalrecords%$limit > 0) // partial page
			{
				$lastpage = $totalpages * $limit;
				$totalpages++;
			} 
			else 
				$lastpage = ($totalpages - 1) * $limit;
				
			if($extraurl != '')
				$extraurl = '&'.$extraurl;
				
			$navstring  = "<table width=\"$tablewidth\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\">";
			$navstring .= "<tr class='ListViewPageLinks'>";
			$navstring .= "<td align='right'>";
			if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit
			{
				if ($offset != 0)
				{
					$navstring .= "<a title='First Page' class='perPageLink' href='javascript:goPageRec(0)'><img src='images/start.gif' width='11' height='9' border='0' alt='First Page' align='middle'><img src='images/spacer.gif' width='1' height='1' border='0'><b>Start</b></a>";
					$navstring .= "<a title='Previous Page' class='perPageLink' href='javascript:goPageRec(".($offset-$limit).")'><img src='images/previous.gif' width='6' height='9' border='0' alt='Previous Page' align='middle'><img src='images/spacer.gif' width='1' height='1' border='0'><b>Prev</b></a>&nbsp;";
				}
				
				if ($totalpages < $blocksize)
				{
					$blocksize = $totalpages;
					$firstpage = 0;//1;
				}
				elseif ($pagenumber > $blocksize) 
					$firstpage = ($pagenumber-$blocksize) + 1;
				elseif ($pagenumber == $blocksize) 
					$firstpage = 1;
				else
					$firstpage = 0;
				$blocklimit = $blocksize + $firstpage;//*$limit ." to ".$i*$limit + $limit
				for ($i=$firstpage;$i<$blocklimit;$i++)
				{ 
					if ($i == ($pagenumber-1))
					{	
						$start = $i*$limit+1;
						$end   = $i*$limit + $limit;
						if ($end>$totalrecords)
							$end   = $totalrecords;
						$navstring .= "&nbsp;<span class='txtorg'>".$start ."-". $end ." </span>";
					}
					else 
					{ 
						if ($i < $totalpages)
						{
							$start = $i*$limit+1;
							$end   = $i*$limit + $limit;
							//$nextoffset = $limit * ($i-1); 
							if ($end>$totalrecords)
								$end   = $totalrecords;
							$nextoffset = $limit * $i; 
							$navstring .= "&nbsp;<a title='Page ". $i ." of ". $totalpages ."' class='ListViewPageLinks' href='javascript:goPageRec(".$nextoffset.")'>".$start ."-". $end ."</a>";
						}
					} 
				}
				if($totalrecords-$offset > $limit)
				{
					$navstring .= "&nbsp;<a title='Next Page' class='perPageLink' href='javascript:goPageRec(".($offset+$limit).")'><b>Next</b><img src='images/spacer.gif' width='1' height='1' border='0'><img src='images/next.gif' width='6' height='9' border='0' alt='Next Page' align='middle'></a>";
					$navstring .= "<a title='Last Page' class='perPageLink' href='javascript:goPageRec(".($lastpage).")'><b>End</b><img src='images/spacer.gif' width='1' height='1' border='0'><img src='images/end.gif' width='11' height='9' border='0' alt='Last Page' align='middle'></a>&nbsp;";
				}	
			}
			else
			{
				$start = $offset*$limit+1;
				$end   = $offset*$limit + $limit;
				if ($end>$totalrecords)
					$end   = $totalrecords;
				$navstring .= "<span class='txtorg'>".$start ."-". $end ." </span>";
			}
			$navstring .= "Total Records: <b>$totalrecords</b></td></tr>";
			$navstring .= "</table>";
		}
		else
			$navstring  = "&nbsp;";
		$PerPagearray[0]=$offset;
		$PerPagearray[1]=$navstring;
		return $PerPagearray;
	}
function recordsetNav_MemberList($db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$extraurl='',$blocksize=15,$strCountQry='No')
{
	/*
	EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0,$extraurl,$blocksize);

	&$db_connect is the MySQL connection passed by reference
	$db_query is your entire query string including WHERE criteria and ORDER BY - without the LIMIT statement!
	$page_url will probably be $PHP_SELF
	$tablewidth determines the width of the $navstring table
	$verbiage, by default set to 'true', prints out "page:$pagenumber/$totalpages  total records:$totalrecords"
	$extraurl extra variables passed in the URL e.g. $extraurl="&findfield=$findfield&findvalue=$findvalue"
	$blocksize, by default set to 15, determines how many page links to display
	*/
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;	
	$pagenumber = intval(($offset + $limit) / $limit);
	$totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table width=\"$tablewidth\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\">";
	
	if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit
	{
		$navstring .= "<tr>";
		$navstring .= "<td align='center'>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			$navstring .= "<a title='First Page' class='paginationfont' href='".$page_url."?offset=0$extraurl'>";
			$navstring .= "<a title='Previous Page' class='paginationfont' href='".$page_url."?offset=".$Offset."$extraurl'>Previous";
		}
		
		if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		
		$blocklimit = $blocksize + $firstpage;
		
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{ 
				$navstring .= "<span class='NavPageFont'>$i</span> "; 
			} else { 
				if ($i <= $totalpages)
				{
					$nextoffset = $limit * ($i-1); 
					$navstring .= "<a title='Page ". $i ." of ". $totalpages ."' class='paginationfont' href='".$page_url."?offset=".$nextoffset."$extraurl'>$i</a> ";
				}
			} 
		}
				
		if($totalrecords-$offset > $limit)
		{ 
			$navstring .= "&nbsp;<a title='Next Page' class='paginationfont' href='".$page_url."?offset=".($offset+$limit)."$extraurl'>Next</a> &nbsp;"; 
			$navstring .= "<a title='Last Page' class='paginationfont' href='".$page_url."?offset=".$lastpage."$extraurl'></a>";
		}
		$navstring .= "</td></tr>";
	}	
	
	
	if ($verbiage)
	{
		$navstring .= "<tr><td align='center' nowrap>";
		$navstring .= "<span class='WhiteFont'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		$navstring .= "&nbsp;&nbsp; Total records: <b>".$totalrecords."</b></span>";
		$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	return $PerpageArray;
}

function recordsetNav_VendorList($db_query,$page_url,$offset=0,$limit='',$tablewidth='100%',$verbiage=1,$extraurl='',$blocksize=15,$strCountQry='No')
{

	
	/*
	EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0,$extraurl,$blocksize);

	&$db_connect is the MySQL connection passed by reference
	$db_query is your entire query string including WHERE criteria and ORDER BY - without the LIMIT statement!
	$page_url will probably be $PHP_SELF
	$tablewidth determines the width of the $navstring table
	$verbiage, by default set to 'true', prints out "page:$pagenumber/$totalpages  total records:$totalrecords"
	$extraurl extra variables passed in the URL e.g. $extraurl="&findfield=$findfield&findvalue=$findvalue"
	$blocksize, by default set to 15, determines how many page links to display
	*/
	
	$objDB = new extendsClassDB();
	$objDB->dbSetQuery($db_query,"select");
	$db_result = $objDB->dbSelectQuery();
	if($strCountQry=="Yes")
		$totalrecords  = $db_result[0][0];
	else
		$totalrecords  = $objDB->dbQueryNumRows;	
	$pagenumber = intval(($offset + $limit) / $limit);
	$totalpages = intval($totalrecords/$limit);
	if ($totalrecords%$limit > 0) // partial page
	{
		$lastpage = $totalpages * $limit;
		$totalpages++;
	} else {
		$lastpage = ($totalpages - 1) * $limit;
	}
	if($extraurl != '')
	{
		$extraurl = '&'.$extraurl;
	}
	// start building navigation string
	$navstring  = "<table width=\"$tablewidth\" cellspacing=\"0\" cellpadding=\"3\" border=\"0\">";
	
	if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit
	{
		$navstring .= "<tr>";
		$navstring .= "<td align='center' class='fresults-perpage'>";
		if ($offset != 0)
		{
			$Offset=$offset-$limit;
			$navstring .= "<a title='First Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' href='".$page_url."?offset=0$extraurl'> << </a>&nbsp;";
			$navstring .= "<a title='Previous Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' href='".$page_url."?offset=".$Offset."$extraurl'> < </a> &nbsp;&nbsp;";
		}
		
		if ($totalpages < $blocksize)
		{
			$blocksize = $totalpages;
			$firstpage = 1;
		} elseif ($pagenumber > $blocksize) {
			$firstpage = ($pagenumber-$blocksize) + 2;
		} elseif ($pagenumber == $blocksize) {
			$firstpage = 2;
		} else {
			$firstpage = 1;
		}
		
		$blocklimit = $blocksize + $firstpage;
		
		// Page numbers
		for ($i=$firstpage;$i<$blocklimit;$i++)
		{ 
			if ($i == $pagenumber)
			{ 
				$navstring .= "<span class='pagecountactive'>$i</span> "; 
			} else { 
				if ($i <= $totalpages)
				{
					$nextoffset = $limit * ($i-1); 
					$navstring .= "<a title='Page ". $i ." of ". $totalpages ."' class=pagecountinactive onMouseover=this.className='pagecolumnmouseover' onMouseout=this.className='pagecountinactive' href='".$page_url."?offset=".$nextoffset."$extraurl'>$i</a> ";
				}
			} 
		}
	  	
				
		if($totalrecords-$offset > $limit)
		{ 
			$navstring .= "&nbsp;<a title='Next Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' href='".$page_url."?cat_id=".$cat_id."&offset=".($offset+$limit)."$extraurl'> > </a> &nbsp;"; 
			$navstring .= "<a title='Last Page' class='pagecount_next' onMouseover=this.className='pagecolumnmouseover1' onMouseout=this.className='pagecount_next' href='".$page_url."?offset=".$lastpage."$extraurl'> >> </a>";
		}
		$navstring .= "</td></tr>";
	}	
	
	
	if ($verbiage)
	{
		$navstring .= "<tr><td align='center' nowrap>";
		$navstring .= "<span class='WhiteFont'>Page: <b>".$pagenumber."</b>/<b>".$totalpages."</b>";
		$navstring .= "&nbsp;&nbsp; Total records: <b>".$totalrecords."</b></span>";
		$navstring .= "</td></tr>";
	}	
	$navstring .= "</table>";
	$PerpageArray[0]=$offset;
	$PerpageArray[1]=$navstring;
	return $PerpageArray;
}
?>