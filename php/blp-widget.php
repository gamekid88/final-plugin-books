<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * @package     EQM
 * @copyright   Copyright (c) 2015, Eric Rathmann
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
 
/**
  * This is the class the creates the widget within the wordpress system.
  *
  * 
  * @since 1.0
  */

class BLP_Book_Widget extends WP_Widget
{
    /**
  * This the function the creates the constructor for the widget. 
  *
  *
  * @since 1.0
  */
      function __construct() {
		parent::__construct( 'tm_random_widget', 'Testimonial Master Random Widget' );
	}

  /**
  * This the function that creates the title for the widget.
  *
  *
  * @since 1.0
  */
      function form( $instance ) {
		$defaults = array(
			'title'            => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'edd' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>"/>
		</p>

		<?php
	}

        
        /**
  * This the function that updates the widget.
  *
  *
  * @since 1.0
  */
      function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']            = strip_tags( $new_instance['title'] );
		return $instance;
	}

        /**
  * This is that displays the titles and authors in the widget.
  *
  *
  * @since 1.0
  */
       function widget( $args, $instance ) {
		$args['id']        = ( isset( $args['id'] ) ) ? $args['id'] : 'edd_cart_widget';
		$instance['title'] = ( isset( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $args['id'] );
		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
                 $eric_book_array = new WP_Query( array('post_type' => 'book', 'posts_per_page' => -1) );

                if( $eric_book_array->have_posts() )
                {
                    while( $eric_book_array->have_posts() )
                    {                    
                    $eric_book_array->the_post();
                    $title = get_the_title();
                    
                    echo "<p>$title</p>";                
                
                    }
                
                 
                }
                    echo $args['after_widget'];
            }
            
            
}