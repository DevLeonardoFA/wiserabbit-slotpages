<?php

/**
 * 
 * * All initial settings for the plugin
 * 
 */

class WRSP {
    
    public function __construct() {
        
        // 1. CPT for Bundles
        add_action('init', [$this, 'WRSP_CPT']);

        // 2. Shortcode
        add_action('init', [$this, 'WRSP_shortcode']);


    }



    // WRSP CPT
    public function WRSP_CPT() {
        
        register_post_type(
            'slot', 
            [
                'label' => __('Slots', 'WRSP'),
                'public' => false,
                'show_ui' => true,
                'supports' => ['title', 'editor', 'thumbnail'],
                'menu_icon' => 'dashicons-analytics',
            ]
        );

    }



    // WRSP Shortcode
    public function WRSP_shortcode() {

        add_shortcode('WRSP', [$this, 'WRSP_Frontend']);

    }
    // WRSP Frontend
    public function WRSP_Frontend() {

        require_once dirname(__DIR__, 1) . '/frontend/WRSP_Content.php';
        do_action('WRSP_shortcode_content');

    }



}
new WRSP();

?>