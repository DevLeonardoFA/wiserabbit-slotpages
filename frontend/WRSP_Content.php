<?php 

add_shortcode('WRSP', function() {

    ob_start();

    $args = array(
        'post_type' => 'slot',
        'posts_per_page' => 6,
        'paged' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1
    );

    $query = new WP_Query($args);


    $wrsp_settings = get_option('wrsp_plugin_settings', []);
    
    $custom_css = '';

    if (!empty($wrsp_settings['font_family_url'])) {

        // remove ' or " from string
        $wrsp_settings['font_family_url'] = str_replace(['"', "'"], '', $wrsp_settings['font_family_url']);

        $custom_css .= '@import url(' . esc_url($wrsp_settings['font_family_url']) . ');';
    }
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

    echo '<style>' . $custom_css . '</style>';

    ?>

    <div class="WRSP_grid">

        <select name="quantity_slots" id="WRSP_quantity_slots">
            <option value="6">6</option>
            <option value="9">9</option>
            <option value="12">12</option>            
        </select>

        <select name="order" id="WRSP_order">
            <option value="desc">Descending</option>
            <option value="asc">Ascending </option>
            <option value="rand">Random</option>
        </select>

        <div id="WRSP_slots">
            <?php 

                if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
                
                    require dirname(__DIR__, 1) . '/assets/template/SlotCard.php';

                endwhile; 
                wp_reset_postdata();
                
                else :
                    echo 'No posts found.';
                endif;
            ?>
        </div>

        <div class="loadmore">
            <button id="WRSP_loadmore" class="button">Load More</button>
        </div>

    </div>

    <?
    
    return ob_get_clean();

});