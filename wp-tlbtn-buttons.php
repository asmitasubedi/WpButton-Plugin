<?php
/*
Plugin Name: TechLekh Custom Buttons
Plugin URI:
Description: Custom Button Plugin
Author: Asmita Subdedi
Version: 1.0
Author URI: http://www.techlekh.com/
*/

define('CUSTOM_BUTTON_CREATOR_VERSION', '1.0');
define('CUSTOM_BUTTON_CREATOR_URL', plugins_url('',__FILE__));
define('CUSTOM_BUTTON_CREATOR_PATH',plugin_dir_path( __FILE__ ));

include 'includes/tlbtn_include.php';

function custombuttons_admin_register_head(){
	$cssurl = CUSTOM_BUTTON_CREATOR_URL.'/css/tlbtn_styles.css';
	echo '<link rel=\'stylesheet\' href="'.$cssurl.'" type=\'text/css\' media=\'all\' />';

	echo '<link rel=\'stylesheet\' href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>';
}

function custombuttons_admin_load_js(){
	$jsurl = CUSTOM_BUTTON_CREATOR_URL.'/js/tlbtn_scripts.js';

	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';
	echo '<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>';
	echo '<script src="'.$jsurl.'"></script>';
}

//load assets
add_action('admin_head', 'custombuttons_admin_register_head');
add_action('admin_enqueue_scripts','custombuttons_admin_load_js');

//add admin panel
add_action('admin_menu', 'register_custom_admin_page');

//create menus in admin panel
function register_custom_admin_page(){
    add_menu_page("TL Buttons", "TL Buttons", "add_users", __FILE__, "custom_buttons_list", plugins_url('wp-tlbtn-buttons/images/icon.png'));
	add_submenu_page(__FILE__, "Manage Buttons", "Manage Buttons", "add_users", "custom-buttons-list", "custom_buttons_list");
    add_submenu_page(__FILE__, "Add Buttons", "Add Buttons", "add_users","custom-buttons-add", "custom_buttons_add");
}

//create database on activate
register_activation_hook(__FILE__,'tlbtn_custom_buttons_db');

//create database function
function tlbtn_custom_buttons_db(){
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

//table name only
function button_tablename(){
    global $table_prefix;
    $table_name = $table_prefix.'tlbtn_buttons';
    return $table_name;
}
?>