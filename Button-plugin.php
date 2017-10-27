<?php
/*
Plugin Name: Custom Buy Now Buttons
Plugin URI:
Description: Custom Button Plugin for an additional buy now feature
Author: Asmita
Version: 1.0
Author URI: http://www.techlekh.com/
*/

include ('includes/custom-buttons-list.php');
include ('includes/custom-buttons-add.php');

add_action('admin_menu', 'register_custom_admin_page');

function register_custom_admin_page(){
    add_menu_page("Custom Buttons", "Custom Buttons", "add_users", __FILE__, "custom_buttons_list");
    add_submenu_page(__FILE__, 'Add Buttons', 'Add Buttons', 'add_users','custom-buttons-add', 'custom_buttons_add');
}

register_activation_hook(__FILE__,'custom_buttons_create_db');

function custom_buttons_create_db(){
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
    $table_name= button_tablename();
//	$table_name = $wpdb->prefix . 'custombuynow_buttons';
	
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id int(11) NOT NULL auto_increment,        
        btn_name varchar(100) default NULL,
        btn_description varchar(500) default NULL,
        btn_text varchar(100) default NULL,
        btn_url varchar(250) default NULL,
		btn_price varchar(100) default NULL,
		PRIMARY KEY  (id)
        )$charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function button_tablename(){
    global $table_prefix;
    $table_name = $table_prefix.'custombuynow_buttons';
    return $table_name;
}

?>