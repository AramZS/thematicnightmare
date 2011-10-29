<?php
  


function nmwp_opengraph() {

  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }

	if ( is_home() ) {

		?><meta property="og:title" content="<?php bloginfo('name'); ?>"/><?php
	
		//If the user has designated a default thumbnail for their site, output into an opengraph tag. 
		if ( empty($nmwp_fb_thumb) == FALSE ) {
	
			?><meta property="og:image" content="<?php echo $nmwp_fb_thumb; ?>"/><?php
		
		}
		?><meta property="og:url" content="<?php bloginfo('url') ?>" /><?php
		?><meta property="og:type" content="website" /><?php
	
	} else {
		
		
		?><meta property="og:url" content="<?php echo get_permalink(); ?>"/><?php

		//Open Graph has a special way to recognize author pages. If it is an author page, let's display that. If it is an archive, it's a blog type. Otherwise it will just be an article type. Drop some custom thumbnails in there too.
		if ( is_author() ) {
			?><meta property="og:title" content="<?php bloginfo('title'); wp_title(); ?>"/><?php
			?><meta property="og:type" content="author" /><?php
			//If it is an archive page, there may not be a thumbnail to pull from, so let's designate the default thumbnail again. 
			if ( empty($nmwp_fb_thumb) == FALSE ) {
		
				?><meta property="og:image" content="<?php echo $nmwp_fb_thumb; ?>"/><?php
			
			}				
		} elseif ( is_archive() ) {
			?><meta property="og:title" content="<?php bloginfo('title'); wp_title(); ?>"/><?php
			?><meta property="og:type" content="blog" /><?php
			if ( empty($nmwp_fb_thumb) == FALSE ) {
		
				?><meta property="og:image" content="<?php echo $nmwp_fb_thumb; ?>"/><?php
			
			}			
		}else {
			//No matter what I do, the wp_title function adds spaces to the title. At least this way they are to the right of the title, not before. 
			?><meta property="og:title" content="<?php wp_title('', true, 'right'); ?>"/><?php
			?><meta property="og:type" content="article" /><?php
			//let's get the fb thumbnail image. In order to not make another one, we can reuse the 196x196 thumbnails created for the slider. 
			//It must be 50x50 minimum and have a max ration of 3:1. 
			//This code gets just the thumbnail src.
			?><meta property="og:image" content="<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slide-thumb' );
$url = $thumb['0']; echo $url; ?>"/><?php
		}
	
	}
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
}

add_action('wp_head', 'nmwp_opengraph');

?>