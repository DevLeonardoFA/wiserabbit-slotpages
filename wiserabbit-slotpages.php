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
require_once __DIR__ . '/frontend/options.php';

add_action('admin_enqueue_scripts', 'backend_style');
add_action('wp_enqueue_scripts', 'frontend_style_script');


function backend_style() {
    wp_enqueue_style('WRSP_back_style', plugins_url('assets/style/backend.css', __FILE__));    
}

function frontend_style_script() {
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css'); 
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);

    wp_enqueue_style('WRSP_front_style', plugins_url('assets/style/frontend.css', __FILE__));   
    wp_enqueue_script('WRSP_front_script', plugins_url('assets/script/options.js', __FILE__));
}





// Use it if you want to create 10 slots for testing
// require_once __DIR__ . '/OnlyForTest.php';



?>