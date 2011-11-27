<?php

function nmwp_widgets_sidebar_init() {

	if ( function_exists('register_sidebar') )
	register_sidebar( array(
		'name' => __( 'Ad Sidebar Top', 'thematic' ),
		'id' => 'ad-sidebar-top',
		'description' => __( 'The ad space at the top of the sidebar, do not use title. 300x250.', 'thematic' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );	

	if ( function_exists('register_sidebar') )
	register_sidebar( array(
		'name' => __( 'Ad Sidebar Mid', 'thematic' ),
		'id' => 'ad-sidebar-mid',
		'description' => __( 'The ad space at the middle of the sidebar, do not use title. 300x250.', 'thematic' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );	
	
}

add_action( 'widgets_init', 'nmwp_widgets_sidebar_init' );

// Thumbs and custom field
function sidebaradtop() {
?>
<div id="sidebar-top-ad" class="aside main-aside">
					<?php if ( !function_exists('dynamic_sidebar')
					|| !dynamic_sidebar('Ad Sidebar Top') ) : ?>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/300x250TestAd.png" />
					<?php endif; ?>  
</div><!-- end Ad block -->

<?php

if (is_single()) {

	if (has_post_format('aside'))
	{
	}
	else
	{

		?>
			<div id="bonusbox" class="aside main-aside">
			</div>
		<?php
		
	}
	
}

?>

<?php
}
add_action('thematic_abovemainasides', 'sidebaradtop');

function sidebaradmid() {
?>
<div id="sidebar-mid-ad" class="aside main-aside">
					<?php if ( !function_exists('dynamic_sidebar')
					|| !dynamic_sidebar('Ad Sidebar Mid') ) : ?>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/300x250TestAd.png" />
					<?php endif; ?>  
</div><!-- end Ad block -->
<?php
}
add_action('thematic_betweenmainasides', 'sidebaradmid');

?>