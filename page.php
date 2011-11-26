<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

		<div id="container">
		
			<?php thematic_abovecontent(); ?>
		
			<div id="content">
	
	            <?php
	        
	            // calling the widget area 'page-top'
	            get_sidebar('page-top');
	
	            the_post();
	            
	            thematic_abovepost();
	        
	            ?>
	            
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
	                
	                // creating the post header
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

										
										echo $postmeta_issingle . $postcomments . $postmeta_edit;
										
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
	
	                    <?php
	                    
	                    the_content();
	                    
	                    wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'thematic'), "</div>\n", 'number');
	                    
	                    edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>
	
						</div><!-- .entry-content -->
					</div>
				</div><!-- #post -->
	
	        <?php
	        
	        thematic_belowpost();
	        
	        // calling the comments template
       		if (THEMATIC_COMPATIBLE_COMMENT_HANDLING) {
				if ( get_post_custom_values('comments') ) {
					// Add a key/value of "comments" to enable comments on pages!
					thematic_comments_template();
				}
			} else {
				thematic_comments_template();
			}
	        
	        // calling the widget area 'page-bottom'
	        get_sidebar('page-bottom');
	        
	        ?>
	
			</div><!-- #content -->
			
			<?php thematic_belowcontent(); ?> 
			
		</div><!-- #container -->

<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();

?>