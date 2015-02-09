<?php /* Smarty version 2.6.9, created on 2008-01-25 13:10:46
         compiled from content.tpl */ ?>
<table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
	<tr>
    	<td  colspan="2" valign="top">&nbsp;</td>
  	</tr>
 	<tr>
    	<td height="50" colspan="3" align="center" valign="top" class="FormHeader">Welcome To Read & Initial system Admin Panel </td>
  	</tr>
<tr> 
    <td colspan="2" valign="top" ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="50%" align="center"> <dl class="curved">
              <dt>Members</dt>
              <dd> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td width="6%">&nbsp;</td>
                    <td width="42%" ><a href="userlist.php" class="DashFont">Total Members</a></td>
                    <td width="52%"><a href="userlist.php" class="DashFont"><?php echo $this->_tpl_vars['UserCount1']; ?>
</a></td>
                  </tr>
                  <tr> 
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td ><a href="userlist.php?account_status=Active" class="DashFont">Total Active Members</a></td>
                    <td><a href="userlist.php?account_status=Active" class="DashFont"><?php echo $this->_tpl_vars['ActiveUserlistCount']; ?>
</a></td>
                  </tr>
                  <tr> 
                    <td colspan="3" height="10"></td>
                  </tr>				  
                  <tr> 
                    <td>&nbsp;</td>
                    <td><a href="userlist.php?account_status=InActive" class="DashFont">Total InActive Members</a></td>
                    <td><a href="userlist.php?account_status=InActive" class="DashFont"><?php echo $this->_tpl_vars['InActiveUserlistCount']; ?>
</a></td>
                  </tr>
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                </table>
                <p  class="last">&nbsp;</p>
              </dd>
            </dl></td>
          <td width="50%" align="center"> <dl class="curved">
              <dt>Groups</dt>
              <dd> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td width="6%">&nbsp;</td>
                    <td width="42%"><a href="grouplist.php" class="DashFont">Total Groups</a></td>
                    <td width="52%"><a href="grouplist.php" class="DashFont"><?php echo $this->_tpl_vars['GroupCount']; ?>
</a></td>
                  </tr>
                  <tr> 
                    <td height="10" colspan="3"></td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr> 
                    <td height="10" colspan="3"></td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td nowrap></td>
                    <td></td>
                  </tr>
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                </table>
                <p  class="last">&nbsp;</p>
              </dd>
            </dl></td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>										
        <tr> 
          <td width="50%" align="center"> <dl class="curved">
              <dt>Documents</dt>
              <dd> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td width="6%">&nbsp;</td>
                    <td width="42%" ><a href="documentlist.php" class="DashFont">Total Documents</a></td>
                    <td width="52%"><a href="documentlist.php" class="DashFont"><?php echo $this->_tpl_vars['documentCount']; ?>
</a></td>
                  </tr>
                  <tr> 
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                </table>
                <p  class="last">&nbsp;</p>
              </dd>
            </dl></td>
          <td width="50%" align="center" style="display:none;"> <dl class="curved">
              <dt>News Letter</dt>
              <dd> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td width="6%">&nbsp;</td>
                    <td width="42%" ><a href="list_news_letter.php" class="DashFont">Total News Letter</a></td>
                    <td width="52%"><a href="list_news_letter.php" class="DashFont"><?php echo $this->_tpl_vars['totalnewsletter']; ?>
</a></td>
                  </tr>
                  <tr> 
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr> 
                    <td colspan="3">&nbsp;</td>
                  </tr>
                </table>
                <p  class="last">&nbsp;</p>
              </dd>
            </dl></td>
        </tr>
		<tr>
<td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>										
        
      </table></td>
  </tr>	
  <tr width="70%">
  		<td height="30" valign="top" class="FormHeader" width="48%">&nbsp;</td>
    	<td height="30" valign="top" class="FormHeader" width="52%">&nbsp;</td>
  </tr>
</table>
