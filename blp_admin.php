<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
* Plugin Name: Eric's Book Logging System
* Description: This plugin will allows the admin to enter, edit, and delete book information. This information will be entered post meta and will require
 * no database. Shortcodes are included that will allow the admin to show all information, show author information, and allow a widget with book names to be 
 * created.
* Version: 1.0
* Author: Eric Rathmann
* Author URI: http://www.mylocalwebstop.com/
* Plugin URI: http://www.mylocalwebstop.com/
* Text Domain: my-plugin
* Domain Path: /languages
* @author Eric Rathmann
* @version 1.0
*/

add_action('admin_menu', 'book_panel');



/**
  * Adds the admin file to the side and allows rest of the plugin to work
  *
  * @since 1.0
*/
function book_panel()
{
	if (function_exists('add_menu_page'))
	{
		add_menu_page('Erics Book Logging System', 'Erics Book Logging System', 'moderate_comments', __FILE__, 'book_logging_system');
	}
}


function custom_post ()
{
    $args = array(
      'public' => true,
      'label'  => 'Books',
      'post_title' => 'book_title'
    );
    register_post_type( 'book', $args );

    
    
    
    
}

?>