<?php
/**
 * Created By: JetroTullRoa
 */

/**
 * Removes standard footer admin, later priority to catch other plugins
 *
 */
function remove_footer_admin () {

	printf(
		__( 'Designed &amp; Developed by <a href="%1$s" target="_blank">Jetro Tull Roa</a>', 'woothemes' ),
		esc_url( 'www.jetrotullroa.com' )
	);
}
add_filter( 'admin_footer_text', 'remove_footer_admin', 5000 );

/**
 * Disable the emoji's
 */
function pfd_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'wingz_disable_emojis_tinymce' );
}

add_action( 'init', 'pfd_disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param    array  $plugins
 * @return   array             Difference between the two arrays
 */
function pfd_disable_emojis_tinymce( $plugins ){
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Adds body class for jQuery and other differentiation - uses Mobile_Detect
 * @param array $classes
 * @return array
 */

function add_body_class( $classes ){
	global $detect, $post;

	if ( $detect->isMobile() ):
		if ( $detect->isTablet() ):
			$classes[] = 'tablet';
		else:
			$classes[] = 'mobile';
		endif;

		if ( $detect->version( 'iPad' ) ):
			$classes[] = ' ipad';
		endif;
		// no need for iPhone detection as WordPress does it and is implemented by Canvas

		if ( $detect->version( 'Android' ) ):
			$classes[] = ' android';
		endif;
	endif;

	$classes[] = $post->post_name;

	return $classes;
}

add_filter( 'body_class', 'add_body_class' );

/**
 * Add Except Meta Box to pages
 */
function pfd_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'pfd_add_excerpts_to_pages' );

/**
 * Get ancestor page name
 *
 * @return string
 */
function pfd_get_ancestor_page_name(){
	global $post;

	$ancestors = get_post_ancestors( $post );

	$page_name = get_the_title( end( $ancestors ) );

	return $page_name;
}
