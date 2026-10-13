<?php
/**
 * Plugin Name: Yoga Ensalada Testimonials
 * Description: Reusable, editable GenerateBlocks testimonial slider with arrows and dots.
 * Version: 1.0.0
 * Requires at least: 6.5
 * Requires PHP: 7.4
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', function () {
 if ( ! WP_Block_Type_Registry::get_instance()->is_registered( 'generateblocks/element' ) ) { return; }
 register_block_pattern_category( 'yogaensalada', array( 'label' => 'Yoga Ensalada' ) );
 $content = file_get_contents( __DIR__ . '/testimonial.html' );
 $content = str_replace( '{{assets}}', esc_url( plugins_url( 'assets/images', __FILE__ ) ), $content );
 register_block_pattern( 'yogaensalada/testimonial-slider', array(
  'title' => 'Yoga Ensalada · Testimonial Slider',
  'description' => 'Four editable testimonial slides with working arrows and dots. Replace the marked placeholder quotes.',
  'categories' => array( 'yogaensalada' ),
  'content' => $content,
 ) );
}, 20 );

add_action( 'enqueue_block_assets', function () {
 wp_enqueue_style( 'yogaensalada-testimonials', plugins_url( 'assets/slider.css', __FILE__ ), array(), (string) filemtime( __DIR__ . '/assets/slider.css' ) );
 if ( is_admin() ) {
  wp_enqueue_style( 'yogaensalada-testimonials-editor', plugins_url( 'assets/editor.css', __FILE__ ), array( 'yogaensalada-testimonials' ), (string) filemtime( __DIR__ . '/assets/editor.css' ) );
 }
} );

add_action( 'wp_enqueue_scripts', function () {
 wp_enqueue_script( 'yogaensalada-testimonials', plugins_url( 'assets/slider.js', __FILE__ ), array(), (string) filemtime( __DIR__ . '/assets/slider.js' ), array( 'in_footer' => true, 'strategy' => 'defer' ) );
} );
