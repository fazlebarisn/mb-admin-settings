<?php
/**
 * Plugin Name:       MB Admin Settings
 * Description:       All admin settings
 * Requires at least: 6.4.2
 * Requires PHP:      7.0
 * Version:           1.0.0
 * Author:            Cansoft
 * Author URI:		  https://www.cansoft.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mb-admin-settings
 */
defined('ABSPATH') or die('Nice Try!');

// theme-general-settings
// edit.php?post_type=product

/**
 * add submenu
 */
function mb_admin_submenu_page() {

    add_submenu_page(
        'theme-general-settings',
        'Admin Settings',
        'Admin Settings',
        'manage_options',
        'mb-admin-settings-page',
        'mb_admin_submenu_page_callback',
    );

}
add_action('admin_menu', 'mb_admin_submenu_page', 999);

// Callback function for submenu page
function mb_admin_submenu_page_callback() {
    ?>
    <div class="wrap">
        <h2>Admin Settings</h2>
        <form method="post" action="options.php">
            <?php
            // Output your form fields here
            settings_fields('mb_admin_settings');
            do_settings_sections('mb_email_section');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Add textarea input field
function mb_admin_settings() {
    add_settings_section(
        'mb_admin_settings_section',
        'Email Settings',
        'mb_admin_settings_section_callback',
        'mb_email_section'
    );

    add_settings_field(
        'mb_template_field',
        'Template Type',
        'mb_template_field_callback',
        'mb_email_section',
        'mb_admin_settings_section'
    );

    add_settings_field(
        'mb_email_body_field',
        'Email Body',
        'mb_email_body_field_callback',
        'mb_email_section',
        'mb_admin_settings_section'
    );

    register_setting('mb_admin_settings', 'mb_email_body_field');
}
add_action('admin_init', 'mb_admin_settings');

// Section callback function
function mb_admin_settings_section_callback() {
    echo "Welcome to our Email Template Management section! This feature empowers you to streamline your communication by providing a centralized hub for creating, managing, and registering email templates. Whether you're crafting personalized messages or ensuring brand consistency, this section has you covered.";
}

// Template callback function
function mb_template_field_callback() {
    ?>
        <div style="margin-bottom: 10px;">
            <a href="#" target="_blank">
                <button class="button" type="button">Template</button>
            </a>
            <a href="#" target="_blank">
                <button class="button" type="button">Approved Template</button>
            </a>
        </div>
    <?php
}

// Textarea field callback function
function mb_email_body_field_callback() {
    $value = get_option('mb_email_body_field');
    $editor_id = 'mb_admin_settings_editor';
    wp_editor($value, $editor_id, array('textarea_name' => 'mb_email_body_field'));
}







