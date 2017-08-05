{include file='admin_header.tpl'}

{* INCLUDE JAVASCRIPT FILE *}
<script type="text/javascript" src="../include/js/getting_started.js"></script>
<script type="text/javascript" src="../include/fckeditor/fckeditor.js"></script>

<h2>Getting Started Pro - Manage Steps</h2>
{lang_print id=12000051}<br /><br />

{if $add == 0}

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
	<td class='header'>Edit step</td>
</tr>
<tr>
	<td class='setting1'>Edit your step by filling the form below.</td>
</tr>
<tr>
	<td class='setting2'>
    <form action="admin_getting_started_manage.php?add=0&step_id={$step_id}" name="editStep" method="post" target="_parent">
	
	<div style="margin-top:5px;margin-bottom:2px;">
		<b>{lang_print id=12000056}</b><br>If you put 0, this step will be the first step that your user will see, when you add another step insert 1.
	</div>
	<div style="margin-bottom:5px;"><input type="text" name="order_id" maxlength="50" size="30" value="{$step_info.order_id}"></div>
	
	<div style="margin-bottom:2px;"><b>{lang_print id=12000057}</b></div>
	<div style="margin-bottom:5px;"><input type="text" name="title" maxlength="50" size="30" value="{$step_info.title}"></div>
	
	{* DISPLAY FCKEDITOR *}
	<div style="margin-bottom:5px;">
		<script type="text/javascript">
 		<!--
  		var sToolbar;
  		var oFCKeditor = new FCKeditor('description');
	  	oFCKeditor.BasePath = "../include/fckeditor/";
	  	oFCKeditor.Config["ProcessHTMLEntities"] = false;
		oFCKeditor.Config["CustomConfigurationsPath"] = "../../js/getting_started_fckconfig.js";
		oFCKeditor.Height = "300";
		oFCKeditor.ToolbarSet = "se_getting_started";
		oFCKeditor.Value = '{$step_info.description}';
		oFCKeditor.Config["SocialEngineUploadCustom"] = {if !empty($global_plugins.album) && $user->level_info.level_album_allow}true{else}false{/if};
		oFCKeditor.Create() ;
		//-->
		</script>
	</div>
	
	{* DISPLAY BUTTONS *}
	<div style="margin-bottom:2px;">
		<input type="submit" class="button" value="{lang_print id=173}">
		<input type="hidden" name="task" value="edit">
	</div>
	</td>
</tr>
</table>
{else}
<table cellpadding='0' cellspacing='0' width='600'>
<tr>
	<td class='header'>Add a New Step</td>
</tr>
<tr>
	<td class='setting1'>Add a new step to your guide by filling the form below.</td>
</tr>
<tr>
	<td class='setting2'>
    <form action="admin_getting_started_manage.php?add=1" name="addStep" method="post" target="_parent">
	
	<div style="margin-top:5px;margin-bottom:2px;">
		<b>{lang_print id=12000056}</b><br>If you put 0, this step will be the first step that your user will see, when you add another step insert 1.
	</div>
	<div style="margin-bottom:5px;"><input type="text" name="order_id" maxlength="50" size="30"></div>
	
	<div style="margin-bottom:2px;"><b>{lang_print id=12000057}</b></div>
	<div style="margin-bottom:5px;"><input type="text" name="title" maxlength="50" size="30"></div>
	
	{* DISPLAY FCKEDITOR *}
	<div style="margin-bottom:5px;">
		<script type="text/javascript">
 		<!--
  		var sToolbar;
  		var oFCKeditor = new FCKeditor('description');
	  	oFCKeditor.BasePath = "../include/fckeditor/";
	  	oFCKeditor.Config["ProcessHTMLEntities"] = false;
		oFCKeditor.Config["CustomConfigurationsPath"] = "../../js/getting_started_fckconfig.js";
		oFCKeditor.Height = "300";
		oFCKeditor.ToolbarSet = "se_getting_started";
		oFCKeditor.Value = '';
		oFCKeditor.Config["SocialEngineUploadCustom"] = {if !empty($global_plugins.album) && $user->level_info.level_album_allow}true{else}false{/if};
		oFCKeditor.Create() ;
		//-->
		</script>
	</div>
	
	{* DISPLAY BUTTONS *}
	<div style="margin-bottom:2px;">
		<input type="submit" class="button" value="{lang_print id=12000058}">
		<input type="hidden" name="task" value="add">
	</div>
	</td>
</tr>
</table>
{/if}

{include file='admin_footer.tpl'}