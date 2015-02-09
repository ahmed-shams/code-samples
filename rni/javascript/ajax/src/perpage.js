// JavaScript Document
function perpageDispaly(spanId,Startlimit,Endlimit,filename,Display)
{
	var Values = Display;
	var success = function(t){perpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanId + '&Startlimit=' + Startlimit + '&Endlimit=' + Endlimit; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function perpageComplete(t, Values)
{
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
	showAsEditable(Values, true);
}