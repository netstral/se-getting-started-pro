<?

class NSL_Getting_Started {
	
	// Initialize Variables
	var $user_id = NULL;

	/**
	 * Sets the user's id
	 * 
	 * @param	int	$user_id	Represents the user's id (Optional)
	 */
	function NSL_Getting_Started($user_id=NULL) {
		if($user_id != NULL) {
			$this->user_id = $user_id;
		} else {
			$this->user_id = 0;
		}
	}
	
	/**
	 * Gets total steps from database
	 * 
	 * @return	int	$step_total		Represents the total steps number
	 */
	function get_total_steps_from_database() {
		global $database;

		// Get total steps form database
		$step_resource = $database->database_query("SELECT * FROM se_getting_started_steps WHERE order_id != '0'");
		$step_total    = $database->database_num_rows($step_resource);
		
		// Return total steps
		return $step_total;
	}
	
	/**
	 * Gets steps from database
	 * 
	 * @return	array	$step_array		Represents an array containg the steps
	 */
	function get_steps_from_database() {
		global $database;
		
		// Get steps from database
		$step_resource = $database->database_query("SELECT * FROM se_getting_started_steps ORDER BY order_id ASC");
		
		// Put steps into an array
		$step_array	  = array();
		while($step_info = $database->database_fetch_assoc($step_resource)) {
			$step_array[] = $step_info;
		}
		
		// Return steps array
		return $step_array;
	}
	
	/**
	 * Gets the last step from database
	 * 
	 * @return	int	$last_step_id		Represents the last step's id
	 */
	function get_laststep_from_database() {
		global $database;
		
		// Get last step from database
		$step_resource = $database->database_query("SELECT MAX(order_id) as last_step_id FROM se_getting_started_steps");
		$step_info     = $database->database_fetch_assoc($step_resource);
		
		// Set last step id
		$last_step_id = $step_info['last_step_id'];
		
		// Return last step id
		return $last_step_id;
	}
	
	/**
	 * Gets steps from the database
	 * 
	 * @param	int		$order_id		Represents the step's order id
	 * 
	 * @return	array	$step_array		Represents an array containg steps information
	 */
	function get_step_from_database($order_id) {
		global $database;
		
		// Get step from database
		$step_resource = $database->database_query("SELECT * FROM se_getting_started_steps WHERE order_id = '{$order_id}'");
		$step_info     = $database->database_fetch_assoc($step_resource);
		
		// Return step
		return $step_info;
	}
	
	/**
	 * Gets step info from database
	 * 
	 * @return	array	$step_info		Represents an the step's information
	 */
	function get_step_info_from_database($step_id) {
		global $database;
		
		// Get step info from database
		$step_resource = $database->database_query("SELECT * FROM se_getting_started_steps WHERE step_id='{$step_id}'");
		$step_info     = $database->database_fetch_assoc($step_resource);
		
		// Return step info
		return $step_info;
	}
	
	/**
	 * Gets the user's getting started status
	 * 
	 * @param	int		$user_id	Represents the user's id
	 */
	function get_status() {
		global $database;
		
		// Get status from database
		$gs_resource = $database->database_query("SELECT status FROM se_getting_started WHERE user_id='{$this->user_id}'");
		$gs_info     = $database->database_fetch_assoc($gs_resource);
		
		// Set status
		$status = $gs_info['status'];
		
		// Return status
		return $status;
	}
	
	/**
	 * Sets the user's getting started status
	 * 
	 * @param	int		$user_id	Represents the user's id
	 * 			string	$status		Represents the status (COMPLTED, SKIPPED, NONE)
	 */
	function set_status($status) {
		global $database;
		
		// Set time
		$created = time();
		
		// SQL query
		$sql = "
			INSERT INTO se_getting_started
				(user_id, created, status) 
			VALUES 
				('{$this->user_id}', '{$created}', '{$status}')
		";
	
		// Run query
		$database->database_query($sql) or die($database->database_error());
	}
	
	/**
	 * Adds a new step
	 * 
	 * @param	int		$order_id		Represents the step's order id
	 * 			string	$title			Represents the step's title
	 * 			string	$description	Represents the step's description
	 */
	function add_step($order_id, $title, $description) {
		global $database, $setting;
		 
		// Trim title and set time
   		$title   = censor(trim($title));
		$created = time();
    	
		// HTML
    	$description = cleanHTML($description, $setting['setting_getting_started_html']);
    	$description = censor($description);
    	$description = htmlspecialchars($description, ENT_QUOTES);
		
   		// SQL query
		$sql = "
			INSERT INTO se_getting_started_steps
				(order_id, created, title, description)
			VALUES
				('{$order_id}', '{$created}', '{$title}', '{$description}')
		";

		// Run query
		$database->database_query($sql) or die($database->database_error());
	}
	
	/**
	 * Edits a step
	 * 
	 * @param	int		$step_id		Represents the step's id
	 * 			int		$order_id		Represents the step's order id
	 * 			string	$title			Represents the step's title
	 * 			string	$description	Represents the step's description
	 */
	function edit_step($step_id, $order_id, $title, $description) {
		global $database, $setting;
		
		// Set time
   		$title   = censor(trim($title));
		
		// HTML
    	$description = cleanHTML($description, $setting['setting_getting_started_html']);
    	$description = censor($description);
    	$description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
		
		// SQL query
		$sql = "
			UPDATE
				se_getting_started_steps
			SET
				order_id='{$order_id}',
				title='{$title}',
				description='{$description}'
			WHERE
				step_id='{$step_id}'
			LIMIT
				1
		";
		
		// Run query
		$database->database_query($sql) or die($database->database_error());
	}
	
	/**
	 * Deletes a step
	 * 
	 * @param	int	$step_id	Represents the step's id
	 */
	function delete_step($step_id) {
		global $database;
		
		// SQL query
		$sql = "
			DELETE FROM
				se_getting_started_steps
			WHERE
				step_id='{$step_id}'
			LIMIT
				1
		";
		
		// Run query
		$database->database_query($sql) or die($database->database_error());
	}
	
	/**
	 * Get return url (If widgets is installed)
	 * 
	 * @param	string	$return_url		Represents the return's url
	 */
	function get_return_url() {
		global $database;
		
		// Check if widgets plugin is installed
		$is_installed = nsl::plugin_is_installed('widgets_home');
		
		// If widgets is installed, set return url to user_widgets_home.php
		if($is_installed > 0) {
			$return_url = 'user_widgets_home.php';
		} else {
			$return_url = 'user_home.php';
		}
		
		// Return url
		return $return_url;
	}
}

?>