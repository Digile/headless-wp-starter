<?php
/**
 * Allow GET requests from * origin
 * Thanks to https://joshpress.net/access-control-headers-for-the-wordpress-rest-api/
 */
add_action( 'rest_api_init', function () {

    remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );

    add_filter( 'rest_pre_serve_request', function ( $value ) {
        $http_origin = $_SERVER['HTTP_ORIGIN'];

        if ($http_origin == "http://localhost:3000" || $http_origin == "http://localhost:3100" || $http_origin == "http://www.domain3.com")
        {  
        
            header( 'Access-Control-Allow-Origin: ' . $http_origin );
            header( 'Access-Control-Allow-Methods: GET' );
            header( 'Access-Control-Allow-Credentials: true' );
            return $value;
        }
    });
}, 15 );
