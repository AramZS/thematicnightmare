<?php


  
  if ( $nmwp_social_rss == 'true' ){
  
	?>
		<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/socialmediaicons/rss.png" alt="Syndicate this site using RSS" /></a> 
	<?php 
  
  }
 
  if ( $nmwp_social_twit == 'true' ){
  
	?>
		<a href="http://twitter.com/<?php echo $nmwp_social_twit_un; ?>" title="<?php echo $nmwp_social_twit_un; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/socialmediaicons/twitter.png" alt="<?php echo $nmwp_social_twit_un; ?>" /></a> 
	<?php
  
  }

  if ( $nmwp_social_fb == 'true' ){
  
	?>
		<a href="http://facebook.com/<?php echo $nmwp_social_fb_un; ?>" title="<?php echo $nmwp_social_fb_un; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/socialmediaicons/facebook.png" alt="<?php echo $nmwp_social_fb_un; ?>" /></a> 
	<?php
  
  }
  
  if ( $nmwp_social_contribute == 'true' ){
  
	?>
		<img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/socialmediaicons/write.png" alt="Write for Us." /> 
	<?php
  
  }

	$iconsarray = explode(",",$nmwp_social_addl_icons);
	$iconscount = count($iconsarray);
	$urlsarray = explode(",",$nmwp_social_addl_urls);
	$urlcount = count($urlsarray); 
		$k=0;
  
  if ( $nmwp_social_addl_icons !== "" ){
  

	
	foreach ($urlsarray as $key => $value) {
  

  
	?>
		<a href="<?php echo $urlsarray[$key]; ?>"><img src="<?php echo $iconsarray[$key]; ?>" /></a> 
	<?php
	
		$k++;
	
	}
  
  }  
  
?>