<?
$page = "admin_getting_started";
include "admin_header.php";

// Process input
$task = nsl::getpost('task', 'main');

// Create class ojbect
$gs = new NSL_Getting_Started();

// Delete step
if($task == 'delete') {
	$step_id = nsl::getpost('step_id');
	
	$gs->delete_step($step_id);
}

// Save changes
elseif($task == 'dosave')
{
	$setting_getting_started_html = nsl::post('setting_getting_started_html');
  
	$sql = "UPDATE se_settings SET setting_getting_started_html='{$setting_getting_started_html}'";
	$database->database_query($sql) or die($database->database_error()." <b>SQL was: </b>$sql");
  
  
	$setting = $database->database_fetch_assoc($database->database_query("SELECT * FROM se_settings LIMIT 1"));
	$result = 1;
}

// Get total steps
$total_steps = $gs->get_total_steps_from_database();

// Get steps
$steps = $gs->get_steps_from_database();

// Assign smarty variables and include footer
$smarty->assign('total_steps', $total_steps);
$smarty->assign('steps', $steps);
include "admin_footer.php";
?>