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

add_action('admin_enqueue_scripts', 'WRSP_Backend_Style');
add_action('wp_enqueue_scripts', 'WRSP_Frontend_Style_Script');

add_filter('template_include', 'WRSP_Single_Slot');
add_action('admin_enqueue_scripts', 'WRSP_add_Color_Picker');
add_action('wp_ajax_wrsp_save_plugin_settings', 'WRSP_Save_Settings');
// make settings work
add_action('admin_enqueue_scripts', 'WRSP_Enqueue_Scripts');
add_action('wp_enqueue_scripts', function () {
    wp_add_inline_script( 'wrsp-settings-script', 'console.log("This is an inline script!");', 'after' );
});

add_action('wp_head', 'WRSP_Print_CSS_Directly'); 
add_action('wp_footer', 'WRSP_Print_JS_Directly'); 




function WRSP_Backend_Style() {
    wp_enqueue_style('WRSP_back_style', plugins_url('assets/style/backend.css', __FILE__));    
}
function WRSP_Frontend_Style_Script() {
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css'); 
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);

    wp_enqueue_style('WRSP_front_style', plugins_url('assets/style/frontend.css', __FILE__));   
    wp_enqueue_script('WRSP_front_script', plugins_url('assets/script/options.js', __FILE__));
}



// use our template
function WRSP_Single_Slot($template) {
    if (is_singular('slot')) {
        $single_slot_template = plugin_dir_path(__FILE__) . 'single-slot.php';

        if (file_exists($single_slot_template)) {
            return $single_slot_template;
        }
    }

    return $template;
}



// color picker
function WRSP_add_Color_Picker($hook_suffix) {
    // Apenas carregue o color picker na sua página de configurações
    if ('toplevel_page_your-plugin-slug' !== $hook_suffix) { // Substitua 'your-plugin-slug' pelo slug real da sua página
        return;
    }
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
}
function WRSP_Save_Settings() {

    check_ajax_referer('wrsp_save_settings_nonce', '_wpnonce'); 

    $settings_data = [];

    if (isset($_POST['font_family'])) {
        $settings_data['font_family'] = sanitize_text_field(wp_unslash($_POST['font_family']));
    }
    if (isset($_POST['text_color'])) {
        $settings_data['text_color'] = sanitize_hex_color(wp_unslash($_POST['text_color']));
    }
    if (isset($_POST['button_bg_color'])) {
        $settings_data['button_bg_color'] = sanitize_hex_color(wp_unslash($_POST['button_bg_color']));
    }
    if (isset($_POST['button_border_color'])) {
        $settings_data['button_border_color'] = sanitize_hex_color(wp_unslash($_POST['button_border_color']));
    }
    if (isset($_POST['button_text_color'])) {
        $settings_data['button_text_color'] = sanitize_hex_color(wp_unslash($_POST['button_text_color']));
    }

    // Custom CSS and JS
    if (isset($_POST['custom_css'])) {
        $settings_data['custom_css'] = wp_kses_post(wp_unslash($_POST['custom_css']));
    }
    if (isset($_POST['custom_js'])) {
        $settings_data['custom_js'] = wp_kses_post(wp_unslash($_POST['custom_js'])); 
    }

    update_option('wrsp_plugin_settings', $settings_data);

    wp_send_json_success('Settings saved!');
}
function WRSP_Apply_Custom_Styles_and_Scripts() {


    $wrsp_settings = get_option('wrsp_plugin_settings', []);
    
    $custom_css = '';
    if (!empty($wrsp_settings['font_family'])) {
        $custom_css .= ' .WRSP_grid * { font-family: ' . esc_attr($wrsp_settings['font_family']) . ' !important; }';
    }
    if (!empty($wrsp_settings['text_color'])) {
        $custom_css .= '.WRSP_grid span, .WRSP_grid p, .WRSP_grid h1, .WRSP_grid h2, .WRSP_grid h3, .WRSP_grid h4, .WRSP_grid h5, .WRSP_grid h6,
        #post-single-slot span ,#post-single-slot p, #post-single-slot h1, #post-single-slot h2, #post-single-slot h3, #post-single-slot h4, #post-single-slot h5, #post-single-slot h6{ color: ' . esc_attr($wrsp_settings['text_color']) . ' !important;  }';
    }
    if (!empty($wrsp_settings['button_bg_color'])) {
        $custom_css .= ' .WRSP_grid .button, .WRSP_grid .button { background-color: ' . esc_attr($wrsp_settings['button_bg_color']) . ' !important; }';
    }
    if (!empty($wrsp_settings['button_border_color'])) {
        $custom_css .= ' .WRSP_grid .button, .WRSP_grid .button { border-color: ' . esc_attr($wrsp_settings['button_border_color']) . ' !important; }';
    }
    if (!empty($wrsp_settings['button_text_color'])) {
        $custom_css .= ' .WRSP_grid .button, .WRSP_grid .button { color: ' . esc_attr($wrsp_settings['button_text_color']) . ' !important; }';
    }
    if (!empty($wrsp_settings['custom_css'])) {
        $custom_css .= wp_kses_post($wrsp_settings['custom_css']);
    }

    wp_add_inline_script( 'wrsp-settings-script', 'console.log("This is an inline script!");', 'after' );


}

function WRSP_Print_CSS_Directly() {
    
    $wrsp_settings = get_option('wrsp_plugin_settings', []);

    if (!empty($wrsp_settings['custom_css'])) {
        echo '<style type="text/css" id="wrsp-custom-styles">' . wp_kses_post($wrsp_settings['custom_css']) . '</style>';
    }

}


function WRSP_Print_JS_Directly(){

    $wrsp_settings = get_option('wrsp_plugin_settings', []);

    if (!empty($wrsp_settings['custom_js'])) {
        echo '<script type="text/javascript" id="wrsp-custom-scripts">' . wp_kses_post($wrsp_settings['custom_js']) . '</script>';
    }

}


function WRSP_Enqueue_Scripts() {

    $args = array(
        'ajaxurl'             => admin_url('admin-ajax.php'),
        'nonce'               => wp_create_nonce('wrsp_save_settings_nonce'),
        'success_message'     => esc_html__('Settings saved successfully!', 'WRSP'),
        'error_message'       => esc_html__('Error saving settings: ', 'WRSP'),
        'general_error_message' => esc_html__('An error occurred during save.', 'WRSP'),
    );
    
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    
    wp_register_script( 'wrsp-settings-script', plugins_url('/assets/script/settings.js', __FILE__));
    wp_localize_script( 'wrsp-settings-script', 'wrsp_vars', $args);
    wp_enqueue_script( 'wrsp-settings-script', plugins_url('/assets/script/settings.js', __FILE__),  array('jquery', 'wp-color-picker'), '1.0', true);

}
    



// Use it if you want to create 10 slots for testing
// require_once __DIR__ . '/OnlyForTest.php';



?>