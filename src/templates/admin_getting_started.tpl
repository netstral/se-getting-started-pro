{include file='admin_header.tpl'}

{* INCLUDE JAVASCRIPT FILE *}
<script type="text/javascript" src="../include/js/getting_started.js"></script>
<script type="text/javascript" src="../include/fckeditor/fckeditor.js"></script>

<h2>{lang_print id=12000050}</h2>
{lang_print id=12000051}<br /><br />

<form action="admin_getting_started.php" method="POST">

<table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'>HTML Format</td>
  </tr>
    <td class='setting1'>Insert HTML tags you want to allow and separate by comma (ie: br, img, p)</td>
  </tr>
  <tr>
    <td class='setting2'>
      <table cellpadding='2' cellspacing='0'>
        <tr>
          <td><input type='text' name='setting_getting_started_html' value='{$setting.setting_getting_started_html}'></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br />

<table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'>Help</td>
  </tr>
    <td class='setting1'>This will help you start adding new steps</td>
  </tr>
  <tr>
    <td class='setting2'>
      <table cellpadding='2' cellspacing='0'>
        <tr>
          <td>When you set your Order ID to 0, this step will be the first step in your guide. The last step you add will be the final step, where the user will see final information and go to their homepage.</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br />

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
	<td class='header'>{lang_print id=12000052}</td>
</tr>
<tr>
	<td class='setting1'>{lang_print id=12000053}</td>
</tr>
<tr>
	<td class='setting2'>
    	<table cellpadding='2' cellspacing='0'>
		<tr>
	    	<td><img src='../images/icons/gs_add16.png' class='icon' border='0'> <a href="admin_getting_started_manage.php?add=1">{lang_print id=12000054}</a><br><br></td>
	 	</tr>
	  	{section name=step_loop loop=$steps}
        <tr>
          	<td><b>Step {$steps[step_loop].order_id}:</b> {$steps[step_loop].title}</td>
          	<td>&nbsp;&nbsp;&nbsp;
		    	<a href="admin_getting_started_manage.php?add=0&step_id={$steps[step_loop].step_id}"><img src="../images/icons/gs_edit16.png" class="icon" title="Edit Step" border="0"></a>
				&nbsp;&nbsp;
				<a href="javascript:void();" onClick="NSLGS_confirmDelete('{$steps[step_loop].step_id}');">
					<img src="../images/icons/gs_skip16.png" class="icon" title="Delete Step"border="0">
				</a>
		  	</td>
      	</tr>
	  	{/section}
      	</table>
	</td>
</tr>
</table>
<br />

{lang_block id=173 var=langBlockTemp}<input type='submit' class='button' value='{$langBlockTemp}' />{/lang_block}
<input type='hidden' name='task' value='dosave' />
</form>

{* DELETE EXISTING STEP (HIDDEN DIV) *}
<div style="display:none;" id="confirmdelete">
	<div style="margin-top:10px;">{lang_print id=12000055}</div>
	
	{* DISPLAY BUTTONS *}
	<div style="margin-top:5px;">
		<input type="button" class="button" value="{lang_print id=175}" onClick="parent.TB_remove();parent.NSLGS_deleteStep();">
		<input type="button" class="button" value="{lang_print id=39}" onClick="parent.TB_remove();">
	</div>
</div>

{include file='admin_footer.tpl'}