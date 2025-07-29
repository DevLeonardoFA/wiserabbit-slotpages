<?php 

add_shortcode('WRSP', function() {


    $args = array(
        'post_type' => 'slot',
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);

    ob_start();

    ?>

    <div class="WRSP_grid">

        <select name="quantity_slots" id="WRSP_quantity_slots">
            <option value="1">6</option>
            <option value="1">9</option>
            <option value="1">12</option>            
        </select>

        <select name="order" id="WRSP_order">
            <option value="ASC">ASC</option>
            <option value="DESC">DESC</option>
            <option value="RAND">RAND</option>
        </select>

        <div id="WRSP_slots">
            <?php 
                if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
                    require_once dirname(__DIR__, 1) . '/assets/template/SlotCard.php';
                endwhile; endif; 
            ?>
        </div>

    </div>

    <?
    
    return ob_get_clean();

});