<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
* Plugin Name: Eric's Book Logging System
* Description: This plugin will allows the admin to enter, edit, and delete book information. This information will be entered post meta and will require
 * no database. Shortcodes are included that will allow the admin to show all information, show author information, and allow a widget with book names to be 
 * created. Also inserting, editing, and deleting functionality is included.
* Version: 1.0
* Author: Eric Rathmann
* Author URI: http://www.mylocalwebstop.com/
* Plugin URI: http://www.mylocalwebstop.com/
* Text Domain: my-plugin
* Domain Path: /languages
* @author Eric Rathmann
* @version 1.0
*/

add_action('admin_menu', 'blp_book_panel');
add_action('init', 'blp_custom_post');
add_action('widgets_init', create_function('', 'return register_widget("BLP_Book_Widget");'));
include "php/blp-shortcode.php";
include "php/blp_mainsettings.php";
include "php/blp-globalsettings.php";
include 'php/blp-widget.php';
add_shortcode('full_book_list', 'show_all_books');
add_shortcode('group_by_author', 'show_by_author');



/**
  * Adds the admin file to the side and allows rest of the plugin to work
  *
  * @since 1.0
*/
function blp_book_panel()
{
	if (function_exists('add_menu_page'))
	{
		add_menu_page('Erics Book Logging System', 'Erics Book Logging System', 'moderate_comments', __FILE__, 'blp_book_logging_system');
                add_submenu_page(__FILE__, __('Global Settings', 'my-plugin'), __('Global Settings', 'my-plugin'), 'moderate_comments', 'blp_global_settings', 'blp_generate_settings_page');
        }

}
function blp_custom_post ()
{
    $labels = array(
		'name'               => 'Books',
		'singular_name'      => 'Book',
		'menu_name'          => 'Books',
		'name_admin_bar'     => 'Books',
		'add_new'            => 'Add New Book',
		'add_new_item'       => 'Add New Book',
		'new_item'           =>  'New Book',
		'edit_item'          =>  'Edit Book',
		'view_item'          =>  'View Book',
		'all_items'          => 'All Books',
		'search_items'       => 'Search Books',
		'parent_item_colon'  =>  'Parent Books:',
		'not_found'          => 'No books found.',
		'not_found_in_trash' =>  'No books found in Trash.'
	); 
        
        
    $args = array(
      'labels' => $labels,
      'public' => true,
      'label'  => 'Books',
      'post_title' => 'book_title'
    );
    register_post_type( 'book', $args );   
    
    
}// end custom post

?>