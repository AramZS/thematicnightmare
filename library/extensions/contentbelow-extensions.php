<?php

function childtheme_override_previous_post_link() {
	?>
	<div class="float-left"> <?php
        $prevPost = get_previous_post();
        $prevthumbnail = get_the_post_thumbnail($prevPost->ID, 'homepage-thumb');
        previous_post_link('%link',''.$prevthumbnail.''); ?>
  	</div><?php

}

?>