<?php

// include theme options (250) not working yet. 
include('library/control/options.php');

  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }

function nmwp_footer_pagelinks() {
	echo '<ul id="simplepages">';
	wp_list_pages('depth=1&sort_column=menu_order&title_li=');
	echo '</ul>';
}
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-formats', array( 'aside', 'link', 'quote' ) );
}

//Altering the doctype to support FBML and OpenGraph
function childtheme_create_doctype($content) {
    $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n";
    $content .= '<html xmlns="http://www.w3.org/1999/xhtml"';
	$content .= 'xmlns:og="http://ogp.me/ns#"';
	$content .= 'xmlns:fb="https://www.facebook.com/2008/fbml"';
	return $content;
}
add_filter('thematic_create_doctype', 'childtheme_create_doctype');

//Should prob add some other sizes for mobile devices. 

function nmwp_favicon() {
	echo '<link rel="shortcut icon" href="' . get_bloginfo('stylesheet_directory') . '/library/imgs/favicon.ico" />';
}

add_action('wp_head', 'nmwp_favicon');

include('library/extensions/standout-extensions.php');

//Adding custom font for headlines.
function nmwp_fonts() {
	echo "<link href='http://fonts.googleapis.com/css?family=Nobile:400,700' rel='stylesheet' type='text/css'>";
	

	
}

add_action('wp_head', 'nmwp_fonts');
	
//Let's add some nice smooth opengraph functionality here to make sharing content on Facebook easier. 

include('library/extensions/opengraph-extensions.php');

function nmwp_widgets_init() {

	if ( function_exists('register_sidebar') )
	register_sidebar( array(
		'name' => __( 'Ad Head Right', 'thematic' ),
		'id' => 'ad-head-right',
		'description' => __( 'The upper right widget area. Do not use the title. 180x150px', 'thematic' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );	

}

add_action( 'widgets_init', 'nmwp_widgets_init' );

//enable the slideshow slider cycler for featured area. 

function nmwp_cycler_script() {


	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>';
	echo '<script type="text/javascript" src="' . get_bloginfo('stylesheet_directory') . '/library/extensions/jquery.cycle.all.js"></script>';
	?>
	<script type="text/javascript">
			
				$('#featured').cycle({
					fx: 'fade',
					delay: -4000
				});
			
	</script>
	
<?php
}

add_action('wp_head', 'nmwp_cycler_script');

//Add bclass so I can change the width of the site at will. 

function childtheme_override_brandingopen() {
	
	echo "<div id=\"branding\" class=\"bclass\">\n";
	
}
add_action('thematic_header','thematic_brandingopen',1);

//custom header code
include('library/control/controlheader.php');

//You know what's dumb? Using PHPThumb when WordPress has a really good function that does the same thing built in. 
	
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 250, 200 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'homepage-thumb', 250, 200 ); //(soft cropped)
	add_image_size( 'head-thumb', 180, 150, true ); //(hard cropped)
	add_image_size( 'slide-thumb', 196, 196, true ); //(hard cropped)
}

//Let's get fun places in there. We'll figure out how to fill them in a bit. 
	
function childtheme_override_blogtitle() { ?>

				<div id="majorstory" class="headad">
					<?php include('library/control/headstory-extension.php'); ?>
				</div>
				<div id="socialhead">
					<?php include('library/control/socialicons-extension.php'); ?>
				</div>
				<div id="searchhead">
					<?php include ( TEMPLATEPATH . '/searchform.php'); ?>
				</div>
				<div id="adrighthead" class="headad">
					<?php if ( !function_exists('dynamic_sidebar')
					|| !dynamic_sidebar('Ad Head Right') ) : ?>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/180x150TestAd.png" />
					<?php endif; ?>
				</div>
				<div id="sitetitle">
					<div id="logo">
						<a href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
					</div>
					

<?php 
	
	

}add_action('thematic_header','thematic_blogtitle',3);


//A tagline for profit and fun.

function childtheme_override_blogdescription() { 

			$blogdesc = '>' . get_bloginfo('description');

	        	echo "\t\t<div id=\"tagline\" $blogdesc</div>\n\n";

				echo "</div> <div class=\"clearfloat\"></div> <!--end sitetitle div-->";


}add_action('thematic_header','thematic_blogdescription',5);




//HTML5 markup FTW. Also, the slider. 

include('library/control/navslider.php');

/**Better safe than sorry, let's kill overflow posibilities */		
function nmwp_belowheader()
{ ?>

		<div class="clearfloat"></div>
		
<?php }
add_action('thematic_belowheader','nmwp_belowheader');


/** Seriously... I hate having to rewrite numbers in CSS over and over again for body width. Let's just freaking give the width a class and add it to whatever the hell needs it, starting with the main div. **/

function nmwp_altermainclass() {
?>
	<script type="text/javascript" language="javascript">
		/*<![CDATA[*/
			jQuery(document).ready( function()
			{
				jQuery('#main').addClass('bclass');
			});
		/*]]>*/
	</script>
<?php
}
add_action( 'wp_head', 'nmwp_altermainclass' );

/**Who knows when the menu div may be used again, best to be specific in selections. This is just easier... honest.**/

function nmwp_altermenuclass() {
?>
	<script type="text/javascript" language="javascript">
		/*<![CDATA[*/
			jQuery(document).ready( function()
			{
				jQuery('#header nav .menu').addClass('bclass');
			});
		/*]]>*/
	</script>
<?php
}
add_action( 'wp_head', 'nmwp_altermenuclass' );


/**Author boxes get the big bucks**/
/**Going to enact the crazy author fix to get this working with Google authors.**/
/**Don't forget to apply the Google Profile author fix to Author pages, otherwise that stupid code is all for naught**/

function nmwp_afterpostauthor() {
	
	
	if ( get_the_author_meta('description') ) : ?>
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
	<?php endif; ?>
	
	<?php
	
}

add_action('thematic_belowpost','nmwp_afterpostauthor');

/*function remove_doctype() {
	remove_filter('thematic_create_doctype', $content)
}
add_action('init', 'remove_title');

//Creates the DOCTYPE section
function nmwp_create_doctype() {
	$content = '<!DOCTYPE html>';
    $content .= '<html xmlns="http://www.w3.org/1999/xhtml"
		xmlns:og="http://ogp.me/ns#"
		xmlns:fb="http://www.facebook.com/2008/fbml">';
    echo apply_filters('nmwp_create_doctype', $content);
} // end thematic_create_doctype */

	
//Adds some nifty social networks to your userprofile so I can call the shit out of them.
function my_new_contactmethods( $contactmethods ) {
    // Add Twitter
    $contactmethods['twitter'] = 'Twitter name without the "@"';
    //add Facebook
    $contactmethods['facebookURL'] = 'Facebook profile URL'; 
	//Add Google Plus. 
	$contactmethods['gplusURL'] = 'Google Profile URL for authorid. Should look like https://plus.google.com/108109243710611392513/posts'; 
    return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);

//Let's change some excerpt char numbers and keep styling in!
//This does not apply if the poster uses the more tag. How to make that work?
//Answer: No idea. Droping the text I want after the excerpt tag in the loop instead. Putting just a '...' in here instead. 

function nmpress_killer_excerpt( $text ) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace('\]\]\>', ']]&gt;', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text, '<p> <strong> <bold> <i> <em> <emphasis> <del> <h1> <h2> <h3> <h4> <h5>');
		$excerpt_length = 200; //200 words for some reason... would prefer a char count. Not sure how to do it. 
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
		  array_pop($words);
		  array_push($words, '...');
		  $text = implode(' ', $words);
		}
	}
return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'nmpress_killer_excerpt');


/** Let's make a better loop**/

function nmwp_main_loop() {

	//Remember that global variable I called a while back? Let's bring it back. 
  global $firstslide;
  
  //Establish the array to hold the arguments for the query_posts
  $args = array(
	/**Here post__not_in expects an array. You'd think you could put a comma seperated
	string here and that would be fine, but you can't. Instead you have to explode the comma seperated list into an array**/
	'post__not_in' => explode(",", $firstslide),
	'posts_per_page' => 10
	);
  
	query_posts($args);

	
	?>

	<div id="post-list" class="hfeed">
		<!--begin the posts loop-->
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); 
			//formats are stored in individual php files in the main directory in the filename convention of 
			//format-formatname.php. Nifty.
			//Via http://www.netmagazine.com/features/wordpress-post-formats-made-easy
		  if(!get_post_format()) {
               get_template_part('format', 'standard');
          } else {
               get_template_part('format', get_post_format());
          }
		
		?>
			<?php endwhile; ?>
			<?php else : ?>

				<h1 class="error-title">Not Found</h1>
				<p>Sorry, Unable to find what you are looking for. Try a different search.</p>
			
			<?php endif; ?>
			
		
	</div>
	<?php
	wp_reset_query();
}
	
include('library/loops/single-loop.php');

include('library/loops/archive-loop.php');

include('library/loops/category-loop.php');

include('library/loops/search-loop.php');

include('library/loops/tag-loop.php');

add_action( 'pre_get_posts', 'wpse18412_pre_get_posts' );
function wpse18412_pre_get_posts( &$wp_query )
{
    if ( $wp_query->is_feed() ) {
        $post_format_tax_query = array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => 'post-format-aside', // Change this to the format you want to exclude
            'operator' => 'NOT IN'
        );
        $tax_query = $wp_query->get( 'tax_query' );
        if ( is_array( $tax_query ) ) {
            $tax_query = $tax_query + $post_format_tax_query;
        } else {
            $tax_query = array( $post_format_tax_query );
        }
        $wp_query->set( 'tax_query', $tax_query );
    }
}
	
?>