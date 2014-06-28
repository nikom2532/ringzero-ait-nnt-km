<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
    
	/**
	 * Database Loader
	 *
	 * @access	public
	 * @param	string	the DB credentials
	 * @param	bool	whether to return the DB object
	 * @param	bool	whether to enable active record (this allows us to override the config setting)
	 * @return	object
	 */
	function database($params = '', $return = FALSE, $active_record = NULL) 
	{
	    
		// Grab the super object
		$CI =& get_instance();

		// Do we even need to load the database class?
		if (class_exists('CI_DB') AND $return == FALSE AND $active_record == NULL AND isset($CI->db) AND is_object($CI->db)) 
		{
			return FALSE;
		}

		require_once(BASEPATH.'database/DB'.EXT);

		// Load the DB class
        $db =& DB($params, $active_record);

        $my_driver = config_item('subclass_prefix').'DB_'.$db->dbdriver.'_driver';
        $my_driver_file = APPPATH.'core/'.$my_driver.EXT;

        if (file_exists($my_driver_file)) {
            require_once($my_driver_file);
            $db = new $my_driver(get_object_vars($db));
        }

        if ($return === TRUE) {
            return $db;
        }

        // Initialize the db variable.  Needed to prevent
        // reference errors with some configurations
        $CI->db = '';
        $CI->db = $db;
		
		log_message('debug', 'Database is active Driver "'. $CI->db->dbdriver . '"');
	}
}