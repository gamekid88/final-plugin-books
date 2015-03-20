<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * @package     EQM
 * @copyright   Copyright (c) 2015, Eric Rathmann
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
 
/**
  * This is the shortcode that displays all of the quotes and authors that the admin has entered.
  *
  * @param array $atts Used to pass the results back to the website
  * @return $short_display_quote 
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

function my_global_section()
	{
		echo 'These text areas are created at the top of the shortcode lists.';
	}

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


function generate_settings_page()
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