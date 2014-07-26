<?php
/**
 * Theme Functions
 *
 * Please do not edit this file. This file is part of the Cyber Chimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

// Load Core
require_once( get_template_directory() . '/cyberchimps/init.php' );

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

function ifeature_add_site_info() { ?>
	<p>&copy; Company Name</p>	
<?php }
add_action('cyberchimps_site_info', 'ifeature_add_site_info');	

if ( ! function_exists( 'cyberchimps_comment' ) ) :
// Template for comments and pingbacks.
// Used as a callback by wp_list_comments() for displaying the comments.
function cyberchimps_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'cyberchimps' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'cyberchimps' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( '%1$s <span class="says">%2$s</span>', sprintf( '<cite class="fn">%1$s</cite>',
												get_comment_author_link() ),
												__( 'says', 'cyberchimps' ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'cyberchimps' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'cyberchimps' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'cyberchimps' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for cyberchimps_comment()

// set up next and previous post links for lite themes only
function cyberchimps_next_previous_posts() {
	if( get_next_posts_link() || get_previous_posts_link() ): ?>
	<div class="more-content">
		<div class="row-fluid">
			<div class="span6 previous-post">
				<?php previous_posts_link(); ?>
			</div>
			<div class="span6 next-post">
				<?php next_posts_link(); ?>
			</div>
		</div>
	</div>
<?php
	endif;
}
add_action( 'cyberchimps_after_content', 'cyberchimps_next_previous_posts' );

if ( ! function_exists( 'cyberchimps_theme_check' ) ) :
// core options customization Names and URL's
//Pro or Free has to stay prepended with cyberchimps_
function cyberchimps_theme_check() {
	$level = 'free';
	return $level;
}
endif;
//Theme Name
function ifeature_options_theme_name(){
	$text = 'iFeature';
	return $text;
}
//Doc's URL
function ifeature_options_documentation_url() {
	$url = 'http://cyberchimps.com/help/';
	return $url;
}
// Support Forum URL
function ifeature_options_support_forum() {
	$url = 'http://cyberchimps.com/forum/pro/';
	return $url;
}
//Page Options Help URL
function ifeature_options_page_options_help() {
	$url = 'http://cyberchimps.com/element-how-tos/';
	return $url;
}
// Slider Options Help URL
function ifeature_options_slider_options_help() {
	$url = 'http://cyberchimps.com/faq/how-to-use-the-ifeature-pro-slider/';
	return $url;
}
add_filter( 'cyberchimps_current_theme_name', 'ifeature_options_theme_name', 1 );
add_filter( 'cyberchimps_documentation', 'ifeature_options_documentation_url' );
add_filter( 'cyberchimps_support_forum', 'ifeature_options_support_forum' );
add_filter( 'cyberchimps_page_options_help', 'ifeature_options_page_options_help' );
add_filter( 'cyberchimps_slider_options_help', 'ifeature_options_slider_options_help' );

//upgrade bar
function ifeature_upgrade_title(){
	$title = 'iFeature Pro 5';
	return $title;
}
function ifeature_upgrade_link(){
	$link = 'http://cyberchimps.com/ifeaturepro/';
	return $link;
}
add_filter( 'cyberchimps_upgrade_pro_title', 'ifeature_upgrade_title' );
add_filter( 'cyberchimps_upgrade_link', 'ifeature_upgrade_link' );

// Help Section
function ifeature_options_help_header() {
	$text = 'iFeature';
	return $text;
}
function ifeature_options_help_sub_header(){
	$text = __( 'iFeature Responsive Drag and Drop WordPress Theme', 'cyberchimps' );
	return $text;
}

add_filter( 'cyberchimps_help_heading', 'ifeature_options_help_header' );
add_filter( 'cyberchimps_help_sub_heading', 'ifeature_options_help_sub_header' );

// Branding images and defaults

// Banner default
function ifeature_banner_default() {
	$url = '/images/branding/banner.jpg';
	return $url;
}
add_filter( 'cyberchimps_banner_img', 'ifeature_banner_default' );

//slider defaults
function ifeature_slider_image_1() {
	$image = '/images/branding/ifp5slider.jpg';
	return $image;
}
//add same image to all 3 slider image filters
add_filter( 'cyberchimps_slide_pro_img1', 'ifeature_slider_image_1' );
add_filter( 'cyberchimps_slide_pro_img2', 'ifeature_slider_image_1' );
add_filter( 'cyberchimps_slide_pro_img3', 'ifeature_slider_image_1' );

// default background color
function ifeature_default_background_color() {
	$color = 'f7f7f7';
	return $color;
}
add_filter( 'default_background_color', 'ifeature_default_background_color' );

// Default for twitter bar handle
function cyberchimps_twitter_handle_filter() {
	return 'WordPress';
}
add_filter( 'cyberchimps_twitter_handle_filter', 'cyberchimps_twitter_handle_filter' );

// default header option
function ifeature_header_drag_and_drop_default() {
	$option =  array(
			'cyberchimps_logo' => __( 'Logo', 'cyberchimps' )
		);
	return $option;
}
add_filter( 'header_drag_and_drop_default', 'ifeature_header_drag_and_drop_default' );

// set searchbar by default
function ifeature_searchbar_default() {
	$default = 'checked';
	return $default;
}
add_filter( 'searchbar_default', 'ifeature_searchbar_default' );

//theme specific skin options in array. Must always include option default
function ifeature_skin_color_options( $options ) {
	// Get path of image
	$imagepath = get_template_directory_uri(). '/inc/css/skins/images/';
	
	$options = array(
		'default'	=> $imagepath . 'default.png',
		'green'		=> $imagepath . 'green.png'
	);		
	return $options;
}
add_filter( 'cyberchimps_skin_color', 'ifeature_skin_color_options', 1 );

// theme specific background images
function ifeature_background_image( $options ) {
	$imagepath =  get_template_directory_uri() . '/cyberchimps/lib/images/';
	$options = array(
			'none' => $imagepath . 'backgrounds/thumbs/none.png',
			'noise' => $imagepath . 'backgrounds/thumbs/noise.png',
			'blue' => $imagepath . 'backgrounds/thumbs/blue.png',
			'dark' => $imagepath . 'backgrounds/thumbs/dark.png',
			'space' => $imagepath . 'backgrounds/thumbs/space.png'
			);
	return $options;
}
add_filter( 'cyberchimps_background_image', 'ifeature_background_image' );

// theme specific typography options
function ifeature_typography_sizes( $sizes ) {
	$sizes = array( '8','9','10','12','14','16','20' );
	return $sizes;
}
function ifeature_typography_faces( $faces ) {
	$faces = array(
				'Arial, Helvetica, sans-serif'						 => 'Arial',
				'Arial Black, Gadget, sans-serif'					 => 'Arial Black',
				'Comic Sans MS, cursive'							 => 'Comic Sans MS',
				'Courier New, monospace'							 => 'Courier New',
				'Georgia, serif'									 => 'Georgia',
				'Impact, Charcoal, sans-serif'						 => 'Impact',
				'Lucida Console, Monaco, monospace'					 => 'Lucida Console',
				'Lucida Sans Unicode, Lucida Grande, sans-serif'	 => 'Lucida Sans Unicode',
				'Palatino Linotype, Book Antiqua, Palatino, serif'	 => 'Palatino Linotype',
				'Tahoma, Geneva, sans-serif'						 => 'Tahoma',
				'Times New Roman, Times, serif'						 => 'Times New Roman',
				'Trebuchet MS, sans-serif'							 => 'Trebuchet MS',
				'Verdana, Geneva, sans-serif'						 => 'Verdana',
				'Symbol'											 => 'Symbol',
				'Webdings'											 => 'Webdings',
				'Wingdings, Zapf Dingbats'							 => 'Wingdings',
				'MS Sans Serif, Geneva, sans-serif'					 => 'MS Sans Serif',
				'MS Serif, New York, serif'							 => 'MS Serif',
				);
	return $faces;
}
function ifeature_typography_styles( $styles ) {
	$styles = array( 'normal' => 'Normal','bold' => 'Bold' );
	return $styles;
}
add_filter( 'cyberchimps_typography_sizes', 'ifeature_typography_sizes' );
add_filter( 'cyberchimps_typography_faces', 'ifeature_typography_faces' );
add_filter( 'cyberchimps_typography_styles', 'ifeature_typography_styles' );

function ifeature_post_tags( $tags ) {
	$tag = trim( $tags, 'Tags:' );
	$tag = explode( ',', $tag );
	$tag = implode( ' ', $tag );
	return $tag;
}
add_filter( 'cyberchimps_post_tags', 'ifeature_post_tags' );

/* remove meta seperator */
function ifeature_seperator( $sep ) {
	$sep = ' ';
	return $sep;
}
add_filter( 'cyberchimps_entry_meta_sep', 'ifeature_seperator' );
//add imenu section
function ifeature_sections_filter( $sections ) {
	$new_sections = array(	array( 	'id' => 'cyberchimps_imenu_section',
																	'label' => __('iMenu Options', 'cyberchimps'),
																	'heading' => 'cyberchimps_header_heading'
																	)
												);
	$sections = array_merge( $sections, $new_sections );
	return $sections; 
}
add_filter( 'cyberchimps_sections_filter', 'ifeature_sections_filter' );

// add top bar option and add contact information
function ifeature_fields_filter( $fields ) {
	$new_fields = array( 	array( 	'name' => __('Menu Home Icon', 'cyberchimps'),
																'id' => 'menu_home_button',
																'type' => 'toggle',
																'std' => 1,
																'section' => 'cyberchimps_imenu_section',
																'heading' => 'cyberchimps_header_heading'											
															),
											);							
	$fields = array_merge( $fields, $new_fields );
	
	foreach( $fields as $key => $value ):
	// move the search bar to imenu section	
		if( $value['id'] == 'searchbar' ):
			$fields[$key]['section'] = 'cyberchimps_imenu_section';
		endif;
	endforeach;
	
	return $fields;
}
add_filter( 'cyberchimps_field_filter', 'ifeature_fields_filter', 2 );

//add home button to menu
function ifeature_add_home_menu( $menu, $args ) {

	//check if the toggle is set. And if it is, then add the home button to the start of the primary menu.
	$is_home = cyberchimps_get_option( 'menu_home_button', 1 );
	if( $is_home == 1 && $args->theme_location == 'primary' ) {
		$home = '<li id="menu-item-ifeature-home"><a href="'. home_url() .'"><img src="'. get_template_directory_uri() .'/images/home.png" alt="Home" /></a></li>';
		$menu = $home . $menu;
	}
	return $menu;
}
add_filter( 'wp_nav_menu_items', 'ifeature_add_home_menu', 10, 2 );