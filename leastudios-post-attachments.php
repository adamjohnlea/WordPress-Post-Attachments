<?php
/*
 * Plugin Name: leaStudios Post Attachments
 * Plugin URI: https://adamjohnlea.com/plugins/post-attachments/
 * Description: Add files to a post and allow users to download them
 * Version: 1.0 alpha
 * Author: Adam John Lea
 * Author URI: https://adamjohnlea.com
 */

register_activation_hook( __FILE__, 'leastudios_activate' );
function leastudios_activate() {
    global $wpdb;
    $table_attachments = $wpdb->prefix . 'leastudios_post_attachments';
    $sql_attachments = "CREATE TABLE IF NOT EXISTS $table_attachments (
        id int(11) NOT NULL AUTO_INCREMENT,
        file_name varchar(255) NOT NULL,
        user_id int(11) NOT NULL,
        post_id int(11) NOT NULL,
        file_path longtext NOT NULL,
        updated_at datetime NOT NULL,
        uploaded_file_name varchar(255) NOT NULL,
        PRIMARY KEY (id)
    );";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql_attachments );
    $default_headers = array('Version' => 'Version');
    $plugin_data = get_file_data(__FILE__, $default_headers, 'plug-in');
    update_option( 'leastudios_version', $plugin_data['Version'] );
}