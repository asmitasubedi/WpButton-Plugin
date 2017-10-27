<?php
function custom_buttons_delete(){
  echo 'hii';
  global $wpdb;
  $table_name=button_tablename();
  $delete_btn_data = $_GET['btn_delete'];
  $delete_btn_data = explode('_',$wpbtn_get_data);
  echo $delete_btn_data[0];
  echo $delete_btn_data[1];
  /*if(($delete_btn_data[0]=='delete')){
    $sql="DELETE FROM $table_name WHERE id='$delete_btn_data[1]'";
    $wpdb->query($sql);
  }*/
	//$where = array('id'=>$_GET['btn_delete']);
	//$wpdb->delete($table_name,$where);
}

function custom_buttons_list(){
echo 'Buttons List Function';
global $wpdb;
$table_name= button_tablename();

if(isset($_GET['btn_delete'])){
	//$delete_btn_id = $_GET['btn_delete'];
    custom_buttons_delete();
}

$sql = "SELECT * FROM $table_name";
$button_list = $wpdb->get_results($sql);

echo '<div class="wrap">';
echo '<h2>Button List<a class="add-new-h2" href="admin.php?page=custom-buttons-add">Add New</a></h2>';
?>
 <table class="wp-list-table widefat fixed bookmarks" cellspacing="0">
    <thead>
      <tr>
        <th>Button</th>
        <th>Button Name & Description</th>
		<th>Request URL</th>
		<th>Price</th>
        <th>Shortcode</th>
        <th></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Button</th>
        <th>Button Name & Description</th>
		<th>Request URL</th>
		<th>Price</th>
        <th>Shortcode</th>
        <th></th>
      </tr>
    </tfoot>
    <tbody>
    <?php
      foreach ($button_list as $btnl){
        echo '<tr class="alternate">';
        echo '<td>'.do_shortcode('[buttons ids="'.$btnl->id.'"]').'</td>';
        echo '<td><a href="admin.php?page=custom-buttons-add&btnids='.$btnl->id.'"><strong>'.$btnl->btn_name.'</strong></a><br />'.$btnl->btn_description.'</td>';
        echo '<td><a href='.$btnl->btn_url.'>'.$btnl->btn_url.'</a></td>';
		echo '<td>'.$btnl->btn_price.'</td>';
		echo '<td>[buttons ids="'.$btnl->id.'"]</td>';
        echo '<td><a href="admin.php?page=custom-buttons-add&btnids='.$btnl->id.'">Edit</a> | <a href="admin.php?page=custom-buttons-list&btn_delete=delete_'.$btnl->id.'">Delete</a></td>';
        echo '</tr>';
      }
    ?>
    </tbody>
  </table>
  <?php
  echo '</div>';
   
   
}
?>