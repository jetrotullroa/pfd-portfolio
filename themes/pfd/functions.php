<?php

require_once( get_stylesheet_directory() . '/includes/Mobile_Detect.php' );
require_once( get_stylesheet_directory() . '/includes/pfd-common-functions.php' );
require_once( get_stylesheet_directory() . '/includes/pfd-theme-functions.php' );
require_once( get_stylesheet_directory() . '/includes/pfd-integration-functions.php' );


function pfd_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'pfd_enqueue_styles' );



?>
