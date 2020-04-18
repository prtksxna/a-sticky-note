<?php
/*
Plugin Name: Sticky Note
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

  wp_enqueue_style( 'sticky-note-google-fonts', 'https://fonts.googleapis.com/css2?family=Covered+By+Your+Grace&display=swap', false );

  register_block_type( 'sticky-note/sticky-note', array(
    'style' => 'sticky-note-style',
    'editor_style' => 'sticky-note-editor',
    'editor_script' => 'sticky-note',
  ) );
}
add_action( 'init', 'sticky_note_block' );

function sticky_note_styles() {
  wp_enqueue_style( 'sticky-note-google-fonts', 'https://fonts.googleapis.com/css2?family=Covered+By+Your+Grace&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'sticky_note_styles');
