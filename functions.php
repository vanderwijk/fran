<?php 

// Load translation
function fran_theme_setup(){
	load_theme_textdomain( 'fran', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'widgets', 'script', 'style', 'search-form' ) );
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
				'header' => 'Header',
			)
		);
	}
}
add_action( 'after_setup_theme', 'fran_theme_setup' );

// Theme customizer
require 'customizer.php';

// Include scripts and styles
function fran_scripts_styles () {
	if ( !is_admin() ) {

		wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css', array(), wp_get_theme()->get('Version') );
		wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/grid.css', array(), wp_get_theme()->get('Version') );
		wp_enqueue_style( 'roboto', get_template_directory_uri() . '/css/roboto.css', array(), wp_get_theme()->get('Version') );
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'typography', get_template_directory_uri() . '/css/typography.css', array(), wp_get_theme()->get('Version') );
		wp_enqueue_style( 'widget', get_template_directory_uri() . '/css/widget.css', array(), wp_get_theme()->get('Version') );
		wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', array(), wp_get_theme()->get('Version') );
		if ( is_single() ) {
			wp_enqueue_style( 'comments', get_template_directory_uri() . '/css/comments.css', array(), wp_get_theme()->get('Version') );
		}
		wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), wp_get_theme()->get('Version') );

		wp_enqueue_script( 'jquery' );

		wp_register_script( 'headroom', get_template_directory_uri() . '/js/headroom.min.js', array( 'jquery' ), '0.7.0', true );
		wp_enqueue_script( 'headroom' );

		wp_register_script( 'masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array( 'masonry' ), wp_get_theme()->get('Version'), true );
		if ( is_front_page() || is_archive() || is_search() ) {
			wp_enqueue_script( 'masonry' );
			wp_enqueue_script( 'masonry-init' ); 
		}

		wp_register_script( 'initialise', get_template_directory_uri() . '/js/initialise.js', array( 'jquery' ), wp_get_theme()->get('Version'), true );
		wp_enqueue_script( 'initialise' );

	}
}
add_action( 'wp_enqueue_scripts', 'fran_scripts_styles' );

// Add search menu item
function custom_add_loginout_link( $items, $args ) {
	if ($args->theme_location == 'header'){
		if ( !get_theme_mod ( 'show_search' ) == '' ) {
			$items .= '<li class="search-toggle"><a href="#">Zoeken</a></li>';
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'custom_add_loginout_link', 10, 2 );

// Thumbnails
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'archive', 320, 400, true );
	add_image_size( 'single', 660, 9999 );
	add_image_size( 'attachment', 960, 9999 );
	add_image_size( 'hero', 1000, 9999 );
}

if ( ! isset( $content_width ) ) $content_width = 920;

// Content width for embeds
if ( ! isset( $content_width ) ) $content_width = 980;

// Custom logo
function fran_custom_logo_setup() {
	$defaults = array(
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'fran_custom_logo_setup' );


// Responsive oEmbed
function fran_responsive_embed( $html, $url, $attr, $post_ID ) {
	$return = '<div class="video-container">' . $html . '</div>';
	return $return;
}
add_filter( 'embed_oembed_html', 'fran_responsive_embed', 10, 4 );

// Overwrite number of posts in archive page
if ( !is_admin() ) {
	add_filter( 'pre_get_posts', 'fran_posts_per_page' );
}
function fran_posts_per_page( $query ) {
	$query->query_vars['posts_per_page'] = 9;
	return $query;
}

// Add current-page class to taxonomy archives
function fran_current_nav_class($classes, $item) {
	$post_type = get_query_var( 'post_type' );
	if ( get_post_type() == $post_type ) {
		$classes = array_filter( $classes, "get_current_value" );
	}
	// Go to Menus and add a menu class named: {custom-post-type}-menu-item
	if( in_array( $post_type.'-menu-item', $classes ) ) {
		array_push( $classes, 'current-page-parent' );
	}
	return $classes;
}

function get_current_value( $element ) {
	return ( $element != "current-page-parent" );
}
add_filter( 'nav_menu_css_class', 'fran_current_nav_class', 10, 2);

function fran_remove_admin_bar() {
	if ( !current_user_can( 'edit_posts' ) && !is_admin() ) {
		show_admin_bar( false );
	}
}
add_action('after_setup_theme', 'fran_remove_admin_bar');

// Footer widget columns
$footer_widget_columns = get_theme_mod( 'footer_widgets' );
if( $footer_widget_columns == '' ) {
	$widgetclass = 'one-third';
} else {
	switch ( $footer_widget_columns ) {
		case '3columns':
			$widgetclass = 'one-third';
			break;
		case '4columns':
			$widgetclass = 'one-fourth';
			break;
	}
}

// Disable smileys
if ( !get_theme_mod ( 'disable_smileys' ) == '' ) {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
}

// Widget areas
if (function_exists( 'register_sidebar')) {
	register_sidebar(array(
		'name'=> 'Home',
		'id' => 'home',
		'before_widget' => '<div class="col one-third"><div id="%1$s" class="block widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=> 'Main',
		'id' => 'main',
		'before_widget' => '<div id="%1$s" class="block widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=> 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div id="%1$s" class="block widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=> 'Footer',
		'id' => 'footer',
		'before_widget' => '<div class="col ' . $widgetclass . '"><div id="%1$s" class="block widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

// Modify exerpts
function fran_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'fran_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function fran_excerpt_strip_tags( $content ) {
	return strip_tags( $content, '<p>' );
}
add_filter( 'the_excerpt', 'fran_excerpt_strip_tags' );

// Remove Yoast SEO plugin comments from html source
function ad_ob_start() {
	ob_start( 'ad_filter_wp_head_output' );
}
function ad_ob_end_flush() {
	ob_end_flush();
}
function ad_filter_wp_head_output( $output ) {
	if ( defined( 'WPSEO_VERSION' ) ) {
		$output = str_ireplace( '<!-- This site is optimized with the Yoast SEO plugin v' . WPSEO_VERSION . ' - https://yoast.com/wordpress/plugins/seo/ -->', '', $output );
		$output = str_ireplace( '<!-- / Yoast SEO plugin. -->', '', $output );
	}
	return $output;
}
add_action( 'get_header', 'ad_ob_start' );
add_action( 'wp_head', 'ad_ob_end_flush', 100 );

// Remove recent comments style
function fran_remove_recent_comments_style() {  
	global $wp_widget_factory;  
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}
add_action( 'widgets_init', 'fran_remove_recent_comments_style' );