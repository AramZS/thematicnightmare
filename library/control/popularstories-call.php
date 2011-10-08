<?php
function nmwp_popularstories() {

	//Remember that global variable I called a while back? Let's bring it back. 
  global $firstslide;
  
  //Establish the array to hold the arguments for the query_posts
  $args = array(
	/**Here post__not_in expects an array. You'd think you could put a comma seperated
	string here and that would be fine, but you can't. Instead you have to explode the comma seperated list into an array**/
	'post__not_in' => explode(",", $firstslide),
	'posts_per_page' => 10
	);
		?><div id="divMostReadPosts">
		<?php if ( function_exists('get_stats_exclude_home') && $top_posts = get_stats_exclude_home(7,3) ) : ?>
			<h3>Most Read Recent Posts</h3>
			<ul>
		<?php foreach ( $top_posts as $p ) : ?>
				<li><a href="<?php echo $p['post_permalink']; ?>"><?php echo $p['post_title']; ?></a></li>
		<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		</div> <?php
	
}

add_action('thematic_above_indexloop','nmwp_popularstories');
?>

		$poppost  = '';
		
		if ( function_exists('get_stats_exclude_home') && $top_posts = get_stats_exclude_home(7,5) ) : 
		?><div class="slide"><?php
			foreach ( $top_posts as $p ) : 
			
			/**
			For some insane reason, the people who made WP decided to use entirely different methods to call items when dealing with their analytics API. Forget about this, says I. I'll just loop in yet another WP_Query and turn the caching up. This is a terrible solution, work on optimizing it later. 
			**/
			
				$post = get_post($p['post_id']);
				echo 'Post ID: ';
				echo $p['post_id'];
				echo 'Next- ';
				?><a href="<?php echo $p['post_permalink']; ?>"><?php echo $p['post_title']; ?></a><?php
				//Yes, I'm doing this again. It works. 
				$poppost .= $post . ",";
				return $poppost;
			
			endforeach;
			wp_reset_postdata();
			echo $poppost;
			$pop_arg = array(
								'post__in' => explode(",", $poppost)
							);
			
			$pop_query = new WP_Query($pop_arg);
			while ( $pop_query->have_posts() ) : $pop_query->the_post();
			
			?>	
					<div class="subslider ss<?php echo $k; ?>">	
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail( 'slide-thumb' ); ?></a>
						<?php } else { ?>
							<a href="<?php the_permalink(); ?>"><img class="attachment-slide-thumb" src="<?php bloginfo('template_directory'); ?>/library/imgs/sliderdummy.png" alt="" /></a>
						<?php } ?>
						<div class="slider-item-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
							<?php
							//If title is longer than 60chars, prob not going to fit. 
							if (strlen($post->post_title) > 60) {
								echo substr(the_title($before = '', $after = '', FALSE), 0, 57) . '...'; 
							} 
							else {
								the_title();
							}
							?>
						</a></div>
						
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