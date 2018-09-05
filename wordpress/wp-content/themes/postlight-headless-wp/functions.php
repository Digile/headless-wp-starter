<?php

// Frontend origin
require_once 'inc/frontend-origin.php';

// ACF commands
require_once 'inc/class-acf-commands.php';

// Logging functions
require_once 'inc/log.php';

// CORS handling
require_once 'inc/cors.php';

// Admin modifications
require_once 'inc/admin.php';

// Add Menus
require_once 'inc/menus.php';

// Add Headless Settings area
require_once 'inc/acf-options.php';

// Add custom API endpoints
require_once 'inc/api-routes.php';


add_filter( 'rest_ad_query', function( $args ) {

  $ignore = array('per_page', 'search', 'order', 'orderby', 'slug');

  foreach ( $_GET as $key => $value ) {
    if (!in_array($key, $ignore)) {
      $args['meta_query'][] = array(
        'key'   => $key,
        'value' => $value,
      );
    }
  }

  return $args;
});


function wpse28782_remove_menu_items() {
  if( !current_user_can( 'administrator' ) || current_user_can( 'admanager' )):
      remove_menu_page( 'edit.php?post_type=ad' );
  endif;
}

add_action( 'admin_menu', 'wpse28782_remove_menu_items' );
