<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * @package     BLP
 * @copyright   Copyright (c) 2014, Eric Rathmann
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */


function insert_book ()
{
    if(isset($_POST['saved-book-name']) AND (wp_verify_nonce( $_POST['nonce_field'], 'nonce_check')))	
    {
    	$book_name = sanitize_text_field($_POST['saved-book-name']);
	$author = sanitize_text_field($_POST['saved-author-name']);
        $summary = sanitize_text_field($_POST['saved-summary']);
	$thoughts = sanitize_text_field($_POST['saved-thoughts']);
        
        $my_post = array(
         post_title => $book_name,
         post_status => 'publish'
         );
        
        $post_id = wp_insert_post( $my_post );
        add_post_meta( $post_id, 'author', $author, true);
        add_post_meta( $post_id, 'summary', $summary, true);
        add_post_meta( $post_id, 'thoughts', $thoughts, true);    
     
    }

}


function delete_book ()
{
   if(isset($_POST['delete_book_id']) && wp_verify_nonce( $_POST['nonce_field'], 'nonce_check')) 
	{
            $deleted_book_id = intval($_POST["delete_book_id"]);
            wp_delete_post( $deleted_book_id, true );
    
        }
    
function edit_book ()
{
    if(isset($_POST['hid_edit_book_id']) && wp_verify_nonce( $_POST['nonce_field'], 'nonce_check')) 
        {   
            $hid_edit_book_id = intval($_POST["hid_edit_book_id"]);
            $edit_book_name = sanatize_text_field(($_POST["edit-book-name"]));
            $edit_author_name = sanatize_text_field(($_POST["edit-author-name"]));
            $edit_summary = sanatize_text_field(($_POST["edit-summary-name"]));
            $edit_thoughts = sanatize_text_field(($_POST["edit-thoughts-name"]));
            
            $my_post = array(
                'ID' => $hid_edit_book_id,
                'post_title' => $edit_book_name
            );
            
             wp_update_post( $my_post );
             
             update_post_meta( $hid_edit_book_id , 'author', $edit_author_name);
             update_post_meta( $hid_edit_book_id , 'summary', $edit_summary);
             update_post_meta( $hid_edit_book_id , 'thoughts', $edit_thoughts);
         }
    
 
        
    
}

function load_book()
{
	
	$eric_book_array = new WP_Query( array('post_type' => 'book', 'posts_per_page' => -1) );
        
	?><h2><?php _e('Quotes and their Authors','my-plugin');?></h2>
	<table class="widefat">
            <thread>
                <tr>
                    <th><?php _e('Book Name','book-logging-plugin'); ?></th>
                    <th><?php _e('Author','book-logging-plugin'); ?></th>
<                   <th><?php _e('Summary','book-logging-plugin'); ?></th>
                    <th><?php _e('Thoughts','book-logging-plugin'); ?></th>
                    
                </tr>
            </thread>
	<?php 
	 if( $eric_book_array->have_posts() )
            {
                while( $eric_book_array->have_posts() )
                {                    
                    $eric_book_array->the_post();
                    
                    $title = get_the_title();
                    $author = get_post_meta( get_the_ID(), 'author', true );
                    $summary = get_post_meta( get_the_ID(), 'summary', true );
                    $thoughts = get_post_meta( get_the_ID(), 'thoughts', true );
                
                  
		?>
		<tr>
			<td>
				<form action="" method="post"><input type="hidden" name="delete_quote" value="confirmation" />
					<input type="hidden" name="delete_book_id" value="<?php echo esc_attr(get_the_ID()); ?>" />
					<input type="submit" value= <?php _e('Delete','my-plugin');?> />
					<?php wp_nonce_field('nonce_check','nonce_field'); ?>
				</form>
			</td>
			<td><button onclick="show_popup(<?php echo $value["quote_id"]; ?>);">Edit</button></td>
			<td><?php echo esc_html($title); ?></td>
			<td><?php echo esc_html($author); ?></td>
                        <td><?php echo esc_html($summary); ?></td>
                        <td><?php echo esc_html($thoughts); ?></td>
                        
			<div style =" display:none;" id="dialog<?php echo$value["quote_id"]; ?>" title=<?php _e('Edit Book','my-plugin');?>>
				<form action="" method="post"><input type="hidden" name="hid_edit_quote" value="confirmation" />
					<input type="hidden" name="hid_edit_book_id" value="<?php echo esc_attr(get_the_ID()); ?>" />
					<?php _e('Please edit the book name:','my-plugin')?> <input type= "text" name="edit-book-name" value= "<?php echo $title; ?>" ><br />   
					<?php _e('Please edit the author:','my-plugin')?> <input type= "text" name="edit-author-name" value="<?php echo $author;?>"><br />
                                        <?php _e('Please edit the summary:','my-plugin')?> <textarea name="edit-summary"> <?php echo esc_textarea($summary);?></textarea><br />
                                        <?php _e('Please edit the thoughts:','my-plugin')?> <textarea name="edit-thoughts"> <?php echo esc_textarea($thoughts);?></textarea><br />
					<input type="submit" name="submit_edit" value=<?php _e('Submit Edit','my-plugin');?>
				</form>
			</div> 
		</tr>
		<?php
	} 
	?> 
         <tfoot>
            <tr>
            <th><?php _e('Book Name','testmonial-master'); ?></th>
            <th><?php _e('Author','testmonial-master'); ?></th>
            <th><?php _e('Summary','testmonial-master'); ?></th>
            <th><?php _e('Thoughts','testmonial-master'); ?></th>
            </tr>
        </tfoot>
	</table>
	<form action="" method="post">
		<?php _e('Please enter a book name:','my-plugin')?> <input type="text" name="saved-book-name"><br />   
		<?php _e('Please enter the author:','my-plugin')?> <input type="text" name="saved-author-name"><br />
                <?php _e('Please enter the summary:','my-plugin')?> <input type="text" name="saved-summary"><br />
                <?php _e('Please enter the thoughts:','my-plugin')?> <input type="text" name="saved-thoughts"><br />
                
		<input type="submit" value="<?php _e('Add Quote','my-plugin');?>"/>
		<?php wp_nonce_field('nonce_check','nonce_field'); ?>
	</form>
	<?php 
}// end function load_quote





?>