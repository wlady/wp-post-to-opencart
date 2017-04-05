<?php
/**
 * Plugin Name: Posts to OpenCart
 * Plugin URI: http://www.likbet.com
 * Description: This plugin allows to publish WP posts to site powered by OpenCart.
 * Version: 1.0.0
 * Author: Vladimir Zabara
 */

include ('post-to-opencart.class.php');
if ( is_admin () ) {
	include ('post-to-opencart-admin.class.php');
    $plugin = new PostToOpenCartAdmin;
} else {
	new PostToOpenCart;
}
