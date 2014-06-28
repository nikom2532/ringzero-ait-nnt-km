<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Template Class
 *
 * Build your CodeIgniter pages much easier with partials, breadcrumbs, layouts and themes
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category			Libraries
 * @author			Philip Sturgeon
 * @license			http://philsturgeon.co.uk/code/dbad-license
 * @link					http://philsturgeon.co.uk/code/codeigniter-template
 * @edit by			Supachai Komepiraprai
 */
class Template
{
	private $_module = '';
	private $_controller = '';
	private $_method = '';

	private $_layout = FALSE; // By default, dont wrap the view with anything
	private $_title = '';
	private $_view = array();
	private $_css = array();
	private $_js = array();
	private $_metadata = array();
	private $_breadcrumbs = array();
	private $_title_separator = ' | ';

	// Seconds that cache will be alive for
	private $cache_lifetime = 0;//7200;

	private $_ci;

	// ------------------------------------------------------------------------

	private $_data = array();

	/**
	 * Constructor - Sets Preferences
	 *
	 * The constructor can be passed an array of config values
	 */
	function __construct($config = array())
	{
		$this->_ci =& get_instance();
		$this->_ci->load->helper('url');

		if ( ! empty($config))
		{
			$this->initialize($config);
		}

		log_message('debug', 'Template class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize preferences
	 *
	 * @access	public
	 * @param	array	$config
	 * @return	void
	 */
	function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			$this->{'_'.$key} = $val;
		}

		// Modular Separation / Modular Extensions has been detected
		if (method_exists( $this->_ci->router, 'fetch_module' ))
		{
			$this->_module = $this->_ci->router->fetch_module();
		}

		// What controllers or methods are in use
		$this->_controller	= $this->_ci->router->fetch_class();
		$this->_method 		= $this->_ci->router->fetch_method();
	}

	// --------------------------------------------------------------------

	/**
	 * Magic Get function to get data
	 *
	 * @access	public
	 * @param	string	$name
	 * @return	mixed
	 */
	public function __get($name)
	{
		return isset($this->_data[$name]) ? $this->_data[$name] : NULL;
	}

	// --------------------------------------------------------------------

	/**
	 * Magic Set function to set data
	 *
	 * @access	public
	 * @param	string	$name
	 * @param	mixed	$value
	 * @return	mixed
	 */
	public function __set($name, $value)
	{
		$this->_data[$name] = $value;
	}

	// --------------------------------------------------------------------

	/**
	 * Set data using a chainable metod. Provide two strings or an array of data.
	 *
	 * @access	public
	 * @param	string	$name
	 * @param	mixed	$value
	 * @return	object	$this
	 */
	public function set($name, $value = NULL)
	{
		// Lots of things! Set them all
		if (is_array($name) OR is_object($name))
		{
			foreach ($name as $item => $value)
			{
				$this->_data[$item] = $value;
			}
		}

		// Just one thing, set that
		else
		{
			$this->_data[$name] = $value;
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Build the entire HTML output combining partials, layouts and views.
	 *
	 * @access	public
	 * @param	string	$view
	 * @param	array	$data
	 * @param	bool	$return
	 * @return	string
	 */
	public function build($view, $data = array(), $return = FALSE)
	{
		// Set whatever values are given. These will be available to all view files
		is_array($data) OR $data = (array) $data;

		// Merge in what we already have with the specific data
		$this->_data = array_merge($this->_data, $data);

		// We don't need you any more buddy
		unset($data);

		if (empty($this->_title))
		{
			$this->_title = $this->_guess_title();
		}

		// Output template variables to the template
		$template['title']			= $this->_title;
		$template['breadcrumbs']	= $this->_breadcrumbs;
		$template['metadata']		= implode("\n\t", $this->_metadata);
		$template['css']		= implode("\n\t", $this->_css);
		$template['js']		= implode("\n\t", $this->_js);

		foreach($this->_view as $key => $val)
		{
			$template[$key] = $val;
		}

		$this->_data['template'] =& $template;

		// Disable sodding IE7's constant cacheing!!
		$this->_ci->output->set_header('Expires: Sat, 01 Jan 2000 00:00:01 GMT');
		$this->_ci->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->_ci->output->set_header('Cache-Control: post-check=0, pre-check=0, max-age=0');
		$this->_ci->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
		$this->_ci->output->set_header('Pragma: no-cache');

		// Let CI do the caching instead of the browser
		$this->_ci->output->cache( $this->cache_lifetime );

		// Test to see if this file
		$this->_body = $this->_find_view( $view, array(), TRUE );

		// Want this file wrapped with a layout file?
		if ($this->_layout)
		{
			// Added to $this->_data['template'] by refference
			$template['body'] = $this->_body;

			// Find the main body and 3rd param means parse if its a theme view (only if parser is enabled)
			$this->_body =  self::_load_view($this->_layout, $this->_data, TRUE);
		}

		// Want it returned or output to browser?
		if ( ! $return)
		{
			$this->_ci->output->set_output($this->_body);
		}

		return $this->_body;
	}

	// ------------------------------------------------------------------------

	/**
	 * Build the entire JSON output, setting the headers for response.
	 *
	 * @access	public
	 * @param	array	$data
	 * @return	void
	 */
	public function build_json($data = array())
	{
		$this->_ci->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->_ci->output->set_output(json_encode((object) $data));
	}

	// ------------------------------------------------------------------------

	/**
	 * Set the title of the page
	 *
	 * @access	public
	 * @return	object	$this
	 */
	public function title()
	{
		// If we have some segments passed
		if ($title_segments =& func_get_args())
		{
			$this->_title = implode($this->_title_separator, $title_segments);
		}

		return $this;
	}

	// ------------------------------------------------------------------------

	/**
	 * Remove metdata tag of head data
	 *
	 * @access	public
	 * @param	string	$name		keywords, description, etc
	 * @param	string	$content	The content of meta data
	 * @param	string	$type		Meta-data comes in a few types, links for example
	 * @return	object	$this
	 */
	public function remove_meta($name, $content = '', $type = '')
	{
		//unset($this->_metadata[$line]);
		$content = empty($content) ? '' : $content;
		$type = empty($type) ? 'meta' : $type;
		$search = array_search($this->_find_meta($name,$content,$type),$this->_metadata);
		if(is_int($search)) {
			unset($this->_metadata[$search]);
		}
		return $this;
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Set metadata tag before all other head data
	 *
	 * @access	public
	 * @param	string	$name		keywords, description, etc
	 * @param	string	$content	The content of meta data
	 * @param	string	$type		Meta-data comes in a few types, links for example
	 * @return	object	$this
	 */
	public function meta($name, $content = '', $type = 'meta')
	{
		if(preg_match('/^(<(meta|link|script) (.+)>)(<\/script>)?/i', $name)) {
			$this->_metadata[] = $name;
		} else {
			$name = htmlspecialchars(strip_tags($name));
			$content = htmlspecialchars(strip_tags($content));

			// Keywords with no comments? ARG! comment them
			if ($name == 'keywords' AND ! strpos($content, ','))
			{
				$content = preg_replace('/[\s]+/', ', ', trim($content));
			}

			if($type == 'meta')
			{
				$this->_metadata[] = '<meta name="'.$name.'" content="'.$content.'" />';
			} else {
				$this->_metadata[] = '<link rel="'.$name.'" href="'.$content.'" />';
			}

			return $this;
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Find metadata tag to remove
	 *
	 * @access	private
	 * @param	string	$name		keywords, description, etc
	 * @param	string	$content	The content of meta data
	 * @param	string	$type		Meta-data comes in a few types, links for example
	 * @return		string	$meta_string
	 */
	private function _find_meta($name, $content, $type = 'meta') 
	{
		if(preg_match('/^(<(meta|link|script) (.+)>)(<\/script>)?/i', $name)) {
			$meta_string = $name;
		} else {
			$name = htmlspecialchars(strip_tags($name));
			$content = htmlspecialchars(strip_tags($content));

			// Keywords with no comments? ARG! comment them
			if ($name == 'keywords' AND ! strpos($content, ',')) {
				$content = preg_replace('/[\s]+/', ', ', trim($content));
			}

			if($type === 'meta') {
				$meta_string = '<meta name="'.$name.'" content="'.$content.'" />';
			} 
			else if($type === 'link') {
				$meta_string = '<link rel="'.$name.'" href="'.$content.'" />';
			}
		}
		return $meta_string;
	}

	// ------------------------------------------------------------------------

	/**
	 * Remove css stylesheet before rendering to head data
	 *
	 * @access	public
	 * @param	string	$line	The line being added to head
	 * @param	string	$attributes	type of stylesheet
	 * @return		object	$this
	 */
	public function remove_css($line, $attributes = array())
	{
		//array_unshift($this->_css, $line);
		$search = array_search($this->_find_css($line,$attributes) ,$this->_css);
		if(is_int($search)) {
			unset($this->_css[$search]);
		}
		return $this;
	}

	// ------------------------------------------------------------------------

	/**
	 * Set css stylesheet before rendering to head data
	 *
	 * @access	public
	 * @param	string	$line	The line being added to head
	 * @param	string	$attributes	type of stylesheet
	 * @return		object	$this
	 */
	public function css($line, $attributes = array())
	{
		$attribute_str = $this->_parse_asset_html($attributes);

		if ( ! preg_match('/rel="([^\"]+)"/', $attribute_str))
		{
			$attribute_str .= ' rel="stylesheet"';
		}

		$this->_css[] = '<link href="' . site_url($line) . '" type="text/css"' . $attribute_str . ' />' . "\n";
		return $this;
	}
	
	// ------------------------------------------------------------------------

	/**
	 * CSS URL
	 *
	 * Helps generate stylesheet locations.
	 *
	 * @access		public
	 * @param		string	$line	The line being added to head
	 * @param		string	$attributes	type of stylesheet
	 * @return			object	$this  
	 */
	public function css_url($line, $attributes = array())
	{
		if (strpos($line, '://') !== FALSE)
		{
			$attribute_str = $this->_parse_asset_html($attributes);
			if ( ! preg_match('/rel="([^\"]+)"/', $attribute_str))
			{
				$attribute_str .= ' rel="stylesheet"';
			}

			$this->_css[] = '<link href="' . $line . '" type="text/css"' . $attribute_str . ' />' . "\n";
		}
		return $this;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Find stylesheet tag to remove
	 *
	 * @access	private
	 * @param	string	$ling			keywords, description, etc
	 * @param	string	$attributes	type of stylesheet
	 * @return		string	$css_str
	 */
	private function _find_css($line, $attributes = array()) {
		$attribute_str = $this->_parse_asset_html($attributes);
		if ( ! preg_match('/rel="([^\"]+)"/', $attribute_str)) {
			$attribute_str .= ' rel="stylesheet"';
		}

		if (strpos($line, '://') !== FALSE){
			$css_str = '<link href="' . $line . '" type="text/css"' . $attribute_str . ' />' . "\n";
		} else {
			$css_str = '<link href="' . site_url($line) . '" type="text/css"' . $attribute_str . ' />' . "\n";
		}
		return $css_str;
	}

	// ------------------------------------------------------------------------

	/**
	 * Remove javascript before rendering to head data
	 *
	 * @access	public
	 * @param	string	$line	The line being added to head
	 * @return	object	$this
	 */
	public function remove_js($line)
	{
		//array_unshift($this->_js, $line);
		$search = array_search($this->_find_js($line),$this->_js);
		if(is_int($search)) {
			unset($this->_js[$search]);
		}
		return $this;
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Set javascript before rendering to head data
	 *
	 * @access	public
	 * @param	string	$line	The line being added to head
	 * @return		object	$this
	 */
	public function js($line)
	{
		$this->_js[] = '<script type="text/javascript" src="' . site_url($line) . '"></script>' . "\n";
		return $this;
	}
	
	// ------------------------------------------------------------------------

	/**
	 * JS URL
	 *
	 * Helps generate Javascript asset locations.
	 *
	 * @access		public
	 * @param		string    $line The line being added to head
	 * @return			object   $this
	 */
	public function js_url($line)
	{
		if (strpos($line, '://') !== FALSE)
		{
			$this->_js[] = '<script type="text/javascript" src="' . $line . '"></script>' . "\n";
		}
		return $this;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Find stylesheet tag to remove
	 *
	 * @access	private
	 * @param	string	$ling			The line being added to head
	 * @return		string	$js_str
	 */
	private function _find_js($line)
	{
		if (strpos($line, '://') !== FALSE) {
			$js_str = '<script type="text/javascript" src="' . $line . '"></script>' . "\n";
		} else {
			$js_str = '<script type="text/javascript" src="' . site_url($line) . '"></script>' . "\n";
		}
		return $js_str;
	}

	// ------------------------------------------------------------------------

	/**
	 * Which theme layout should we using here?
	 *
	 * @access	public
	 * @param	string	$view
	 * @param	string	$layout_subdir
	 * @return	object	$this
	 */
	public function set_layout($view, $layout_subdir = '')
	{
		$this->_layout = $view;

		$layout_subdir AND $this->_layout_subdir = $layout_subdir;

		return $this;
	}

	// ------------------------------------------------------------------------

	/**
	 * Helps build custom breadcrumb trails
	 *
	 * @access	public
	 * @param	string	$name	What will appear as the link text
	 * @param	string	$uri	The URL segment
	 * @return	 	object	$this
	 */
	public function set_breadcrumb($name, $uri = '')
	{
		$this->_breadcrumbs[] = array('name' => $name, 'uri' => $uri );
		return $this;
	}

	// ------------------------------------------------------------------------

	/**
	 * Set a the cache lifetime
	 *
	 * @access	public
	 * @param	int			$seconds
	 * @return		object	$this
	 */
	public function set_cache($seconds = 0)
	{
		$this->cache_lifetime = $seconds;
		return $this;
	}

	// ------------------------------------------------------------------------

	/**
	 * set_view
	 * Loaded and Grab the content of the view before building template
	 *
	 * @access	public
	 * @param	string	$name
	 * @param	string	$view
	 * @param	array		$data
	 * @return	 	object	$this
	 */
	public function set_view($name, $view, $data = array()) 
	{
		if( ! array_key_exists($name, $this->_view) )
		{
			$this->_view[$name] = $this->_ci->load->view($view,$data,TRUE);
		}
		return $this;
	}

	// ------------------------------------------------------------------------

	// A module view file can be overriden in a theme
	private function _find_view($view, array $data, $parse_view = TRUE)
	{
		return self::_load_view($view, $this->_data + $data);
	}

	// ------------------------------------------------------------------------

	private function _load_view($view, array $data, $parse_view = TRUE)
	{
		// Grab the content of the view (parsed or loaded)
		return $this->_ci->load->view($view, $data, TRUE );
	}

	// ------------------------------------------------------------------------

	private function _guess_title()
	{
		$this->_ci->load->helper('inflector');

		// Obviously no title, lets get making one
		$title_parts = array();

		// If the method is something other than index, use that
		if ($this->_method != 'index')
		{
			$title_parts[] = $this->_method;
		}

		// Make sure controller name is not the same as the method name
		if ( ! in_array($this->_controller, $title_parts))
		{
			$title_parts[] = $this->_controller;
		}

		// Is there a module? Make sure it is not named the same as the method or controller
		if ( ! empty($this->_module) AND !in_array($this->_module, $title_parts))
		{
			$title_parts[] = $this->_module;
		}

		// Glue the title pieces together using the title separator setting
		$title = humanize(implode($this->_title_separator, $title_parts));

		return $title;
	}

	// ------------------------------------------------------------------------

	/**
	 * Parse HTML Attributes
	 *
	 * Turns an array of attributes into a string
	 *
	 * @access		private
	 * @param		array		attributes to be parsed
	 * @return			string 	string of html attributes
	 */
	private function _parse_asset_html($attributes = NULL)
	{
		$attribute_str = '';

		if (is_string($attributes))
		{
			$attribute_str = $attributes;
		}
		else if (is_array($attributes) || is_object($attributes))
		{
			foreach ($attributes as $key => $value)
			{
				$attribute_str .= ' ' . $key . '="' . $value . '"';
			}
		}

		return $attribute_str;
	}
	// ------------------------------------------------------------------------
}

// END Template class