<?php

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
	$theme_version = et_get_theme_version();
	wp_enqueue_style('divi/style', get_template_directory_uri() . '/style.css', false, $theme_version);
	wp_enqueue_style('mft/style', get_stylesheet_directory_uri() . '/css/style.css', false, null);
  wp_enqueue_script('mft/scripts', get_stylesheet_directory_uri() . '/scripts/main.js', false, null, true);
}, 100);

/**
 * Set image quality
 */
add_filter('jpeg_quality', function($arg){return 100;});

/**
 * Accessible mobile nav menu
 */
add_action('after_setup_theme', function() {
	remove_action( 'et_header_top', 'et_add_mobile_navigation' );
	add_action('et_header_top', 'a11y_mobile_navigation');
	function a11y_mobile_navigation(){
		if ( is_customize_preview() || ( 'slide' !== et_get_option( 'header_style', 'left' ) && 'fullscreen' !== et_get_option( 'header_style', 'left' ) ) ) {
			printf(
				'<div id="et_mobile_nav_menu">
					<div class="mobile_nav closed">
						<span class="select_page">%1$s</span>
						<a class="mobile_menu_toggle" href="#"></a>
					</div>
				</div>',
				esc_html__( 'Select Page', 'Divi' )
			);
		}
	}
});

/**
*	This will hide the Divi "Project" post type.
*	Thanks to georgiee (https://gist.github.com/EngageWP/062edef103469b1177bc#gistcomment-1801080) for his improved solution.
*/
add_filter( 'et_project_posttype_args', function( $args ) {
 	return array_merge( $args, array(
 		'public'              => false,
 		'exclude_from_search' => false,
 		'publicly_queryable'  => false,
 		'show_in_nav_menus'   => false,
 		'show_ui'             => false
 	));
}, 10, 1);
