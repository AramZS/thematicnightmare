<?php

//This function will allow us to get the x number or whatevers ago the post was published. Via: http://aramzs.me/6s

function time_ago( $type = 'post' ) {

	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
	return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

}


//OK, time to redo the single-story loop to our liking. Adapted from instructions at http://www.cozmoslabs.com/716-create-an-about-the-author-area-for-thematic/

function childtheme_override_single_post() {

// The Single Post
		
				thematic_abovepost(); ?>
			
				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					}
     				/**thematic_postheader();**/
				
					
					?>
					<div class="entry-top">
						
							<?php the_title('<h1>', '</h1>'); ?>
						
						
						<div class="entry-meta">
						<?php
						
						// Create $posteditlink    
						$posteditlink .= '<a href="' . get_bloginfo('wpurl') . '/wp-admin/post.php?action=edit&amp;post=' . $id;
						$posteditlink .= '" title="' . __('Edit post', 'thematic') .'">';
						$posteditlink .= __('Edit', 'thematic') . '</a>';
						
						$postmeta_issingle .= '<span class="meta-prep meta-prep-entry-date">' . __('Published: ', 'thematic') . '</span>';
						$postmeta_issingle .= '<span class="entry-date"><abbr class="published" title="';
						$postmeta_issingle .= get_the_time(thematic_time_title()) . '">';
						$postmeta_issingle .= time_ago();
						$postmeta_issingle .= ' at ';
						$postmeta_issingle .= get_the_time();
						$postmeta_issingle .= ' on ';
						$postmeta_issingle .= get_the_date();
						$postmeta_issingle .= '</abbr></span>';
			  
						
						
						//Display author info area
						
						$postauthor .= '<span class="meta-prep meta-prep-author">' . __(' by ', 'thematic') . '</span>';	
						$postauthor .= '<span class="author vcard">'. '<a class="url fn n" rel="author" href="';
						$postauthor .= get_author_link(false, $authordata->ID, $authordata->user_nicename);
						$postauthor .= '" title="' . __('View all posts by ', 'thematic') . get_the_author() . '">';
						$postauthor .= get_the_author();
						$postauthor .= '</a></span></h2>';
						
						// Display edit link
						if (current_user_can('edit_posts')) {
							$postmeta_edit .= ' <span class="meta-sep meta-sep-edit">|</span> ' . '<span class="edit">' . $posteditlink . '</span>';
						}     

						
						echo $postmeta_issingle . $postauthor . $postmeta_edit;
						
						?>
						</div><!-- .entry-meta -->
					</div>
					<div class="clear"></div>
					<div class="entry-sub-container">
						<div class="entry-content">
							<?php thematic_content(); ?>

							<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'thematic') . '&after=</div>') ?>
						</div><!-- .entry-content -->
						<?php thematic_postfooter(); ?>
					</div>
				</div><!-- #post -->
		<?php

			thematic_belowpost();
}
 // end single_post

?>