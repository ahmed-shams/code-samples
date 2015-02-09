var loadstatustext1="<img src='themes/announcements/images/loading.gif' />"
function SaveImportance(action,ImpRate,ListingType,Ident,FileName)
{	
	document.getElementById("Content").innerHTML=loadstatustext1	
	var success = function(t){SaveImportanceComplete(t,Ident);}
	var failure = function(t){editFailed(t);}
	var url = FileName;	
    var pars = '&action=' + action+'&ImpRate=' + ImpRate + '&LType='+ListingType+'&Ident=' + Ident ; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SaveImportanceComplete(t,Values,spanId,Ident)
{	
	var strValue = t.responseText.split('||');	
	Values = Values.toString();
	document.getElementById("Content").innerHTML=strValue;
	document.getElementById('MenuImg').src = "{/literal}{$ANNOUNCEMET_THEME}{literal}images/down.gif";		
}

function editFailed(t, Values)
{
}


///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// Common Functions (Related to PHP) start here ////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function parseArrayString(temp,Loop)
{
	var tempArray = new Array();
	tempArray = temp.split("\n");
	if(Loop == "Yes")
	{
		return tempArray;
	}
	else if(Loop == "No")
	{
		return tempArray;
	}
}
function stripslashes( str, from, to ) 
{
	var idx = str.indexOf( from );
    while ( idx > -1 ) 
	{
        str = str.replace( from, to ); 
        idx = str.indexOf( from );
    }
    return str;
}
function removeChar(input) 
{
	var output = "";
	for (var i = 0; i < input.length; i++) 
	{
		if ((input.charCodeAt(i) == 13) && (input.charCodeAt(i + 1) == 10)) 
		{
			i++;
			output += " ";
		} 
		else 
		{
			output += input.charAt(i);
	   }
	}
	return output;
}
function Trim(TRIM_VALUE)
{
	if(TRIM_VALUE.length < 1)
	{
		return"";
	}
	TRIM_VALUE = RTrim(TRIM_VALUE);
	TRIM_VALUE = LTrim(TRIM_VALUE);
	if(TRIM_VALUE=="")
	{
		return "";
	}
	else
	{
		return TRIM_VALUE;
	}
} //End Function
function RTrim(VALUE)
{
	var w_space = String.fromCharCode(32);
	var v_length = VALUE.length;
	var strTemp = "";
	if(v_length < 0)
	{
		return"";
	}
	var iTemp = v_length -1;
	while(iTemp > -1)
	{
		if(VALUE.charAt(iTemp) == w_space)
		{
		}
		else
		{
			strTemp = VALUE.substring(0,iTemp +1);
			break;
		}
		iTemp = iTemp-1;
	} 
	return strTemp;
} 
function LTrim(VALUE)
{
	var w_space = String.fromCharCode(32);
	if(v_length < 1)
	{
		return"";
	}
	var v_length = VALUE.length;
	var strTemp = "";
	var iTemp = 0;
	while(iTemp < v_length)
	{
		if(VALUE.charAt(iTemp) == w_space)
		{
		}
		else
		{
			strTemp = VALUE.substring(iTemp,v_length);
			break;
		}
		iTemp = iTemp + 1;
	} 
	return strTemp;
} 
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// Common Functions (Related to PHP) End here ////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

