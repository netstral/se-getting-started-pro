<?
$page = "admin_levels_getting_startedsettings";
include "admin_header.php";

// Process input
$task     = nsl::getpost('task', 'main');
$level_id = nsl::getpost('level_id', 0);

// Validate level id
$sql = "SELECT * FROM se_levels WHERE level_id='{$level_id}' LIMIT 1";
$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was: </b>$sql");

if(!$database->database_num_rows($resource)) { nsl::redirect('admin_levels.php'); }

$level_info = $database->database_fetch_assoc($resource);

// Set result and error vars
$result   = FALSE;
$is_error = FALSE;

// Save changes
if($task == "dosave")
{
 	$level_getting_started_view = nsl::post('level_getting_started_view');

  	// Format HTML correctly
  	$level_getting_started_html = preg_replace('/[,\s]+/', ',', $level_getting_started_html);
    
    // SAVE SETTINGS
    $sql = "
      	UPDATE
        	se_levels
      	SET 
  			level_getting_started_view='{$level_getting_started_view}'
     	 WHERE
        	level_id='{$level_info['level_id']}'
      	LIMIT
        	1
    ";

	$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
    
    $level_info = $database->database_fetch_assoc($database->database_query("SELECT * FROM se_levels WHERE level_id='{$level_info['level_id']}'"));
    $result     = TRUE;
}

// Assign smarty variables and include footer
$smarty->assign('level_getting_started_html', str_replace(',', ', ', $level_info['level_getting_started_html']));
$smarty->assign_by_ref('level_info', $level_info);
$smarty->assign('is_error', $is_error);
$smarty->assign('result', $result);
include "admin_footer.php";
?>