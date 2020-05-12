<?php
/**
 * Sticky note block for Gutenberg.
 *
 * @file Main file.
 * @package a-sticky-note
 */

/**
 * Plugin Name: A Sticky Note
 * Plugin URI: https://github.com/prtksxna/a-sticky-note
 * Description: Gutenberg block to add sticky notes to your blog posts.
 * Version: 1.1.3
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Prateek Saxena
 * Author URI: https://prtksxna.com
 * License: GPL v2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
function a_sticky_note_block() {
  $asset_file = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';

  wp_register_script(
    'sticky-note',
    plugins_url( 'build/index.js', __FILE__ ),
    $asset_file['dependencies'],
    $asset_file['version'],
    true,
  );

  wp_register_style(
    'sticky-note-editor',
    plugins_url( 'editor.css', __FILE__),
    array( 'wp-edit-blocks' ),
    filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
  );

  wp_register_style(
    'sticky-note-style',
    plugins_url( 'style.css', __FILE__),
    array(),
    filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
  );

  wp_enqueue_style( 'sticky-note-google-fonts', 'https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap', false, 'custom' );

  register_block_type(
    'sticky-note/sticky-note',
    array(
        'style'         => 'sticky-note-style',
        'editor_style'  => 'sticky-note-editor',
        'editor_script' => 'sticky-note',
    )
  );
}
add_action( 'init', 'a_sticky_note_block' );

/**
 * Register Google Font styles.
 */
function a_sticky_note_styles() {
  wp_enqueue_style( 'sticky-note-google-fonts', 'https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap', false, 'custom' );
}
add_action( 'wp_enqueue_scripts', 'a_sticky_note_styles' );
