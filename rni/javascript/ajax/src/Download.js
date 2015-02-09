function TabDisplay(spanid,Display,CatagoryId,DisplayId,filename)   //This Function  used to display the Pergpage
{  //alert(spanid);
	var Values = Display;
	var success = function(t){TabDisplayComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&d=' + CatagoryId + '&t=' + DisplayId;  alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function TabDisplayComplete(t, Values)
{ //alert(t.responseText);
	strValue = t.responseText.split('||');
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue[0];
	document.getElementById("TabDisp").innerHTML = strValue[1];
	document.getElementById("userProduct").className = "tab_menuajax";
	showAsEditable(Values, true);
}