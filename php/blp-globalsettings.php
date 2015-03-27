<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * @package     EQM
 * @copyright   Copyright (c) 2015, Eric Rathmann
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
 



/**
  * This is the function that sets up the settings page. It registers the settings. 
  * It also adds two text boxes. 
  *
  * 
  *
  * @since 2.0
  */
function blp_init()
{
register_setting( 'blp-settings-group', 'blp-settings' );
add_settings_section( 'blp-global-section', 'Main Settings', 'blp_global_section', 'blp_global_settings' );
add_settings_field( 'main-text', 'Text above main shortcode.', 'main_title_shortcode_func', 'blp_global_settings', 'blp-global-section');
add_settings_field( 'author-text', 'Text displays above the author shortcode.', 'author_title_shortcode_func', 'blp_global_settings', 'blp-global-section');    
}

add_action('admin_init','blp_init');


/**
  * This the function that runs first on the page and echos out a statement.
  *
  * 
  * @since 1.0
  */
function my_global_section()
	{
		_e('These text areas are created at the top of the shortcode lists.','my-plugin'); 
	}

        
  /**
  * This the function that sets up the shortcode function for the main title in list of books.
  *
  * @since 1.0
  */
function main_title_shortcode_func()
	{
		$settings = (array) get_option( 'blp-settings' );
		$main_shortcode_title = '';
		if (isset($settings['main_shortcode_title']))
		{
			$main_shortcode_title = esc_attr( $settings['main_shortcode_title'] );
		}
		echo "<input type='text' name='blp-settings[main_shortcode_title]' id='blp-settings[main_shortcode_title]' value='$main_shortcode_title' />";
               
	}
 
        /**
  * This the function that sets up the author title in the book list.
  *
  *
  * @since 1.0
  */
function author_title_shortcode_func()
	{
		$settings = (array) get_option( 'blp-settings' );
		$author_shortcode_title = '';
		if (isset($settings['authpr_shortcode_title']))
		{
			$author_shortcode_title = esc_attr( $settings['author_shortcode_title'] );
		}
		echo "<input type='text' name='blp-settings[author_shortcode_title]' id='blp-settings[author_shortcode_title]' value='$author_shortcode_title' />";
               
	}       


        /**
  * This the function that generates the settings page for the admin.
  *
  * @since 2.0
  */
function blp_generate_settings_page()
	{
		?>
	<div class="wrap">
             <h2>Settings</h2>
                <form action="options.php" method="POST">
                    <?php settings_fields( 'blp-settings-group' ); ?>
                    <?php do_settings_sections( 'blp_global_settings' ); ?>
                    <?php submit_button(); ?>
                </form>
        </div>
		<?php
	}

?>