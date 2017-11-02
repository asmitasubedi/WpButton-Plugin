<?php


function custom_buttons_list(){
global $wpdb;
$table_name= button_tablename();

if(isset($_GET['btn_delete'])){
	custom_buttons_delete();
	redirectUser();
}

$sql = "SELECT * FROM $table_name ORDER BY ts DESC";
$button_list = $wpdb->get_results($sql);

echo '<div class="wrap">';
echo '<h2>Button List</h2>';
echo '<a class="link-text" href="admin.php?page=custom-buttons-add"><div class="new-btn" >Add New</div></a>';
?>
 <table  id="myTable" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Button</th>
        <th>Button Name & Description</th>
		<th>Request URL</th>
		<th>Price</th>
        <th>Shortcode</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Button</th>
        <th>Button Name & Description</th>
		<th>Request URL</th>
		<th>Price</th>
        <th>Shortcode</th>
        <th>Actions</th>
      </tr>
    </tfoot>
    <tbody>
    <?php
      foreach ($button_list as $btnl){
        
        echo '<td>'.do_shortcode('[tlbtns ids="'.$btnl->id.'"]').'</td>';
        echo '<td><a href="admin.php?page=custom-buttons-add&btnids='.$btnl->id.'"><strong>'.$btnl->btn_name.'</strong></a><br />'.$btnl->btn_description.'</td>';
        echo '<td><a href='.$btnl->btn_url.'>'.$btnl->btn_url.'</a></td>';
		echo '<td>'.$btnl->btn_price.'</td>';
		echo '<td>[tlbtns ids="'.$btnl->id.'"]</td>';
        echo '<td><a href="admin.php?page=custom-buttons-add&btnids='.$btnl->id.'">Edit</a> | <a href="admin.php?page=custom-buttons-list&btn_delete=delete_'.$btnl->id.'" onclick="javascript:custom_buttons_delete()">Delete</a></td>';
        echo '</tr>';
      }
    ?>
    </tbody>
  </table>
  <?php
  echo '</div><!--wrap-->';
}
?>