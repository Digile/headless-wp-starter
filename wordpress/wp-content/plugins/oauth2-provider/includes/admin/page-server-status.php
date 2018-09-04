<?php
/**
 * Server Status
 *
 */
global $license_error;
$license_error = null;
function wo_server_status_page() {
	wp_enqueue_style( 'wo_admin' );
	wp_enqueue_script( 'wo_admin' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	?>
    <div class="wrap">
        <h2><?php _e( 'Server Status', 'wp-oauth' ); ?></h2>
        <div class="section group">
            <div class="col span_4_of_6">
				<?php wo_display_settings_tabs(); ?>
            </div>
            <div class="col span_2_of_6 sidebar">
                <div class="module">
                    <h3>Technical Support</h3>
                    <div class="inner">
                        <p>
                            Upgrade to Pro with 30% OFF and receive priority support and all the grant types.
                        </p>

                        <a href="https://wp-oauth.com/downloads/wp-oauth-server/" class="button button-primary">Download
                            PRO</a>

                        <h4>Use "PROME" at checkout for 30% OFF.</h4>
                        <strong>Build <?php echo _WO()->version; ?></strong>
                    </div>
                </div>

                <div class="module hire-us">
                    <h3>Hire a Developer</h3>
                    <div class="inner">
                        <p>
                            If you are looking for a developer for your project, why not hire the professionals that
                            built this plugin!
                        </p>
                        <p>
                            <strong>Get a Free Quote</strong>
                        </p>
						<?php
						$current_user = wp_get_current_user();
						?>
                        <form action="https://wp-oauth.com/professional-services-request/">
                            <input type="text" name="yourname" placeholder="Enter Your Name"
                                   value="<?php echo $current_user->user_firstname; ?>" required/>
                            <input type="hidden" name="email" value="<?php echo $current_user->user_email; ?>"/>
                            <input type="hidden" name="website" value="<?php echo site_url(); ?>"/>

                            <br/>

                            <input type="submit" class="button button-primary" value="Request more information"/>
                            <br/><br/>
                            <small>
                                Your information is private and is not shared with anyone other than our development
                                team.
                            </small>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
	<?php
}