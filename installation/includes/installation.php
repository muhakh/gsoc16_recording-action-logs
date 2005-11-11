<?php
/**
* @version $Id$
* @package Joomla
* @subpackage Installation
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

error_reporting( E_ALL );
@set_magic_quotes_runtime( 0 );

if (file_exists( JPATH_ROOT . '/configuration.php' && filesize( JPATH_ROOT . '/configuration.php' ) > 10)) {
	header( 'Location: ../installation/index.php' );
	exit();
}

//Globals
$GLOBALS['mosConfig_absolute_path'] = JPATH_ROOT . DIRECTORY_SEPARATOR;
$GLOBALS['mosConfig_sitename']      = 'Joomla! - Web Installer';

require_once( JPATH_LIBRARIES . '/loader.php' );

//File includes
require_once( dirname(__FILE__). '/functions.php' );
require_once( dirname(__FILE__). '/classes.php' );
require_once( dirname(__FILE__). '/html.php' );

//Library imports
jimport( 'joomla.version' );
jimport( 'joomla.classes.app');
jimport( 'joomla.factory' );
jimport( 'joomla.files' );
jimport( 'joomla.xml' );

/**
* Joomla! Mainframe class
*
* Provide many supporting API functions
* @package Joomla
*/
class JInstallation extends JApplication {
	
	/**
	* Class constructor
	* @param database A database connection object
	*/
	function __construct( ) {
		
		if (!isset( $_SESSION['session_userstate'] )) {
			$_SESSION['session_userstate'] = array();
		}
		$this->_userstate =& $_SESSION['session_userstate'];

		$this->_head 			= array();
		$this->_head['title'] 	= $GLOBALS['mosConfig_sitename'];
		$this->_head['meta'] 	= array();
		$this->_head['custom'] 	= array();
		$this->_client 		    = 2;
	}
}

$mainframe =& new JInstallation();

/** @global $_VERSION */
$_VERSION = new JVersion();

$_LANG =& JFactory::getLanguage();
$_LANG->_load( JPATH_INSTALLATION .'/language/' . $mosConfig_lang . '.ini' );
?>
