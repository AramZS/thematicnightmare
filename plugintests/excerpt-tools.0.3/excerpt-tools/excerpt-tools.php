<?php
 /*
 Plugin Name: Excerpt Tools 
 Description: Customize your excerpts. Allows you to limit the length of excerpts with a jQuery character counter, display a custom title and description for the excerpt box and show the excerpt box on pages.
 Author: Zack Kakia
 Version: 0.3
 */
 
 $jscounter = plugins_url( 'js/jquery.charcounter.js', __FILE__ );
 
 add_action('admin_init', 'e_tools_box_init');
 
 // Checks options to see if custom excerpts are turned on. if so, adds them
 function e_tools_box_init()
 {
     $options = get_option('e_tools');
     if ($options[enable_post] == 1) {
         remove_meta_box('postexcerpt', 'post', 'core');
         add_meta_box('e_tools_excerpt', $options['excerpt_title'], 'e_tools_meta_box', 'post', 'normal', 'high');
     } 
	 
	if ($options[enable_page] == 1) {
         //remove_meta_box('postexcerpt', 'post', 'core');
         add_meta_box('e_tools_excerpt', $options['excerpt_title'], 'e_tools_meta_box', 'page', 'normal', 'high');
     }  
	 
 }
 
 add_action('admin_init', 'e_tools_init');
 add_action('admin_menu', 'e_tools_add_page');
 
 // Init plugin options to white list our options
 function e_tools_init()
 {
     register_setting('e_tools_options', 'e_tools');
 }
 // Add menu page
 function e_tools_add_page()
 {
     add_options_page('Excerpt Options', 'Excerpt Tools', 'manage_options', 'e_tools_handler', 'e_tools_page');
 }
 // Draw the menu page itself
 function e_tools_page()
 { global $jscounter;
?>

<div class="wrap">
  <h2>Excerpt Options </h2>
  <form method="post" action="options.php">
    <?php
     settings_fields('e_tools_options');
?>
   <?php
     $options = get_option('e_tools');
?>
<fieldset style="border-style:solid;border-width:thin;" >
      	<legend> </legend>
   <table class="form-table">
      
      <tr valign="top">
        <th scope="row">Use Custom Excerpt On Posts?</th>
        <td><input name="e_tools[enable_post]" type="checkbox" value="1" <?php
     checked('1', $options[enable_post]);
?> /></td>
      </tr>
      
            <tr valign="top">
        <th scope="row">Use Custom Excerpt On Pages?</th>
        <td><input name="e_tools[enable_page]" type="checkbox" value="1" <?php
     checked('1', $options[enable_page]);
?> /></td>
      </tr>
      
      <tr valign="top">
        <th scope="row">Excerpt Length(only use a number, eg: 150)</th>
        <td><input type="text" name="e_tools[excerpt_length]" value="<?php
     echo $options['excerpt_length'];
?>" /></td>
      </tr>
      
      <tr valign="top">
        <th scope="row">Excerpt title</th>
        <td><input type="text" name="e_tools[excerpt_title]" style="width:90%" value="<?php
     echo $options['excerpt_title'];
?>" /></td>
      </tr>
      
      <tr valign="top">
        <th scope="row">Excerpt description</th>
        <td>
<textarea rows="2" cols="60" name="e_tools[excerpt_text]"  id="e_tools[excerpt_text]"><?php
      echo $options['excerpt_text'];
?></textarea>

</td>
      </tr>
    </table>
    
    </fieldset>
    <p class="submit">
      <input type="submit" class="button-primary" value="<?php
     _e('Save Changes');
?>" />
    </p>
    
    
    
  </form>
</div>

<?php
 }
 
 
 function e_tools_meta_box($post)
 { 
  global $jscounter;
  wp_enqueue_script('jquery');
?>
<label class="hidden" for="excerpt">
  <?php
     _e('Excerpt');
?>
</label>
<textarea rows="1" cols="40" name="excerpt" tabindex="6" id="excerpt"><?php
     echo $post->post_excerpt;
?></textarea>
<p>
  <?php  
     $options = get_option('e_tools');
     echo $options['excerpt_text'];
?>
</p>
<br />


<script type="text/javascript"  src="<?php echo  $jscounter; ?>"> </script>
<script>

    jQuery(function($) {

    $("#excerpt").charCounter( <?php  echo $options['excerpt_length']; ?>, {

    container: "<div id='counter' class='counter' style='padding-top:5px;'></div>",

    classname: "counter",

    format: "%1 characters remaining"



});

     });

    </script>
<?php
 }
?>