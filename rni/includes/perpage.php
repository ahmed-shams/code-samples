<? 
	global $global_config;
	global $_SESSION;
	$NumPages 	 = ($TotalNum%$PerPage)==0 ? floor($TotalNum/$PerPage): floor($TotalNum/$PerPage)+1 ; //Number of Pages taking $PerPage per Page
	if(($NumPages%5)==0){
		$NumDisplay =  floor($NumPages/5);
		$NumDisplay = ($NumDisplay-1)*5+1;
	}	else	{
		$NumDisplay = floor($NumPages/5);
		$NumDisplay = $NumDisplay*5+1; 
	}
	
if($NumPages>=1){
	$intPerPage ="<table width=100% border=0 cellspacing=0 cellpadding=0 align=right><tr class=GridCell1><td nowrap width=10% class=FormLabelBold>";
	$PerPageFrom = ($Start+1);
	$PerPageTo = $Start+$PerPage;
	if ($PerPageTo > $TotalNum) $PerPageTo = $TotalNum;
	$intPerPage.="Showing rows $PerPageFrom - $PerPageTo </td><td nowrap  width=10%  class=FormLabelBold>($TotalNum total)";

	if ($_SESSION["LanguageCode"]==2)
	$intPerPage.="</td><td align=left>";
	else
	$intPerPage.="</td><td align=right>";

	if($Page!=0 && $Display!=1)	{
		$strPage = $Page-5;
		$strDisplay = $Display-5;
		$intPerPage.= "<a href = $formlink?Page=0&fieldname=$fieldname>"; 
		$intPerPage.="<img src=".$global_config['SiteImagePath']."/leftfirst.gif border=0></a>&nbsp;&nbsp;";
		$intPerPage.="<a href = $formlink?Page=$strPage&Display=$strDisplay&sort=$sort&fieldname=$fieldname>";
		$intPerPage.="<img src=".$global_config['SiteImagePath']."/left1.gif border=0></a>";
 	}
     	$Interval = $Display+4;
		 if($Interval>=$NumPages) {
			$Interval = $NumPages;
			$DFLAG = 1;
	 	}
		for($i=$Display;$i<=$Interval;$i++)	{
			if($Page==$i-1)	{
				$intPerPage.="<span class=WhiteFont>$i</span>";
    		}	else	{
       			$I=$i-1;			
				$intPerPage.="<a href = $formlink?Page=$I&Display=$Display&sort=$sort&fieldname=$fieldname>"; 
       			$intPerPage.="<span class=WhiteFont>$i</span>";
				$intPerPage.="</a>";
        	}
		}
   		if($DFLAG!=1) 	{
           $I=$i-1;
		   $Display1=$Display+5;
		   $NumDisplay1=$NumDisplay;
		   $intPerPage.="&nbsp;&nbsp;<a href = $formlink?Page=$I&Display=$Display1&sort=$sort&fieldname=$fieldname>";
           $intPerPage.="<img src=".$global_config['SiteImagePath']."/right1.gif width=7 height=8 border=0></a>&nbsp;&nbsp;"; 
           $intPerPage.="<a href = $formlink?Page=$NumDisplay1&Display=$NumDisplay1&sort=$sort&fieldname=$fieldname>"; 
           $intPerPage.="<img src=".$global_config['SiteImagePath']."/rightlast.gif border=0></a>";
    	} 
           $intPerPage.="</td>";
           $intPerPage.="</tr>";
           $intPerPage.="</table>";
} else {
	$intPerPage ="<table width=100% border=0 cellspacing=0 cellpadding=0 align=right><tr class=WhiteFont><td colspan=2 nowrap width=10% class=FormLabelBold>&nbsp;</td></tr></table>";
}
?>