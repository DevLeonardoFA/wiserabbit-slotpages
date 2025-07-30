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

        // 2. Taxonomies for Providers
        add_action('init', [$this, 'WRSP_taxonomies']);

        // 4. Metabox
        add_action('add_meta_boxes', [$this, 'WRSP_metabox']);

        // 5. Save Metabox
        add_action('save_post_slot', [$this, 'WRSP_metabox_save']);

        // 6. Add New Sub Menu
        add_action('admin_menu', [$this, 'WRSP_add_settings_page']);
        add_action('admin_menu', [$this, 'WRSP_add_introductions']);


    }



    // WRSP CPT
    public function WRSP_CPT() {
        
        register_post_type(
            'slot', 
            [
                'label' => __('Slots', 'WRSP'),
                'public' => true,
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
                'taxonomies' => ['provider'],
                
            ],
        );

    }
    // WRSP CPT Providers
    public function WRSP_taxonomies() {
        
        register_taxonomy(
            'provider', 
            'slot', 
            [
                'labels' => [
                    'name' => __('Providers', 'WRSP'),
                    'singular_name' => __('Provider', 'WRSP'),
                    'search_items' => __('Search Providers', 'WRSP'),
                    'popular_items' => __('Popular Providers', 'WRSP'),
                    'all_items' => __('All Providers', 'WRSP'),
                    'edit_item' => __('Edit Provider', 'WRSP'),
                    'update_item' => __('Update Provider', 'WRSP'),
                    'add_new_item' => __('Add New Provider', 'WRSP'),
                    'new_item_name' => __('New Provider Name', 'WRSP'),
                    'separate_items_with_commas' => __('Separate providers with commas', 'WRSP'),
                    'add_or_remove_items' => __('Add or remove providers', 'WRSP'),
                    'choose_from_most_used' => __('Choose from the most used providers', 'WRSP'),
                ],
                'public' => false,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_rest' => true,
                'query_var' => true,
                'hierarchical' => true,
            ],
        );

    }





    // Metabox
    public function WRSP_metabox() {
        
        add_meta_box(
            'WRSP_metabox', 
            __('Slot Information', 'WRSP'),
            [$this, 'WRSP_metabox_content'], 
            'slot', 
            'side',
        );

    }
    // Render Metabox
    public function WRSP_metabox_content($post) {

        ?>

        <div class="WRSP_Metabox">

            <div class="d-block">
                <label for="WRSP_rating" class="star_rating"><?= __('Star Rating', 'WRSP') ?></label>
                <select name="WRSP_rating" id="WRSP_rating">
                    <?php for($i = 1; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php selected(get_post_meta($post->ID, 'WRSP_rating', true), $i); ?> ><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- <div class="d-block">    
                <label for="WRSP_provider" class="provider_name"><?php // __('Provider Name', 'WRSP') ?></label>
                <input type="text" name="WRSP_provider" id="WRSP_provider" value="<?php // echo get_post_meta($post->ID, 'WRSP_provider', true); ?>">
            </div> -->

            <div class="d-block">    
                <label for="WRSP_RTP" class="RTP"><?= __('Return to Player Percentage ( % )', 'WRSP') ?></label>
                <input type="number" name="WRSP_RTP" id="WRSP_RTP" min="0" max="100" value="<?php echo get_post_meta($post->ID, 'WRSP_RTP', true); ?>">
            </div>

            <div class="d-block">    
                <label for="WRSP_MinMaxWager" class="MinMaxWager"><?= __('Minimum/Maximum Wager', 'WRSP') ?></label>
                <div class="minmax">
                    <input type="number" name="WRSP_MinimumWager" id="WRSP_MinMaxWager" class="WRSP_MinimumWager" value="<?php echo get_post_meta($post->ID, 'WRSP_MinimumWager', true); ?>" placeholder="Minimum Wager">
                    <input type="number" name="WRSP_MaximumWager" id="WRSP_MinMaxWager" class="WRSP_MaximumWager" value="<?php echo get_post_meta($post->ID, 'WRSP_MaximumWager', true); ?>" placeholder="Minimum Wager">
                </div>
            </div>
    
        </div>

        <?php

    }
    // Save Metabox
    public function WRSP_metabox_save($post_id) {
        
        if (isset($_POST['WRSP_rating'])) {
            update_post_meta($post_id, 'WRSP_rating', $_POST['WRSP_rating']);
        }
        // if (isset($_POST['WRSP_provider'])) {
        //     update_post_meta($post_id, 'WRSP_provider', $_POST['WRSP_provider']);
        // }
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

    

    // Add a new sub menu for settings
    public function WRSP_add_settings_page() {

        add_submenu_page(
            'edit.php?post_type=slot',
            __('Slot Settings', 'WRSP'),
            __('Slot Settings', 'WRSP'),
            'manage_options',
            'WRSP_settings',
            [$this, 'WRSP_settings_page']
        );
        

    }
    // Render settings page
    public function WRSP_settings_page() {

        require dirname(__DIR__, 1) . '/assets/template/settings.php';

    }



    // Add a new sub menu for Introductions
    public function WRSP_add_introductions() {
        add_submenu_page(
            'edit.php?post_type=slot',
            __('Introductions', 'WRSP'),
            __('Introductions', 'WRSP'),
            'manage_options',
            'WRSP_introductions',
            [$this, 'WRSP_introductions_page']
        );
    }
    // Render introductions page
    public function WRSP_introductions_page() {

        require dirname(__DIR__, 1) . '/assets/template/introductions.php';

    }
    



}
new WRSP();

?>