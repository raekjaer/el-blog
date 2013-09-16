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

/**
 * Add Google Analytics tracking code to footer.
 * See http://www.wpbeginner.com/beginners-guide/how-to-install-google-analytics-in-wordpress/
 */
add_action('wp_footer', 'add_googleanalytics');
function add_googleanalytics() {
  if (is_user_logged_in() == FALSE) {
    echo "<script>" .
      "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){" .
      "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o)," .
      "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)" .
      "})(window,document,'script','//www.google-analytics.com/analytics.js','ga');" .
      "ga('create', 'UA-44041803-1', 'joernsdagbog.dk');" .
      "ga('send', 'pageview');" .
    "</script>" .
    "\n";
  }
}

/*
 * Add og:image meta tag to head
 * Needed for Publicize if there is no gravatar image
 */

function twentythirteen_child_custom_head() {
  echo '<meta property="og:image" content="http://joernsdagbog.dk/wp-content/uploads/2013/09/Joern_s.jpg">';
}
add_action('wp_head', 'twentythirteen_child_custom_head');

?>