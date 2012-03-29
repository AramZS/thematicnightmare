<?php



function childtheme_override_access() {  

  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }

	//I will want to place a value in this variable inside this function and then retrieve it elsewhere. 
  global $firstslide;
  global $poppost;
  
?>


	    
	    <nav>
	    		
	    	<div class="skip-link"><a href="#content" title="<?php _e('Skip navigation to the content', 'thematic'); ?>"><?php _e('Skip to content', 'thematic'); ?></a></div><!-- .skip-link -->
	    		
	    	<?php 
	    		
	    	if ((function_exists("has_nav_menu")) && (has_nav_menu(apply_filters('thematic_primary_menu_id', 'primary-menu')))) {
	    		echo  wp_nav_menu(thematic_nav_menu_args());
    		} else {
    			echo  thematic_add_menuclass(wp_page_menu(thematic_page_menu_args()));	
    		}
    		
	    	?>
	        
		</nav><!-- #access -->
		
<?php 

	//Sliders are for home page only boyo. 
	if (is_home() ):
	//Just declaring an empty variable, prob do not need to do this. 
	$firstslide = "";
	//So lets see. We need to take the comma seperated list of category IDs and manipulate them into seperate loops for each category. 
	
	$exploded_slider_cats = explode(",", $nmwp_slider_cat);
	
	//Ok, now need to count the number of categories to be checked against the counter. 
	
	$cats_item_count = count($exploded_slider_cats);
	
	//Let's start the counter at 1, we just have to account for it. 
	$k = 1;
	
			function filter_where( $where = '' ) {
			// posts in the last 1 to 90 days
			$where .= " AND post_date < '" . date('Y-m-d', strtotime('-2 days')) . "'";
			return $where;
			}
	
?>
		
		<aside id="featured" class="bclass">
<?php
	//Loop categories in use. 
	foreach ($exploded_slider_cats as $value) {
		
		//Note the meta key here. This should only select stories with featured images, eliminating the need for if checks. 
		add_filter( 'posts_where', 'filter_where' );
		$sliderquery = new WP_Query( array( 'cat' => $value, 'showposts' => 5) );
		remove_filter( 'posts_where', 'filter_where' );
			?><div class="slide">
			<h4><?php echo get_cat_name($value); ?></h4>
			<?php
				
			while ( $sliderquery->have_posts() ) : $sliderquery->the_post();
		
	
?>			
				
					<div class="subslider ss<?php echo $k; ?>">	
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail( 'slide-thumb' ); ?></a>
						<?php } else { ?>
							<a href="<?php the_permalink(); ?>"><img class="attachment-slide-thumb" src="<?php bloginfo('template_directory'); ?>/library/imgs/sliderdummy.png" alt="" /></a>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>"><div class="slider-item-title">
							
							<?php
							//If title is longer than 60chars, prob not going to fit. 
							if (strlen($post->post_title) > 60) {
								echo substr(the_title($before = '', $after = '', FALSE), 0, 57) . '...'; 
							} 
							else {
								the_title();
							}
							?>
						</div></a>
						
					</div>
					
					<?php
					
					/**This delivers the ID of the first post of each slide (category) to the global variable in a comma seperated list. 
					
					Note: This is built to scale, so no matter how many categories are used to populate the slider, the first item of every category in the slider will be excluded from the post list on the home page **/
					
					if ($k == 1) {
						$firstslide .= get_the_ID() . ",";
						
					}
					$k++;
					if ($k > 5) { $k=1; }
			
			//end the loop. 			
			endwhile;
			// end the slide ?>
			</div>
			<?php
				
	wp_reset_postdata();
	wp_reset_query();
	}
	//One extra slide for popular stories. Works with the Jetpack wordpress stats stuff.
	/**Notes on the API at http://wordpress.stackexchange.com/questions/12189/using-stats-get-csv-to-return-a-list-of-popular-posts-by-views-with-thumbnails in answers. **/
	include('popularstories.php'); 
	?>
		
		
	<?php if ( function_exists('get_stats_exclude_home') && $popPosts = get_stats_exclude_home(14,6) ) : 
	$poppost = "";
	$post = "";
	?>
		<div class="slide">
		<h4>Popular</h4>
		<?php foreach ( $popPosts as $p ) :
				 $poppost .= $p['post_id'] . ",";
				 
				 
				 ?>
		<?php endforeach; 
	
		/**For testing purposes:
		$poppost = "5060,5006,4978,4924,4943,";**/
	
		$popArg = array(
							'showposts' => 5,
							'post__in' => explode(",", $poppost)
						);
	
			$popQuery = new WP_Query($popArg);
			while ( $popQuery->have_posts() ) : $popQuery->the_post();
			
			?>	
					<div class="subslider ss<?php echo $k; ?>">	
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail( 'slide-thumb' ); ?></a>
						<?php } else { ?>
							<a href="<?php the_permalink(); ?>"><img class="attachment-slide-thumb" src="<?php bloginfo('template_directory'); ?>/library/imgs/sliderdummy.png" alt="" /></a>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>"><div class="slider-item-title">
							
							<?php
							//If title is longer than 60chars, prob not going to fit. 
							//This isn't working, it's just outputting the elipsis. Got to fix.
							if (strlen($post->post_title) > 60) {
								echo substr(the_title($before = '', $after = '', FALSE), 0, 57) . '...'; 
							} 
							else {
								the_title();
							}
							?>
						</div></a>
						
					</div>
					
					<?php
					
					/**This delivers the ID of the first post of each slide (category) to the global variable in a comma seperated list. 
					
					Note: This is built to scale, so no matter how many categories are used to populate the slider, the first item of every category in the slider will be excluded from the post list on the home page **/
					
					if ($k == 1) {
						$firstslide .= get_the_ID() . ",";
						
					}
					$k++;
					if ($k > 5) { $k=1; }
			
			//end the loop.
				endwhile; 			
			
		
			// end the slide ?>
			</div>
			<?php
			endif;
				
	wp_reset_postdata();
	wp_reset_query();
	?>
	</aside>
	<?php	return $firstslide; 
	?>	
			
		
		
<?php 
		

		endif; //end check for home. 
		return $firstslide;
}
		
		add_action('thematic_header','thematic_access',9);
?>