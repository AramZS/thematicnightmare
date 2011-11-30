<?php

function childtheme_override_previous_post_link() {
	
        $prevPost = get_previous_post();
		$prevPostPermalink = get_permalink( $prevPost );
		$prevPostTitle = get_the_title( $prevPost );
		?>
		
		<a class="prevlink-box" href="<?php echo $prevPostPermalink; ?>" alt="<?php echo $prevPostTitle; ?>">
			<div class="left">
			<table><tr>
			<td>
			<?php
			$prevthumbnail = get_the_post_thumbnail($prevPost->ID, 'homepage-thumb');
			echo $prevthumbnail;
			?></td>
			<td valign="top"><div class="prevlink-title"><?php echo $prevPostTitle; ?></div></td>
			</tr></table>
			</div>
		</a>
  	<?php

}

function childtheme_override_next_post_link() {
	
        $nextPost = get_next_post();
		$nextPostPermalink = get_permalink( $nextPost );
		$nextPostTitle = get_the_title( $nextPost );
		?>
		
		<a class="nextlink-box" href="<?php echo $nextPostPermalink; ?>" alt="<?php echo $nextPostTitle; ?>">
			<div class="right">
			<table><tr>
			<td valign="top">
				<div class="nextlink-title"><?php echo $nextPostTitle; ?></div>
			</td>
			<td><?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, 'homepage-thumb');
			echo $nextthumbnail; ?></td>
			</tr></table>
			</div>
		</a>
  	<?php

}

?>