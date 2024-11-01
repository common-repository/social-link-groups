<?php 
if ( ! defined( 'ABSPATH' ) ) 
{
    exit;
}
global $wpdb;
$table_name = $wpdb->prefix . "aspl_asl_group_data";
$charset_collate = $wpdb->get_charset_collate();

if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {

    $sql = "CREATE TABLE $table_name (
            `id` mediumint(9) NOT NULL AUTO_INCREMENT,
            `title` text(200),
            `group_data` text NOT NULL,
            `shortcode` text NOT NULL,
            `sticky` text,
            PRIMARY KEY  (id)
    )$charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

 ?>