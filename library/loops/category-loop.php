<?php
function childtheme_override_category_loop() {


  
		global $options, $blog_id;
		
		foreach ($options as $value) {
		    if (get_option( $value['id'] ) === FALSE) { 
		        $$value['id'] = $value['std']; 
		    } else {
		    	if (THEMATIC_MB) 
		    	{
		        	$$value['id'] = get_option($blog_id,  $value['id'] );
		    	}
		    	else
		    	{
		        	$$value['id'] = get_option( $value['id'] );
		    	}
		    }
		}

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
	
  
  
  //Establish the array to hold the arguments for the query_posts
  $args = array(
	'paged' => get_query_var('paged')
	);
  
	query_posts($args);

	
	?>

	<div id="post-list" class="hfeed">
		<!--begin the posts loop-->
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); 
			//formats are stored in individual php files in the main directory in the filename convention of 
			//format-formatname.php. Nifty.
			//Via http://www.netmagazine.com/features/wordpress-post-formats-made-easy
		  if(!get_post_format()) {
               get_template_part('format', 'standard');
          } else {
               get_template_part('format', get_post_format());
          }
		
		?>
			<?php endwhile; ?>
			<?php else : ?>

				<h1 class="error-title">Not Found</h1>
				<p>Sorry, Unable to find what you are looking for. Try a different search.</p>
			
			<?php endif; ?>
			
		
	</div>
	<?php
	wp_reset_query();

}
?>