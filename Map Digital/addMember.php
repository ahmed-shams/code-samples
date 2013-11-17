<?php
require_once './Inc/no_caching.php';
require_once ('./conf.php');
$auth = new Auth();
$auth->forceLogin();
include 'db.php';
include 'formClass.php';
include 'functions.php';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><meta charset="UTF-8" >
<title>Manage Form/Badge</title>
<link rel="stylesheet" type="text/css" href="rp.css">
<script language="JavaScript" type="text/javascript" src="Inc/JS/shortcut.js"></script>
<script language="JavaScript" type="text/javascript" src="Inc/JS/functionkeys.js"></script>
<script language="JavaScript" type="text/javascript" src="Inc/JS/validate.js"></script>
<script language="JavaScript" type="text/javascript" src="Inc/JS/tableRollover.js"></script>
<script language="JavaScript" type="text/javascript" src="Inc/JS/filterTable.js"></script>
<script language="JavaScript" type="text/javascript" src="Inc/JS/sortabletable.js"></script>
<script language="JavaScript" type="text/javascript" src="Inc/JS/option.js"></script>
<script language="JavaScript" type="text/javascript" src="Inc/JS/badgeoption.js"></script>
<script language="JavaScript" type="text/javascript" src="Inc/JS/multiplemove.js"></script>
<link type="text/css" href="Inc/jquery-ui-1.8.custom/css/smoothness/jquery-ui-1.8.custom.css" rel="Stylesheet" >	

<script type="text/javascript" src="Inc/jquery-ui-1.8.custom/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="Inc/jquery-ui-1.8.custom/js/jquery-ui-1.8.custom.min.js"></script>

<script type="text/javascript" src="Inc/JS/jquery.simpletooltip.js"></script>

<script type="text/javascript" src="DropdownMenu/js/jquery.dropdown.js"></script>
<link href="DropdownMenu/css/dropdown/themes/default/helper.css" media="screen" rel="stylesheet" type="text/css" >
<link href="DropdownMenu/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" >
<link href="DropdownMenu/css/dropdown/themes/default/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="Inc/JS/jquery.bgiframe.js"></script>
<script type="text/javascript" >
function addform(){ window.location.href="addform.php";};
function searchform() {window.location.href="searchform.php";};
function reports() {window.location.href="reportsajax.php";};
function clearform(){window.location.href="addMember.php";}; 
 
var state = 'none'; 
function showhide(layer_ref) { 
	if (state == 'block') { 
		state = 'none'; 
	} 
	else { 
		state = 'block'; 
	} 
	if (document.all) { //IS IE 4 or 5 (or 6 beta) 
		eval( "document.all." + layer_ref + ".style.display = state"); 
	} 
	if (document.layers) { //IS NETSCAPE 4 or below 
		document.layers[layer_ref].display = state; 
	} 
	if (document.getElementById &&!document.all) { 
		hza = document.getElementById(layer_ref); 
		hza.style.display = state; 
	} 
}

function setSelected(oform){
	if(oform.Group.selectedIndex != 0){
		document.forms[oform.name].submit();
		return true;
	}
	else
	return false;
}; 


function valselected(ofrm){
	var ele= document.getElementsByName("todoitems");
	var cnt=0; var i;
	for(i=0; i<(ele.length); i++){
		if(ele[i].checked) {
			cnt=cnt+1;
		}
	}
	if(cnt==0) {alert("Please select an action"); return false;}
	if(cnt==1) {return true;}
	if(cnt>=1) {alert("Please select an action"); return false;}
};


$(document).ready(function() {
	$("#tabs").tabs();					   

	$("#tabs").bind('tabsselect', function(event, ui) {
		document.location.href = '#'+(ui.index+1);
	});

	if(document.location.hash!='') {
      //get the index
      indexToLoad = document.location.hash.substr(1,document.location.hash.length);
	  $("#tabs").tabs('select',indexToLoad-1);

	  
   }
});

var fontsettings= new Array();

function set_fntsize(ftsize,sideid){	
var setto=document.getElementById(sideid).value;	
var settoid=setto.replace(/ /g,'');
var saveval;
if(sideid=="lselecteditems"){
	settoid="left_"+settoid;
	savekey="left_"+ document.getElementById(sideid).value + "=";
	saveval= savekey + ftsize+"pt";   
} else {
	if(sideid=="rselecteditems")
		settoid="right_"+settoid;
		savekey="right_"+ document.getElementById(sideid).value + "=";
		saveval= savekey + ftsize+"pt";   
	}
	for(var k=0;k<fontsettings.length;k++){
		if(fontsettings[k].indexOf(savekey)>-1)
			fontsettings.splice(k,1);
		}
		fontsettings.push(saveval);	
		document.getElementById("fontformat").value=fontsettings;
		var settodiv=window.frames["iframe1"].document.getElementById(settoid);
		$(settodiv).css("font-size",ftsize+"pt"); 
	
	}

	function savevalues(){
		fontsettings.length=0;
		$.post("badgeLayout.php?finallayout=true",$("#finallayout").serialize(), function(data){ 
		$("#tabs").tabs('select',1); alert(data);
//	window.location.reload(); //to clear option fields upon load	
	});
};


function focuson(t){
	t.scrollIntoView();
};

$(function(){
	$("a.tooltiplink").simpletooltip({ showEffect: "show", hideEffect: "hide" , click:true});
});

function start(){
	init();
};

$(function() {
var fname = $("#cb_fieldname"),
			fvalue = $("#cb_fieldvalue"),
			allFields = $([]).add(fname).add(fvalue);
			
		function checkLength(o,n,min,max) {
			var y=o.value; 
			if ( y.length > max || y.length < min ) {
				alert("Length of " + n + " must be between "+min+" and "+max+".");
				return false;
			} else {
				return true;
			}

		};
		
		
		$("#dialog-form").dialog({
			bgiframe: true,
			autoOpen: false,
			height:200,
			width: 600,
			modal:true,
			
		closeOnEscape:true,
			buttons: {
				'Add to right of badge': function() {
					var bValid = true;
					//allFields.removeClass('ui-state-error');					
					var frmelements= new Array();
					var i; var fieldname=""; 
					ofrm=document.forms["cb_fields"]; 
					
					frmelements= document.forms["cb_fields"].elements;
					var frmlen=frmelements.length;
					for(i=0; i<frmlen; i++){
					fieldname=frmelements[i].name; 
					if(fieldname!="field side")
									bValid = bValid && checkLength(frmelements[i],fieldname,1,1000);
									}
					if (bValid) {
					var setside=document.getElementById('cb_fieldside');
						setside.value="Right";
						var field_name=document.getElementById('cb_fieldname').value;
						var sdata = $("#cb_fields").serialize(); 
						$.post("createbadgefields.php",sdata, function(data){
						if(data.indexOf("DuplicateFlag")==-1){
						alert(data); 
						if(data.indexOf(field_name)==-1 && data.indexOf("Error")==-1){
						var addtoavailableoptions=document.getElementById('ravailableOptions');
						addOption(addtoavailableoptions,field_name,field_name );
						}
						}
						else{
						if(data.indexOf("DuplicateFlag")!=-1){
						var checkupdate=confirm("Field Name already exists for this event. Click OK to update Field Value.");
						if(checkupdate){
						$.post("createbadgefields.php?action=update",sdata, function(data){alert(data);});
						}
						}
						}
						});	
						//document.forms[1].submit();						
						$(this).dialog('close');
					}
					},
				'Add to left of badge': function() {
					var bValid = true;
					//allFields.removeClass('ui-state-error');
					
					var frmelements= new Array();
					var i; var fieldname=""; 
					ofrm=document.forms["cb_fields"]; 					
					frmelements= document.forms["cb_fields"].elements;
					var frmlen=frmelements.length;
					for(i=0; i<frmlen; i++){
					fieldname=frmelements[i].name; 
					if(fieldname!="field side")
									bValid = bValid && checkLength(frmelements[i],fieldname,1,1000);
									}
									
									
					if (bValid) {
						var setside=document.getElementById('cb_fieldside');
						setside.value="Left";
						var field_name=document.getElementById('cb_fieldname').value;
						var sdata = $("#cb_fields").serialize(); 
						$.post("createbadgefields.php",sdata, function(data){
						if(data.indexOf("DuplicateFlag")==-1){
						alert(data); 
						if(data.indexOf(field_name)==-1 && data.indexOf("Error")==-1){
						var addtoavailableoptions=document.getElementById('bavailableOptions');
						addOption(addtoavailableoptions,field_name,field_name );
						}
						}
						else{
						if(data.indexOf("DuplicateFlag")!=-1){
						var checkupdate=confirm("Field Name already exists for this event. Click OK to update Field Value.");
						if(checkupdate){
						$.post("createbadgefields.php?action=update",sdata, function(data){alert(data);});
						}
						}
						}
						});	
						//document.forms[1].submit();						
						$(this).dialog('close');
					}
					},
				
					Cancel: function() {	
				$(this).dialog('close');				
				}
				},
			close: function() {
			allFields.val('').removeClass('ui-state-error');
							
			}
			
			
		});	
		
		$('#create-BFields')
			.button()
			.click(function() {
				$('#dialog-form').dialog('open');

			});

	
	});
	
	function setdefaultrole(){
	var x=document.getElementById('defatrole');
	$.post("saveData.php?action=savedefaultrole",{defaultattrole: x.value}, function(data){alert(data);});
		}
	
	function addNewAttRole(){
	var x=document.getElementById('newatrole');
	if(x.value=="") alert("Please enter new Attendee Role");
	else{
	var myregexp="^[a-zA-Z0-9_\\.\\-\\s]+$";
	if(!x.value.match(myregexp))
	alert("Please enter valid Attendee Role");
	else
	$.post("saveData.php?action=newattendeerole",{newattrole: x.value}, function(data){alert(data); window.location.reload(); var z= document.getElementById("uploaddiv"); z.focus();});
		}
		}
	
function DetectEnterPressed(e) {
	var characterCode
	if(e && e.which){ // NN4 specific code
		e = e
		characterCode = e.which
	} else {
		e = event
		characterCode = e.keyCode // IE specific code
	}
	if (characterCode == 13) 
		return true // Enter key is 13
	else 
		return false
}

</script>


<style type="text/css">		
<!--
	#leftslider span {
		width:120px; float:left; margin:10px; width:100%;
	}
	
	#rightslider span {
		width:120px; float:left; margin:10px; width:100%;
	}

	div.settings-box { width: 160px; }

	div.center { text-align: center; }
	table#container { margin-left: auto; margin-right: auto; width: 900px; }
	table#container td { text-align: left; }

	td#td1 { }

	span#leftlmargin { margin-top: -15px; margin-left: 90px; }
	span#leftrmargin { margin-top: -15px; margin-left: 90px; }
	span#lefttmargin { margin-top: -15px; margin-left: 90px; }
	span#leftbmargin { margin-top: -15px; margin-left: 90px; }
	span#rightlmargin { margin-top: -15px; margin-left: 90px; }
	span#rightrmargin { margin-top: -15px; margin-left: 90px; }
	span#righttmargin { margin-top: -15px; margin-left: 90px; }
	span#rightbmargin { margin-top: -15px; margin-left: 90px; }

-->
</style>


</head>

<body onload ="return start();" id="<?php $info = pathinfo($_SERVER['PHP_SELF']);
$file_name = basename(basename($_SERVER['PHP_SELF']), '.' . $info['extension']);
echo $file_name; ?>" >
<div id="contents"><div id="main"> 
<? php
// include 'header.php';

?>
<!-- ============ NAVIGATION BAR SECTION ============== -->
<table width="100%" id="header-container">
<tr valign="top"><td align="center" style='color:black'>
<?php
if (isset($_GET['selectedevent']) && $_GET['selectedevent'] != '') {
	$seleventid = $_GET['selectedevent'];
	$result = get_active_un_event($auth->user[user_id]);
	$enumrows = mysql_num_rows($result);
	if ($enumrows != 0) {
		$eventid = $eventname = array();
		while ($row = mysql_fetch_array($result)) {
			$eventid[].= $row['event_id'];
			$eventname[].= $row['eventname'];
			if ($row['event_id'] == $seleventid) {
				$_SESSION['seleventid'] = $seleventid;
				$_SESSION['modifyingEvent'] = $selectedevent = $row['eventname'];
				$_SESSION['eventsdate'] = $seleventsdate = $row['start_date'];
				$_SESSION['eventedate'] = $seleventedate = $row['end_date'];
				//echo "<b> "; echo "<i>You are now editing</i>: $selectedevent" ; echo"</b></td>";
				
			}
		}
		include 'header.php';
	} else echo $error = "<p style='color:white'>Unauthorized access of Event.</p>";
} else {
	if (isset($_SESSION['modifyingEvent']) && $_SESSION['modifyingEvent'] != '') {
		$selectedevent = $_SESSION['modifyingEvent'];
		include 'header.php';
	} else {
		$selectedevent = "<i>Please switch to an event to modify</i></td>";
		exit;
	}
}
?>

</tr></table>
<!-- ============ LEFT COLUMN (MENU) ============== -->
<div class="center">
<table id="container" valign="top" >
<tr>
<td valign="top" id="td1"><br>
<?php
echo ("<div align='right'><input type='button' class='submitbutton' name='clearForms' value='Clear Forms' onclick= 'clearform()'></div>");
if (isset($_GET['action']) && ($_GET['action'] == 'UploadForm')) {
	if (isset($_SESSION['modifyingEvent']) && $_SESSION['modifyingEvent'] != '') {
		if (isset($_GET['todo']) && $_GET['todo'] == 'Upload') {
			if (!isset($_FILES['uploadedfile']) || $_FILES['uploadedfile']['error'] !== UPLOAD_ERR_OK || $_FILES['uploadedfile']['tmp_name'] == '' /* || $_FILES['uploadedfile']['type'] != "application/vnd.ms-excel" */) {
//				var_dump($_FILES['uploadedfile']); die();
				if ($_FILES['uploadedfile']['error'] > 0) {
					switch ($_FILES['uploadedfile']['error']) {
						case 1:
							$eerror = 'File exceeded maximum server upload size';
						break;
						case 2:
							$eerror = 'File exceeded maximum file size';
						break;
						case 3:
							$eerror = 'File only partially uploaded';
						break;
						case 4:
							$eerror = 'No file uploaded';
						break;
					}
				}
				else
				{
					$eerror = "Enter valid file type & path. Please close the file if its open.";
				}
				$errorcount+= 1;
				setmessage($eerror, 'uploadedfile');
			}
			
			if ($errorcount > 0) {
				$attributes = array('?action=UploadForm');
				$frmsubmiturl = makeUrl($attributes);
				redirect($frmsubmiturl);
			} else {
								
				// Where the file is going to be placed
				$target_path = "AttendeeList/uploads/";
				$target_path = $target_path . basename($_FILES['uploadedfile']['name']);
								
				if (file_exists($target_path) && 0) {
					$eerror = $_FILES['uploadedfile']['name'] . " already exists.";
					setmessage($eerror, 'uploadedfile');
				} else {
															
					if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {						
						$success = "The file " . basename($_FILES['uploadedfile']['name']) . " is uploaded.<div id='instruction' style='margin-left=90px'>Click <a href='#' onclick=clearform()>refresh</a> to get access for Registration.</div>";
						setmessage($success, 'uploadedfile');
						$csvfile = $target_path;
						$eventid = $_SESSION['seleventid'];
						$databasetable = "event_" . $eventid . "_attendees";
						//		$fieldseparator = ",";
						$fieldseparator = ",";
						$lineseparator = "\n";
						//set 1 for auto increment field else 0
						$addauto = 1;
						//save query to output file
						$save = 0;
						
						$outputfile = "output.sql";
						if (!file_exists($csvfile)) {
							echo "File not found. Make sure you specified the correct path.\n";
							exit;
						}
						$file = fopen($csvfile, "r");
						if (!$file) {
							echo "Error opening data file.\n";
							exit;
						}
						$size = filesize($csvfile);
						if (!$size) {
							echo "File is empty.\n";
							exit;
						}
						$rows = array();
						ini_set('memory_limit', '200M');
						while (($row = fgetcsv($file, 100000, ',')) !== FALSE) {
							$rows[] = $row;
						}
						fclose($file);
						
						//get column no of the dropdown list fields
						for ($r = 0;$r < count($rows[0]);$r++) {
							$temp = $rows[0][$r];
							if ($temp == 'Attendee Role') $arcolumnno = $r;
							if ($temp == 'Individual Invitation Status') $iiscolumnno = $r;
							if ($temp == 'Company Invitation Status') $ciscolumnno = $r;
						}
						for ($j = 1;$j < count($rows);$j++) {
							for ($k = 0;$k < count($rows[$j]);$k++) {
								if (!isset($_SESSION['seleventid'])) die("Action cannot be taken on the selected event please close the window and re-login.");
								else {
									//check if the options are entered properly
									$eveid = $_SESSION['seleventid'];
									if ($k == $arcolumnno) {
										/*$optionsarr=get_ar_options($eveid);
										                              for($t=0;$t<count($optionsarr);$t++){
										                              $nospacestr = str_replace(' ','', $optionsarr[$t]);
										                              $nospacesoptions[$nospacestr]=$optionsarr[$t];
										                              }
										                              if(!in_array(strtolower($rows[$j][$k]),$optionsarr)){
										                              if(!array_key_exists(str_replace(' ','',strtolower($rows[$j][$k])),$nospacesoptions)){
										                              $eerror="'Attendee Role' '".$rows[$j][$k]."' does not adhere to the requirement. Please correct it and upload again";
										                              unset($_SESSION['uploadedfile']);
										                              unlink($csvfile);
										                              //delete any records that were uploaded
										                              removeuploadedrecords($eveid);
										                              die($eerror);
										                              }
										                              else
										                              $rows[$j][$k]=ucwords($nospacesoptions[strtolower($rows[$j][$k])]);
										                              }*/
									} else {
										if ($k == $iiscolumnno) {
											$optionsarr = array_map('strtolower', get_iis_options($eveid));
											for ($t = 0;$t < count($optionsarr);$t++) {
												$nospacestr = str_replace(' ', '', $optionsarr[$t]);
												$nospacesoptions[$nospacestr] = $optionsarr[$t];
											}
											
											if (!in_array(strtolower($rows[$j][$k]), $optionsarr)) {
//												if (!array_key_exists(str_replace(' ', '', strtolower($rows[$j][$k])), $nospacesoptions)) {
												if (!array_key_exists(str_replace(' ', '', strtolower($rows[$j][$k])), $nospacesoptions)) {
													
													$eerror = "'Individual Invitation Status' '" . $rows[$j][$k] . "' does not adhere to the requirement. Please correct it and upload again";
													unset($_SESSION['uploadedfile']);
													unlink($csvfile);
													//delete any records that were uploaded
													removeuploadedrecords($eveid);
													die($eerror);
												}
												else
												{
													//$rows[$j][$k] = ucwords($nospacesoptions[strtolower($rows[$j][$k]) ]);
													//$rows[$j][$k] = ucwords($nospacesoptions[$rows[$j][$k]]);
												}
											}
										} else {
											if ($k == $ciscolumnno) {
												$optionsarr = array_map('strtolower', get_cis_options($eveid));
												for ($t = 0;$t < count($optionsarr);$t++) {
													$nospacestr = str_replace(' ', '', $optionsarr[$t]);
													$nospacesoptions[$nospacestr] = $optionsarr[$t];
												}
												if (!in_array(strtolower($rows[$j][$k]), $optionsarr) && $rows[$j][$k] != '') {
//													if (!array_key_exists(str_replace(' ', '', strtolower($rows[$j][$k])), $nospacesoptions)) {
													if (!array_key_exists(str_replace(' ', '', strtolower($rows[$j][$k])), $nospacesoptions)) {														
														$eerror = "'Company Invitation Status' '" . $rows[$j][$k] . "' does not adhere to the requirement. Please correct it and upload again";
														unset($_SESSION['uploadedfile']);
														unlink($csvfile);
														//delete any records that were uploaded
														removeuploadedrecords($eveid);
														die($eerror);
													}
													else
													{
														//$rows[$j][$k] = ucwords($nospacesoptions[strtolower($rows[$j][$k]) ]);

														//$rows[$j][$k] = $nospacesoptions[$rows[$j][$k]];														
													}
													
												}
											}											
// 											else
// 											{
// 												$rows[$j][$k] = mysql_real_escape_string($rows[$j][$k]);
// 											}
										}
									}
								}
							}
							
							foreach ($rows[$j] as $key => $value)
							{
								$rows[$j][$key] = mysql_real_escape_string($value);
							}
							$linemysql = implode("','", $rows[$j]);
							
							if ($addauto) {
								$query =  "insert ignore into $databasetable values('','$eventid','Pre-Reg','$linemysql');";
							} else {
								$query = "insert ignore into $databasetable values('$eventid','Pre-Reg','$linemysql');";
							}
							$queries.= $query . "\n";
							$resultq = downloadFileData($query, $databasetable, $rows[$j]);
							if (!$resultq) {
								unlink($csvfile);
								unset($_SESSION['uploadedfile']);
								die("<font color=red>Data download was not successful.Please ensure that the uploaded file adheres to the template. If not please download the template and fill accordingly. </font><br><font color=blue>Click on 'Clear forms' button to go back</font>");
							}
						}
						if ($save) {
							if (!is_writable($outputfile)) {
								echo "File is not writable, check permissions.\n";
							} else {
								$file2 = fopen($outputfile, "w");
								if (!$file2) {
									echo "Error writing to the output file.\n";
								} else {
									fwrite($file2, $queries);
									fclose($file2);
								}
							}
						}
					} else {
						
						if (is_writable($target_path)) {
							
							$eerror = "There was an error uploading the file, please try again!";
							setmessage($eerror, 'uploadedfile');
						} else {
							
							$eerror = "Upload directory: $target_path not writable";
							setmessage($eerror, 'uploadedfile');
						}						
					}					
					$result = extractoptions($eventid, $databasetable);
				
					$attributes = array('?action=UploadForm');
					$frmsubmiturl = makeUrl($attributes);
					//	redirect($frmsubmiturl);
					
				}
			}
		}
	}
}
function setmessage($var, $field) {
	$_SESSION["$field"] = $var;
}
$fnmessage = $nfnmessage = " ";
$form_validate = new formValidator();
if (isset($_GET['action']) && ($_GET['action'] == 'ManageFormFields')) {
    if (get_magic_quotes_gpc()) {
        $_GET = array_map('stripslashes', $_GET);
        $_POST = array_map('stripslashes', $_POST);
        $_COOKIE = array_map('stripslashes', $_COOKIE);
    }

    if (isset($_GET['todo'])) {
        $Todo = $_GET['todo'];
        switch ($Todo) {
			case 'add':
				if (isset($_POST['Fieldname']) && isset($_POST['Fieldtype']))
				{
					$fnmessage = $form_validate->validateEmpty('Fieldname', 'Fieldname is empty. ', 1, 500);
					$fnmessage.= $form_validate->validateFormfield('Fieldname', 'Please enter valid fieldname');                        
					$errors = $form_validate->checkErrors();
					if (! ($fnmessage == "" && ! $errors))
					{
						echo $form_validate->displayErrors();
						break;
					}
					else
					{
						$fieldname = sanitizeString($_POST['Fieldname']);

						if ((strcasecmp($_POST['Fieldtype'], TYPE3) === 0) || 
							(strcasecmp($_POST['Fieldtype'], TYPE8) === 0) ||
							(strcasecmp($_POST['Fieldtype'], TYPE5) === 0) ||
							(strcasecmp($_POST['Fieldtype'], TYPE10) === 0))
							
						{
							$form_validate->validatefieldoptions('client_options', "Sorry, the system was unable to create field <i>{$fieldname}</i> as a drop-down list of options.  Please try again, specifying the field and its options.");
							$errors = $form_validate->checkErrors();
							if (! ($fnmessage == "" && ! $errors))
							{
								echo $form_validate->displayErrors();
								break;
							}
							else
							{
								$options = trim($_POST['client_options']);
								$options = array_unique(explode("\n", $options));
							
								foreach ($options as $key => $value)
								{
									$options[$key] = trim($value);
								}
								
								$success = addNewFieldwOpt($fieldname, $options, $_POST['Fieldtype']);
							}
						}
						else
						{
							$success = addNewField($fieldname, $_POST['Fieldtype']);
						}

						if ($success) {
							$fnmessage = "Field is successfully added";
						} else {
							$fnmessage = "Unsuccessful action: Fieldname already exists/Event is not selected to edit/Options are not added successfully. Please try again.";
						}

						$_SESSION['message'] = $fnmessage;
						$attributes = array('?action=ManageFormFields');
						$frmsubmiturl = makeUrl($attributes);
						//redirect($frmsubmiturl);
					}
				}
				break;
			case 'renameorigin': /*
				            if(isset($_GET['selected']) && isset($_GET['newvalue'])){
				            $_POST['oldValue']= $_GET['selected'];
				            $_POST['newValue']=$_GET['newvalue'];
				            $nfnmessage=$form_validate->validateEmpty('newValue','New Field name is empty. ',1,40);
				            $nfnmessage.=$form_validate->validateFormfield('newValue','Please enter valid alphabetic/alphanumeric fieldname');
				            if($nfnmessage==""){
				            $newfieldname = sanitizeString($_GET['newvalue']);
				            $oldfieldname = sanitizeString($_GET['selected']);
				            $success=updateField($oldfieldname, $newfieldname);
				            if($success){
				            $nfnmessage="Fieldname is successfully updated";}
				            else{$nfnmessage="Fieldname could not be updated at origin. Please try again later.";}
				            }
				            
				            $_SESSION['nfnmessage'] = $nfnmessage;
				            $attributes=array('?action=ManageFormFields');
				            $frmsubmiturl=makeUrl($attributes);
				            redirect($frmsubmiturl);
				            }
				            break;*/
			case 'renamedisplay':
				if (isset($_GET['selected']) && isset($_GET['newvalue'])) {
					$_POST['oldValue'] = $_GET['selected'];
					$_POST['newValue'] = $_GET['newvalue'];
					$dnfnmessage = $form_validate->validateEmpty('newValue', 'New Field name is empty. ', 1, 40);
					$dnfnmessage.= $form_validate->validateFormfield('newValue', 'Please enter valid alphabetic/alphanumeric fieldname');
					if ($dnfnmessage == "") {
						$dnewfieldname = sanitizeString($_GET['newvalue']);
						$doldfieldname = sanitizeString($_GET['selected']);
						$dnewfieldnameq = "'$dnewfieldname'";
						$doldfieldnameq = "'$doldfieldname'";
						$eveid = $_SESSION['seleventid'];
						/*
						                  $file_name="RenameFields/renamedfields_".$eveid.".php";
						                  
						                  include "'".$file_name."'";
						                  $stringtowrite= '$renamedfields['."$doldfieldnameq".']='."$dnewfieldnameq".'';
						                  $file=fopen($file_name,"r+");
						                  if(!$file)$dnfnmessage="File Could not be opened.";
						                  fseek ( $file,0, SEEK_END);
						                  $high = ftell($file);
						                  $high=$high-3;
						                  fseek ( $file,$high);
						                  fwrite($file,$stringtowrite."; \r\n ?>");*/
						/*fwrite($file,"define('".strtoupper($doldfieldname)."','".$dnewfieldname."');\r\n?>");*/
						//fclose($file);
						//require $file_name;
						$add_res = add_renamedfield($doldfieldnameq, $dnewfieldnameq, $eveid);
						//		if(array_key_exists ("$doldfieldname",$renamedfields)){
						if ($add_res) {
							$dnfnmessage = "Fieldname is successfully updated";
						} else {
							$dnfnmessage = "Fieldname could not be updated for display. Please try again later.";
						}
					}
					$_SESSION['dnfnmessage'] = $dnfnmessage;
					$attributes = array('?action=ManageFormFields');
					$frmsubmiturl = makeUrl($attributes);
					//	redirect($frmsubmiturl);
					
				}
				break;
			}
	}
}
echo "
<script language='javascript'>
function EnableDisableField(id){
var selels= document.getElementById(id);
if(selels.checked==true){
document.getElementById('Enable').value='true';
document.getElementById('Disable').value='false';
var lavopts=document.getElementById('bavailableOptions'); 
addOption(lavopts,selels.value,selels.value );
var ravopts=document.getElementById('ravailableOptions'); 
addOption(ravopts,selels.value,selels.value );
}
else{
document.getElementById('Disable').value='true';
document.getElementById('Enable').value='false';
var lavopts=document.getElementById('bavailableOptions'); 
removeOption(lavopts,selels.value);
var ravopts=document.getElementById('ravailableOptions'); 
removeOption(ravopts,selels.value);

}

document.getElementById('EnFormField').value=id;
$.post('updateFields.php',$('#form1').serialize(), function(data){
document.getElementById('Enable').value='false';
document.getElementById('Disable').value='false';

});
}


</script>
";
$urlAttributes = array('?action=EnableFormfields');
$url = makeUrl($urlAttributes);
$g_addform = new formGenerator($name = 'EnDisForm', $action = $url, $method = 'post', $formId = "form1");
$g_addform->addFormPart("<fieldset style='width:90%; height:300px' ><legend><b>Enable/Disable Existing Form Fields</b></legend><br>");
$g_addform->addFormPart("<a href='#EnDis' class='tooltiplink' >Help?</a><div id='EnDis'><p>
<p style='text-align:right'><a href='#' rel='close'>Close x</a></p>
1. Check to enable a form field to be included in the Registration form<br><br>
2. Uncheck to disable the form field. Unchecked form field will not appear on the Registration form 

</p></div>");
$g_addform->addFormPart("<br><div style='margin-left:30'><br>");
$g_addform->addElement('hidden', array('name' => 'EnFormField', 'id' => 'EnFormField'), array());
$g_addform->addElement('hidden', array('name' => 'Enable', 'id' => 'Enable'), array());
$g_addform->addElement('hidden', array('name' => 'Disable', 'id' => 'Disable'), array());

/*
 *   IMPROVEMENT - 2011_0905 - Javier R.
 *      move all includes to the top of file or code block.
 *      This will help with lost includes which in this case define TYPEs
 */
//get default fields
include "properties.php";
for ($r = 0;$r < count($defaultfields);$r++) {
	for ($t = 0;$t < count($defaultfields[$r]);$t++) {
		if ($t == 0) $deffields[$r].= $defaultfields[$r][$t];
	}
}
//get assigned fields
$result = get_group_formfields("Registrar");
if ($result != '') {
	$gfnumrows = mysql_num_rows($result);
	$gffieldoptions = array();
	if ($gfnumrows == 0) {
		$_SESSION['msgff'] = "Formfileds are not assigned.";
		if (isset($_SESSION['msgff'])) {
			$msg = $_SESSION['msgff'];
			$g_addform->addFormPart('<font color=red><small><i>' . $msg . '</i></small></font>');
			unset($_SESSION['msgff']);
		}
	} else {
		while ($row = mysql_fetch_array($result)) {
			$gffieldoptions[].= $row['fieldname'];
		}
		for ($j = 0;$j < count($gffieldoptions);$j++) {
			$assignedfieldoptions[$j] = $gffieldoptions[$j];
		}
	}
}
//get all fields
$resultall = get_all_formfields_id();
if ($resultall != '') {
	$gfnumrowsall = mysql_num_rows($resultall);
	$gffieldoptionsall = array();
	if ($gfnumrowsall == 0) {
		$_SESSION['msg'] = "Form Fields are not available for this event";
	} else {
		$g_addform->addFormPart("<div style='height:250px;width=50%;border:1px solid #000; overflow:auto; margin-left:20px'>");
		$g_addform->addFormPart('<table>');
		$gffieldoptionsall = $gffieldoptionsallid = '';
		while ($row = mysql_fetch_assoc($resultall)) {
			$gffieldoptionsallid = $row['formfield_id'];
			$gffieldoptionsallfn = $row['fieldname'];
			if (in_array($gffieldoptionsallfn, $assignedfieldoptions) && in_array($gffieldoptionsallfn, $deffields)) $g_addform->addFormPart('<tr><td align="center"><input id=selected:' . $gffieldoptionsallid . ' type=checkbox name="selectedFields" checked="checked" disabled ></td><td>' . $gffieldoptionsallfn . '</td></tr>');
			else {
				if (in_array($gffieldoptionsallfn, $assignedfieldoptions)) {
					$eveid = $_SESSION['seleventid'];
					/*
					               $file_name="RenameFields/renamedfields_".$eveid.".php";
					               include $file_name;  */
					$renamedfields = get_all_renamedfields($eveid);
					if (array_key_exists($gffieldoptionsallfn, $renamedfields)) {
						if (array_search($gffieldoptionsallfn, $renamedfields)) {
							$tempkey = array_search($gffieldoptionsallfn, $renamedfields);
							if ($tempkey == $renamedfields["$gffieldoptionsallfn"]) $gffieldoptionsallfn = $renamedfields["$tempkey"];
							else $gffieldoptionsallfn = $renamedfields["$gffieldoptionsallfn"];
						} else $gffieldoptionsallfn = $renamedfields["$gffieldoptionsallfn"];
					}
					$g_addform->addFormPart('<tr><td align="center"><input id=selected:' . $gffieldoptionsallid . ' type=checkbox name="selectedFields" checked="checked"  value="' . $gffieldoptionsallfn . '" onclick="EnableDisableField(this.id)" ></td><td>' . $gffieldoptionsallfn . '</td></tr>');
				} else {
					$eveid = $_SESSION['seleventid'];
					/*$file_name="RenameFields/renamedfields_".$eveid.".php";
					 include $file_name;  */
					$renamedfields = get_all_renamedfields($eveid);
					if (array_key_exists($gffieldoptionsallfn, $renamedfields)) {
						if (array_search($gffieldoptionsallfn, $renamedfields)) {
							$tempkey = array_search($gffieldoptionsallfn, $renamedfields);
							if ($tempkey == $renamedfields["$gffieldoptionsallfn"]) $gffieldoptionsallfn = $renamedfields["$tempkey"];
							else $mfieldoptions[$t] = $renamedfields["$gffieldoptionsallfn"];
						} else $gffieldoptionsallfn = $renamedfields["$gffieldoptionsallfn"];
					}
					$g_addform->addFormPart('<tr><td align="center"><input id=selected:' . $gffieldoptionsallid . ' type=checkbox name="selectedFields"  value= "' . $gffieldoptionsallfn . '" onclick="EnableDisableField(this.id)" ></td><td>' . $gffieldoptionsallfn . '</td></tr>');
				}
			}
		}
		$g_addform->addFormPart('</table>');
		$g_addform->addFormPart("</div>");
		$g_addform->addFormPart();
	}
} else $_SESSION['msg'] = "To Edit, please select an Event.";
$g_addform->addFormPart("</div></fieldset><br><br>");
echo $g_addform->display();
echo '<br>';
//Manage Formfields
$urlAttributes = array('?action=ManageFormFields', '&todo=rename');
$url = makeUrl($urlAttributes);
$m_addform = new formGenerator($name = 'ManageFields', $action = $url, $method = 'post', $formId = 0);
$m_addform->addFormPart("<fieldset style='width:90%'><legend><b>Manage Form Fields</b></legend><div style='margin-left:30'><br>");
$m_addform->addFormPart("<a href='#ManageFF'  class='tooltiplink'>Help?</a><div id='ManageFF'  ><p>
<p style='text-align:right'><a href='#' rel='close'>Close x</a></p>
1. Create a new form field with its type and options if any<br><br>
2. Rename a form field to change its display name on Registration form
</p></div>");
$m_addform->addFormPart('');
if (isset($_SESSION['message'])) {
	$fnmessage = $_SESSION['message'];
}
$m_addform->addFormPart('<font color=red><small><i>' . $fnmessage . '</i></small></font>');
unset($_SESSION['message']);
$m_addform->addFormPart('');
$m_addform->addFormPart("<div style='background-color:#EBEBEB; width:580px'>");
$m_addform->addFormPart('Create new field:');
$m_addform->addFormPart('');
$m_addform->addFormPart('Field Name&nbsp;&nbsp;');
$m_addform->addElement('text', array('name' => 'Fieldname'), array());
$m_addform->addFormPart('&nbsp;Field Type&nbsp;&nbsp;');
$typearray = array(TYPE1, TYPE6, TYPE2, TYPE3, TYPE7, TYPE8, TYPE4, TYPE9, TYPE5, TYPE10); 
//$typearray = array(TYPE1, TYPE6, TYPE2, TYPE7, TYPE3, TYPE8); 
$m_addform->addElement('select', array('name' => 'Fieldtype'), $typearray);
$m_addform->addFormPart('&nbsp;&nbsp;&nbsp;');
$m_addform->addElement('submit', array('class' => 'submitbutton', 'name' => 'Add', 'value' => 'Create Field', 'onclick' => 'validatefield(this.form)'), array());
$m_addform->addFormPart('&nbsp;&nbsp;&nbsp;');
$m_addform->addFormPart('');
/*
 *   IMPROVEMENT - 2011_0905 - Javier R.
 *      Comment this out. These form fields should only show up if we are selecting
 *      dropdown types (TYPE8/TYPE3). Otherwise it becomes unneccessary. * 
 */
/*
$showhide = "showhide('div1');";
$m_addform->addFormPart('<div onclick="' . $showhide . '"><button type="button" style="width:185px;margin-left:60px"><small>Create dropdown options for new field</small></button></div>');
$m_addform->addFormPart('<div id="div1" style="display: none;margin-left:70" >');
$m_addform->addElement('text', array('id' => 'option1', 'name' => 'option1'), array());
$m_addform->addFormPart();
$m_addform->addElement('text', array('id' => 'option2', 'name' => 'option2'), array());
$m_addform->addFormPart();
$m_addform->addElement('text', array('id' => 'option3', 'name' => 'option3'), array());
$m_addform->addFormPart();
$m_addform->addElement('text', array('id' => 'option4', 'name' => 'option4'), array());
$m_addform->addFormPart();
$m_addform->addElement('text', array('id' => 'option5', 'name' => 'option5'), array());
$m_addform->addFormPart();
$m_addform->addElement('text', array('id' => 'option6', 'name' => 'option6'), array());
$m_addform->addFormPart();
$m_addform->addElement('text', array('id' => 'option7', 'name' => 'option7'), array());
$m_addform->addFormPart();
$m_addform->addElement('text', array('id' => 'option8', 'name' => 'option8'), array());
$m_addform->addFormPart();
$m_addform->addFormPart('</div></div>');
 */
/*
 *      IMPROVEMENT - 2011_0905 - Javier R.
 *          Use a text area instead. This needs to be improved upon.
 */
$m_addform->addFormPart('<div style="display: block; margin-left: 70">');
$m_addform->addFormPart();
$m_addform->addFormPart('If field is a drop-down list, please specify options (one per line):</br>');
$m_addform->addElement('textarea', array('name'=>'client_options', 'rows'=>7, 'cols'=>30));
$m_addform->addFormPart(); 
$m_addform->addFormPart('</div>');
$m_addform->addFormPart('</div>');

$m_addform->addFormPart();
$m_addform->addFormPart();
$m_addform->addFormPart("<div style='background-color:#EBEBEB; width:580px'>");
$m_addform->addFormPart("Rename Fields:");
$m_addform->addFormPart('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
if (isset($_SESSION['nfnmessage'])) {
	$nfnmessage = $_SESSION['nfnmessage'];
}
$m_addform->addFormPart('<font color=red><small><i>' . $nfnmessage . '</i></small></font>');
unset($_SESSION['nfnmessage']);
if (isset($_SESSION['dnfnmessage'])) {
	$nfnmessage = $_SESSION['dnfnmessage'];
}
$m_addform->addFormPart('<font color=red><small><i>' . $nfnmessage . '</i></small></font>');
unset($_SESSION['dnfnmessage']);
$m_addform->addFormPart();
$m_addform->addFormPart('<table><tr><td>Created Field Names </td><td>');
$result = get_all_formfields();
$mnumrows = mysql_num_rows($result);
$mfieldoptions = '';
if ($mnumrows == 0) {
	$nofields = true;
	$mfieldoptions = array('[0]' => 'Form fields are not available for this event');
}
//$mfieldoptions = "No fields available";
else {
	$mfieldoptions = array('[0]' => 'Select');
	while ($row = mysql_fetch_assoc($result)) {
		$mfieldoptions[].= $row['fieldname'];
	}
}
function multiarray_keys($ar) {
	$vals = array_values($ar);
	for ($r = 0;$r < count($vals);$r++) {
		$elkeys.= $vals[$r][0];
		$elkeys.= ",";
	}
	return $elkeys;
}
require_once "properties.php";
$defaultfieldslist = explode(",", multiarray_keys($defaultfields));
/*for($n=0;$n<count($mfieldoptions);$n++){
if (in_array($mfieldoptions[$n],$defaultfieldslist)) 
unset($mfieldoptions[$n]);
}*/
$diff = array_diff($mfieldoptions, $defaultfieldslist);
//array key will be different, merge to make them sequential.
$mfieldoptions = array_merge($diff);
//check if name exists in renamed fields
$eveid = $_SESSION['seleventid'];
/*$file_name="RenameFields/renamedfields_".$eveid.".php";
 include $file_name;  */
$renamedfields = get_all_renamedfields($eveid);
for ($t = 0;$t < count($mfieldoptions);$t++) {
	if (array_key_exists($mfieldoptions[$t], $renamedfields)) {
		if (array_search($mfieldoptions[$t], $renamedfields)) {
			$tempkey = array_search($mfieldoptions[$t], $renamedfields);
			if ($tempkey == $renamedfields["$mfieldoptions[$t]"]) $mfieldoptions[$t] = $renamedfields["$tempkey"];
			else $mfieldoptions[$t] = $renamedfields["$mfieldoptions[$t]"];
		} else $mfieldoptions[$t] = $renamedfields["$mfieldoptions[$t]"];
	}
}
$m_addform->addElement('select', array('name' => 'oldValue'), $mfieldoptions);
$m_addform->addFormPart('</td></tr><tr><td>');
$m_addform->addFormPart('New Field Name</td><td>');
if (isset($nofields)) $m_addform->addElement('text', array('name' => 'newValue', 'size' => '24', 'disabled' => 'disabled'), array());
else $m_addform->addElement('text', array('name' => 'newValue', 'size' => '24'), array());
$m_addform->addFormPart('</td></tr></table>');
$m_addform->addFormPart('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
/*$m_addform->addElement('button',array('id'=>'rename','class'=>'submitbutton','name'=>'rename','value'=> 'Rename at origin','onclick'=>'submitform(this.form)'),array());*/
$m_addform->addFormPart('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
$m_addform->addElement('button', array('class' => 'submitbutton', 'style' => 'width:150', 'name' => 'rename', 'value' => 'Rename for display', 'onclick' => 'return valform(this.form);'), array());
$m_addform->addFormPart();
$m_addform->addFormPart('</div>');
//display form
echo $m_addform->display();
echo "</div></fieldset><br><br>";
//Upload file
echo "<fieldset style='width:90%'><legend><b>Upload Attendee List</b></legend><div id='uploaddiv' style='margin-left:30'>";
$urlAttributes = array('?action=UploadForm&todo=Upload');
$url = makeUrl($urlAttributes);
$upl_addform = new formGenerator($name = 'UploadForm', $action = $url, $method = 'post', $formId = 2);
//$upl_addform->addFormPart("<fieldset style='width:90%'><legend><b>Upload Attendee List</b></legend><div id='uploaddiv' style='margin-left:30'>");
$upl_addform->addFormPart('');
$upl_addform->addFormPart("<a href='#UploadHelp' class='tooltiplink'>Help?</a><div id='UploadHelp'><p>
<p style='text-align:right'><a href='#' rel='close'>Close x</a></p>
1. Download the template of chosen fields<br>
2. Save it as a '*.csv' file. example: 'eventname_testfile.csv'<br>
3. Ensure filetype is CSV in filetype option of the save dialog box<br>
4. Save the file<br>
5. Upload the saved file<br>
</p></div>");
$tempseleventid = $_SESSION['seleventid'];
$upl_addform->addFormPart('<a href="downloadTemplate.php?action=UploadForm&todo=download&eventselected=' . $tempseleventid . '">Download template</a>');
$upl_addform->addFormPart('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick=window.open("downloadTemplate.php?action=UploadForm&todo=UploadRequirements&eventselected=' . $tempseleventid . '","","toolbars=no,menubar=no,location=no,scrollbars=yes,resizable=yes,status=yes,width=900,height=700")>Requirements to fill the template</a><br>');
$upl_addform->addFormPart();
$eveuperror = $esuccess = '';
$error = false;
if (isset($_SESSION['eveupsuccess'])) {
	$esuccess = $_SESSION['eveupsuccess'];
	$error = true;
}
$upl_addform->addFormPart('<font color=red><small><i>' . $esuccess . '</i></small></font>');
unset($_SESSION['eveupsuccess']);
$upl_addform->addElement('hidden', array('name' => 'MAX_FILE_SIZE', 'value' => '8000000'), array());
$upl_addform->addFormPart('Upload File&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
if (!checkfileuploaded($tempseleventid)) $upl_addform->addElement('file', array('name' => 'uploadedfile'), array());
else $upl_addform->addElement('file', array('name' => 'uploadedfile', 'disabled' => 'disabled'), array());
if (isset($_SESSION['uploadedfile'])) {
	$eveuperror = $_SESSION['uploadedfile'];
	$upl_addform->addFormPart('<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red><small><i>' . $eveuperror . '</i></small></font>');
	$error = true;
	unset($_SESSION['uploadedfile']);
}
$upl_addform->addFormPart();
$upl_addform->addFormPart('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
if (!checkfileuploaded($tempseleventid)) $upl_addform->addElement('submit', array('class' => 'submitbutton', 'name' => 'upload', 'value' => 'Upload'), array());
else {
	$upl_addform->addElement('submit', array('class' => 'submitbutton', 'name' => 'upload', 'value' => 'Upload', 'disabled' => 'disabled'), array());
	//choose default attendee role
	$choosedefault = true;
}
$upl_addform->addFormPart();
$upl_addform->addFormPart('<div id="instruction"><small><b><i>Allowed file type: CSV.</i></b></small></div>');
if ($choosedefault) {
	$upl_addform->addFormPart("<br>Choose default Attendee Role&nbsp;&nbsp;&nbsp;");
	//get Attendee Roles
	$aroptions = get_aroptions($tempseleventid);
	//remove any blank role
	/*$emparray=array('0'=>'');
	   $aroptions=array_diff($aroptions,$emparray);
	   $aroptions=array_values($aroptions);
	   for($r=0;$r<count($aroptions);$r++){
	   $aroptions[$r]=ucwords($aroptions[$r]);
	   }*/
	$upl_addform->addElement('select', array('id' => 'defatrole', 'name' => 'defaultattrole', 'onchange' => 'setdefaultrole()'), $aroptions);
	$upl_addform->addFormPart("<br><br>");
}
//$upl_addform->addFormPart("</div></fieldset><br><br>");
echo $upl_addform->display();
$upl2_addform = new formGenerator($name = 'NewAttForm', $action = "#", $method = 'post', $formId = 'newatt');
$upl2_addform->addFormPart("Add New Attendee Role&nbsp;&nbsp;&nbsp;");
$upl2_addform->addElement('text', array('id' => 'newatrole', 'name' => 'newattrole'), array());
$upl2_addform->addElement('button', array('class' => 'submitbutton', 'name' => 'new_att', 'value' => 'Add', 'onClick' => 'addNewAttRole()'), array());
$upl2_addform->addFormPart("<br><br>");
echo $upl2_addform->display();
echo "</div></fieldset><br><br>";
if ($error) echo "<script language='javascript' defer>var x= document.getElementById('uploaddiv'); x.scrollIntoView();</script>";
//Badge Layout
echo ' 
<fieldset style="width:90%;"><legend><b>Badge Layout</b></legend> 
<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1" >Select Badge Fields</a></li>
		<li><a href="#tabs-2" >Preview</a></li>
				
	</ul>
	<div id="tabs-1"><p>';
echo '<div id="dialog-form" title="Create additional badge fields">';
$uAttributes = array('?todo=CBfields');
$url = makeUrl($uAttributes);
$cbf_addform = new formGenerator($name = 'CB_Fields', $action = $url, $method = 'post', $formId = "cb_fields");
$cbf_addform->addElement('hidden', array('id' => 'cb_fieldside', 'name' => 'field side'), array());
$cbf_addform->addFormPart('<table width=100%><tr><td>Field Name</td><td> ');
$cbf_addform->addElement('text', array('id' => 'cb_fieldname', 'name' => 'field name', 'class' => 'text ui-widget-content ui-corner-all'), array());
$cbf_addform->addFormPart('</td><tr><td>Field Value</td><td>');
$cbf_addform->addElement('textarea', array('id' => 'cb_fieldvalue', 'name' => 'field value', 'rows' => 7, 'cols' => 40, 'class' => 'textarea ui-widget-content ui-corner-all'), array());
$cbf_addform->addFormPart('</td></tr></table>');
echo $cbf_addform->display();
echo "</div>";
//echo '<button id="create-BFields">Create additional badge fields</button>';
$b_addform = new formGenerator($name = 'BadgeForm', $action = 'javascript:void(0)', $method = 'post', $formId = 3);
//$b_addform->addFormPart("<fieldset style='width:90%;'><legend><b>Badge Layout</b></legend><div id='containment-wrapper'>");
$beventid = $_SESSION['seleventid'];
//$b_addform->addFormPart('<div class="demo">');
$bresultall = get_group_formfields("Registrar");
if ($bresultall != '') {
	$bfnumrowsall = mysql_num_rows($bresultall);
	$bffieldoptionsall = array();
	if ($bfnumrowsall == 0) {
		$_SESSION['bmsg'] = "Formfields are not available for this event";
		$_SESSION['bdefaultfieldsadd'] = true;
	} else {
		$bffieldoptionsall = array('[0]' => 'Select');
		while ($row = mysql_fetch_assoc($bresultall)) {
			$bffieldoptionsall[].= $row['fieldname'];
		}
		for ($j = 0;$j < count($bffieldoptionsall) - 1;$j++) {
			$bfieldoptionsall[$j] = $bffieldoptionsall[$j];
		}
		//badge left fields
		//get selected fields
		$result = getSelectedFields($beventid);
		$num_rows = mysql_num_rows($result);
		$leftarray = $rightarray = array();
		if ($num_rows > 0) {
			while ($row = mysql_fetch_array($result)) {
				$templeft = $row["left_fields"];
				if (strpos($templeft, ",") > - 1) $leftarray = explode(',', $templeft);
				else $leftarray[].= $templeft;
				$tempright = $row["right_fields"];
				if (strpos($tempright, ",") > - 1) $rightarray = explode(',', $tempright);
				else $rightarray[].= $tempright;
			}
			$diff_l_fields = array_diff($bfieldoptionsall, $leftarray);
			//array key will be different, merge to make them sequential.
			$l_fds = array_merge($diff_l_fields);
			$diff_r_fields = array_diff($bfieldoptionsall, $rightarray);
			$r_fds = array_merge($diff_r_fields);
		} else {
			$l_fds = $r_fds = $bfieldoptionsall;
		}
		//get extrafields
		$result = getExtraFields($beventid);
		$num_rows = mysql_num_rows($result);
		if ($num_rows > 0) {
			while ($row = mysql_fetch_array($result)) {
				if ($row['badgeside_flag'] == "Left") $l_fds[].= $row['fieldname'];
				else {
					if ($row['badgeside_flag'] == "Right") $r_fds[].= $row['fieldname'];
				}
			}
		}
		//remove fields from available options that are also in selected
		for ($l = 0;$l < count($leftarray);$l++) {
			if (in_array($leftarray[$l], $l_fds)) {
				$l_fds = array_diff($l_fds, $leftarray);
			}
		}
		for ($r = 0;$r < count($rightarray);$r++) {
			if (in_array($rightarray[$r], $r_fds)) {
				$r_fds = array_diff($r_fds, $rightarray);
			}
		}
		//check if fields are renamed for left fields
		$renamedfields = get_all_renamedfields($eveid);
		for ($t = 0;$t < count($l_fds);$t++) {
			if (array_key_exists($l_fds[$t], $renamedfields)) {
				if (array_search($l_fds[$t], $renamedfields)) {
					$tempkey = array_search($l_fds[$t], $renamedfields);
					if ($tempkey == $renamedfields["$l_fds[$t]"]) $l_fds[$t] = $renamedfields["$tempkey"];
					else $l_fds[$t] = $renamedfields["$l_fds[$t]"];
				} else $l_fds[$t] = $renamedfields["$l_fds[$t]"];
			}
		}
		//check if fields are renamed for right fields
		for ($t = 0;$t < count($r_fds);$t++) {
			if (array_key_exists($r_fds[$t], $renamedfields)) {
				if (array_search($r_fds[$t], $renamedfields)) {
					$tempkey = array_search($r_fds[$t], $renamedfields);
					if ($tempkey == $renamedfields["$r_fds[$t]"]) $r_fds[$t] = $renamedfields["$tempkey"];
					else $r_fds[$t] = $renamedfields["$r_fds[$t]"];
				} else $r_fds[$t] = $renamedfields["$r_fds[$t]"];
			}
		}
		$b_addform->addFormPart("<div id='instruction'><small><b> *Please select fields for both side of the badge and then save the fields. Hold CTRL or SHIFT key to select multiple fields.</b></small></div><br><br>");
		$b_addform->addFormPart("<br>");
		$b_addform->addFormPart("<table><tr><td><font style='text-align:center'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Left of Badge</b></font><br><br>");
		$b_addform->addElement('hidden', array('name' => 'bOptionsselected', 'id' => 'bOptSel'), array());
		$b_addform->addElement('select', array('name' => 'bavailableOptions', 'id' => 'bavailableOptions', 'size' => '5', 'multiple' => 'multiple'), $l_fds);
		$b_addform->addElement('select', array('name' => 'bselectedOptions', 'id' => 'bselectedOptions', 'size' => '5', 'multiple' => 'multiple'), $leftarray);
		$b_addform->addFormPart('</td><td width=50px></td><td><font style=text-align:center><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Right of Badge</b></font><br><br>');
		//badge right fields
		$b_addform->addElement('hidden', array('name' => 'rOptionsselected', 'id' => 'rOptSel'), array());
		$b_addform->addElement('select', array('name' => 'ravailableOptions', 'id' => 'ravailableOptions', 'size' => '5', 'multiple' => 'multiple'), $r_fds);
		$b_addform->addElement('select', array('name' => 'rselectedOptions', 'id' => 'rselectedOptions', 'size' => '5'), $rightarray);
		$b_addform->addFormPart('</td></tr></table>');
	}
} else $_SESSION['bmsg'] = "To Edit, please select an Event.";
$b_addform->addFormPart('<button id="create-BFields" class="submitbutton">Add custom text</button><br>');
$b_addform->addFormPart('<div id="instruction"><small><b> *Ex. Wireless Access Code</b></small></div><br>');
$b_addform->addFormPart('');
$b_addform->addFormPart('<div align="center">');
$b_addform->addElement('button', array('class' => 'submitbutton', 'name' => 'setLayout', 'value' => 'Save Selections', 'onClick' => 'multipleSelectOnSubmit();submitBadgeSelected(this.form)'), array());
$b_addform->addFormPart('</div>');
$b_addform->addFormPart("<br><br>");
echo $b_addform->display();
echo "
<script type='text/javascript'>
createMovableOptions('bavailableOptions','bselectedOptions',300,200,'Available fields:','Selected fields:');
createMovableOptions('ravailableOptions','rselectedOptions',300,200,'Available fields:','Selected fields:');
</script>
";
echo '</p>
	</div>
	<div id="tabs-2"><p>';
if (isset($_SESSION['seleventid'])) $eventid = $_SESSION['seleventid'];
?>

<iframe id="iframe1" name="iframe1" height="340" width="830" src ="./badge/index.php?event=<?php echo $eventid; ?>&preview=true" width="100%" height="300" style="overflow: hidden;" scrolling="no">

</iframe>

<table style="margin: 10px 0px 0px 0px;">
<tr><td> 

<script type="text/javascript">
	$(document).ready(function(){
	/*	$("#leftlmargin").slider({
			'minValue': 0, 
			'maxValue': 800, 
			'startValue': [0], 
			'slide': function(e, ui){ 
				$('#lmargin').val(ui.value);
				var iframediv=window.frames["iframe1"].document.getElementById("LeftFramediv");
				$(iframediv).css("padding-left",document.getElementById("lmargin").value + "pt"); 
			}
		});*/
		
		$("#leftslider > span").each(function() {
			var id = $(this).attr("id"); 
			$(this).slider({
			'minValue': 1, 
			'maxValue': 600, 
			'slide': function(e, ui){ 
				$('#'+id).val(ui.value);
				var iframediv=window.frames["iframe1"].document.getElementById("LeftFramediv");
				$(iframediv).css("text-align","center");
				switch(id){
				case "leftlmargin":
				$(iframediv).css("padding-left",document.getElementById(id).value + "pt"); 
				document.getElementById("llmargin").value=document.getElementById(id).value+ "pt";
				break;
				case "leftrmargin":
				$(iframediv).css("padding-right",document.getElementById(id).value + "pt"); 
				document.getElementById("lrmargin").value=document.getElementById(id).value+ "pt";
				break;
				case "lefttmargin":
				$(iframediv).css("padding-top",document.getElementById(id).value + "pt"); 
				document.getElementById("ltmargin").value=document.getElementById(id).value+ "pt";
				break;
				case "leftbmargin":
				$(iframediv).css("padding-bottom",document.getElementById(id).value + "pt"); 
				document.getElementById("lbmargin").value=document.getElementById(id).value+ "pt";
				break;				
				}
				
				
				
			}
			});
		});

		
	});
</script>

<form id="finallayout" name="finallayout">

<div class="settings-box">
<div id="leftslider" >
<label for="setMarginsleft"><b>Set Margins Left:</b></label><br><br>
<label for="Left">Left:
<input type="text" size="4" id="llmargin" name="llmargin" readonly style="border: none;">
</label><br>
<span id="leftlmargin"></span>
<!-- onChange='set_margins("",this.value,"","","LeftFramediv")'-->

<label for="Right">Right:
<input type="text" size="4" id="lrmargin" name="lrmargin" readonly style="border: none;">
</label><br>
<span id="leftrmargin"></span>

<label for="Top">Top:
<input type="text" size="4" id="ltmargin" name="ltmargin" readonly style="border: none;">
</label><br>
<span id="lefttmargin"></span>

<label for="Bottom">Bottom:
<input type="text" size="4" id="lbmargin" name="lbmargin" readonly style="border: none;">
</label><br>
<span id="leftbmargin"></span>
</div>
</div>
</td>
<td width="300">&nbsp;</td>
<td>

<script type="text/javascript">
	$(document).ready(function(){
	$("#rightslider > span").each(function() {
			var id = $(this).attr("id"); 
			$(this).slider({
			'minValue': 1, 
			'maxValue': 600, 
			'slide': function(e, ui){ 
				$('#'+id).val(ui.value);
				var iframediv=window.frames["iframe1"].document.getElementById("RightFramediv");
				$(iframediv).css("text-align","center");
				switch(id){
				case "rightlmargin":
				$(iframediv).css("padding-left",document.getElementById(id).value + "pt"); 
				document.getElementById("rlmargin").value=document.getElementById(id).value+ "pt";
				break;
				case "rightrmargin":
				$(iframediv).css("padding-right",document.getElementById(id).value + "pt"); 
				document.getElementById("rrmargin").value=document.getElementById(id).value+ "pt";
				break;
				case "righttmargin":
				$(iframediv).css("padding-top",document.getElementById(id).value + "pt"); 
				document.getElementById("rtmargin").value=document.getElementById(id).value+ "pt";
				break;
				case "rightbmargin":
				$(iframediv).css("padding-bottom",document.getElementById(id).value + "pt"); 
				document.getElementById("rbmargin").value=document.getElementById(id).value+ "pt";
				break;				
				}		
				
			}
			});
		});

		
	});
</script>


<div class="settings-box">
<div id="rightslider" >
<label for="setMarginsright"><b>Set Margins Right:</b></label><br><br>
<label for="Left">Left:
<input type="text" size="4" id="rlmargin" name="rlmargin" readonly style="border: none;">
</label><br>
<span id="rightlmargin"></span>

<!-- onChange='set_margins("",this.value,"","","RightFramediv")'-->

<label for="Right">Right:
<input type="text" size="4" id="rrmargin" name="rrmargin" readonly style="border: none;">
</label><br>
<span id="rightrmargin"></span>

<label for="Top">Top:
<input type="text" size="4" id="rtmargin" name="rtmargin" readonly style="border: none;">
</label><br>
<span id="righttmargin"></span>

<label for="Bottom">Bottom:
<input type="text" size="4" id="rbmargin" name="rbmargin" readonly style="border: none;">
</label><br>
<span id="rightbmargin"></span>

</div>
</div>


<!--
<td>Left<input type="text" size="3" id="lmargin" name="lmargin" onChange='set_margins(this.value,"","","","RightFramediv")'>
</td>
<td>Right<input type="text" size="3" id="rmargin" name="rmargin" onChange='set_margins("",this.value,"","","RightFramediv")'>
</td>
<td>Top<input type="text" size="3" id="tmargin" name="tmargin" onChange='set_margins("","",this.value,"","RightFramediv")'>
</td>
<td>Bottom <input type="text" size="3" id="bmargin" name="bmargin" onChange='set_margins("","","",this.value,"RightFramediv")'>
</td> -->
</td>

</tr>
</table>
<input type="hidden" id="fontformat" name="fontformat">
</form>
<br>
<div id="badge_fields">
<table>
<?php
$res = getSelectedFields($eventid);
$leftarray = $rightarray = array();
while ($row = mysql_fetch_array($res)) {
	$templeft = $row["left_fields"];
	if (strpos($templeft, ",") > - 1) $leftarray = explode(',', $templeft);
	else $leftarray[].= $templeft;
	$tempright = $row["right_fields"];
	if (strpos($tempright, ",") > - 1) $rightarray = explode(',', $tempright);
	else $rightarray[].= $tempright;
}
?>
<tr><td>
Field&nbsp;&nbsp;&nbsp;<select id="lselecteditems" name="lselecteditems">
<?php
for ($r = 0;$r < count($leftarray);$r++) {
	echo "<option value='$leftarray[$r]'>" . $leftarray[$r] . "</option>";
}
?>
</select>
</td>
<td width="300">&nbsp;</td>
<td>
Field&nbsp;&nbsp;&nbsp;<select id="rselecteditems" name="rselecteditems">
<?php
for ($r = 0;$r < count($rightarray);$r++) {
	echo "<option value='$rightarray[$r]'>" . $rightarray[$r] . "</option>";
}
?>
</select></td>
</tr>
<tr><td>
<div class="settings-box">
Font size
<select id="lfntsize" name="blfntsize" onkeydown='if (DetectEnterPressed(event)) set_fntsize(this.value,"lselecteditems");' onchange='set_fntsize(this.value,"lselecteditems");'>
	<option></option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="18">18</option>
	<option value="20">20</option>
	<option value="22">22</option>
	<option value="24">24</option>
	<option value="26">26</option>
	<option value="28">28</option>
	<option value="30">30</option>
	<option value="32">32</option>
	<option value="34">34</option>
</select>
</div>
</td>
<td width="300">&nbsp;</td>
<td>
<div class="settings-box">
Font size
<select id="rfntsize" name="brfntsize" onkeydown='if (DetectEnterPressed(event)) set_fntsize(this.value,"rselecteditems");' onchange='set_fntsize(this.value,"rselecteditems");'>
	<option></option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="18">18</option>
	<option value="20">20</option>
	<option value="22">22</option>
	<option value="24">24</option>
	<option value="26">26</option>
	<option value="28">28</option>
	<option value="30">30</option>
	<option value="32">32</option>
	<option value="34">34</option>
</select>
</div>
</td></tr>


</tr></table>

</div>
<br>
<div style="text-align: right;">
<input type="button" onclick="savevalues();" value="Save Layout" name="Save" class="submitbutton"></div>

</p></div>

<!--<div id="tabs-3"><p>

</p>
</div>-->

<?php
echo '</div></div></fieldset>';
?>

</td></tr>
</table>
</div>

</div>
<br>
<?php include "./footer.php"; ?>
</div>
</body>
</html>
