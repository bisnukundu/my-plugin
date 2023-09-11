<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die();
}

//After uninstall the plugin all database table will remove related with this plugin

global $wpdb, $table_prefix;
$table_name = $table_prefix . 'bisnu';
$wpdb->query( "DROP TABLE $table_name" );