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
		<div id="sidebar-top-container" class="aside main-aside">

			<div id="sharebox">
					<div class="social-centerer">
						<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php the_permalink(); ?>" show_faces="false" width="290" action="recommend" font=""></fb:like>
					</div>
					<br />
					<div class="social-centerer">
						<div class="stumble-button socialtab left">
							<script src="http://www.stumbleupon.com/hostedbadge.php?s=2"></script>
						</div>
						
						<div class="plus-button socialtab left">
							<g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone>
						</div>
					
						<div class="facebook-button socialtab left">
							<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="horizontal" data-via="nitemaremodenet">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
						</div>
					</div>
			</div>			
			<div id="bonusbox">
				
			</div>
			
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