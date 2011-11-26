		<article class="hentry asidetype" <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
					
			<div class="entry">
				<?php the_excerpt(); ?><!-- Excerpt -->
				<div class="clear"></div>
			</div><!--END entry -->
			
			<footer>
				<div class="submeta">
					<span><?php comments_popup_link( 'No comments yet.', 'One comment', '% comments', 'comments-link', 'Comments are off for this post'); ?></span>
				</div>	
				<address class="post-meta">
					Written by <a href="<?php echo get_site_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a> on <time><?php the_time( 'F j, Y' ); ?> at <?php the_time('g:i a'); ?></time>
				</address><!--/post-meta-->
			</footer>
			</article>
