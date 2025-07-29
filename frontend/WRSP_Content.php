<?php 

add_shortcode('WRSP', function() {

    ob_start();

    $args = array(
        'post_type' => 'slot',
        'posts_per_page' => 6,
        'paged' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1
    );

    $query = new WP_Query($args);

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