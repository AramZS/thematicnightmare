<?php 
/* Define the custom box */

add_action( 'add_meta_boxes', 'quote_add_custom_box' );

// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'quote_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'quote_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function quote_add_custom_box() {
    add_meta_box( 
        'quote_sectionid',
        __( 'Quote Info', 'quote_textdomain' ),
        'quote_inner_custom_box',
        'post' 
    );
}

/* Prints the box content */
function quote_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'quote_noncename' );

  // The actual fields for data entry
  echo '<label for="quote_author">';
       _e("Enter the author of the quote", 'quote_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="quote_author" name="quote_author" value="' . get_post_meta($post->ID, 'quote_author', true) . '" size="45" />';
  
  echo '<br /><label for="quote_source">';
       _e("Enter the source of the quote", 'quote_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="quote_source" name="quote_source" value=" " size="45" />';
  
  echo '<br /><label for="quote_link">';
       _e("Enter a link to the source of the quote", 'quote_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="quote_link" name="quote_link" value=" " size="80" />';
}

/* When the post is saved, saves our custom data */
function quote_save_metabox($post_id) {
// check nonce
if (!isset($_POST['quote_noncename']) || !wp_verify_nonce($_POST['quote_noncename'], 'quote_sectionid')) {
return $post_id;
}

// check capabilities
if ('post' == $_POST['post_type']) {
if (!current_user_can('edit_post', $post_id)) {
return $post_id;
}
} elseif (!current_user_can('edit_page', $post_id)) {
return $post_id;
}

// exit on autosave
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
return $post_id;
}

if(isset($_POST['quote_author'])) {
update_post_meta($post_id, 'quote_author', $_POST['quote_author']);
} else {
delete_post_meta($post_id, 'quote_author');
}
}

add_action('save_post', 'quote_save_metabox');



/**
 * jQuery show/hide for meta box, post editor meta box
 * 
 * Hides/Shows boxes on demand - depending on your selection inside the post formats meta box

function wpse14707_scripts()
{

	
		wp_enqueue_script( 'jquery' );

		$script = '
		<script type="text/javascript">
			jQuery( document ).ready( function($)
				{
					$( "#quote_sectionid" ).addClass( "hidden" );

					$( "input:not(#post-format-quote)" ).change( function() {
						$( "#postdivrich" ).removeClass( "hidden" );
						$( "#quote_sectionid" ).addClass( "hidden" );
					} );

					$( "input#post-format-quote" ).change( function() {
						
						$( "#quote_sectionid" ).removeClass( "hidden" );
					} );

					$( "input[name=\"post_format\"]" ).click( function() {
						var mydiv = $(this).attr( "id" ).replace( "post-format-", "" );
						$( "#quote_sectionid div.inside div" ).addClass("hidden");
						$( "#quote_sectionid div.inside div#"+mydiv).removeClass( "hidden" );
					} );
				}
			);
		</script>
		';

		return print $script;

}
add_action( 'admin_footer', 'wpse14707_scripts' );

 */

?>
