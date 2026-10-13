<?php
/** Editor-visible design system controls for native and GenerateBlocks blocks. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'init',
	function () {
		register_block_style( 'core/button', array( 'name' => 'secondary', 'label' => __( 'Secondary', 'yogensalada-color' ) ) );

		foreach ( array( 'core/image', 'core/post-featured-image' ) as $block ) {
			register_block_style( $block, array( 'name' => 'landscape', 'label' => __( 'Landscape 16:9', 'yogensalada-color' ) ) );
			register_block_style( $block, array( 'name' => 'square', 'label' => __( 'Square 1:1', 'yogensalada-color' ) ) );
		}
	}
);

/**
 * GenerateBlocks 2.4.1 exposes this filter for newly inserted Button variations.
 * Store token references in real block settings, instead of assigning extra classes.
 */
add_filter(
	'generateblocks_default_button_attributes',
	function ( $attributes ) {
		$attributes['styles'] = array(
			'display'         => 'inline-flex',
			'alignItems'      => 'center',
			'justifyContent'  => 'center',
			'columnGap'       => 'var(--yc-button-gap)',
			'backgroundColor'=> 'var(--yc-color-primary)',
			'color'           => 'var(--yc-color-primary-text)',
			'fontFamily'      => 'var(--yc-font-body)',
			'fontSize'        => 'var(--yc-font-body-size)',
			'fontWeight'      => 'var(--yc-weight-heading)',
			'lineHeight'      => '1.3',
			'paddingTop'      => 'var(--yc-button-padding-y)',
			'paddingRight'    => 'var(--yc-button-padding-x)',
			'paddingBottom'   => 'var(--yc-button-padding-y)',
			'paddingLeft'     => 'var(--yc-button-padding-x)',
			'borderRadius'    => 'var(--yc-radius-button)',
			'minHeight'       => '48px',
			'textDecoration'  => 'none',
			'transition'      => 'background-color var(--yc-transition) ease, filter var(--yc-transition) ease',
			'&:hover'         => array( 'filter' => 'brightness(.92)' ),
			'&:focus-visible' => array( 'outline' => '3px solid var(--yc-navy)', 'outlineOffset' => '4px' ),
		);

		return $attributes;
	}
);
