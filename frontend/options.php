<?php

add_action('wp_enqueue_scripts', function (){

    $args = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('WRSP_nonce')
    );

    wp_register_script('WRSP_front_script', plugins_url('../assets/script/options.js', __FILE__));
    wp_localize_script('WRSP_front_script', 'WRSP', $args);
    wp_enqueue_script('WRSP_front_script', plugins_url('../assets/script/options.js', __FILE__), array('jquery'), '1.0', true);
    
});

function WRSP_Options() {

    check_ajax_referer('WRSP_nonce', 'nonce');


    ob_start();

    $quantity_slots = $_POST['quantity_slots'];
    $order = $_POST['order'];

    $args = array(
        'post_type' => 'slot',
        'posts_per_page' => $quantity_slots,
        'order' => $order,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

        require dirname(__DIR__, 1) . '/assets/template/SlotCard.php';

    endwhile; endif; 

    wp_reset_postdata();

    echo ob_get_clean();

    wp_die();

}
add_action('wp_ajax_WRSP_Options', 'WRSP_Options');
add_action('wp_ajax_nopriv_WRSP_Options', 'WRSP_Options');


function WRSP_LoadMore() {
    
    check_ajax_referer('WRSP_nonce', 'nonce');

    ob_start();

    $ids = $_POST['ids'];
    $order = $_POST['order'];
    $quantity_slots = $_POST['quantity_slots'];

    $args = array(
        'post_type' => 'slot',
        'posts_per_page' => $quantity_slots,
        'post__not_in' => $ids,
        'orderby' => $order,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

        require dirname(__DIR__, 1) . '/assets/template/SlotCard.php';

    endwhile; 
    else:
        echo 'No more posts';
    
    endif;

    wp_reset_postdata();

    echo ob_get_clean();

    wp_die();

}
add_action('wp_ajax_WRSP_LoadMore', 'WRSP_LoadMore');
add_action('wp_ajax_nopriv_WRSP_LoadMore', 'WRSP_LoadMore');






?>