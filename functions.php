<?php

/**
  * Change the path for the header image
  * See http://wordpress.org/support/topic/setting-default-header-image-in-child-theme#post-3687736
  */
function twentythirteen_child_custom_header_setup() {
  // $args in add_theme_support() in child theme will auto override what defined in parent's
  // see http://core.trac.wordpress.org/browser/tags/3.5/wp-includes/theme.php#L1292
  $args = array(
    //'default-image' => get_stylesheet_directory_uri() . '/images/header-image.png',
    'default-image' => '',
  );
  add_theme_support( 'custom-header', $args );
}
// add it the same way Twenty Thirteen does
add_action( 'after_setup_theme', 'twentythirteen_child_custom_header_setup' );
?>