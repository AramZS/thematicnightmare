<?php
  


function nmwp_standout_tag() {
  // load the custom options
  // DAMN IT, REMEMBER TO DO THIS INSIDE THE FUNCTION.
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }
/**

	Ok, so, we're going to try and implement the Google's standout tag. Information about implementation is at http://www.google.com/support/news_pub/bin/answer.py?answer=191283. However it isn't entirely clear IMO, so I'm implementing what I think of as the 'safe' version. The most minimal possible use of the standout tag while encorperating the highlighted story you designate for the header. 
	
	This way we're pretty much trying to follow the standard Google rule of 'don't put SEO information in the header if the content doesn't exist on your page.' 

**/

//I'm not clear if Google cares if you use the standout tag to link to the same article multiple times across your site. But just in case, let's...

	if ( is_home() || is_front_page() ) {
	
		//New Query to select the post set in the options page as featured in the header. 
		$standout_query = new WP_Query( 'p=' . $nmwp_head_post );
		while ( $standout_query->have_posts() ) : $standout_query->the_post();
		?>
			<link rel="standout" href="<?php the_permalink(); ?>">
		<?php
		endwhile;

		//Reset post data
		wp_reset_postdata();
	
	}

}

add_action('wp_head', 'nmwp_standout_tag');

?>