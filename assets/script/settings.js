jQuery(document).ready(function($) {

    'use strict';

    // let tabs = $('.WRSP_EffectAccondion .tab');
    const basicSettings = $('.basicSettings');
    const advancedSettings = $('.advancedSettings');
    const saveButton = $('#WRSP_save_settings');


    // color pickers
    if (typeof jQuery !== 'undefined') {
        jQuery(document).ready(function($) {
            $('.wrsp-color-picker').wpColorPicker();
        });
    }

    // accordion effect
    // $('.WRSP_EffectAccondion .tab').on('click', () => {

    //     console.log('clicked');
    //     console.log($(this));

    //     $(tabs).removeClass('active');
    //     $(this).addClass('active');

    //     if ($(this).attr('id') === 'tab_basic') {
    //         basicSettings.show();
    //         advancedSettings.hide();
    //     } else {
    //         basicSettings.hide();
    //         advancedSettings.show();
    //     }
    // });

    let tabs = document.querySelectorAll('.tab');

    // accordion effect
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {

            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            if (tab.id === 'tab_basic') {
                basicSettings.show();
                advancedSettings.hide();
            } else {
                basicSettings.hide();
                advancedSettings.show();
            }
        });
    });


    // Save Settings functionality
    saveButton.on('click', () => {

        const formData = new FormData();
        formData.append('action', 'wrsp_save_plugin_settings');
        formData.append('_wpnonce', wrsp_vars.nonce);
        
        // Basic Settings
        formData.append('font_family_url', $('#wrsp_font_family_url').val());
        formData.append('font_family', $('#wrsp_font_family').val());
        formData.append('text_color', $('#wrsp_text_color').val());
        formData.append('button_bg_color', $('#wrsp_button_bg_color').val());
        formData.append('button_border_color', $('#wrsp_button_border_color').val());
        formData.append('button_text_color', $('#wrsp_button_text_color').val());

        // Advanced Settings
        formData.append('custom_css', $('#wrsp_custom_css').val());
        formData.append('custom_js', $('#wrsp_custom_js').val());

        // Send the form data
        fetch(wrsp_vars.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(wrsp_vars.success_message);
            } else {
                alert(wrsp_vars.error_message + data.data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(wrsp_vars.general_error_message);
        });

    });



});

