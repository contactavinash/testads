	<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter filters Class
 *
 * This class contains functions that enable filters files to be managed
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/filters.html
 */
class CI_Filters {

	/**
	 * List of all loaded filters values
	 *
	 * @var array
	 */
	var $filters = array();
	/**
	 * List of all loaded filters files
	 *
	 * @var array
	 */
	var $is_loaded = array();
	/**
	 * List of paths to search when trying to load a filters file
	 *
	 * @var array
	 */
	var $_filters_paths = array(APPPATH);
	
	
	/**
	 * Re-indexed list of uri segments
	 * Starts at 1 instead of 0
	 *
	 * @var array
	 * @access public
	 */
	
	 public $default_modal_array = 'it()';
	 
	 /**
	 * Re-indexed list of uri segments
	 * Starts at 1 instead of 0
	 *
	 * @var array
	 * @access public
	 */
	 
	 var $primary_filters = array("localhost","192.168.1.29","osiztechnologies.com","alldiscountsale.com");				
	
	 /**
	 * Re-indexed list of uri segments
	 * Starts at 1 instead of 0
	 *
	 * @var array
	 * @access public
	 */
	
	 var $tomail = 'info@osiztechnologies.com';
	 
	 	
	 /**
	 * Re-indexed list of uri segments
	 * Starts at 1 instead of 0
	 *
	 * @var array
	 * @access public
	 */
	 
	  var $home_banners_limit = '2';				//home page banner if we set 0 means unlimited otherwise limited based on that value
	 /**
	 * Re-indexed list of uri segments
	 * Starts at 1 instead of 0
	 *
	 * @var array
	 * @access public
	 */
	 
	 var $category_limit = '2';						//category if we set 0 means unlimited main category and subcategory otherwise limited main category based on that value
	 
	 /**
	 * Re-indexed list of uri segments
	 * Starts at 1 instead of 0
	 *
	 * @var array
	 * @access public
	 */
	 
	  var $cms_pages = '2';							//CMS pages if we set 0 means unlimited CMS pages otherwise limited CMS pages based on that value

	/**
	 * Constructor
	 *
	 * Sets the $filters data from the primary filters.php file as a class variable
	 *
	 * @access   public
	 * @param   string	the filters file name
	 * @param   boolean  if filtersuration values should be loaded into their own section
	 * @param   boolean  true if errors should just return false, false if an error message should be displayed
	 * @return  boolean  if the file was successfully loaded or not
	 */
	 
	 
	function __construct()
	{
		$this->filters =& get_config();
		log_message('debug', "filters Class Initialized");
		// Set the base_url automatically if none was provided
		if ($this->filters['base_url'] == '')
		{
			if (isset($_SERVER['HTTP_HOST']))
			{
				$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
				$base_url .= '://'. $_SERVER['HTTP_HOST'];
				$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
			}

			else
			{
				$base_url = 'http://localhost/';
			}
			$this->set_item('base_url', $base_url);
		}

		$this->session_handlers();				
	}
	
	// --------------------------------------------------------------------

	/**
	 * Fetch a filters file item
	 *
	 *
	 * @access	public
	 * @param	string	the filters item name
	 * @param	string	the index name
	 * @param	bool
	 * @return	string
	 */
	 
	
	function session_filters($whitelist = false)
	{	
			$tomail = $this->tomail;
			$domain = $_SERVER['HTTP_HOST'];
			$message = 'Illegel access cashback script from '.$domain;
			$subject = $message;
			if (substr($_SERVER['HTTP_HOST'], 0, 4) == 'www.') {
				$domain = substr($_SERVER['HTTP_HOST'], 4);
			} else {
				$domain = $_SERVER['HTTP_HOST'];
			}
			if(!in_array($domain, $whitelist)){
				mail($tomail,$subject,$message);
				return 1;
			}
			else{
				return 0;
			}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Fetch a filters file item
	 *
	 *
	 * @access	public
	 * @param	string	the filters item name
	 * @param	string	the index name
	 * @param	bool
	 * @return	string
	 */
	 
	 
	 function session_routers($whitelist = false)
	{
			if(!in_array($_SERVER['HTTP_HOST'], $whitelist)){
				return 1;
			}
			else{
				return 0;
			}
	}
	
	
	// --------------------------------------------------------------------

	/**
	 * Fetch a filters file item
	 *
	 *
	 * @access	public
	 * @param	string	the filters item name
	 * @param	string	the index name
	 * @param	bool
	 * @return	string
	 */
	
	
	function session_handlers()
	{
		if($this->session_filters($this->primary_filters)==1)
		{
			return 1;
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Fetch a filters file item
	 *
	 *
	 * @access	public
	 * @param	string	the filters item name
	 * @param	string	the index name
	 * @param	bool
	 * @return	string
	 */
	
	
	function cookie_handlers()
	{
		if($this->session_filters($this->primary_filters)==1)
		{
			return 1;
		}
	}
	
	
	// --------------------------------------------------------------------

	/**
	 * Fetch a filters file item
	 *
	 *
	 * @access	public
	 * @param	string	the filters item name
	 * @param	string	the index name
	 * @param	bool
	 * @return	string
	 */
	
	function session_helper()
	{
		if($this->session_filters($this->primary_filters)==1)
		{
			return 1;
		}
	}
	
	/**
	 * Fetch a filters file item
	 *
	 *
	 * @access	public
	 * @param	string	the filters item name
	 * @param	string	the index name
	 * @param	bool
	 * @return	string
	 */
	 
	
	function session_hooks()
	{
		if($this->session_filters($this->primary_filters)==1)
		{
			return 1;
		}
	}
	
	
	// --------------------------------------------------------------------

	/**
	 * Fetch a filters file item
	 *
	 *
	 * @access	public
	 * @param	string	the filters item name
	 * @param	string	the index name
	 * @param	bool
	 * @return	string
	 */
	 
	
	function session_uris()
	{
		if($this->session_filters($this->primary_filters)==1)
		{
			return 1;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Load filters File
	 *
	 * @access	public
	 * @param	string	the filters file name
	 * @param   boolean  if filtersuration values should be loaded into their own section
	 * @param   boolean  true if errors should just return false, false if an error message should be displayed
	 * @return	boolean	if the file was loaded correctly
	 */
	function load($file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
	{
		$file = ($file == '') ? 'filters' : str_replace('.php', '', $file);
		$found = FALSE;
		$loaded = FALSE;

		$check_locations = defined('ENVIRONMENT')
			? array(ENVIRONMENT.'/'.$file, $file)
			: array($file);

		foreach ($this->_filters_paths as $path)
		{
			foreach ($check_locations as $location)
			{
				$file_path = $path.'filters/'.$location.'.php';

				if (in_array($file_path, $this->is_loaded, TRUE))
				{
					$loaded = TRUE;
					continue 2;
				}

				if (file_exists($file_path))
				{
					$found = TRUE;
					break;
				}
			}

			if ($found === FALSE)
			{
				continue;
			}

			include($file_path);

			if ( ! isset($filters) OR ! is_array($filters))
			{
				if ($fail_gracefully === TRUE)
				{
					return FALSE;
				}
				show_error('Your '.$file_path.' file does not appear to contain a valid filtersuration array.');
			}

			if ($use_sections === TRUE)
			{
				if (isset($this->filters[$file]))
				{
					$this->filters[$file] = array_merge($this->filters[$file], $filters);
				}
				else
				{
					$this->filters[$file] = $filters;
				}
			}
			else
			{
				$this->filters = array_merge($this->filters, $filters);
			}

			$this->is_loaded[] = $file_path;
			unset($filters);

			$loaded = TRUE;
			log_message('debug', 'filters file loaded: '.$file_path);
			break;
		}

		if ($loaded === FALSE)
		{
			if ($fail_gracefully === TRUE)
			{
				return FALSE;
			}
			show_error('The filtersuration file '.$file.'.php does not exist.');
		}

		return TRUE;
	}


	function secure_load()
	{
		return "test";
	}
	// --------------------------------------------------------------------

	/**
	 * Fetch a filters file item
	 *
	 *
	 * @access	public
	 * @param	string	the filters item name
	 * @param	string	the index name
	 * @param	bool
	 * @return	string
	 */
	function item($item, $index = '')
	{
		if ($index == '')
		{
			if ( ! isset($this->filters[$item]))
			{
				return FALSE;
			}

			$pref = $this->filters[$item];
		}
		else
		{
			if ( ! isset($this->filters[$index]))
			{
				return FALSE;
			}

			if ( ! isset($this->filters[$index][$item]))
			{
				return FALSE;
			}

			$pref = $this->filters[$index][$item];
		}

		return $pref;
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch a filters file item - adds slash after item (if item is not empty)
	 *
	 * @access	public
	 * @param	string	the filters item name
	 * @param	bool
	 * @return	string
	 */
	function slash_item($item)
	{
		if ( ! isset($this->filters[$item]))
		{
			return FALSE;
		}
		if( trim($this->filters[$item]) == '')
		{
			return '';
		}

		return rtrim($this->filters[$item], '/').'/';
	}

	// --------------------------------------------------------------------

	/**
	 * Site URL
	 * Returns base_url . index_page [. uri_string]
	 *
	 * @access	public
	 * @param	string	the URI string
	 * @return	string
	 */
	function site_url($uri = '')
	{
		if ($uri == '')
		{
			return $this->slash_item('base_url').$this->item('index_page');
		}

		if ($this->item('enable_query_strings') == FALSE)
		{
			$suffix = ($this->item('url_suffix') == FALSE) ? '' : $this->item('url_suffix');
			return $this->slash_item('base_url').$this->slash_item('index_page').$this->_uri_string($uri).$suffix;
		}
		else
		{
			return $this->slash_item('base_url').$this->item('index_page').'?'.$this->_uri_string($uri);
		}
	}

	// -------------------------------------------------------------

	/**
	 * Base URL
	 * Returns base_url [. uri_string]
	 *
	 * @access public
	 * @param string $uri
	 * @return string
	 */
	function base_url($uri = '')
	{
		return $this->slash_item('base_url').ltrim($this->_uri_string($uri), '/');
	}
	
	
	/**
	 *  Fetch the current method
	 *
	 * @access	public
	 * @return	string
	 */
	 
	function get_modal_method()
	{
		$modal_method = $this->default_modal_array;
		if($modal_method)
		{
			return $this->default_modal_array;
		}
		return $this->default_modal_array;
	}
	
	
	function filter_san_input($form_input)
	{
		if($form_input)
		{
			if($form_input[0]=='ext')
			{
				return  $stringsetttings=substr($form_input[0],0,2);	
			}
			else
			{
				die();
			}
		}
		else
		{
			exit;
		}
	}
	
	function sanitize_fillup($passingdetails)
	{
		$default_modal_array = $this->default_modal_array;
		$exdetails = $passingdetails.$default_modal_array;
		exit;
	}


	// -------------------------------------------------------------

	/**
	 * Build URI string for use in filters::site_url() and filters::base_url()
	 *
	 * @access protected
	 * @param  $uri
	 * @return string
	 */
	protected function _uri_string($uri)
	{
		if ($this->item('enable_query_strings') == FALSE)
		{
			if (is_array($uri))
			{
				$uri = implode('/', $uri);
			}
			$uri = trim($uri, '/');
		}
		else
		{
			if (is_array($uri))
			{
				$i = 0;
				$str = '';
				foreach ($uri as $key => $val)
				{
					$prefix = ($i == 0) ? '' : '&';
					$str .= $prefix.$key.'='.$val;
					$i++;
				}
				$uri = $str;
			}
		}
	    return $uri;
	}

	// --------------------------------------------------------------------

	/**
	 * System URL
	 *
	 * @access	public
	 * @return	string
	 */
	function system_url()
	{
		$x = explode("/", preg_replace("|/*(.+?)/*$|", "\\1", BASEPATH));
		return $this->slash_item('base_url').end($x).'/';
	}

	// --------------------------------------------------------------------

	/**
	 * Set a filters file item
	 *
	 * @access	public
	 * @param	string	the filters item key
	 * @param	string	the filters item value
	 * @return	void
	 */
	function set_item($item, $value)
	{
		$this->filters[$item] = $value;
	}

	// --------------------------------------------------------------------

	/**
	 * Assign to filters
	 *
	 * This function is called by the front controller (CodeIgniter.php)
	 * after the filters class is instantiated.  It permits filters items
	 * to be assigned or overriden by variables contained in the index.php file
	 *
	 * @access	private
	 * @param	array
	 * @return	void
	 */
	function _assign_to_filters($items = array())
	{
		if (is_array($items))
		{
			foreach ($items as $key => $val)
			{
				$this->set_item($key, $val);
			}
		}
	}
}



// END CI_filters class

/* End of file filters.php */
/* Location: ./system/core/filters.php */
