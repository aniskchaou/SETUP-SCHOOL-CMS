<?php
/*
Plugin Name: School Management
Plugin URI: http://www.mobilewebs.net/mojoomla/extend/wordpress/school/
Description: School Management System Plugin for wordpress is ideal way to manage complete school operation. 
The system has different access rights for Admin, Teacher, Student and Parent.
Version: 58.0
Author: Mojoomla
Author URI: http://codecanyon.net/user/dasinfomedia
Text Domain: school-mgt
Domain Path: /languages
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Copyright 2015  Mojoomla  (email : sales@mojoomla.com)
*/
 
define( 'SMS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

define( 'SMS_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

define( 'SMS_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );
define( 'SMS_CONTENT_URL',  content_url( ));

require_once SMS_PLUGIN_DIR . '/settings.php';
require_once SMS_PLUGIN_DIR . '/api/school-api-files.php';

?>