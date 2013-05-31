<?php
/*
Plugin Name: AboutMagic-Plugin
Description: AboutMagic plugin for Wordpress
Version: 0.1
Author: Fernando Hidalgo
Author URI: http://sopinet.com
Plugin URI: https://github.com/sopinet/aboutmagic-plugin
*/


/**
 * Define some useful constants
 **/
define('ABOUTMAGIC_VERSION', '1.0');
define('ABOUTMAGIC_DIR', plugin_dir_path(__FILE__));
define('ABOUTMAGIC_URL', plugin_dir_url(__FILE__));



/**
 * Load files
 * 
 **/
function aboutmagicplugin_load(){
		
    if(is_admin()) {
        require_once(ABOUTMAGIC_DIR.'includes/admin.php');
		}
    
    require_once(ABOUTMAGIC_DIR.'includes/core.php');
}

aboutmagicplugin_load();
add_action('wp_print_scripts', 'aboutmagicplugin_ScriptsAction');


function aboutmagicplugin_ScriptsAction() {
	$mosaic_js = ABOUTMAGIC_URL . 'assets/js/mosaic.1.0.1.min.js';
	$mosaic_css = ABOUTMAGIC_URL . 'assets/css/mosaic.css';
 if (!is_admin())
	{
	  wp_enqueue_script('jquery');
		wp_enqueue_script('aboutmagic_script', $mosaic_js);
		wp_enqueue_style('aboutmagic_style', $mosaic_css);
	}
}

/**
 * Activation, Deactivation and Uninstall Functions
 * 
 **/
register_activation_hook(__FILE__, 'aboutmagic_activation');
register_deactivation_hook(__FILE__, 'aboutmagic_deactivation');


function aboutmagicplugin_activation() {
    
	//actions to perform once on plugin activation go here    
    
	
    //register uninstaller
    register_uninstall_hook(__FILE__, 'aboutmagicplugin_uninstall');
}

function aboutmagicplugin_deactivation() {
    
	// actions to perform once on plugin deactivation go here
	    
}

function aboutmagicplugin_uninstall(){
    
    //actions to perform once on plugin uninstall go here
	    
}

?>
