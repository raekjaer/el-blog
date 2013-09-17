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
 * and http://codegurus.eu/2012/01/add-custom-fields-under-wp-general-settings/
 */

// Add GA field to general options
add_filter('admin_init', 'ga_general_settings_register_fields');
function ga_general_settings_register_fields()
{
    register_setting('general', 'ga_field', 'esc_attr');
    add_settings_field('ga_field', '<label for="ga_field">'.__('Google Analytics tracking ID' , 'my_field' ).'</label>' , 'ga_general_settings_fields_html', 'general');
} 
function ga_general_settings_fields_html()
{
    $value = get_option( 'ga_field', '' );
    echo '<input type="text" id="ga_field" name="ga_field" value="' . $value . '" />';
}

// Add GA tracking code to footer part of page
add_action('wp_footer', 'add_googleanalytics');
function add_googleanalytics() {
  $ga_tracking_id = get_option('ga_field', FALSE);
  if (is_user_logged_in() == FALSE && $ga_tracking_id != FALSE) {
    echo "<script>" .
      "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){" .
      "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o)," .
      "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)" .
      "})(window,document,'script','//www.google-analytics.com/analytics.js','ga');" .
      "ga('create', '" . $ga_tracking_id . "', 'joernsdagbog.dk');" .
      "ga('send', 'pageview');" .
    "</script>" .
    "\n";
  }
}

?>