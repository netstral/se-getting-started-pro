{include file='admin_header.tpl'}

{* $Id: admin_levels_blogsettings.tpl 16 2009-01-13 04:01:31Z john $ *}

<h2>{lang_sprintf id=288 1=$level_info.level_name}</h2>
{lang_print id=282}

<table cellspacing='0' cellpadding='0' width='100%' style='margin-top: 20px;'>
<tr>
<td class='vert_tab0'>&nbsp;</td>
<td valign='top' class='pagecell' rowspan='{math equation="x+5" x=$level_menu|@count}'>

  	<h2>Getting Started Pro Settings</h2>
  	Edit access for user levels and manage your HTML support
  	<br /><br />
  
  	{* SHOW SUCCESS MESSAGE *}
  	{if $result != 0}
    	<div class='success'><img src='../images/success.gif' class='icon' border='0'> {lang_print id=191}</div>
 	 {/if}
  
  	{* SHOW ERROR MESSAGE *}
 	{if $is_error != 0}
    	<div class='error'><img src='../images/error.gif' class='icon' border='0'> {lang_print id=$is_error}</div>
  	{/if}
  
  
  	<form action='admin_levels_getting_startedsettings.php' name='info' method='POST'>
  
  	<table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      	<td class='header'>Allow Access</td>
    </tr>
    <tr>
      	<td class='setting1'>Do you want allow users of this level to access the Getting Started guide?</td>
    </tr>
    <tr>
      	<td class='setting2'>
        	<table cellpadding='0' cellspacing='0'>
          	<tr>
            	<td><input type='radio' name='level_getting_started_view' id='level_getting_started_view_1' value='1'{if  $level_info.level_getting_started_view} checked{/if} />&nbsp;</td>
            	<td><label for='level_getting_started_view_1'>Yes, allow access.</label></td>
          	</tr>
          	<tr>
            	<td><input type='radio' name='level_getting_started_view' id='level_getting_started_view_0' value='0'{if !$level_info.level_getting_started_view} checked{/if} />&nbsp;</td>
            	<td><label for='level_getting_started_view_0'>No, do not allow acccess.</label></td>
          	</tr>
        	</table>
      	</td>
    </tr>
	</table>
  
  
  	{lang_block id=173 var=langBlockTemp}<input type='submit' class='button' value='{$langBlockTemp}' />{/lang_block}
  	<input type='hidden' name='task' value='dosave' />
  	<input type='hidden' name='level_id' value='{$level_info.level_id}' />
  	</form>
  
</td>
</tr>

{* DISPLAY MENU *}
<tr><td width='100' nowrap='nowrap' class='vert_tab'><div style='width: 100px;'><a href='admin_levels_edit.php?level_id={$level_info.level_id}'>{lang_print id=285}</a></div></td></tr>
<tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;'><div style='width: 100px;'><a href='admin_levels_usersettings.php?level_id={$level_info.level_id}'>{lang_print id=286}</a></div></td></tr>
<tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;'><div style='width: 100px;'><a href='admin_levels_messagesettings.php?level_id={$level_info.level_id}'>{lang_print id=287}</a></div></td></tr>
{foreach from=$global_plugins key=plugin_k item=plugin_v}
{section name=level_page_loop loop=$plugin_v.plugin_pages_level}
  <tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;{if $plugin_v.plugin_pages_level[level_page_loop].page == $page} border-right: none;{/if}'><div style='width: 100px;'><a href='{$plugin_v.plugin_pages_level[level_page_loop].link}?level_id={$level_info.level_id}'>{lang_print id=$plugin_v.plugin_pages_level[level_page_loop].title}</a></div></td></tr>
{/section}
{/foreach}

<tr>
<td class='vert_tab0'>
  <div style='height: 1200px;'>&nbsp;</div>
</td>
</tr>
</table>


{include file='admin_footer.tpl'}