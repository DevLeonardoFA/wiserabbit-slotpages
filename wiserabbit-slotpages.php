<?php

/**
 * 
 * Plugin Name: Wiserabbit Slotpages
 * Plugin URI: 
 * Description: user-friendly way to manage and display slot information, SEO-friendly and scalable across 150 websites.
 * Version: 1.0
 * Author: Leonardo F. Alonso
 * Author URI: https://leonardofalonso.vercel.app/
 * License: GPL2
 * 
 * */


if( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/backend/WRSP.php';
require_once __DIR__ . '/frontend/WRSP_Content.php';

add_action('admin_enqueue_scripts', 'backend_style');
add_action('wp_enqueue_scripts', 'frontend_style');



function backend_style() {
    wp_enqueue_style('WRSP_back_style', plugins_url('assets/style/backend.css', __FILE__));    
}
function frontend_style() {
    wp_enqueue_style('WRSP_front_style', plugins_url('assets/style/frontend.css', __FILE__));    
}

?>