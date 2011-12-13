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
							<table>
								<tbody>
								<tr>
									<td width="75%" valign="baseline" >
										<?php the_title('<h1>', '</h1>'); ?>
									</td>
								
									<td width="25%" valign="baseline">
										<p class="entry-meta">
										<?php
										
										global $id, $post, $authordata;
										
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
										$postauthor .= get_author_posts_url(get_the_author_meta( 'ID' ));
										$postauthor .= '" title="' . __('View all posts by ', 'thematic') . get_the_author() . '">';
										$postauthor .= get_the_author();
										$postauthor .= '</a></span></h2>';
										
										//comment count
										
										$postcomments .= "<span class='meta-prep meta-prep-comments'> with </span>"; 
										$postcomments .= "<span class='meta-comment-single-top'>";
										
										 $num_comments = get_comments_number(); // for some reason get_comments_number only returns a numeric value displaying the number of comments
										 if ( comments_open() ){
											  if($num_comments == 0){
												  $comments = __('no comments');
											  }
											  elseif($num_comments > 1){
												  $comments = $num_comments. __(' comments');
											  }
											  else{
												   $comments ="one comment";
											  }
										 $write_comments = '<a href="' . get_comments_link() .'" class="url fn n">'. $comments.'</a>';
										 }
										 else{$write_comments =  __('comments disabled');}
										
										$postcomments .= $write_comments;
										$postcomments .= "</span>";
										
										// Display edit link
										if (current_user_can('edit_posts')) {
											$postmeta_edit .= ' <span class="meta-sep meta-sep-edit">|</span> ' . '<span class="edit">' . $posteditlink . '</span>';
										}     

										
										echo $postmeta_issingle . $postauthor . $postcomments . $postmeta_edit;
										
										/**echo "<span class='meta-comment-single-top'>";
										comments_number();
										echo "</span>";**/
										
										?>
										</p><!-- .entry-meta -->
									</td>
								</tr>
							</tbody>
							</table>
					</div>
					<div class="clear"></div>
					<div class="entry-sub-container">
						<div class="entry-content">
							<?php thematic_content();

		if ( get_the_author_meta('description') ) : 
		
		/**Author boxes get the big bucks**/
		/**Going to enact the crazy author fix to get this working with Google authors.**/
		/**Don't forget to apply the Google Profile author fix to Author pages, otherwise that stupid code is all for naught**/
		
		?>
		<div class="clear"></div>
		<div class="author-bio">
			<div id="author-avatar">
						<?php echo get_avatar( get_the_author_email(), '60' ); ?>
			</div><!-- author-avatar --> 
			<div id="author-text">
					<h4>Post by <a href="<?php get_site_url(); ?>/author/<?php the_author_meta('user_login'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a></span></h4> 
					<p><?php the_author_description(); ?></p> 

		<?php 
			$twitterAuthorWordCount = get_the_author_meta('twitter');
			$twitterAuthorMeta = str_word_count($twitterAuthorWordCount);
		if ( $twitterAuthorMeta > 0) { 
		?>
			
		<div class="authorSocial"><a href="http://twitter.com/<?php echo the_author_meta('twitter'); ?>" class="twitter-follow-button">Follow @<?php echo the_author_meta('twitter'); ?></a>
		<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script></div>

		<?php } ?>

			</div><!-- author-text --> 
			<div class="clear"></div>
		</div><!-- author-bio -->
		
		<br />
	<?php endif; 

							 wp_link_pages('before=<div class="page-link">' .__('Pages:', 'thematic') . '&after=</div>') ?>
						</div><!-- .entry-content -->
						<?php thematic_postfooter(); ?>
					</div>
				</div><!-- #post -->
		<?php

			thematic_belowpost();
}
 // end single_post

?>