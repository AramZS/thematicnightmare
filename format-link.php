		<?php
		
		$page = get_the_title();
		$node = new OpenGraphNode($page);
		
		$ogImage = $node->image;
		$ogTitle = $node->title;
		
		$postID = get_the_ID();
		
		if ( (strlen($ogImage)) > 0 ){
		
			$imgParts = pathinfo($ogImage);
			$imgExt = $imgParts['extension'];
			$imgTitle = $imgParts['filename'];

			$ogCacheImg = 'wp-content/uploads/' . date("o") . "/" . $postID . "-" . $imgTitle . "." . $imgExt;
			
			
			if ( !file_exists($ogCacheImg) ) {
			

				copy($ogImage, $ogCacheImg);
			
			}
			//$ogCacheImg = $ogImage;
			
		} else {
		
			$ogCacheImg = get_bloginfo(stylesheet_directory) . "/library/imgs/link.png";
		
		}
		
		?>
		
		<article class="asidetype asidelink <?php thematic_post_class(); ?>" id="post-<?php the_ID(); ?>">

					<div class="responses">
						<span><?php comments_popup_link( 'No responses yet.', 'One response', '% responses', 'comments-link', 'Responses are off for this post'); ?></span>
					</div>
			
			<div class="entry">
			
			<table class="aside-table" width="100%">
				<tr>
				<td width="24%" class="author-td" valign="bottom" align="center">
				<div class="aside-link">
				
					<a href="<?php the_title(); ?>" title="<?php echo $ogTitle; ?>"><img alt="<?php echo $ogTitle; ?>" src="<?php echo $ogCacheImg; ?>" /></a>
				
				</div>
				</td>
				<td width="76%" valign="top" class="text-td">
				<div class="aside-text left">
					<?php the_content(); ?><!-- Full content -->
					
					

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
