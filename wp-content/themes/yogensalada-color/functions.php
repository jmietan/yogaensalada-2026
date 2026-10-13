<?php
/**
 * Theme setup, frontend assets, and shared block rendering.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Share theme styles with the frontend and the block editor.
add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'editor-styles' );
		add_editor_style( 'theme.css' );
		add_theme_support( 'responsive-embeds' );
	}
);

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'yogensalada-color',
			get_theme_file_uri( 'theme.css' ),
			array(),
			(string) filemtime( get_theme_file_path( 'theme.css' ) )
		);
	}
);

// Group the theme's reusable patterns in the editor inserter.
add_action(
	'init',
	function () {
		register_block_pattern_category(
			'yogensalada-color',
			array(
				'label' => __( 'Yogensalada Color', 'yogensalada-color' ),
			)
		);
	}
);

add_action(
	'admin_notices',
	function () {
		if ( ! defined( 'GENERATEBLOCKS_VERSION' ) ) {
			echo '<div class="notice notice-warning"><p>Yogensalada Color requires the GenerateBlocks plugin. Activate GenerateBlocks before editing this theme.</p></div>';
		}
	}
);

/**
 * Show the theme brand until a custom Site Logo is selected in the editor.
 */
add_filter(
	'render_block_core/site-logo',
	function ( $content ) {
		if ( trim( $content ) !== '' || has_custom_logo() ) {
			return $content;
		}

		return '<div class="wp-block-site-logo yc-default-logo"><a href="'
			. esc_url( home_url( '/' ) )
			. '" class="custom-logo-link" rel="home"><img src="'
			. esc_url( get_theme_file_uri( 'assets/images/brand.svg' ) )
			. '" width="180" height="92" alt="'
			. esc_attr__( 'Yoga Ensalada home', 'yogensalada-color' )
			. '" /></a></div>';
	}
);

/**
 * Mark matching custom navigation links using WordPress native request state.
 */
add_filter(
	'render_block_core/navigation-link',
	function ( $content, $block ) {
		$url = $block['attrs']['url'] ?? '';

		if (
			is_front_page() && untrailingslashit( $url ) === untrailingslashit( home_url( '/' ) )
			|| is_front_page() && $url === '/'
		) {
			$content = str_replace(
				'class="wp-block-navigation-item__content"',
				'aria-current="page" class="wp-block-navigation-item__content"',
				$content
			);
		}

		return $content;
	},
	10,
	2
);

// Page query filters, contact form, and permalink-aware navigation.
require_once get_theme_file_path( 'inc/pages.php' );

// Enhance the homepage practice rail with scrolling controls.
add_action(
	'wp_enqueue_scripts',
	function () {
		if ( is_front_page() ) {
			wp_enqueue_script(
				'yc-practice',
				get_theme_file_uri( 'assets/js/practice.js' ),
				array(),
				(string) filemtime( get_theme_file_path( 'assets/js/practice.js' ) ),
				array(
					'in_footer' => true,
					'strategy'  => 'defer',
				)
			);
		}
	}
);

/**
 * Mark container blocks for the frontend scroll-in enhancement.
 * This does not change saved block markup or the editor canvas.
 */
function yogensalada_mark_scroll_container( $content ) {
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return $content;
	}

	$processor = new WP_HTML_Tag_Processor( $content );

	if ( $processor->next_tag() ) {
		$processor->set_attribute( 'data-yc-scroll-container', 'true' );
	}

	return $processor->get_updated_html();
}

add_filter( 'render_block_generateblocks/element', 'yogensalada_mark_scroll_container' );
add_filter( 'render_block_core/group', 'yogensalada_mark_scroll_container' );

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_script(
			'yc-scroll-reveal',
			get_theme_file_uri( 'assets/js/scroll-reveal.js' ),
			array(),
			(string) filemtime( get_theme_file_path( 'assets/js/scroll-reveal.js' ) ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}
);

// Shared editor presets and defaults for newly inserted blocks.
require_once get_theme_file_path( 'inc/design-system.php' );

