<?php 

function WRSP_Frontend() {

    $args = array(
        'post_type' => 'slot',
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo get_the_content();
        }
    }

}

add_action('WRSP_shortcode_content', 'WRSP_Frontend');