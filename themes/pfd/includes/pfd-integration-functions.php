<?php
/**
 * Created By: Jetro Tul lRoa
 */

/**
 * Add Metabox for extra featured images (powered by plugin)
 *
 * @return void
 */
function pfd_add_featured_image_metabox(){
	if ( class_exists( 'MultiPostThumbnails' ) ) :
		new MultiPostThumbnails(
			array(
				'label'     => 'Desktop Page Banner',
				'id'        => 'desktop-image',
				'post_type' => 'page'
			)
		);
		new MultiPostThumbnails(
			array(
				'label'     => 'Mobile Page Banner',
				'id'        => 'mobile-image',
				'post_type' => 'page'
			)
		);
		new MultiPostThumbnails(
			array(
				'label'     => 'Additional Image',
				'id'        => 'additional-image',
				'post_type' => 'page'
			)
		);
	endif;
}

add_action( 'init',  'pfd_add_featured_image_metabox' );

/**
 * Outputs different page banners
 *
 * @return void
 */
function the_page_banner(){

	global $post, $detect;
	$attr = array(
		'class' => 'graceful-slice',
	);

	$id = $title = '';


	echo '<div class="page-banner-container"><div class="page-banner">';
	if ( is_front_page() ) :
		$id = get_option('page_on_front');
	elseif ( get_post_type( $post ) == 'page' ) :
		$id = $post->ID;
	else:
		if ( is_shop() ) :
			$page = get_page_by_title( 'Shop Banner' );
			$id = $page->ID;
		elseif ( is_home() ) :
			$page = get_page_by_title( 'Blog Banner' );
			$id = $page->ID;
		endif;
	endif;
	if ( !$detect->isMobile() || $detect->isTablet() ) :

		if ( class_exists( 'MultiPostThumbnails' ) ) :
			if ( MultiPostThumbnails::has_post_thumbnail(
				'page',
				'desktop-image',
				$id
			) ):
				MultiPostThumbnails::the_post_thumbnail(
					'page',
					'desktop-image',
					$id,
					'full',
					$attr
				);
			else:
				//insert default mobile image here
			endif;
		endif;
	else:
		if ( class_exists( 'MultiPostThumbnails' ) ) :
			if ( MultiPostThumbnails::has_post_thumbnail(
				'page',
				'mobile-image',
				$id
			) ):
				MultiPostThumbnails::the_post_thumbnail(
					'page',
					'mobile-image',
					$id,
					'full',
					$attr
				);
			else:
				//insert default mobile image here
			endif;
		endif;
	endif;
	if ( is_page()  ) :
		$title =  '<h1>' . pfd_get_ancestor_page_name() . '</h1>';
	elseif ( is_archive() || is_singular( '' ) || is_singular( '' ) || is_singular( '' ) ) :
		$title =  '<h3>' . $title . '</h3>';
	endif;
	if ( ! is_front_page() ) :
		echo '<div class="parent-title">' . $title . '</div>';
	endif;
	echo '</div></div>';
}
//
function the_additional_image( $size = 'full' ) {
	global $post;

	$id = $post->ID;

	if ( class_exists( 'MultiPostThumbnails' ) ) :
		if ( MultiPostThumbnails::has_post_thumbnail(
			'page',
			'additional-image',
			$id
		) ):
			MultiPostThumbnails::the_post_thumbnail(
				'page',
				'additional-image',
				$id,
				$size
			);
		else:
			//insert default mobile image here
		endif;
	endif;
}

function the_gravity_form( $form_id ) {
	if ( function_exists( 'gravity_form' ) ) :
		gravity_form( $form_id, false, false, false, '', true, 12 );
	endif;
}

function get_hero_image() {

	global $post, $detect;
	$attr = array(
		'class' => 'graceful-slice',
	);

	$id = $title = '';

	if ( is_front_page() ) :
		$id = get_option('page_on_front');
	elseif ( get_post_type( $post ) == 'page' ) :
		$id = $post->ID;
	else:
		if ( is_post_type_archive( 'shop' ) ) :
			$page = get_page_by_title( 'Shop' );
			$id = $page->ID;
		elseif ( is_singular( 'about' ) ) :
			$page = get_page_by_title( 'About' );
			$id = $page->ID;
		elseif ( is_singular( 'contact-us' ) ) :
			$page = get_page_by_title( 'Contact Us' );
			$id = $page->ID;
		endif;
	endif;
	if ( !$detect->isMobile() || $detect->isTablet() ) :

		if ( class_exists( 'MultiPostThumbnails' ) ) :
			if ( MultiPostThumbnails::has_post_thumbnail(
				'page',
				'hero-image',
				$id
			) ):
				MultiPostThumbnails::the_post_thumbnail(
					'page',
					'hero-image',
					$id,
					'full',
					$attr
				);
			else:
				//insert default mobile image here
			endif;
		endif;
	else:
		if ( class_exists( 'MultiPostThumbnails' ) ) :
			if ( MultiPostThumbnails::has_post_thumbnail(
				'page',
				'hero-mobile-image',
				$id
			) ):
				MultiPostThumbnails::the_post_thumbnail(
					'page',
					'hero-mobile-image',
					$id,
					'full',
					$attr
				);
			else:
				//insert default mobile image here
			endif;
		endif;
	endif;
}

function get_archive_image() {

	global $post, $detect;
	$attr = array(
		'class' => 'graceful-slice',
	);

	$id = $title = '';

	if ( is_front_page() ) :
		$id = get_option('page_on_front');
	elseif ( get_post_type( $post ) == 'page' ) :
		$id = $post->ID;
	else:
		if ( is_post_type_archive( 'shop' ) ) :
			$page = get_page_by_title( 'Shop' );
			$id = $page->ID;
		elseif ( is_singular( 'about' ) ) :
			$page = get_page_by_title( 'About' );
			$id = $page->ID;
		elseif ( is_singular( 'contact-us' ) ) :
			$page = get_page_by_title( 'Contact Us' );
			$id = $page->ID;
		endif;
	endif;
	if ( !$detect->isMobile() || $detect->isTablet() ) :

		if ( class_exists( 'MultiPostThumbnails' ) ) :
			if ( MultiPostThumbnails::has_post_thumbnail(
				'page',
				'hero-image',
				$id
			) ):
				MultiPostThumbnails::the_post_thumbnail(
					'page',
					'hero-image',
					$id,
					'full',
					$attr
				);
			else:
				//insert default mobile image here
			endif;
		endif;
	else:
		if ( class_exists( 'MultiPostThumbnails' ) ) :
			if ( MultiPostThumbnails::has_post_thumbnail(
				'page',
				'hero-mobile-image',
				$id
			) ):
				MultiPostThumbnails::the_post_thumbnail(
					'page',
					'hero-mobile-image',
					$id,
					'full',
					$attr
				);
			else:
				//insert default mobile image here
			endif;
		endif;
	endif;
}

function the_shop_banner() {

	global $post, $detect;
	$attr = array(
		'class' => 'graceful-slice',
	);

	$id = $title = '';
	if ( is_shop() ) :
		$id = get_option('Shop');
	elseif ( get_post_type( $post ) == 'page' ) :
		$id = $post->ID;
	else:
		if ( is_post_type_archive( 'shop' ) || is_singular( 'shop' ) ) :
			$page = get_page_by_title( 'Shop Banner' );
			$id = $page->ID;
		endif;
	endif;
	echo '<div class="page-banner-container"><div class="page-banner">';
	if ( !$detect->isMobile() || $detect->isTablet() ) :

		if ( class_exists( 'MultiPostThumbnails' ) ) :
			if ( MultiPostThumbnails::has_post_thumbnail(
				'page',
				'desktop-image',
				$id
			) ):
				MultiPostThumbnails::the_post_thumbnail(
					'page',
					'desktop-image',
					$id,
					'full',
					$attr
				);
			else:
				//insert default mobile image here
			endif;
		endif;
	else:
		if ( class_exists( 'MultiPostThumbnails' ) ) :
			if ( MultiPostThumbnails::has_post_thumbnail(
				'page',
				'mobile-image',
				$id
			) ):
				MultiPostThumbnails::the_post_thumbnail(
					'page',
					'mobile-image',
					$id,
					'full',
					$attr
				);
			else:
				//insert default mobile image here
			endif;
		endif;
	endif;
	if ( is_page()  ) :
		$title =  '<h1>' . pfd_get_ancestor_page_name() . '</h1>';
	elseif ( is_archive() || is_singular( 'helphub_productrange' ) || is_singular( 'helphub_brands' ) || is_singular( 'team-member' ) ) :
		$title =  '<h3>' . $title . '</h3>';
	endif;
	if ( ! is_front_page() ) :
		echo '<div class="parent-title">' . $title . '</div>';
	endif;
	echo '</div></div>';
}
