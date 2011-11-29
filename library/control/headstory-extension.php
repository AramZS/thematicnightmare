<?php

  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }


//New Query to select the post set in the options page. 
$query = new WP_Query( 'p=' . $nmwp_head_post );

while ( $query->have_posts() ) : $query->the_post();
		if ( has_post_thumbnail() ) {
		?>
		
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail( 'head-thumb' ); ?>
			</a>
		
		<?php
		}
		?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>"><div class="rec-head-title">
		
		<?php
		if (strlen($post->post_title) > 60) {
			echo substr(the_title($before = '', $after = '', FALSE), 0, 57) . '...'; 
		} 
		else {
			the_title();
		}
		?>
		</div></a>
		<?php
endwhile;

//Reset post data
wp_reset_postdata();

?>