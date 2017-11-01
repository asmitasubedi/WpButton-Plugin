<?php
/*
Plugin Name: Custom Buy Now Buttons
Plugin URI:
Description: Custom Button Plugin for an additional buy now feature
Author: Asmita
Version: 1.0
Author URI: http://www.techlekh.com/
*/

define('CUSTOM_BUTTON_CREATOR_VERSION', '1.0');
define('CUSTOM_BUTTON_CREATOR_URL', plugins_url('',__FILE__));
define('CUSTOM_BUTTON_CREATOR_PATH',plugin_dir_path( __FILE__ ));

include ('includes/custom-buttons-list.php');
include ('includes/custom-buttons-add.php');
include ('includes/custom-buttons-shortcode.php');

function custombuttons_admin_register_head(){
	echo '<script src="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"></script>';
}

function custombuttons_admin_load_js(){
	$jsurl = CUSTOM_BUTTON_CREATOR_URL.'/js/custom-buttons.js';
	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';
	echo '<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>';
	echo '<script src="'.$jsurl.'"></script>';
}

add_action('admin_head', 'custombuttons_admin_register_head');
add_action('admin_footer','custombuttons_admin_load_js');

add_action('admin_menu', 'register_custom_admin_page');

function register_custom_admin_page(){
    add_menu_page("Custom Buttons", "Custom Buttons", "add_users", __FILE__, "custom_buttons_list");
	add_submenu_page(__FILE__, "Manage Buttons", "Manage Buttons", "add_users", "custom-buttons-list", "custom_buttons_list");
    add_submenu_page(__FILE__, "Add Buttons", "Add Buttons", "add_users","custom-buttons-add", "custom_buttons_add");
}

register_activation_hook(__FILE__,'custom_buttons_create_db');

function custom_buttons_create_db(){
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
    $table_name= button_tablename();
	
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id int(11) NOT NULL auto_increment,        
        btn_name varchar(100) default NULL,
        btn_description varchar(500) default NULL,
        btn_text varchar(100) default NULL,
        btn_url varchar(250) default NULL,
		btn_price varchar(100) default NULL,
		ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ON UPDATE CURRENT_TIMESTAMP,
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