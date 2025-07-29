document.addEventListener('DOMContentLoaded', function() {

    let tabs = document.querySelectorAll('.tab');
    const basicSettings = document.querySelector('.basicSettings');
    const advancedSettings = document.querySelector('.advancedSettings');
    const saveButton = document.getElementById('WRSP_save_settings');


    // color pickers
    if (typeof jQuery !== 'undefined') {
        jQuery(document).ready(function($) {
            $('.wrsp-color-picker').wpColorPicker();
        });
    }

    // accordion effect
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            if (tab.id === 'tab_basic') {
                basicSettings.style.display = 'block';
                advancedSettings.style.display = 'none';
            } else {
                basicSettings.style.display = 'none';
                advancedSettings.style.display = 'block';
            }
        });
    });


    // Save Settings functionality
    saveButton.addEventListener('click', () => {

        const formData = new FormData();
        formData.append('action', 'wrsp_save_plugin_settings');
        formData.append('_wpnonce', wrsp_vars.nonce);
        
        // Basic Settings
        formData.append('font_family_url', document.getElementById('wrsp_font_family_url').value);
        formData.append('font_family', document.getElementById('wrsp_font_family').value);
        formData.append('text_color', document.getElementById('wrsp_text_color').value);
        formData.append('button_bg_color', document.getElementById('wrsp_button_bg_color').value);
        formData.append('button_border_color', document.getElementById('wrsp_button_border_color').value);
        formData.append('button_text_color', document.getElementById('wrsp_button_text_color').value);

        // Advanced Settings
        formData.append('custom_css', document.getElementById('wrsp_custom_css').value);
        formData.append('custom_js', document.getElementById('wrsp_custom_js').value);

        // Enviar via Fetch API
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