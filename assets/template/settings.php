<?php

    // get plugin settings
    $wrsp_settings = get_option('wrsp_plugin_settings', []);

    // Default values
    $font_family_url = isset($wrsp_settings['font_family_url']) ? esc_url($wrsp_settings['font_family_url']) : '';
    $font_family = isset($wrsp_settings['font_family']) ? esc_attr($wrsp_settings['font_family']) : '';
    $text_color = isset($wrsp_settings['text_color']) ? esc_attr($wrsp_settings['text_color']) : '#000000';
    $button_bg_color = isset($wrsp_settings['button_bg_color']) ? esc_attr($wrsp_settings['button_bg_color']) : '#007bff';
    $button_border_color = isset($wrsp_settings['button_border_color']) ? esc_attr($wrsp_settings['button_border_color']) : '#007bff';
    $button_text_color = isset($wrsp_settings['button_text_color']) ? esc_attr($wrsp_settings['button_text_color']) : '#ffffff';

    // Custom CSS and JS
    $custom_css = isset($wrsp_settings['custom_css']) ? esc_textarea($wrsp_settings['custom_css']) : '';
    $custom_js = isset($wrsp_settings['custom_js']) ? esc_textarea($wrsp_settings['custom_js']) : '';

    if($wrsp_settings['font_family_url'] != '') {
        // remove ' or " from string
        $font_family_url = $wrsp_settings['font_family_url'] = str_replace(['"', "'"], '', $wrsp_settings['font_family_url']);
    }

?>

<div class="wrap">

    <h1><?= __('Settings', 'WRSP') ?></h1>

    <div class="WRSP_EffectAccondion">

        <span class="tab active" id="tab_basic"><?= __('Basic Settings', 'WRSP') ?></span>
        <div class="panel basicSettings active">

            <form id="wrsp_settings_form">
                <h3><?= esc_html__('Font Settings', 'WRSP') ?></h3>
                <table class="form-table">


                    <tr>
                        <th scope="row"><label for="wrsp_font_family_url"><?= esc_html__('Font Family Link (google fonts)', 'WRSP') ?></label></th>
                        <td>
                            <input type="text" name="wrsp_font_family_url" id="wrsp_font_family_url" value="<?= $font_family_url ?>" class="regular-text" placeholder="e.g. 'https://fonts.googleapis.com/css?family=Open+Sans:400,700'">
                            <p class="description"><?= esc_html__('Enter the font family link (e.g., "https://fonts.googleapis.com/css?family=Open+Sans:400,700").', 'WRSP') ?></p>
                        </td>
                    </tr>


                    <tr>
                        <th scope="row"><label for="wrsp_font_family"><?= esc_html__('Font Family', 'WRSP') ?></label></th>
                        <td>
                            <input type="text" name="wrsp_font_family" id="wrsp_font_family" value="<?= $font_family ?>" class="regular-text" placeholder="e.g. 'Arial', sans-serif">
                            <p class="description"><?= esc_html__('Enter the desired font family (e.g., Arial, "Times New Roman", etc.).', 'WRSP') ?></p>
                        </td>
                    </tr>


                    <tr>
                        <th scope="row"><label for="wrsp_text_color"><?= esc_html__('Text Color', 'WRSP') ?></label></th>
                        <td>
                            <input type="color" name="wrsp_text_color" id="wrsp_text_color" value="<?= $text_color ?>" class="wrsp-color-picker">
                            <p class="description"><?= esc_html__('Choose the default text color.', 'WRSP') ?></p>
                        </td>
                    </tr>
                </table>

                <h3><?= esc_html__('Button Settings', 'WRSP') ?></h3>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="wrsp_button_bg_color"><?= esc_html__('Button Background Color', 'WRSP') ?></label></th>
                        <td>
                            <input type="color" name="wrsp_button_bg_color" id="wrsp_button_bg_color" value="<?= $button_bg_color ?>" class="wrsp-color-picker">
                            <p class="description"><?= esc_html__('Choose the background color for buttons.', 'WRSP') ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="wrsp_button_border_color"><?= esc_html__('Button Border Color', 'WRSP') ?></label></th>
                        <td>
                            <input type="color" name="wrsp_button_border_color" id="wrsp_button_border_color" value="<?= $button_border_color ?>" class="wrsp-color-picker">
                            <p class="description"><?= esc_html__('Choose the border color for buttons.', 'WRSP') ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="wrsp_button_text_color"><?= esc_html__('Button Text Color', 'WRSP') ?></label></th>
                        <td>
                            <input type="color" name="wrsp_button_text_color" id="wrsp_button_text_color" value="<?= $button_text_color ?>" class="wrsp-color-picker">
                            <p class="description"><?= esc_html__('Choose the text color for buttons.', 'WRSP') ?></p>
                        </td>
                    </tr>
                </table>
            </form>

        </div>

        <span class="tab" id="tab_advanced"><?= __('Advanced Settings', 'WRSP') ?></span>
        <div class="panel advancedSettings" style="display: none;">

            <form id="wrsp_advanced_settings_form">
                <h3><?= esc_html__('Custom CSS', 'WRSP') ?></h3>
                <p class="description"><?= esc_html__('Add your custom CSS here. This will be enqueued in the head of your website.', 'WRSP') ?></p>
                <textarea name="wrsp_custom_css" id="wrsp_custom_css" rows="10" class="large-text code"><?= $custom_css ?></textarea>

                <h3><?= esc_html__('Custom JavaScript', 'WRSP') ?></h3>
                <p class="description"><?= esc_html__('Add your custom JavaScript here. This will be enqueued in the footer of your website.', 'WRSP') ?></p>
                <textarea name="wrsp_custom_js" id="wrsp_custom_js" rows="10" class="large-text code"><?= $custom_js ?></textarea>
            </form>

        </div>
        
        <button class="button button-primary" id="WRSP_save_settings"><?= __('Save Settings', 'WRSP') ?></button>

    </div>

</div>