		<article class="asidetype asidelink <?php thematic_post_class(); ?>" id="post-<?php the_ID(); ?>">

					<div class="responses">
						<span><?php comments_popup_link( 'No responses yet.', 'One response', '% responses', 'comments-link', 'Responses are off for this post'); ?></span>
					</div>
			
			<div class="entry">
			
			<table class="aside-table" width="100%">
				<tr>
				<td width="24%" class="link-td" valign="top" align="center">
				
				
					<img alt="Quote" src="<?php echo get_bloginfo(stylesheet_directory) . "/library/imgs/quotemark.png"; ?>" />
				
				
				</td>
				<td width="76%" valign="top" class="text-td">
				<div class="aside-text quote-text left">
					<?php the_content(); ?><!-- Full content -->
					
					<div class="quote-meta right">
					<?php 
					
						echo '<div class="quote-author">';
						$quoteAuthor = SmartMetaBox::get('quote_author'); 
						echo $quoteAuthor;
						echo '</div>';
						
						echo '<div class="quote-source">';
						$quoteLink = SmartMetaBox::get('quote_link'); 
						$quoteSource = SmartMetaBox::get('quote_source'); 
						?><a href="<?php echo $quoteLink; ?>" title="<?php echo $quoteSource; ?>"><?php echo $quoteSource; ?></a><?php
						echo '</div>';
						
					
					?>
					</div>

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
