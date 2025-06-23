<?php
function mytheme_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('menus');
  add_theme_support('editor-styles');
  add_theme_support('wp-block-styles');
  add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'mytheme_setup');

function mytheme_enqueue_styles() {
  wp_enqueue_style('mytheme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');