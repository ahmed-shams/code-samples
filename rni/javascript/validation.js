var alphabet = "abcdefghijklmnopqrstuvwxyz";
var numeric  = "0123456789";

function IsDateinPast_Today(dtStr,Label,element)
{
	if(IsDate(dtStr,Label,element))
	{
		today=new Date();
		indate=new Date();
		dtStr=trim(dtStr);
		if(dtStr!="")
		{
			dateArr=dtStr.split("/");
			indate.setDate(dateArr[0]); indate.setMonth(dateArr[1]-1); indate.setFullYear(dateArr[2]);
			if(indate>today)
			{
				alert("Invalid "+Label+"\n"+Label+" must be in the Past or Today");
				element.focus();
				element.select();
			}
		}
	}
}
function IsDate(dtStr,Label,element)
{
	var daysInMonth = DaysArray(12)
	var dtCh= "/";
    var minYear=1900;
    var maxYear=2100;
	var errmsg;
	var isDate=true;
	dtStr=trim(dtStr);
	if(dtStr!="")
	{
		var pos1=dtStr.indexOf(dtCh)
		var pos2=dtStr.indexOf(dtCh,pos1+1)
		var strMonth=dtStr.substring(pos1+1,pos2)
		var strDay=dtStr.substring(0,pos1)
		var strYear=dtStr.substring(pos2+1)
		if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
		if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
		for (var i = 1; i <= 3; i++) 
		{
			if (strYear.charAt(0)=="0" && strYr.length>1) strYear=strYear.substring(1)
		}
		month=parseInt(strMonth)
		day=parseInt(strDay)
		year=parseInt(strYear)
		if (pos1==-1 || pos2==-1) 
			{errmsg="Enter a valid Date for "+Label+"\nDate Format is dd/mm/yyyy";
			isDate=false;}
		if (strMonth.length<1 || month<1 || month>12)
			{errmsg="Enter a valid month between 1 and 12 for "+Label+"\nDate Format is dd/mm/yyyy";
			isDate=false;}
		if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month])
			{errmsg="Enter a valid date for "+Label+"\nDate Format is dd/mm/yyyy";
			 isDate=false;}	
		if (strYear.length != 4 || year==0 || year<minYear || year>maxYear)
		  {	errmsg="Enter a valid year between "+minYear+" and "+maxYear+" for "+Label+"\nDate Format is dd/mm/yyyy";  
			isDate=false;}
		if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr,dtCh))==false)
		   {errmsg="Enter a valid Date for "+Label+"\nDate Format is dd/mm/yyyy";
			isDate=false;}
		if(!isDate)
		{
		  alert(errmsg); 
		  element.focus();
		  element.select();
		}
   	}
  	return isDate;	
}

function IsAnnouncementDate(dtStr,Label,element)
{
	//alert(dtStr);
	var daysInMonth = DaysArray(12)
	var dtCh= "/";
    var minYear=1900;
    var maxYear=2100;
	var errmsg;
	var isDate=true;
	dtStr=trim(dtStr);
	if(dtStr!="")
	{
		var pos1=dtStr.indexOf(dtCh)
		var pos2=dtStr.indexOf(dtCh,pos1+1)
		var strMonth=dtStr.substring(pos1+1,pos2)
		var strDay=dtStr.substring(0,pos1)
		var strYear=dtStr.substring(pos2+1)
		if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
		if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
		for (var i = 1; i <= 3; i++) 
		{
			if (strYear.charAt(0)=="0" && strYr.length>1) strYear=strYear.substring(1)
		}
		month=parseInt(strMonth)
		day=parseInt(strDay)
		year=parseInt(strYear)
		if (pos1==-1 || pos2==-1) 
			{errmsg="Enter a valid Date for "+Label+"\nDate Format is dd/mm/yyyy";
			isDate=false;}
		if (strMonth.length<1 || month<1 || month>12)
			{errmsg="Enter a valid month between 1 and 12 for "+Label+"\nDate Format is dd/mm/yyyy";
			isDate=false;}
		if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month])
			{errmsg="Enter a valid date for "+Label+"\nDate Format is dd/mm/yyyy";
			 isDate=false;}	
		if (strYear.length != 4 || year==0 || year<minYear || year>maxYear)
		  {	errmsg="Enter a valid year between "+minYear+" and "+maxYear+" for "+Label+"\nDate Format is dd/mm/yyyy";  
			isDate=false;}
		if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr,dtCh))==false)
		   {errmsg="Enter a valid Date for "+Label+"\nDate Format is dd/mm/yyyy";
			isDate=false;}
		if(!isDate)
		{
		  alert(errmsg); 
		  element.focus();
		  element.select();
		}
   	}
  	return isDate;	
}



function IsFutStartDate(sDate,eDate,Label)
{
	var d1 = eDate;
	DateArray = d1.split("/");
	
	var dd = sDate;
	var Dob = dd.split("/");
	//var CDate = dd.getDate();
	//var CMonth = dd.getMonth();
	//var CYear = dd.getFullYear();
	//var CMonth1 = CMonth+1;
	
	if(DateArray[2]<Dob[2]) 
	{
		return false;
	}
	if(DateArray[2]==Dob[2]) 
	{ 
		if(DateArray[1]<Dob[1])
		{
			return false;
		}
	
		if(DateArray[1]==Dob[1])
		{
			if(DateArray[0]<Dob[0])
			{
				return false;
			}
		}
		return true;
	}
	return true;
}

////////////////////////////////////////////////////////////Date Validation Script function END///////////////////////////////////////////////////
function IsNumber(sText,Label)
{

   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;
   if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsNumber == true; i++) 
   { 
      Char = sText.charAt(i); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsNumber = false;
      }
   }
   if(!IsNumber){
   	alert(Label+ " Must Be numeric")
   }
   return IsNumber;
}

function IsNumberBusiness(sText,Label)
{
//alert(sText)
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;
  // if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsNumber == true; i++) 
   { 
      Char = sText.charAt(i); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsNumber = false;
      }
   }
   if(!IsNumber)
   	alert(Label+ " Must Be numeric")
   return IsNumber;
}

function IsValidText(sText,Label)
{
   var ValidChars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ ";
   var IsValidText=true;
   var Char;
   if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert(Label+ " Must Be Alpha Numeric")
   return IsValidText;
}

function IsValidCompany(sText,Label)
{
	
   var ValidChars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ& -',./";
   var IsValidText=true;
   var Char;
   if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert("Invalid Characters found in "+Label)
   return IsValidText;
}
function IsValidProfileName(sText,Label){
	var ValidChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ&-',./";
   var IsValidText=true;
   var Char;
  // if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert("Invalid Characters found in "+Label)
   return IsValidText;
}

function IsValidCompanyBusiness(sText,Label)
{
   var ValidChars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ& -',./";
   var IsValidText=true;
   var Char;
  // if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert("Invalid Characters found in "+Label)
   return IsValidText;
}


function IsAddress(sText,Label)
{
   var ValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ :.1234567890-,#()'[]{}/&!$%_=+";
   var IsValidText=true;
   var Char;
   if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert(Label+ " Invalid Charactes found")
   return IsValidText;
}

function IsAddressBusiness(sText,Label)
{
   var ValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ .1234567890-,#()'[]{}/";
   var IsValidText=true;
   var Char;
  // if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert(Label+ " Invalid Charactes found")
   return IsValidText;
}

function IsvalidCity(sText,Label)
{
   var ValidChars = "abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ-";
   var IsValidText=true;
   var Char;
   if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert(Label+ " Invalid Charactes found")
   return IsValidText;
}

function IsvalidCityBusiness(sText,Label)
{
   var ValidChars = "abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ-";
   var IsValidText=true;
   var Char;
   //if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert(Label+ " Invalid Charactes found")
   return IsValidText;
}


function IsvalidName(sText,Label){
	//alert()
   var ValidChars = "abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ-";
   var IsValidText=true;
   var Char;
   //if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert(Label+ " Invalid Charactes found")
   return IsValidText;
}

function IsAlphaAndNumeric(sText,Label)
{
	
	
	   var ValidChars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ ";
	   var IsAlphaAndNumeric=true;
	   var Char;
	   if(trim(sText)!=""){
		   if(sText=="") {alert(Label+ " Should not be Empty");return false}
		   sText = trim(sText)
		   for (i = 0; i < sText.length && IsAlphaAndNumeric == true; i++)
		   { 
			  Char = sText.charAt(i).toUpperCase(); 
			  if(ValidChars.indexOf(Char) == -1) 
			  {
				 IsAlphaAndNumeric = false;
			  }
		   }
	   }
	   if(!IsAlphaAndNumeric)
		alert(Label+ " Must Be Alpha Numeric")
	   return IsAlphaAndNumeric;
	   
   
   
}

function IsValidURLhttp(strURL,n)
	{
		strURL 			= strURL.toUpperCase();
		var strlen 		= strURL.split("//");
		var thePrefix 	= strlen[0]+"//";
		if(!(thePrefix=="HTTP://" || thePrefix=="HTTPS://"))
		{
			alert("Invalid URL");
			return false;
		}	
		if(n!=-1) if(strURL.split("/").length>n) return false;		
		return true
	}
	


function IsFax(sText,Label)
{
   var ValidChars = "0123456789-().";
   var IsNumber=true;
   var Char;
  // if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsNumber == true; i++) 
   { 
      Char = sText.charAt(i); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsNumber = false;
      }
   }
   if(!IsNumber)
   	alert(Label+ " Must Be in Format eg:229-230-4443 or (229)-230-4443 or 229.230.4443")
   return IsNumber;
}

function IsPhone(sText,Label)
{
   var ValidChars = "0123456789-().";
   var IsNumber=true;
   var Char;
   if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsNumber == true; i++) 
   { 
      Char = sText.charAt(i); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsNumber = false;
      }
   }
   if(!IsNumber)
   	alert(Label+ " Must Be in Format eg:229-230-4443 or (229)-230-4443 or 229.230.4443")
   return IsNumber;
}

function IsPhoneBusiness(sText,Label)
{
   var ValidChars = "0123456789-().";
   var IsNumber=true;
   var Char;
   //if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsNumber == true; i++) 
   { 
      Char = sText.charAt(i); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsNumber = false;
      }
   }
   if(!IsNumber)
   	alert(Label+ " Must Be in Format eg:229-230-4443 or (229)-230-4443 or 229.230.4443")
   return IsNumber;
}
function IsPhoneSymbol(sText,Label)
{
   var ValidChars = "0123456789-()+";
   var IsNumber=true;
   var Char;
   if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsNumber == true; i++) 
   { 
      Char = sText.charAt(i); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsNumber = false;
      }
   }
   if(!IsNumber)
   	alert(Label+ " Must Be in Format eg:229-230-4443")
   return IsNumber;
}
function isWhitespace(s)
{
	// 	Check if s is empty

//	if (isEmpty(s)) return true;	

	// Checks for whitespace. If there is atleast a non-whitespace character
	// the function will return false.

	var spaces = " \n\t\r"
	var i;
	for(i=0;i<s.length;++i)

		if (spaces.indexOf(s.charAt(i)) == -1) 
			return false;
	return true;
}

function IsPassword(sPass1,Lable)
{
	 
	if(trim(sPass1)=="")
	{
		alert(Lable +" Should Not be Empty")
		return false
	}
	else if(!IsValidText(sPass1, Lable))
    {
		//alert("Password should have combination of numbers and letters")
		return false
    }
	else if (sPass1.length < 5)
	{
		alert("Password must have atleast 5 Characters");
		return false
	}
	else if (sPass1.length > 10)
	{
		alert("Password must be of maximum 10 Characters");
		return false
	}
	else {
		return true;
	}
/*	if(sPass1!=sPass2)
	{
		alert("Password Mismatch")
		return false
	}
	IsFound = false
	for(i=0;i<objBlock.length && !IsFound ;i++)
	{
		reg = new RegExp(objBlock[i])
		if(sPass1.match(reg))
		{
			IsFound = true
		}
	}
	if(IsFound)
	{
		alert("Password should not have "+strLabel)
		return false
	}*/
	
}

function IsAmount(sText)
{
   var ValidChars = "0123456789.,";
   var IsAmount=true;
   var Char;
   if(sText=="") return false
   for (i = 0; i < sText.length && IsAmount == true; i++) 	
   { 
		 Char = sText.charAt(i); 
		 if (ValidChars.indexOf(Char) == -1) 
         {
    	     alert("Invalid Amount");
			 IsAmount = false;
         }
   }
   return IsAmount;
}

function IsValidAmount(sText,Label)
{
	if(!IsAmount(sText))
	{
		alert("Invalid "+Label+".. "+Label+" Must Have Numeric Values")
		return false;
	}
	AmtArray = sText.split(".")
	if(AmtArray.length>2)
	{
		alert("Invalid "+Label+".. "+Label+" Must have single Period for Float")
		return false;
	}
	if(AmtArray.length>1)
	{
		FloatAmt = AmtArray[1];
		if(FloatAmt.length>2)
		{
			alert("Invalid "+Label+"..  Float Value must have two Digits")
			return false;
		}
	}
	return true
}

function IsFloat(sText,Label)
{
	if(!IsAmount(sText))
	{
		alert("Invalid "+Label+".. "+Label+" Must Have Numeric Values")
		return false;
	}
	AmtArray = sText.split(".")
	if(AmtArray.length>2)
	{
		alert("Invalid "+Label+".. "+Label+" Must have single Period for Float")
		return false;
	}
	return true
}



function isEmail(s)
{
	var i = 1,Length = s.length,result;
	
	if(s==""){
		
		alert("Email Address should not be Empty");
		return false;
	}
	
	while((i<Length) && (s.charAt(i) != '@')) i++;
	
	if ((i == Length) || (s.charAt(i) != '@'))
	{
		alert("Email Address don\'t have the character @ after the login name");
		return false;
	}
	
	i+=2;
	
	while((i<Length) && (s.charAt(i) != '.')) i++;

	if ((i == Length) || (s.charAt(i) != '.'))
	{
		alert("Email Address don\'t have the character after the domain name ");
		return false;
	}

	if (i+1 >= Length)
	{
		alert("Email Address should have atleast one character after.");
		return false;
	}
	
	return true;
}

function isEmailAddr(email)
{
  var result = false;
  var theStr = new String(email);
  var index = theStr.indexOf("@");
  if (index > 0)
  {
    var pindex = theStr.indexOf(".",index);
    if ((pindex > index+1) && (theStr.length > pindex+1))
	result = true;
  }
  return result;
}

//This function checks the matching of Passwords.
function IsMatch(Val1,val2,Label)
{
	if(trim(Val1)!=trim(val2))
	{
		alert(Label+"  Should Not Match")
		return false
	}
	return true
}

function trim(Val)
{
	while(''+Val.charAt(0)==' ')
	Val=Val.substring(1,Val.length);
	return Val
}

function IsValid(Val,Label)
{
	if(trim(Val)=="")
	{
		alert(Label+" Should Not be Empty")
		return false
	}
	return true
}


function splitText(theNotes)
{
		theString = theNotes.split("\n")
		NewString = ""
		for(i=0;i<theString.length;i++)
		{
			NewString+=theString[i]+"|"
		}
		return NewString
}
function floatRound(number,X) {
	X = (!X ? 2 : X);
	return Math.round(number*Math.pow(10,X))/Math.pow(10,X);
}

var dtCh= "/";
var minYear=1900;
var maxYear=2100;

function isInteger(s,Lable){
	if(s!=""){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")))
		{
			alert(Lable+" Should be Numeric ")
		 	return false;
		}
    }
    // All characters are numbers.
	}
	else
	{
		return true
	}	
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}

function isDate(dtStr,Label){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strDay=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	
	
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("The date format should be : dd/mm/yyyy for "+Label)
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Please enter a valid month for "+Label+"\nDate Format is dd/mm/yyyy")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Please enter a valid day for "+Label+"\nDate Format is dd/mm/yyyy")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear+" for "+Label+"\nDate Format is dd/mm/yyyy")
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Please enter a valid date for "+Label+"\nDate Format is dd/mm/yyyy")
		return false
	}
return true
}
function EditPopup(theURL)
{
	
	ScreenWidth  = screen.width
	ScreenHeight = screen.height
	PopupWidth   =ScreenWidth/1
	PopupHeight  = ScreenHeight/1.25
	PopupLeft    = (ScreenWidth-PopupWidth)/2
	PopupTop     = (ScreenHeight-PopupHeight)/2
	//PopupTop     = 10
	theURL = theURL
	MM_openPopupWindow(theURL,'PopupWindow','maximize=no,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width='+PopupWidth+',height='+PopupHeight+',left='+PopupLeft+',top='+PopupTop);				
}
	
	function MM_openPopupWindow(theURL,winName,features) 
	{ 
		var hWnd =   window.open(theURL,winName,features);
		if ((document.window != null) && (!hWnd.opener))
			hWnd.opener = document.window;
	}
	
	function isPassword(s)
	{
		if (s.length < 5)
		{
			alert("min. length of password is 5");
			return false;
		}
	
		if (isWhitespace(s))
		{
			alert("please enter the password without spaces");
			return false;
		}
		return true;
	}
	
	function isLogin(s)
	{
		if (s.length < 5)
		{
			alert("min. length of Login ID is 5");
			return false;
		}
	
		if (!isValidwithBag(s,alphabet + numeric + "-._"))
	
		{
			alert("Login ID should contain only the characters from alphabet, numbers and '-._'");
			return false;
		}
		if (!isValidwithBag(s.charAt(s.length-1),alphabet + numeric))
		{
			alert("Login ID should end with an alphanumeric characters.");
			return false;
		}
		if (!isValidwithBag(s.charAt(0),alphabet + numeric))
		{
			alert("Login ID should start with an alphanumeric characters.");
			return false;
		}
		return true;
	}
	


	function isValidwithBag(name,Bag)
	{
		var i;
		name = name.toLowerCase();
		for(i=0;i<name.length;++i)
			if (Bag.indexOf(name.charAt(i)) == -1) 
				return false;
		return true;
	}		

	function isEmpty(s)
	{
		// if the string is null or having the length of zero
		// the function will return true
		return((s==null) || (s.length==0));
	}

	function isWhitespace(s)
	{
		// 	Check if s is empty
	
		if (isEmpty(s)) return true;	
	
		// Checks for whitespace. If there is atleast a non-whitespace character
		// the function will return false.
	
		var spaces = " \n\t\r"
		var i;
		for(i=0;i<s.length;++i)
			if (spaces.indexOf(s.charAt(i)) == -1) 
				return false;
		return true;
	}
	
	/*
	function isDate_Val(obj)
	{

		var curDate,cal = obj.value;
		var calMode = 0;
		curDate = true;
		if (cal.length == 10)
		{
			if(calMode == 0)
			{
				Day = cal.substr(3,2)
				Month = cal.substr(0,2);
			}
			else
			{
				Day = cal.substr(0,2)
				Month = cal.substr(3,2);
			}
			Year = cal.substr(6,4);

			if (!isNaN(Day) && !isNaN(Month) && !isNaN(Year))
			{
					if((Month >= 1 && Month <= 12) && Year.length == 4)
					{
						Date1 = new Date(Year,Month-1,1);
						var tMonth = Date1.getMonth();
						var tYear = Date1.getFullYear();
						if(tMonth == 11)
						{
							tMonth = 0;
							tYear = tYear + 1;
						}
						else
							tMonth++;
						var Date2= new Date(tYear,tMonth,Date1.getDate())
						monthDays = (Date2 - Date1) / 86400000;
						if (Day >= 1 && Day <= monthDays)
							curDate = false;
					}
			}
					
		}
		return curDate;
	}
 */
 
	 function DateDiff(obj2,obj1)
	 {
		// obj2 is Date object
		// obj1 is the text object having the date value
		// will return + value if obj2 < obj1
		// will return - value if obj2 > obj1
		// will return 0 if both are equal.
	
			var cal1 = obj1.value;
			var Date1;
			var calMode = 0;
	
			if (cal1.length == 10)
			{
				if(calMode == 0)
				{
					Day1 = cal1.substr(3,2)
					Month1 = cal1.substr(0,2);
				}
				else
				{
					Day1 = cal1.substr(0,2)
					Month1 = cal1.substr(3,2);
				}
				Year1 = cal1.substr(6,4);
	
				Date1 = new Date(Year1,Month1-1,Day1);
	
				return (Date1 - obj2);
			}
	
	 }

	function isYear(valu)
	{ 
		var ret=true;
		year = new Date();
		var currentyearvalue = year.getYear();
		var oper=currentyearvalue-18;
		var yearval=valu;
	
		if((yearval <1900)||(yearval>oper))
			{ 
			ret=false;
			   return ret;
			}
			return ret;
	}

// JavaScript Document
function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

 		 return true					
	}



function IsProfilePage(sText,Label)
{
   var ValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.1234567890-_";
   var IsValidText=true;
   var Char;
   if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert(Label+ " Invalid Charactes found")
   return IsValidText;
}

function IsValidZipCode(sText,Label)
{
   var ValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 1234567890-";
   var IsValidText=true;
   var Char;
   if(sText=="") {alert(Label+ " Should not be Empty");return false}
   for (i = 0; i < sText.length && IsValidText == true; i++) 
   { 
      Char = sText.charAt(i).toUpperCase(); 
      if(ValidChars.indexOf(Char) == -1) 
      {
         IsValidText = false;
      }
   }
   if(!IsValidText)
   	alert(Label+ " Invalid Charactes found")
   return IsValidText;
}
function HideShowBusinessImage(obj,status){
	if(status=="Hide"){
		document.getElementById(obj).style.display="none";
		document.getElementById(obj).style.visibility="hidden";
	}
	if(status=="Show"){
		document.getElementById(obj).style.display="inline";
		document.getElementById(obj).style.visibility="visible";
	}
}

var closecount = 0;
function setAucTime(which, totalTimers)
{
  //Specify the arrays as display format.
  var maxTime = new Array(60, 60, 24, 30, 12);
  var timeDesc = new Array("s", "m", "h", "d", "M");

  var delay = 1;
  if (totalTimers > 50 && totalTimers < 250)
     delay = 10;
  else if (totalTimers >= 250) 
     delay = 25;
     
  //Extract the innerHTML of the Element, and split it into array of
  //reversed order i.e. seconds are at 0.
  var curTime = document.getElementById('auctime' + which).innerHTML;

  //Extract data between <font style=''>.....</font> tags
  var stIndex = curTime.indexOf(">") + 1;
  var endIndex = curTime.indexOf("<", stIndex);
  curTime = curTime.substring(stIndex, endIndex);

  curTime = curTime.replace(/[^0-9 ]+/g,"");
  if (curTime.charAt(0) == ' ')
     curTime = curTime.substr(1);

  var timeArray = curTime.split(" ");
  timeArray.reverse();

  timeArray[0] -= delay;

  //Length <= 2 considered as the space within <font color=....> tag
  //leads to this.
  //If seconds value of any auction reaches 0, then reload the page from server.
  var FLAG = 0;  if (timeArray.length <= 2 && ((timeArray.length == 1 && timeArray[0] <= 0) || (timeArray[0] == "" && timeArray[1] <= 0)))
  {
      FLAG = 1;
      document.getElementById('auctime' + which).innerHTML = "<font style='font: 13px arial, sans-serif; color:black; background-color: white'><b>CLOSED</b></font>";

      return;
  }

  //Decrement the time correctly to a new value.
  var timeStr = "";
  for (var i=1; i<timeArray.length; i++)
  {
      if (timeArray[i-1] < 0)
      {
         timeArray[i-1] = maxTime[i-1] + timeArray[i-1];
         timeArray[i] -= 1;
      }

      if (i == 1)
          timeStr = timeArray[i-1] + timeDesc[i-1];
      else
          timeStr = timeArray[i-1] + timeDesc[i-1] + " " + timeStr;
  }

  //Append the Highest time unit to output string if and only if its
  //greater than 0.
  //This way we eliminate 0 value displays.
  if (timeArray[timeArray.length-1] > 0)
  {
     if (timeArray.length == 1)
        timeStr = timeArray[timeArray.length-1] + timeDesc[timeArray.length-1];
     else
        timeStr = timeArray[timeArray.length-1] + timeDesc[timeArray.length-1] + " " + timeStr;
  }

  //Blink background of auctions less than 60 min, and
  //Display a changed background for auctions < 60s
  if (timeArray.length == 1 && FLAG == 0)
     timeStr = "<font style='font: 14px arial, sans-serif; color: red'>" + timeStr + "</font>";
  else if (timeArray.length == 2 && timeArray[1] < 5 && FLAG == 0)
     timeStr = "<font style='font: 14px arial, sans-serif; color: green'>" + timeStr + "</font>";
  else if (timeArray.length == 2 && FLAG == 0)
     timeStr = "<font style='font: 13px arial, sans-serif; color: black'>" + timeStr + "</font>";
  else
     timeStr = "<font style='font: 12px arial, sans-serif; color: black'>" + timeStr + "</font>";

  //Write the new decremented timer value back
  var func = "setAucTime(" + which + ", " + totalTimers + ")";
  document.getElementById('auctime' + which).innerHTML = timeStr;
  setTimeout(func,(delay * 1000));       //Recursive function call at 1, 30 or 60 second intervals
}

function redirectTab(objForm,pageURL){
	//document.location.href = pageURL;
	objForm.fAction.value=pageURL;
	objForm.submit();
}

function PopUp(target,height){
		ScreenWidth  = screen.width/1.30;
		ScreenHeight = 500;		
		PopupLeft    = screen.width/10;
		PopupTop     = screen.height/5;
		window.open(target,'','width='+ScreenWidth+',height='+ScreenHeight+',left='+PopupLeft+',top='+PopupTop+',maximize=no,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=Yes,resizable=no');	
}
function ShowPopUps(target,height,width1){
		ScreenWidth  = screen.width/1.30;
		ScreenHeight = height;		
		PopupLeft    = screen.width/10;
		PopupTop     = screen.height/5;
		window.open(target,'','width='+width1+',height='+ScreenHeight+',left='+PopupLeft+',top='+PopupTop+',maximize=no,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=Yes,resizable=no');	
}

function IsValidURL(strURL,n)
{
	strURL 			= strURL.toUpperCase();
		var strlen 		= strURL.split("//");
		var thePrefix 	= strlen[0]+"//";
		if(!(thePrefix=="HTTP://" || thePrefix=="HTTPS://"))
		{
			alert("Invalid URL");
			return false;
		}	
		if(n!=-1) if(strURL.split("/").length>n) return false;		
		return true
}


