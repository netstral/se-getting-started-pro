<?
$page = "admin_getting_started_manage";
include "admin_header.php";

// Process input
$add     = nsl::getpost('add', 1);
$task    = nsl::getpost('task', 'main');
$step_id = nsl::getpost('step_id');

// Create class ojbect
$gs = new NSL_Getting_Started();

// Get step info
$step_info = $gs->get_step_info_from_database($step_id);

// Add step
if($task == 'add') {
	// Get variables
	$order_id    = nsl::post('order_id');
	$title       = nsl::post('title');
	$description = nsl::post('description');	

	// Processing
	$gs->add_step($order_id, $title, $description);
	
	// Redirect to settings page
	nsl::redirect('admin_getting_started.php');
}

// Edit step
if($task == 'edit') {
	// Get variables
	$order_id    = nsl::post('order_id');
	$title    	 = nsl::post('title');
	$description = nsl::post('description');
	
	// Processing
	$gs->edit_step($step_id, $order_id, $title, $description);
	
	// Redirect to settings page
	nsl::redirect('admin_getting_started.php');
}

// Convert HTML characters back
$step_info['description'] = str_replace("\r\n", "", htmlspecialchars_decode($step_info['description']));

// Assign smarty variables and include footer
$smarty->assign('step_info', $step_info);
$smarty->assign('step_id', $step_id);
$smarty->assign('add', $add);
include "admin_footer.php";
?>