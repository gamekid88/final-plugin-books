<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * @package     EQM
 * @copyright   Copyright (c) 2015, Eric Rathmann
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
 
/**
  * This is the shortcode that displays all of the book, author, and all attributes that the admin has entered.
  *
  * @param array $atts Used to pass the results back to the website 
  * @since 1.0
  */

function show_all_books($atts)
{
    $display = '';
    $settings = (array) get_option( 'blp-settings' );
    $display .= esc_html($settings['main_shortcode_title']);
    
    $eric_book_array = new WP_Query( array('post_type' => 'book', 'posts_per_page' => -1) );

    if( $eric_book_array->have_posts() )
            {
                while( $eric_book_array->have_posts() )
                {                    
                    $eric_book_array->the_post();
                    
                    $title = get_the_title();
                    $author = get_post_meta( get_the_ID(), 'author', true );
                    $summary = get_post_meta( get_the_ID(), 'summary', true );
                    $thoughts = get_post_meta( get_the_ID(), 'thoughts', true );
               
                    $display .= "<h2>$title</h2>"; 
                    $display .= "<p> $author</p>";
                    $display .= "<p> $summary</p>";
                    $display .= "<p> $thoughts</p><br />";    
    
    
                }

            }
return $display;

}

/**
  * This the function that displays all the books by a certain author determined by the admin. 
  *
  *
  * @since 1.0
  */
function show_by_author ($atts)
{
	$display = '';
    $settings = (array) get_option( 'blp-settings' );
    $display .= esc_html($settings['author_shortcode_title']);
    
    extract(shortcode_atts(array(
     'author' => '0'
     ), $atts));
    
    $author_var = sanitize_text_field($author);
        
    $args = array(
   'post_type' => 'book',
   'posts_per_page' => -1,
   'meta_query' => array(
        array(
            'key'     => 'author',
            'value'   => $author_var,
            'compare' => '=',
            ),
         ),
       );
    
    
    $eric_book_array = new WP_Query($args);

    if( $eric_book_array->have_posts() )
            {
                while( $eric_book_array->have_posts() )
                {                    
                    $eric_book_array->the_post();
                    
                    $title = get_the_title();
                    $author = get_post_meta( get_the_ID(), 'author', true );
                    $summary = get_post_meta( get_the_ID(), 'summary', true );
                    $thoughts = get_post_meta( get_the_ID(), 'thoughts', true );
               
                    $display .= "<h2>$title</h2>"; 
                    $display .= "<p> $author</p>";
                    $display .= "<p> $summary</p>";
                    $display .= "<p> $thoughts</p><br />";    
    
    
                }

            }    
    return $display;
}





?>
