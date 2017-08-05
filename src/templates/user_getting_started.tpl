{include file='header.tpl'}

{* LOOP THROUGH STEPS *}
	<div class="Getting_Started">
	
		{* STEP TITLE *}
		<div class="title">
			<h3>{$step_info.title}</h3>
		</div>
		
		{* STEP DESCRIPTION *}
		<div class="description">
			{$step_info.description|choptext:75:"<br>"}
		</div>
		
		{* SPACER *}
		<div class="spacer"></div>
		
		{* STEP OPTIONS *}
		<div class="options">
			<div class="options_left">
				{if $step_id != 0}
			  		{$step_id} / {$total_steps} {lang_print id=12000060}
				{/if}
			</div>
			<div class="options_right">
				{if $step_id == $last_step_id}
					<div class="option"><img src="./images/icons/gs_proceed16.png" class="icon"><a href="{$return_url}">{lang_print id=12000061}</a></div>
			  	{else}
			    	{if $step_id != 0}
						<div class="option"><img src="./images/icons/gs_previous16.png" class="icon"><a href="user_getting_started.php?step_id={$previous_step}">{lang_print id=12000063}</a></div>
			    	{/if}
			    	
					<div class="option"><img src="./images/icons/gs_next16.png" class="icon"><a href="user_getting_started.php?step_id={$next_step}">{lang_print id=12000062}</a></div>
					<div class="option"><img src="./images/icons/gs_skip16.png" class="icon"><a href="user_getting_started.php?step_id=skip">{lang_print id=12000064}</a></div>
			  	{/if}
			</div>
		</div>

	</div>
	
{include file='footer.tpl'}