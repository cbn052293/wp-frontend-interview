<?php
/**
 * Plugin Name: Modal Form
 * Description: Modal is visible in all pages after the plugin is activated
 */


// Action Trigger uppon loading
register_activation_hook(__FILE__, 'database_creation');
add_action('wp_enqueue_scripts', 'add_style');
add_action('wp_footer', 'generate_form');


// Create Database
function database_creation() {
	global $wpdb;
	$contact_info = $wpdb->prefix."newsletter_signup";
	$charset = $wpdb->get_charset_collate;

	$query = "CREATE TABLE ".$contact_info."(
		contact_ID     	int    NOT NULL,
		Name 			text,
		Email 			text,
		PRIMARY KEY 	(contact_ID)
	) $charset;";

	dbDelta($query);
}

// Add Style sheet
function add_style() {
	wp_register_style('style', plugin_dir_url(__FILE__).'contact_style.css');
	wp_enqueue_style('style', plugin_dir_url(__FILE__).'contact_style.css');
}


// Generate form on website footer
function generate_form ( $content ) {

    ?>
    <div class="modal-form">
    	<h4>Prunderground newsletter</h4>
    	<div class="spcaer"></div>
		<form method="post" action="<?php the_permalink(); ?>">
		  <input class="input-text" type="text" id="name" name="name" placeholder="Your Name" value="">
		  <input class="input-text" type="email" id="email" name="email" placeholder="Email Address" value="">
		  <input class="input-button" type="submit" name="submit" value="Signup">
		</form>
	</div>
    <?php
}

