<?php

//via http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/

add_smart_meta_box('smart_meta_box_quote', array(
'title'     => 'Quote Meta',
'pages'		=> array('post'),
'context'   => 'normal',
'priority'  => 'high',
'fields'    => array(
array(
'name' => 'Quote Author',
'id' => 'quote_author',
'default' => '',
'desc' => 'The name of the author of the quote.',
'type' => 'text',
),array(
'name' => 'Quote Source',
'id' => 'quote_source',
'default' => '',
'desc' => 'The source document of the quote.',
'type' => 'text',
),array(
'name' => 'Quote Link',
'id' => 'quote_link',
'default' => '',
'desc' => 'A hyperlink to the quote, if one exists.',
'type' => 'text',
)
)

));

/**
 * jQuery show/hide for meta box, post editor meta box
 * 
 * Hides/Shows boxes on demand - depending on your selection inside the post formats meta box
**/
function wpse14707_scripts()
{

	
		wp_enqueue_script( 'jquery' );

		$script = '
		<script type="text/javascript">
			jQuery( document ).ready( function($)
				{
					$( "#smart_meta_box_quote" ).addClass( "hidden" );

					$( "input:not(#post-format-quote)" ).change( function() {
						$( "#postdivrich" ).removeClass( "hidden" );
						$( "#smart_meta_box_quote" ).addClass( "hidden" );
					} );

					$( "input#post-format-quote" ).change( function() {
						
						$( "#smart_meta_box_quote" ).removeClass( "hidden" );
					} );

					$( "input[name=\"post_format\"]" ).click( function() {
						var mydiv = $(this).attr( "id" ).replace( "post-format-", "" );
						$( "#smart_meta_box_quote div.inside div" ).addClass("hidden");
						$( "#smart_meta_box_quote div.inside div#"+mydiv).removeClass( "hidden" );
					} );
				}
			);
		</script>
		';

		return print $script;

}
add_action( 'admin_footer', 'wpse14707_scripts' );



?>