<?php

function childtheme_override_previous_post_link() {
	
        $prevPost = get_previous_post();
		$prevPostPermalink = get_permalink( $prevPost );
		$prevPostTitle = get_the_title( $prevPost );
		?>
		
		<a class="prevlink-box" href="<?php echo $prevPostPermalink; ?>" alt="<?php echo $prevPostTitle; ?>">
			<div class="left">
			<table style="float:left;" class="navtable"><tr>
			<td class="navimgtd">
			<?php
			$prevthumbnail = get_the_post_thumbnail($prevPost->ID, 'bnav-thumb');
			echo $prevthumbnail;
			?></td>
			<td valign="middle" class="navtable"><div class="prevlink-title"><?php echo $prevPostTitle; ?></div></td>
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
			<table style="float:right;" class="navtable"><tr>
			<td valign="middle" class="navtable">
				<div class="nextlink-title"><?php echo $nextPostTitle; ?></div>
			</td>
			<td class="navimgtd"><?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, 'bnav-thumb');
			echo $nextthumbnail; ?></td>
			</tr></table>
			</div>
		</a>
  	<?php

}

?>