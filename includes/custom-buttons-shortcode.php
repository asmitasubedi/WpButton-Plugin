<?php
function get_custombuttons_data($btnid){
  global $wpdb;
  $table_name=button_tablename();
  $sql = "SELECT * FROM $table_name WHERE id='$btnid' LIMIT 1";
  $result = $wpdb->get_row($sql);
  return $result;
}
function custombutton_shortcode($atts){
  global $wpdb;
  $btn_id = $atts['ids'];
    
  $btn_data = get_custombuttons_data($btn_id);
  isset($btn_data->btn_url)? $button_target_url = ($btn_data->btn_url) : $button_target_url = '';
  
  $output = '';
  $output .= '<button type="button" class="custom-buttons" data-class="wpbtn_'.$btn_data->id.'" data-title="'.$btn_data->btn_name.'" data-request-url="'.$button_target_url.'" data-price="'.$btn_data->btn_price.'">'.$btn_data->btn_text.'</button>';
  
  return $output;
} 

if (!is_admin())
{add_filter('widget_text', 'do_shortcode');}
add_shortcode('custom_buttons', 'custombutton_shortcode');
