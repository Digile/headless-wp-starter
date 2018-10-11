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

// Register routes
register_rest_route( 'headless/v1', '/post', [
            'methods'  => 'GET',
            'callback' => 'rest_get_posts_by_interest',
            'args' => [
                'interest' => array_merge(
                    $post_interest_arg,
                    [
                        'required' => true,
                    ]
                ),
            ],
] );


/**
 * Respond to a REST API request to get post data by acf interest
 *
 * @param WP_REST_Request $request Request.
 * @return WP_REST_Response
 */
function rest_get_posts_by_interest( WP_REST_Request $request ) {

  $interest = $request->get_param( 'interest' );

  return get_content_by_interest($interest,'post');
}


/**
 * Returns a post or page given a slug. Returns false if no post matches.
 *
 * @param str $slug Slug
 * @param str $type Valid values are 'post' or 'page'
 * @return Post
 */
function get_content_by_interest( $interest, $type = 'post' ) {
  $content_in_array = in_array(
      $type,
      [
          'post',
          'page',
      ],
      true
  );
  if ( ! $content_in_array ) {
      $type = 'post';
  }
  $args = [
      'interest'        => $interest,
      'post_type'   => $type,
      'post_status' => 'publish'
  ];

  // phpcs:ignore WordPress.VIP.RestrictedFunctions.get_posts_get_posts
  $post_search_results = get_posts( $args );

  return $post_search_results;
 
}
