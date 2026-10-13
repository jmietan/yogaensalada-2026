<?php
/**
 * Theme assets.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function yogaensalada_2026_assets(): void {
	$path = get_template_directory() . '/assets/css/main.css';

	wp_enqueue_style(
		'yogaensalada-2026',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		file_exists( $path ) ? (string) filemtime( $path ) : null
	);
}
add_action( 'wp_enqueue_scripts', 'yogaensalada_2026_assets' );

function yogaensalada_2026_editor_styles(): void {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/main.css' );
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'yogaensalada-2026' ),
		)
	);
}
add_action( 'after_setup_theme', 'yogaensalada_2026_editor_styles' );

/**
 * Render the classic primary menu inside the block-theme header.
 */
function yogaensalada_2026_primary_menu(): string {
	if ( ! has_nav_menu( 'primary' ) ) {
		return '';
	}

	$menu = wp_nav_menu(
		array(
			'theme_location'       => 'primary',
			'container'            => 'nav',
			'container_class'      => 'classic-navigation',
			'container_aria_label' => __( 'Primary Menu', 'yogaensalada-2026' ),
			'menu_class'           => 'classic-navigation__menu',
			'fallback_cb'          => false,
			'echo'                 => false,
		)
	);

	return is_string( $menu ) ? $menu : '';
}
add_shortcode( 'yogaensalada_primary_menu', 'yogaensalada_2026_primary_menu' );
