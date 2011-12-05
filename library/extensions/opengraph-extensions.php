<?php

function nmwp_opengraph() /*function opens*/{

  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }

	if ( is_home() ) /*is home opens*/{

		?><meta property="og:title" content="<?php bloginfo('name'); ?>"/><?php
	
		//If the user has designated a default thumbnail for their site, output into an opengraph tag. 
		if ( empty($nmwp_fb_thumb) == FALSE ) {
	
			?><meta property="og:image" content="<?php echo $nmwp_fb_thumb; ?>"/><?php
		
		}
		?><meta property="og:url" content="<?php bloginfo('url') ?>" /><?php
		?><meta property="og:type" content="website" /><?php
		if ( empty($nmwp_fb_og_descrip) == FALSE ) {
			
			?><meta property="og:description"
					content="<?php echo $nmwp_fb_og_descrip; ?>" /><?php
		} else {
			
			$blogtagline = get_bloginfo('description');
			
			?><meta property="og:description"
					content="<?php echo $blogtagline; ?>" /><?php
		
		}
	
	} /*is home closes opens*/ else { /*not home opens*/
		
		
		?><meta property="og:url" content="<?php echo get_permalink(); ?>"/><?php

		//Open Graph has a special way to recognize author pages. If it is an author page, let's display that. If it is an archive, it's a blog type. Otherwise it will just be an article type. Drop some custom thumbnails in there too.
		if ( is_author() ) { /*author opens*/
			?><meta property="og:title" content="<?php bloginfo('title'); wp_title(); ?>"/><?php
			?><meta property="og:type" content="author" /><?php
			//If it is an archive page, there may not be a thumbnail to pull from, so let's designate the default thumbnail again. 
			if ( empty($nmwp_fb_thumb) == FALSE ) {
		
				?><meta property="og:image" content="<?php echo $nmwp_fb_thumb; ?>"/><?php
			
			}				
		} /*author closes*/ elseif ( is_archive() || is_attachment() || is_category() || is_date() || is_day() || is_feed() || is_month() || is_search() || is_tag() || is_tax() || is_time() || is_year() ) /*non-single, non-home opens*/ {
			?><meta property="og:title" content="<?php bloginfo('title'); wp_title(); ?>"/><?php
			?><meta property="og:type" content="blog" /><?php
			if ( empty($nmwp_fb_thumb) == FALSE ) {
		
				?><meta property="og:image" content="<?php echo $nmwp_fb_thumb; ?>"/><?php
			
			}

			if ( empty($nmwp_fb_og_descrip) == FALSE ) {
			
			?><meta property="og:description"
					content="<?php echo $nmwp_fb_og_descrip; ?>" /><?php
			} else {
				
				$blogtagline = get_bloginfo('description');
				
				?><meta property="og:description"
						content="<?php echo $blogtagline; ?>" /><?php
			
			}
			
		}else /*single opens*/ {
				global $post;
				$post_id = $post;
				$usepostid = $post->ID;
				if (is_object($post_id)) $post_id = $post_id->ID;  
				// Pulling SEO-ed data from the All in One SEO pack plugin.
				// I think the approprite hooks for a single are in the file all_in_one_seo_pack.php.
				//Line 825 to 835. 
				
			//Getting single post description from either the All in One SEO pack or the excerpt or pull the content and make a custom excerpt where one is not provided. 
				$description = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_description', true)));
			if ( empty($description) == FALSE ) /*aioseo descrip opens*/{
					?><meta property="og:description"
					content="<?php echo $description; ?>" /><?php
			} /*aioseo descrip closes*/ else /*no aioseo opens*/ {
			
				$nativedescription = "Nightmare Mode";
				
				if (!empty($post->post_excerpt)) {
					$theexcerptuse = get_the_excerpt();
					$theexcerptclean = strip_tags($theexcerptuse);
					
					if (strlen($theexcerptclean) > 300){
					
						$nativedescription = substr($theexcerptclean, 0, 295) . '...'; 
						
					} else {
					
						$nativedescription = $theexcerptclean;
				
					}
					
					?><meta property="og:description"
						content="<?php echo $nativedescription; ?>" /><?php
				} /*if excerpt exist closes. */ 
				else { /*open without excerpt */
				
					$excerptquery = new WP_Query( 'p=' . $usepostid );
					while ( $excerptquery->have_posts() ) : $excerptquery->the_post();
					
						
						$thecontentforexcerpt = get_the_content();
						$theexcerptclean = strip_tags($thecontentforexcerpt);
						$nativedescription = substr($theexcerptclean, 0, 295) . '...';
						?><meta property="og:description"
						content="<?php echo $nativedescription; ?>" /><?php
						
					endwhile;
					wp_reset_query();
					wp_reset_postdata();
				}
			} /*no aioseo closes*/
			//No matter what I do, the wp_title function adds spaces to the title. At least this way they are to the right of the title, not before. 
			?><meta property="og:title" content="<?php wp_title('', true, 'right'); ?>"/><?php
			?><meta property="og:type" content="article" /><?php
			//let's get the fb thumbnail image. In order to not make another one, we can reuse the 196x196 thumbnails created for the slider. 
			//It must be 50x50 minimum and have a max ration of 3:1. 
			//This code gets just the thumbnail src.
			?><meta property="og:image" content="<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slide-thumb' );
$url = $thumb['0']; echo $url; ?>"/><?php
		} /*single closes*/
	
	} /*not home closes*/
	//okay now that the post and home page specific OG is out of the way... the general stuff. 
	?><meta property="og:site_name" content="<?php bloginfo('name'); ?>"/><?php

	
	//Has the user entered an admin ID or IDs? If so, output them into an fb tag.
	if ( empty($nmwp_fb_IDs) == FALSE ) {
	
		?><meta property="fb:admins" content="<?php echo $nmwp_fb_IDs; ?>"/><?php
	
	}
	
	//Has the user entered a Facebook App ID? If so, output them into an fb tag.
	if ( empty($nmwp_fb_app_ID) == FALSE ) {
	
		?><meta property="fb:app_id" content="<?php echo $nmwp_fb_app_ID; ?>"/><?php
	
	}
} /*function closes*/

add_action('wp_head', 'nmwp_opengraph');

?>