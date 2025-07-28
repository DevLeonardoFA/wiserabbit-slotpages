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

        // 3. Metabox
        add_action('add_meta_boxes', [$this, 'WRSP_metabox']);

        // 4. Save Metabox
        add_action('save_post_slot', [$this, 'WRSP_metabox_save']);

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
                'labels' => [
                    'name' => __('Slots', 'WRSP'),
                    'singular_name' => __('Slot', 'WRSP'),
                    'add_new' => __('Add New Slot', 'WRSP'),
                    'add_new_item' => __('Add New Slot', 'WRSP'),
                    'edit_item' => __('Edit Slot', 'WRSP'),
                    'new_item' => __('New Slot', 'WRSP'),
                    'view_item' => __('View Slot', 'WRSP'),
                    'search_items' => __('Search Slots', 'WRSP'),
                    'not_found' => __('No Slots found', 'WRSP'),
                    'not_found_in_trash' => __('No Slots found in Trash', 'WRSP'),
                ],
            ],
        );

    }



    // Metabox
    public function WRSP_metabox() {
        
        add_meta_box(
            'WRSP_metabox', 
            'Slot Information', 
            [$this, 'WRSP_metabox_content'], 
            'slot', 
            'side',
        );

    }
    // Render Metabox
    public function WRSP_metabox_content($post) {

        ?>

        <div class="WRSP_Metabox">

            <label for="WRSP_rating" class="stat_rating">Stat Rating</label>
            <select name="WRSP_rating" id="WRSP_rating">
                <?php for($i = 1; $i <= 5; $i++) { ?>
                    <option value="<?php echo $i; ?>" <?php selected(get_post_meta($post->ID, 'WRSP_rating', true), $i); ?> ><?php echo $i; ?></option>
                <?php } ?>
            </select>


            <label for="WRSP_provider" class="provider_name">Provider Name</label>
            <input type="text" name="WRSP_provider" id="WRSP_provider" value="<?php echo get_post_meta($post->ID, 'WRSP_provider', true); ?>">


            <label for="WRSP_RTP" class="RTP">Return to Player Percentage</label>
            <input type="number" name="WRSP_RTP" id="WRSP_RTP" min="0" max="100" value="<?php echo get_post_meta($post->ID, 'WRSP_RTP', true); ?>">

            
            <label for="WRSP_MinMaxWager" class="MinMaxWager">Minimum/Maximum Wager</label>
            <input type="number" name="WRSP_MinimumWager" id="WRSP_MinMaxWager" value="<?php echo get_post_meta($post->ID, 'WRSP_MinimumWager', true); ?>">
            <input type="number" name="WRSP_MaximumWager" id="WRSP_MinMaxWager" value="<?php echo get_post_meta($post->ID, 'WRSP_MaximumWager', true); ?>">
    
        </div>

        <?php

    }
    // Save Metabox
    public function WRSP_metabox_save($post_id) {
        
        if (isset($_POST['WRSP_rating'])) {
            update_post_meta($post_id, 'WRSP_rating', $_POST['WRSP_rating']);
        }
        if (isset($_POST['WRSP_provider'])) {
            update_post_meta($post_id, 'WRSP_provider', $_POST['WRSP_provider']);
        }
        if (isset($_POST['WRSP_RTP'])) {
            update_post_meta($post_id, 'WRSP_RTP', $_POST['WRSP_RTP']);
        }
        if (isset($_POST['WRSP_MinimumWager'])) {
            update_post_meta($post_id, 'WRSP_MinimumWager', $_POST['WRSP_MinimumWager']);
        }
        if (isset($_POST['WRSP_MaximumWager'])) {
            update_post_meta($post_id, 'WRSP_MaximumWager', $_POST['WRSP_MaximumWager']);
        }

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