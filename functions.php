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

		?>
		<article class="hentry" <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
			<header class="post-info">
				<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h1>
			
				<address class="post-meta">
					Written by <a href="<?php echo get_site_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a> on <time><?php the_time( 'F j, Y' ); ?> at <?php the_time('g:i a'); ?></time>
				</address><!--/post-meta-->
				<div class="frontpageFB">
					<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php the_permalink(); ?>" show_faces="false" width="380" action="recommend" font=""></fb:like>
					
					<div class="frontpagePlus"><g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone></div>
					
					<div class="frontpageTweet"><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="horizontal" data-via="nitemaremodenet">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>
				</div>
				
			</header>
			
			<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					<?php the_post_thumbnail( 'homepage-thumb' ); ?>
				</a>
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>"><img class="postimg" src="<?php bloginfo('template_directory'); ?>/library/imgs/dummy.png" alt="" /></a>
			<?php } ?> <!-- Thumbnail -->
			
			<div class="entry">
				<?php the_excerpt(); ?><p class="readmoregraf"><a href="<?php the_permalink(); ?>">Read More from <?php the_title(); ?></a></p><!-- Excerpt -->
				<div class="clear"></div>
			</div><!--END entry -->
			
			<footer>
				<div class="submeta">
					<span><?php comments_popup_link( 'No comments yet.', 'One comment', '% comments', 'comments-link', 'Comments are off for this post'); ?></span>
				</div>		 
			</footer>
			</article>
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
	
?>