<?php

// Only for test

// Using API
// function OnlyForTest() {

//     $data = curl_init('https://my-json-server.typicode.com/DevLeonardoFA/json-server/sluts');

//     curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($data, CURLOPT_SSL_VERIFYHOST, false);
//     curl_setopt($data, CURLOPT_SSL_VERIFYPEER, false);

//     $response = curl_exec($data);

//     if ($response) {

//         $data = json_decode($response, true);

//         foreach ($data as $key => $value) {

//             $post_data = [
//                 'post_type'    => 'slot',
//                 'post_title'   => $data[$key]['title'],
//                 'post_content' => 'lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet',
//                 'post_status'  => 'publish',
//                 'post_author'  => 1,
//             ];

//             $post_id = wp_insert_post($post_data);

//             if ($post_id && !is_wp_error($post_id)) {
//                 update_post_meta($post_id, 'WRSP_rating', $data[$key]['WRSP_rating']);
//                 update_post_meta($post_id, 'WRSP_RTP', $data[$key]['WRSP_RTP']);
//                 update_post_meta($post_id, 'WRSP_MinimumWager', $data[$key]['WRSP_MinimumWager']);
//                 update_post_meta($post_id, 'WRSP_MaximumWager', $data[$key]['WRSP_MaximumWager']);
//             }

//         }
//     }

// }
// add_action('admin_menu', 'OnlyForTest');


?>