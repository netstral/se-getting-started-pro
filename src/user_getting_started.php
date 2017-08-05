<?
$page = "user_getting_started";
include "header.php";

// Process input
$step_id       = nsl::getpost('step_id');
$next_step     = $step_id + 1;
$previous_step = $step_id - 1;

// Create class object
$gs = new NSL_Getting_Started($user->user_info['user_id']);

// If access is not allowed and/or user already completed/skipped guide, redirect to homepage
if($user->level_info['level_getting_started_view'] != 1) { nsl::redirect($gs->get_return_url()); }
if($gs->get_status() == 'COMPLETED' || $gs->get_status() == 'SKIPPED') { nsl::redirect($gs->get_return_url()); }

// Get total steps and last step id
$total_steps  = $gs->get_total_steps_from_database();
$last_step_id = $gs->get_laststep_from_database();

// Get steps
$step_info = $gs->get_step_from_database($step_id);

// Set status
if($step_id == $last_step_id || $step_id == 'skip') {
	if($step_id == 'skip') 	      { $gs->set_status('SKIPPED'); nsl::redirect($gs->get_return_url()); }
	if($step_id == $last_step_id) { $gs->set_status('COMPLETED'); }
}

// Convert HTML characters back
$step_info['description'] = str_replace("\r\n", "", htmlspecialchars_decode($step_info['description']));

// Assign smarty variables and include footer
$smarty->assign('return_url', $gs->get_return_url());
$smarty->assign('previous_step', $previous_step);
$smarty->assign('last_step_id', $last_step_id);
$smarty->assign('total_steps', $total_steps);
$smarty->assign('step_info', $step_info);
$smarty->assign('next_step', $next_step);
$smarty->assign('step_id', $step_id);
include "footer.php";
?>