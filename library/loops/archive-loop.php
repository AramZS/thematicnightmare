<?php
function childtheme_override_archive_loop() {

  
  //Establish the array to hold the arguments for the query_posts
  $args = array(
	'posts_per_page' => 10
	);
  
	query_posts($args);

	
	?>

	<div id="post-list" class="hfeed">
		<!--begin the posts loop-->
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); 

		?>
		<article class="hentry" <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
			<header class="post-info">
				<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h1>
			
				<address class="post-meta">
					Written by <a href="<?php echo get_site_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a> on <time><?php the_time( 'F j, Y' ); ?> at <?php the_time('g:i a'); ?></time>
				</address><!--/post-meta-->
				<div class="frontpageFB">
					<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php the_permalink(); ?>" show_faces="false" width="380" action="recommend" font=""></fb:like>
					
					<div class="frontpagePlus"><g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone></div>
					
					<div class="frontpageTweet"><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="horizontal" data-via="nitemaremodenet">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>
				</div>
				
			</header>
			
			<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					<?php the_post_thumbnail( 'homepage-thumb' ); ?>
				</a>
			<?php } else { ?>
				
			<?php } ?> <!-- Thumbnail -->
			
			<div class="entry">
				<?php the_excerpt(); ?><p class="readmoregraf"><a href="<?php the_permalink(); ?>">Read More from <?php the_title(); ?></a></p><!-- Excerpt -->
				<div class="clear"></div>
			</div><!--END entry -->
			
			<footer>
				<div class="submeta">
					<span><?php comments_popup_link( 'No comments yet.', 'One comment', '% comments', 'comments-link', 'Comments are off for this post'); ?></span>
				</div>		 
			</footer>
			</article>
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