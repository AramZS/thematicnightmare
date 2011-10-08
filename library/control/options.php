<?php

	// Set some theme specific variables for the options panel
	$childthemename = "Thematic Nightmare";
	$childshortname = "nmwp";
	$childoptions = array();

function childtheme_options() {
  global $childthemename, $childshortname, $childoptions;
 
	//Create array to store the categories to be used in the drop-down select box. 
	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $cat) {
		$categories[$cat->cat_ID] = $cat->cat_name;
	}
	
	$childoptions = array(
	//Change link color.
	array(	"name" => __('Featured Head Story','thematic'),
			"desc" => __('Find the post ID by mousing over the post in the All Posts section.', 'thematic'),
			"id" => "nmwp_head_post",
			"std" => "12",
			"type" => "text"
		),
		
 
	array( 	"name" => __('Featured Category','thematic'),
			"desc" => __('A category of posts to be featured on the front page.','thematic'),
			"id" => "nmwp_feature_cat",
			"std" => $default_cat,
			"type" => "select",
			"options" => $categories
		),
		
	array( 	"name" => __('Slider Category','thematic'),
			"desc" => __('Type in the Category ID numbers of the categories you want featured. Seperate with commas, no spaces. Find after tag_id in the URL.','thematic'),
			"id" => "nmwp_slider_cat",
			"std" => "1",
			"type" => "text"
		)

	
 );
}

add_action('init', 'childtheme_options');

//Make a theme options page
function childtheme_add_admin() {

	global $childthemename, $childshortname, $childoptions;
	
	if ($_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			//protect against request forgery
			check_admin_referer('childtheme-save');
			//save options
			foreach ($childoptions as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ] );
				} else {
					delete_option( $value['id'] );
				}
			}
			
			header("Location: themes.php?page=options.php&saved=true");
			die;
			
		} else if ( 'reset' == $_REQUEST['action'] ) {
			//protext against request forgery
			check_admin_referer('childtheme-reset');
			//delete the options
			foreach ($childoptions as $value) {
				delete_option( $value['id'] ); }
				
				header("Location: themes.php?page=options.php&reset=true");
				die;
				
			}
		}
		add_theme_page($childthemename." Options", "$childthemename Options", 'edit_themes', basename(__FILE__), 'childtheme_admin');
}

add_action('admin_menu', 'childtheme_add_admin');



function childtheme_admin() {

  global $childthemename, $childshortname, $childoptions;

  // Saved or Updated message
  if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade">
<p><strong>'.$childthemename.' settings saved.</strong></p></div>';
  if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade">
<p><strong>'.$childthemename.' settings reset.</strong></p></div>';

  // The form
  ?>

  <div class="wrap">
  <h2><?php echo $childthemename; ?> Options</h2>

  <form method="post">

  <?php wp_nonce_field('childtheme-save'); ?>
  <table class="form-table">

  <?php foreach ($childoptions as $value) {

    // Output the appropriate form element
    switch ( $value['type'] ) {
      
      case 'text':
      ?>
      <tr valign="top">
        <th scope="row"><?php echo $value['name']; ?>:</th>
        <td>
          <input name="<?php echo $value['id']; ?>" 
                 id="<?php echo $value['id']; ?>" 
                 type="text" 
                 value="<?php echo stripslashes(get_option( $value['id'], 
$value['std'] )); ?>" 
          />
          <?php echo $value['desc']; ?>
        </td>
      </tr>
      <?php
      break;

      case 'select':
      ?>
      <tr valign="top">
        <th scope="row"><?php echo $value['name']; ?></th>
        <td>
          <select name="<?php echo $value['id']; ?>" 
                  id="<?php echo $value['id']; ?>">
            <option value="">--</option>
            <?php foreach ($value['options'] as $key=>$option) {
              if ($key == get_option($value['id'], $value['std']) ) {
                $selected = "selected=\"selected\"";
              } else {
                $selected = "";
              }
            ?>
            <option value="<?php echo $key ?>" <?php echo $selected ?>>
<?php echo $option; ?></option>
          <?php } ?>
          </select>
          <?php echo $value['desc']; ?>
        </td>
      </tr>
      <?php
      break;

      case 'textarea':
      $ta_options = $value['options'];
      ?>
      <tr valign="top">
        <th scope="row"><?php echo $value['name']; ?>:</th>
        <td>
          <?php echo $value['desc']; ?>
          <textarea name="<?php echo $value['id']; ?>" 
                    id="<?php echo $value['id']; ?>" 
                    cols="<?php echo $ta_options['cols']; ?>" 
                    rows="<?php echo $ta_options['rows']; ?>"><?php
            echo stripslashes(get_option($value['id'], $value['std']));
          ?></textarea>
        </td>
      </tr>
      <?php
      break;

      case "radio":
      ?>
      <tr valign="top">
        <th scope="row"><?php echo $value['name']; ?>:</th>
        <td>
          <?php foreach ($value['options'] as $key=>$option) {
            if ($key == get_option($value['id'], $value['std']) ) {
              $checked = "checked=\"checked\"";
            } else {
              $checked = "";
            }
            ?>
            <input type="radio" 
                   name="<?php echo $value['id']; ?>" 
                   value="<?php echo $key; ?>" 
                   <?php echo $checked; ?> 
            /><?php echo $option; ?>
            <br />
          <?php } ?>
          <?php echo $value['desc']; ?>
        </td>
      </tr>
      <?php
      break;

      case "checkbox":
      ?>
      <tr valign="top">
        <th scope="row"><?php echo $value['name']; ?></th>
        <td>
          <?php
          if(get_option($value['id'])){
            $checked = "checked=\"checked\"";
          } else {
            $checked = "";
          }
          ?>
          <input type="checkbox" 
                 name="<?php echo $value['id']; ?>" 
                 id="<?php echo $value['id']; ?>" 
                 value="true" 
                 <?php echo $checked; ?> 
          />
          <?php echo $value['desc']; ?>
        </td>
      </tr>
      <?php
      break;

      default:
      break;
    }
  }
  ?>

  </table>

  <p class="submit">
    <input name="save" type="submit" value="Save changes" class="button-primary" />
    <input type="hidden" name="action" value="save" />
  </p>

  </form>

  <form method="post">
    <?php wp_nonce_field('childtheme-reset'); ?>
    <p class="submit">
      <input name="reset" type="submit" value="Reset" />
      <input type="hidden" name="action" value="reset" />
    </p>
  </form>

  <p><?php _e('For more information ... ', 'thematic'); ?></p>

  <?php
} // end function

?>