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

				<?php
					global $post;
					$post_id = $post;
					$authpostid = $post->ID;
					$getauthorid = $post->post_author;
					
					$authorquery = new WP_Query( array ( 'author' => $getauthorid, 'posts_per_page' => 1, 'post__not_in' => array( $authpostid ),  'post_type' => array( 'post' ) ) );
					while ( $authorquery->have_posts() ) : $authorquery->the_post();
					
						?>
			
			<div id="bonusbox">
						
						<div id="bonuscontainer">
						
							<h5>More by <a href="<?php echo get_site_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a></h5>
						
							<a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark" alt="<?php the_title_attribute(); ?>">	<div class="bonustable">
							<table class="navzero">
							<tbody class="navzero">
							<tr class="navzero">
								<td class="navzero" valign="top">
									<h4><span><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark" alt="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span></h4>
								</td>
								<td class="navzero" valign="top">
									<div id="bonuscontent">
										<?php if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
											<?php the_post_thumbnail( 'head-thumb' ); ?>
										</a>
										<?php } else { ?>
										
										<?php } ?> <!-- Thumbnail -->
									</div>
								</td>
							</tr>
							</tbody>
							</table>
							</div></a>
							<div id="bonuscomments">
								<span><?php comments_popup_link( 'No comments yet.', 'One comment', '% comments', 'comments-link', 'Responses are off for this post'); ?></span>
							</div>
						</div>
						

				
			</div>
			
						<?php
						
						
					endwhile;
					wp_reset_query();
					wp_reset_postdata();
				
				?>
			
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