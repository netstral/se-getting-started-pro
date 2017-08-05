<?

// Set plugin variables
$plugin_name 		   = 'Getting Started Pro Plugin';
$plugin_version 	   = '3.00';
$plugin_type 		   = 'getting_started';
$plugin_desc 		   = 'Provides your members with a simple getting started guide upon their first login.';
$plugin_icon 		   = 'gs16.png';
$plugin_menu_title     = '12000050';
$plugin_pages_main     = '12000050<!>gs16.png<!>admin_getting_started.php<~!~>';
$plugin_pages_level    = '12000065<!>admin_levels_getting_startedsettings.php<~!~>';
$plugin_db_charset     = 'utf8';
$plugin_db_collation   = 'utf8_unicode_ci';
$plugin_reindex_totals = TRUE;

if($install == 'getting_started') 
{
  	//######### GET CURRENT PLUGIN INFORMATION
  	$sql 	  = "SELECT * FROM se_plugins WHERE plugin_type = '{$plugin_type}' LIMIT 1";
  	$resource = $database->database_query($sql) or die($database->database_error()."<b>SQL was:</b> {$sql}");
 
  	$plugin_info = array();
	
  	if($database->database_num_rows($resource))
    	$plugin_info = $database->database_fetch_assoc($resource);


  	//######### INSERT ROW INTO se_plugins
	$sql 	  = "SELECT plugin_id FROM se_plugins WHERE plugin_type = '{$plugin_type}'";
  	$resource = $database->database_query($sql) or die($database->database_error()."<b>SQL was:</b> {$sql}");
	
  	if(!$database->database_num_rows($resource)) 
	{
		$sql = "
			INSERT INTO 
				se_plugins
			SET
				plugin_name 		= '{$plugin_name}',
				plugin_version 	    = '{$plugin_version}',
				plugin_type 		= '{$plugin_type}',
				plugin_desc 		= '".str_replace("'", "\'", $plugin_desc)."',
				plugin_icon 		= '{$plugin_icon}',
				plugin_menu_title   = '{$plugin_menu_title}',
				plugin_pages_main   = '{$plugin_pages_main}',
				plugin_pages_level  = '{$plugin_pages_level}',
				plugin_url_htaccess = '{$plugin_url_htaccess}'
		";
		
		$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
	}

  	//######### UPDATE PLUGIN VERSION IN se_plugins
	else
	{
		$sql = "
			UPDATE 
				se_plugins
			SET 
				plugin_name 		= '{$plugin_name}',
				plugin_version		= '{$plugin_version}',
				plugin_desc  		= '".str_replace("'", "\'", $plugin_desc)."',
				plugin_icon			= '{$plugin_icon}',
				plugin_menu_title	= '{$plugin_menu_title}',
				plugin_pages_main	= '{$plugin_pages_main}',
				plugin_pages_level	= '{$plugin_pages_level}',
				plugin_url_htaccess	= '{$plugin_url_htaccess}' 
			WHERE 
				plugin_type 		= '{$plugin_type}'
		";
		
    	$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
	}
	
	
	//######### CREATE se_getting_started
	$sql = "SHOW TABLES FROM {$database_name} LIKE 'se_getting_started'";
	$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
  
	if(!$database->database_num_rows($resource))
	{
		$sql = "
			CREATE TABLE IF NOT EXISTS `se_getting_started`
			(
				`id` 			INT 			UNSIGNED  NOT NULL auto_increment,
				`user_id`		INT 			UNSIGNED  NOT NULL default 0,
				`created`		BIGINT			UNSIGNED  NOT NULL default 0,
				`status`		VARCHAR(50)		              NULL default NULL,
				PRIMARY KEY (`id`),
				UNIQUE (`user_id`),
				INDEX (`status`)
			)

			ENGINE=MyISAM CHARACTER SET {$plugin_db_charset} COLLATE {$plugin_db_collation}
		";
    
		$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
	}
	
	
	
	//######### CREATE se_getting_started_steps
	$sql = "SHOW TABLES FROM {$database_name} LIKE 'se_getting_started_steps'";
	$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
  
	if(!$database->database_num_rows($resource))
	{
		$sql = "
			CREATE TABLE IF NOT EXISTS `se_getting_started_steps`
			(
				`step_id` 		INT 			UNSIGNED  NOT NULL auto_increment,
				`order_id`		INT				UNSIGNED  NOT NULL default 0,
				`created`		BIGINT			UNSIGNED  NOT NULL default 0,
				`title`			VARCHAR(128)			  NOT NULL default '',
				`description`	LONGTEXT				  NOT NULL default '',
				PRIMARY KEY (`step_id`)
			)

			ENGINE=MyISAM CHARACTER SET {$plugin_db_charset} COLLATE {$plugin_db_collation}
		";
    
		$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
	}


  	//######### ADD COLUMNS se_levels
	$sql = "SHOW COLUMNS FROM `{$database_name}`.`se_levels` LIKE 'level_getting_started_view'";
	$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
  
	if(!$database->database_num_rows($resource))
	{
		$sql = "
			ALTER TABLE se_levels 
				ADD COLUMN `level_getting_started_view`      TINYINT       UNSIGNED  NOT NULL default 1
		";
    
		$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
	}
	
	
	
	//######### ADD COLUMNS/VALUES TO SETTINGS TABLE
	$sql = "SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_getting_started_html'";
	$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was: </b>$sql");
  
	if(!$database->database_num_rows($resource))
	{
		$sql = "ALTER TABLE se_settings ADD COLUMN `setting_getting_started_html`	VARCHAR(128)	NOT NULL default 'strong,b,em,i,u,strike,sub,sup,p,div,pre,address,h1,h2,h3,h4,h5,h6,span,ol,li,ul,a,img,embed'";
		$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was: </b>$sql");
	}
	
	
	
	//######### INSERT LANGUAGE VARS
  	if($database->database_num_rows($database->database_query("SELECT languagevar_id FROM se_languagevars WHERE languagevar_id = 12000050 LIMIT 1")) == 0) 
	{
    	$sql = "
				INSERT INTO se_languagevars 
					(languagevar_id, languagevar_language_id, languagevar_value, languagevar_default) 
				VALUES 
					(12000050, 1, 'Getting Started Pro', ''), 
					(12000051, 1, 'This page contains general settings for the Getting Started Pro plugin.', ''),
					(12000052, 1, 'General Steps Settings', ''),
					(12000053, 1, 'Easily add new steps to your Getting Started guide.', ''),
					(12000054, 1, 'Add a New Step', ''),
					(12000055, 1, 'This step will be completely removed from the guide, are you sure you want to continue?', ''),
					(12000056, 1, 'Order ID', ''),
					(12000057, 1, 'Title', ''),
					(12000058, 1, 'Add Step', ''),
					(12000060, 1, 'steps', ''),
					(12000061, 1, 'Go to your homepage', ''),
					(12000062, 1, 'Next Step', ''),
					(12000063, 1, 'Previous Step', ''),
					(12000064, 1, 'Skip Guide', ''),
					(12000065, 1, 'GS Pro Settings', '')
		";
		
		$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was:</b> {$sql}");
  	}
}

?>