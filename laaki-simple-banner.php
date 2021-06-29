<?php
/**
 * Plugin Name:     Laaki Simple Banner
 * Plugin URI:      https://webdesignvista.com/wordpress/plugins/laaki-simple-banner
 * Description:     Generates a simple banner widget which can be used on any dynamic widgetized area
 * Author:          Lakhya Phukan
 * Author URI:      https://webdesignvista.com/
 * Text Domain:     web_design_vista
 * Version:         0.1.0
 *
 * @package         Web_Design_Vista
 */

require_once "laaki-simple-banner-widget.php";

class Laaki_Simple_Banner {

    function __construct() {
        add_action('widgets_init', array(&$this, 'register_laaki_simple_banner_widget'));
        add_action('admin_enqueue_scripts', array(&$this, 'enqueue_laaki_simple_banner_script'));
    }

    function register_laaki_simple_banner_widget() {
        register_widget('Laaki_Simple_Banner_Widget');
    }

    function enqueue_laaki_simple_banner_script() {
        //Enqueue media.
        wp_enqueue_media();
        // Enqueue custom js file.
        wp_register_script( 'laaki-simple-banner-script', plugin_dir_url( __FILE__ ) . '/js/laaki-simple-banner-script.js', array('jquery') );
        wp_enqueue_script( 'laaki-simple-banner-script' );
    }
    

}

new Laaki_Simple_Banner();