<?php /* Smarty version 2.6.9, created on 2012-01-01 03:59:32
         compiled from includes/header.tpl */ ?>
<?php echo '
<script type="text/javascript" language="javascript">
function FormToLoad(frmAction) {
	$("op").value = frmAction;
	document.frmindex.action = \'index.php\';
	document.frmindex.submit();	
}

function validateSearch() {
	if (document.frmsearch.textfield.value == \'\') { 	
		alert(\'Search word should not be empty.\'); 
		return false; 
	} else {
		document.frmsearch.op.value=\'search\'; 
		document.frmsearch.submit();
		return true;
	}
}

function checkEnter(e,val){ //e is event object passed from function invocation
        var characterCode //literal character code will be stored in this variable
        
        characterCode = e.keyCode; //character code is contained in IE\'s keyCode property
        
        if(characterCode == 13){ //if generated character code is equal to ascii 13 (if enter key)
	        validateSearch();
        return false;
        }
        return true;
    }
</script>
'; ?>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="hdrbg">
      <tr>
        <td width="20%" style="padding-left:18px;">
		<?php if ($this->_tpl_vars['sesUserId'] == ""): ?> 
		<a  href="index.php"><img src="images/logo.jpg" border="0" width="295" height="60" alt="Read & Initial System" /></a>
		<?php else: ?> 
			<img style="cursor:pointer;" src="images/logo.jpg" border="0" width="295" height="60" alt="Read & Initial System" onclick="document.frmindex.op.value='home'; document.frmindex.submit();" />
		<?php endif; ?>		
		</td>
        <td width="80%" align="right" valign="bottom">
			<!-- Menu Starts -->
			<form name="frmindex" method="post" action="index.php">
			<input type="hidden" name="op" id="op" value="" />			
				<table border="0" cellpadding="0" cellspacing="0" class="menubg" align="right">
				<tr>
					<td><img src="images/menubgleft.gif"></td>
					<td>
					<?php if ($this->_tpl_vars['pagename'] == 'register'): ?>
					<p href="#" class="button1"><span>Register</span></p>
					<?php else: ?>
					<a href="#"  class="button"><span onclick="FormToLoad('register')">Register</span></a>
					<?php endif; ?>
					</td>
					<td>					
					<?php if ($this->_tpl_vars['pagename'] == 'signin'): ?>			
					<p class="button1"><span><?php echo $this->_tpl_vars['signintxt']; ?>
</span></p>	
					<?php else: ?>	
					<a href="#"  onclick="FormToLoad('<?php echo $this->_tpl_vars['signintxt']; ?>
')" class="button"><span><?php echo $this->_tpl_vars['signintxt']; ?>
</span></a>
					<?php endif; ?>
					</td>
					<td nowrap>					
					<?php if ($this->_tpl_vars['pagename'] == 'forgotpwd'): ?>		
					<p href="#" class="button1"><span>Forgot your Password</span></p>
					<?php else: ?>
					<a href="#" class="button" onclick="FormToLoad('forgetpwd')"><span>Forgot your Password</span></a>
					<?php endif; ?>
					</td>
					<td><img src="images/menubgright.gif"></td>
				</tr>
				</table>
			</form>
			<!-- Menu Ends -->
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="redline" >
        <tr>
          <td></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15"></td>
          <td width="658"><table width="690" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="searchleft">&nbsp;</td>
              <td class="searchmid">&nbsp;</td>
              <td valign="middle" class="searchmid">			  	
			  	<?php if ($this->_tpl_vars['InnerTpl'] != "forgetpwd.tpl" && $this->_tpl_vars['InnerTpl'] != ""): ?>
				<form name="frmsearch" action="index.php" method="post">
				<input type="hidden" name="op" id="op" value="" />
				  <table width="60%" border="0" align="right" cellpadding="0" cellspacing="0">
					  <tr>
						<td width="22%" class="searchtext">search</td>
						<td width="60%"><input name="textfield" type="text" class="textbox" value="<?php echo $this->_tpl_vars['textfield']; ?>
" onkeypress="checkEnter(event,this.value )"  /></td>
						<td width="18%" align="center"><input type="image" src="images/gobtn.gif"  onclick="return validateSearch()"  /></td>
					  </tr>
				  </table>
				  </form>
				  <?php endif; ?>
			  </td>
              <td class="searchright">&nbsp;</td>
            </tr>
          </table></td>
          <td width="331">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
	  