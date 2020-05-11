<?php
/**
 * Plugin Name: A Sticky Note
 * Plugin URI: https://github.com/prtksxna/a-sticky-note
 * Description: Gutenberg block to add sticky notes to your blog posts.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Prateek Saxena
 * Author URI: https://prtksxna.com
 * License: GPL v2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

function sticky_note_block() {
  $asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

  wp_register_script(
    'sticky-note',
    plugins_url( 'build/index.js', __FILE__ ),
    $asset_file['dependencies'],
    $asset_file['version']
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

  wp_enqueue_style( 'sticky-note-google-fonts', 'https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap', false );

  register_block_type( 'sticky-note/sticky-note', array(
    'style' => 'sticky-note-style',
    'editor_style' => 'sticky-note-editor',
    'editor_script' => 'sticky-note',
  ) );
}
add_action( 'init', 'sticky_note_block' );

function sticky_note_styles() {
  wp_enqueue_style( 'sticky-note-google-fonts', 'https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'sticky_note_styles');
