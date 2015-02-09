{literal}
<script>
{/literal}
{$PreferenceDetails}
{literal}

function LoadLeftMenu(){
	var PrefLen = PreferenceDetails.length;
	for(i=0;i<PrefLen;i++){
		var Inc = parseInt(i)+1; 
		var val = "hd"+Inc;
		var img = "hdImg"+Inc; 
		if(PreferenceDetails[i]==2){
			document.getElementById(val).style.display = 'block'
			document.getElementById(img).src = "images/arrow-2.gif";
			document.getElementById(img).alt = "Collapse Group";
		} else {
			document.getElementById(val).style.display = 'none'
			document.getElementById(img).src = "images/arrow-1.gif";
			document.getElementById(img).alt = "Expand Group";
		}
	}
}

function ShowHide(val,img){
	if(document.getElementById(val)){
		if(document.getElementById(val).style.display == 'none'){
			document.getElementById(val).style.display = 'block'
			document.getElementById(img).src = "images/arrow-2.gif";
			document.getElementById(img).alt = "Collapse Group";
		} else {
			document.getElementById(val).style.display = 'none'
			document.getElementById(img).src = "images/arrow-1.gif";
			document.getElementById(img).alt = "Expand Group";
		}
	} 
}

var TotCnt = '{/literal}{$AdminCount}{literal}'
function ExpandAll(){
	for(i=0;i<TotCnt;i++){
		var Inc = parseInt(i)+1; 
		var val = "hd"+Inc;
		var img = "hdImg"+Inc; 
		
		if(document.getElementById(val))document.getElementById(val).style.display = 'block'
		if(document.getElementById(img))document.getElementById(img).src = "images/arrow-2.gif";
		if(document.getElementById(img))document.getElementById(img).alt = "Collapse Group";
	}
}

function CollapseAll(){
	for(i=0;i<TotCnt;i++){
		var Inc = parseInt(i)+1; 
		var val = "hd"+Inc;
		var img = "hdImg"+Inc; 
		
		if(document.getElementById(val))document.getElementById(val).style.display = 'none'
		if(document.getElementById(img))document.getElementById(img).src = "images/arrow-1.gif";
		if(document.getElementById(img))document.getElementById(img).alt = "Expand Group";
	}
}


function SavePref(){
	var PrefArray = PrefIdentArray = "";
	for(i=0;i<TotCnt;i++){
		var Inc = parseInt(i)+1; 
		var val = "hd"+Inc;
		var IdVal = "hdId"+Inc;
		if(document.getElementById(val) && document.getElementById(IdVal)){
			if(document.getElementById(val).style.display == 'none'){
				shk = 1;
				PrefIdentArrayVAl = document.getElementById(IdVal).value;
			} else {
				shk = 2;
				PrefIdentArrayVAl = document.getElementById(IdVal).value;
			}
		}	
		if(PrefArray==""){
			PrefArray = shk;
			PrefIdentArray = PrefIdentArrayVAl;
		} else {
			PrefArray = PrefArray+","+shk;
			PrefIdentArray = PrefIdentArray+","+PrefIdentArrayVAl;
		}
	}	

	var Values	=	"";
	var success = function(t){ AdsSuccess(t, Values);}
	var failure = function(t){ editFailed(t, Values);}
	var url     =  'save_preference.php';
	var pars1   = 'Pref=' + PrefArray + '&PrefIdentArray=' + PrefIdentArray;
	var myAjax = new Ajax.Request(url, {method:'post',postBody:pars1, onSuccess:success, onFailure:failure});
}

function AdsSuccess(t, Values){
	alert("Preferences Saved")
}

function RevertPref(){
	/*var Values	=	"";
	var success = function(t){ RevertPrefSuc(t, Values);}
	var failure = function(t){ editFailed(t, Values);}
	var url     =  'revert_preference.php';
	var pars1   = '';
	var myAjax = new Ajax.Request(url, {method:'post',postBody:pars1, onSuccess:success, onFailure:failure});
	*/
}

</script>
{/literal}


<div id="Layer1" style="position:relative; height:100%; z-index:1; overflow: scroll; top: 0;" class="ScrollBar"> 
  <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
    <tr> 
      <td height="50" valign="middle"><a href="main.php"><img src="images/admin-panel.gif" border="0"></a></td>
    </tr>
    <tr> 
      <td align="center" class="WhiteFontLight" valign="top" height="75"> <a href="main.php" class="WhiteFontLight" title="Control Panel">Control 
        Panel Home</a><br> <a href="javascript:ExpandAll()" class="WhiteFontLight" title="Expand All">Expand 
        All</a> | <a href="javascript:CollapseAll()" class="WhiteFontLight" title="Collapse All">Collapse 
        All</a><br> <a href="javascript:SavePref()" class="WhiteFontLight" title="Save Preference">Save 
        Prefs</a> | <a href="javascript:ExpandAll()" class="WhiteFontLight" title="Revert preference">Revert 
        Prefs</a>&nbsp; </td>
    </tr>
    <tr> 
      <td height="100"> {section name="admin" loop=$AdminCount} 
        <table width="90%"  border="0" cellpadding="0" cellspacing="0" class="MainPanel" bordercolor="#4AAEDE" align="center">
          <tr> 
            <td width="100%" height="20" valign="middle" class="MainPanelMenu" style="padding-left:5px;cursor:pointer;">{$AdminMenu[admin].MainMenu}</td>
            <td align="right" class="MainPanelMenu" style="padding-right:4px;cursor:pointer;"> 
              <img src="images/arrow-2.gif" border="0"  onClick="ShowHide('hd{$smarty.section.admin.iteration}','hdImg{$smarty.section.admin.iteration}')"  id="hdImg{$smarty.section.admin.iteration}"> 
            </td>
          </tr>
          <tr> 
            <td valign="top" colspan="2" width="100%"> <table id="hd{$smarty.section.admin.iteration}" width="100%"  border="0" cellpadding="2" cellspacing="0">
                {section name="SMenu" loop=$AdminMenu[admin].SubMenucount} 
                <tr colspan="3"> 
                  <td class="LeftSubMenu" border="0" width="200px" onMouseOver="this.className='LeftSubMenu'"> 
				  	<input type="hidden" name="hdId{$smarty.section.admin.iteration}" id="hdId{$smarty.section.admin.iteration}" value="{$AdminMenu[admin].Ident}"  />				  
                    <a href="{$AdminMenu[admin].SubLinks[SMenu]}" class="LeftSubMenuLink" style="width:100%">{$AdminMenu[admin].SubMenus[SMenu]}</a> 
                  </td>
                </tr>
                {/section} </table></td>
          </tr>
        </table>
        <br>
        {/section} </td>
    </tr>
  </table>
</div>
<script>
LoadLeftMenu()
</script>
