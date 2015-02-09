<?php /* Smarty version 2.6.9, created on 2008-01-25 13:10:46
         compiled from leftmenu.tpl */ ?>
<?php echo '
<script>
'; ?>

<?php echo $this->_tpl_vars['PreferenceDetails']; ?>

<?php echo '

function LoadLeftMenu(){
	var PrefLen = PreferenceDetails.length;
	for(i=0;i<PrefLen;i++){
		var Inc = parseInt(i)+1; 
		var val = "hd"+Inc;
		var img = "hdImg"+Inc; 
		if(PreferenceDetails[i]==2){
			document.getElementById(val).style.display = \'block\'
			document.getElementById(img).src = "images/arrow-2.gif";
			document.getElementById(img).alt = "Collapse Group";
		} else {
			document.getElementById(val).style.display = \'none\'
			document.getElementById(img).src = "images/arrow-1.gif";
			document.getElementById(img).alt = "Expand Group";
		}
	}
}

function ShowHide(val,img){
	if(document.getElementById(val)){
		if(document.getElementById(val).style.display == \'none\'){
			document.getElementById(val).style.display = \'block\'
			document.getElementById(img).src = "images/arrow-2.gif";
			document.getElementById(img).alt = "Collapse Group";
		} else {
			document.getElementById(val).style.display = \'none\'
			document.getElementById(img).src = "images/arrow-1.gif";
			document.getElementById(img).alt = "Expand Group";
		}
	} 
}

var TotCnt = \'';  echo $this->_tpl_vars['AdminCount'];  echo '\'
function ExpandAll(){
	for(i=0;i<TotCnt;i++){
		var Inc = parseInt(i)+1; 
		var val = "hd"+Inc;
		var img = "hdImg"+Inc; 
		
		if(document.getElementById(val))document.getElementById(val).style.display = \'block\'
		if(document.getElementById(img))document.getElementById(img).src = "images/arrow-2.gif";
		if(document.getElementById(img))document.getElementById(img).alt = "Collapse Group";
	}
}

function CollapseAll(){
	for(i=0;i<TotCnt;i++){
		var Inc = parseInt(i)+1; 
		var val = "hd"+Inc;
		var img = "hdImg"+Inc; 
		
		if(document.getElementById(val))document.getElementById(val).style.display = \'none\'
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
			if(document.getElementById(val).style.display == \'none\'){
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
	var url     =  \'save_preference.php\';
	var pars1   = \'Pref=\' + PrefArray + \'&PrefIdentArray=\' + PrefIdentArray;
	var myAjax = new Ajax.Request(url, {method:\'post\',postBody:pars1, onSuccess:success, onFailure:failure});
}

function AdsSuccess(t, Values){
	alert("Preferences Saved")
}

function RevertPref(){
	/*var Values	=	"";
	var success = function(t){ RevertPrefSuc(t, Values);}
	var failure = function(t){ editFailed(t, Values);}
	var url     =  \'revert_preference.php\';
	var pars1   = \'\';
	var myAjax = new Ajax.Request(url, {method:\'post\',postBody:pars1, onSuccess:success, onFailure:failure});
	*/
}

</script>
'; ?>



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
      <td height="100"> <?php unset($this->_sections['admin']);
$this->_sections['admin']['name'] = 'admin';
$this->_sections['admin']['loop'] = is_array($_loop=$this->_tpl_vars['AdminCount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['admin']['show'] = true;
$this->_sections['admin']['max'] = $this->_sections['admin']['loop'];
$this->_sections['admin']['step'] = 1;
$this->_sections['admin']['start'] = $this->_sections['admin']['step'] > 0 ? 0 : $this->_sections['admin']['loop']-1;
if ($this->_sections['admin']['show']) {
    $this->_sections['admin']['total'] = $this->_sections['admin']['loop'];
    if ($this->_sections['admin']['total'] == 0)
        $this->_sections['admin']['show'] = false;
} else
    $this->_sections['admin']['total'] = 0;
if ($this->_sections['admin']['show']):

            for ($this->_sections['admin']['index'] = $this->_sections['admin']['start'], $this->_sections['admin']['iteration'] = 1;
                 $this->_sections['admin']['iteration'] <= $this->_sections['admin']['total'];
                 $this->_sections['admin']['index'] += $this->_sections['admin']['step'], $this->_sections['admin']['iteration']++):
$this->_sections['admin']['rownum'] = $this->_sections['admin']['iteration'];
$this->_sections['admin']['index_prev'] = $this->_sections['admin']['index'] - $this->_sections['admin']['step'];
$this->_sections['admin']['index_next'] = $this->_sections['admin']['index'] + $this->_sections['admin']['step'];
$this->_sections['admin']['first']      = ($this->_sections['admin']['iteration'] == 1);
$this->_sections['admin']['last']       = ($this->_sections['admin']['iteration'] == $this->_sections['admin']['total']);
?> 
        <table width="90%"  border="0" cellpadding="0" cellspacing="0" class="MainPanel" bordercolor="#4AAEDE" align="center">
          <tr> 
            <td width="100%" height="20" valign="middle" class="MainPanelMenu" style="padding-left:5px;cursor:pointer;"><?php echo $this->_tpl_vars['AdminMenu'][$this->_sections['admin']['index']]['MainMenu']; ?>
</td>
            <td align="right" class="MainPanelMenu" style="padding-right:4px;cursor:pointer;"> 
              <img src="images/arrow-2.gif" border="0"  onClick="ShowHide('hd<?php echo $this->_sections['admin']['iteration']; ?>
','hdImg<?php echo $this->_sections['admin']['iteration']; ?>
')"  id="hdImg<?php echo $this->_sections['admin']['iteration']; ?>
"> 
            </td>
          </tr>
          <tr> 
            <td valign="top" colspan="2" width="100%"> <table id="hd<?php echo $this->_sections['admin']['iteration']; ?>
" width="100%"  border="0" cellpadding="2" cellspacing="0">
                <?php unset($this->_sections['SMenu']);
$this->_sections['SMenu']['name'] = 'SMenu';
$this->_sections['SMenu']['loop'] = is_array($_loop=$this->_tpl_vars['AdminMenu'][$this->_sections['admin']['index']]['SubMenucount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SMenu']['show'] = true;
$this->_sections['SMenu']['max'] = $this->_sections['SMenu']['loop'];
$this->_sections['SMenu']['step'] = 1;
$this->_sections['SMenu']['start'] = $this->_sections['SMenu']['step'] > 0 ? 0 : $this->_sections['SMenu']['loop']-1;
if ($this->_sections['SMenu']['show']) {
    $this->_sections['SMenu']['total'] = $this->_sections['SMenu']['loop'];
    if ($this->_sections['SMenu']['total'] == 0)
        $this->_sections['SMenu']['show'] = false;
} else
    $this->_sections['SMenu']['total'] = 0;
if ($this->_sections['SMenu']['show']):

            for ($this->_sections['SMenu']['index'] = $this->_sections['SMenu']['start'], $this->_sections['SMenu']['iteration'] = 1;
                 $this->_sections['SMenu']['iteration'] <= $this->_sections['SMenu']['total'];
                 $this->_sections['SMenu']['index'] += $this->_sections['SMenu']['step'], $this->_sections['SMenu']['iteration']++):
$this->_sections['SMenu']['rownum'] = $this->_sections['SMenu']['iteration'];
$this->_sections['SMenu']['index_prev'] = $this->_sections['SMenu']['index'] - $this->_sections['SMenu']['step'];
$this->_sections['SMenu']['index_next'] = $this->_sections['SMenu']['index'] + $this->_sections['SMenu']['step'];
$this->_sections['SMenu']['first']      = ($this->_sections['SMenu']['iteration'] == 1);
$this->_sections['SMenu']['last']       = ($this->_sections['SMenu']['iteration'] == $this->_sections['SMenu']['total']);
?> 
                <tr colspan="3"> 
                  <td class="LeftSubMenu" border="0" width="200px" onMouseOver="this.className='LeftSubMenu'"> 
				  	<input type="hidden" name="hdId<?php echo $this->_sections['admin']['iteration']; ?>
" id="hdId<?php echo $this->_sections['admin']['iteration']; ?>
" value="<?php echo $this->_tpl_vars['AdminMenu'][$this->_sections['admin']['index']]['Ident']; ?>
"  />				  
                    <a href="<?php echo $this->_tpl_vars['AdminMenu'][$this->_sections['admin']['index']]['SubLinks'][$this->_sections['SMenu']['index']]; ?>
" class="LeftSubMenuLink" style="width:100%"><?php echo $this->_tpl_vars['AdminMenu'][$this->_sections['admin']['index']]['SubMenus'][$this->_sections['SMenu']['index']]; ?>
</a> 
                  </td>
                </tr>
                <?php endfor; endif; ?> </table></td>
          </tr>
        </table>
        <br>
        <?php endfor; endif; ?> </td>
    </tr>
  </table>
</div>
<script>
LoadLeftMenu()
</script>