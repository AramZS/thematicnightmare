		<article class="hentry asidetype" <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">

					<div class="responses">
						<span><?php comments_popup_link( 'No responses yet.', 'One response', '% responses', 'comments-link', 'Responses are off for this post'); ?></span>
					</div>
			
			<div class="entry">
			
			<table class="aside-table" width="100%">
				<tr>
				<td width="76%" valign="top" class="text-td">
				<div class="aside-text left">
					<?php the_excerpt(); ?><!-- Excerpt -->
					
					

				</div>
				</td>
				<td width="24%" class="author-td" valign="bottom" align="center">
				<div class="aside-author right">
				
					<a href="<?php echo get_site_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php echo get_avatar( get_the_author_meta('ID'), 128 ); ?></a>
				
				</div>
				</td>
				</tr>
			</table>
				<div class="clear"></div>
				
			</div><!--END entry -->
			
			<footer>
				<address class="post-meta">
					Written by <a href="<?php echo get_site_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a> on <time><?php the_time( 'F j, Y' ); ?> at <?php the_time('g:i a'); ?></time>
				</address><!--/post-meta-->
			</footer>
			</article>
