<?php
function childtheme_override_author_loop() {

  
	?>

	<div id="post-list" class="hfeed">
		<!--begin the posts loop-->
		<?php 
		
		rewind_posts();
		
		while (have_posts()) : the_post(); 
		
		thematic_abovepost(); 
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
			
		
	</div>
	<?php
	wp_reset_query();


}
?>