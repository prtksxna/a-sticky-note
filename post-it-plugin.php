<?php
/*
Plugin Name: Post It
*/

function post_it_block() {
  $asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

  wp_register_script(
    'post-it',
    plugins_url( 'build/index.js', __FILE__ ),
    $asset_file['dependencies'],
    $asset_file['version']
  );

  wp_register_style(
    'post-it-editor',
    plugins_url( 'editor.css', __FILE__),
    array( 'wp-edit-blocks' ),
    filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
  );

  wp_register_style(
    'post-it-style',
    plugins_url( 'style.css', __FILE__),
    array(),
    filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
  );

  wp_enqueue_style( 'zuari-google-fonts', 'https://fonts.googleapis.com/css2?family=Covered+By+Your+Grace&display=swap', false );

  register_block_type( 'post-it/post-it', array(
    'style' => 'post-it-style',
    'editor_style' => 'post-it-editor',
    'editor_script' => 'post-it',
  ) );
}
add_action( 'init', 'post_it_block' );

function post_it_styles() {
  wp_enqueue_style( 'zuari-google-fonts', 'https://fonts.googleapis.com/css2?family=Covered+By+Your+Grace&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'post_it_styles');
