<?php


function OnlyForTest() {
    // create 10 posts for slots
    for ($i = 0; $i < 10; $i++) {
        $post_data = [
            'post_type'    => 'slot',
            'post_title'   => 'Slot ' . $i,
            'post_content' => 'lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet',
            'post_status'  => 'publish',
            'post_author'  => 1,
        ];

        // Inserir o post e obter o ID
        $post_id = wp_insert_post($post_data);

        // Se o post foi criado com sucesso
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, 'WRSP_rating', rand(1, 5));
            update_post_meta($post_id, 'WRSP_provider', 'Provider ' . $i);
            update_post_meta($post_id, 'WRSP_RTP', rand(0, 100));
            update_post_meta($post_id, 'WRSP_MinimumWager', rand(0, 100));
            update_post_meta($post_id, 'WRSP_MaximumWager', rand(0, 100));
        }
    }

}

add_action('admin_menu', 'OnlyForTest');




?>