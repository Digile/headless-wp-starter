<?php

/**
 * Placeholder function for determining the frontend origin.
 *
 * @TODO Determine the headless client's URL based on the current environment.
 *
 * @return str Frontend origin URL, i.e., http://localhost:3000.
 */
function allowed_forntend_origins() {
    return ['http://localhost:3000','http://localhost:3100','https://nextjs-app-ttkioibrnq.now.sh'];
}


/**
 * Placeholder function for determining the frontend origin.
 *
 * @TODO Determine the headless client's URL based on the current environment.
 * ALso needs to configure the front end origin in an env file
 *
 * @return str Frontend origin URL, i.e., http://localhost:3000.
 */
function get_frontend_origin() {
    return 'http://localhost:3000';
}