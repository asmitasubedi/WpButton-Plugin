<?php

//redirect users
function redirectUser(){
    ?>
    <script>
        window.location.assign("http://localhost/wordpress/wp-admin/admin.php?page=custom-buttons-list")
    </script>
    <?php
}

//add button
function custom_buttons_add(){
    global $wpdb;
    $button_ids=0;
    if(isset($_GET['btnids'])){
        $button_ids = $_GET['btnids'];
    }

    $table_name=button_tablename();
    if(isset($_GET['act']) && $_GET['act']=='addbtn'){
        $button_ids=custom_buttons_save();
        redirectUser();
    }
    if($button_ids!=0){
        $sql="SELECT * FROM $table_name WHERE id='$button_ids' LIMIT 1";
        $data['btn_results'] = $wpdb->get_row($sql);
    }
    $data['btnid']=(Object)array('button_id'=>$button_ids);
    buttons_add_view($data);
}

//save and update button
function custom_buttons_save(){
    global $wpdb;
    $table_name=button_tablename();
    $data=array(
        'btn_name'                        => ($_POST['btn_name']!='' ? $_POST['btn_name']:'Unnamed'),
        'btn_description'                 => ($_POST['btn_desc']!='' ? $_POST['btn_desc']:''),
        'btn_text'                        => ($_POST['btn_text']!='' ? $_POST['btn_text']:'New'),
        'btn_url'                         => $_POST['btn_url'],
        'btn_price'						  => ($_POST['btn_price']!='' ? $_POST['btn_price']:'Rs. 0')
    );
    if($_POST['button_id']!=0){
        $where = array('id'=>$_POST['button_id']);
        $wpdb->update($table_name, $data,$where);
        $button_id =$_POST['button_id'];
    }else{
        $wpdb->insert( $table_name, $data);
        $button_id = $wpdb->insert_id;
    }
    return $button_id;
}

//delete button
function custom_buttons_delete(){
    global $wpdb;
    $table_name=button_tablename();
    $delete_btn_data = $_GET['btn_delete'];
    $delete_btn_data = explode('_',$delete_btn_data);

    if(($delete_btn_data[0]=='delete')){
        $sql="DELETE FROM $table_name WHERE id='$delete_btn_data[1]'";
        $wpdb->query($sql);
    }
}

//custom button data id
function get_custombuttons_data($btnid){
    global $wpdb;
    $table_name=button_tablename();
    $sql = "SELECT * FROM $table_name WHERE id='$btnid' LIMIT 1";
    $result = $wpdb->get_row($sql);
    return $result;
}

//custom button output
function custombutton_shortcode($atts){
    global $wpdb;
    $btn_id = $atts['ids'];

    $btn_data = get_custombuttons_data($btn_id);
    isset($btn_data->btn_url)? $button_target_url = ($btn_data->btn_url) : $button_target_url = '';

    $output = '';
    $output .= '<a href="#tlBtn-openModal"><button type="button" class="custom-buttons" data-class="tlbtn_'.$btn_data->id.'" data-title="'.$btn_data->btn_name.'" data-request-url="'.$button_target_url.'" data-price="'.$btn_data->btn_price.'">'.$btn_data->btn_text.'</button></a>';

    return $output;
}
?>