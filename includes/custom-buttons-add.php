<?php
function redirectUser(){
?>
	<script>
		window.location.assign("http://localhost/wordpress/wp-admin/admin.php?page=custom-buttons-list")
	</script>
<?php
}
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
  
function buttons_add_view($data){
  $buttonid = $data['btnid']->button_id;
  isset($data['btn_results'])? $btnobj = $data['btn_results']: $btnobj='';
    ?>

    <div class="wrap">
        <h2>Buttons Add/Edit</h2>
        <form name="buttons_form" id="buttons_form" method="post" action="admin.php?page=custom-buttons-add&act=addbtn" enctype="multipart/form-data">
          <input type="hidden" name="button_id" value="<?php echo $buttonid; ?>"/>
            <div class="stuffbox">
            <h3><label for="link_name">Quick Usage Instruction</label></h3>
            <div class="inside">
          	<p>Step 1: Enter a name and description for this button. </p>
          	<p>Step 2: Enter the button text and the target URL values.</p>
          	<p>Step 3: Save the details by clicking the "Save" button (see the button preview section). This will populate some default button CSS properties.</p>
          	<p>Step 4: Customize all the visual properties of the button then save it again.</p>
          	<p>Step 5: Use the appropriate shortcode to place this button on your site.</p>
          </div></div>
		  
		  <div class="stuffbox">
            <h3><label for="link_name">Basics</label></h3>
            <div class="inside">
              <table cellpadding="0">
                <tr>
                  <td class="tdlabel">Name</td>
                  <td>
                    <input type="text" name="btn_name" id="btn_name" value="<?php echo $btnobj->btn_name; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enter a name for this button</span>
                  </td>
                </tr>
                <tr>
                  <td class="tdlabel" valign="top">Description</td>
                  <td >
                    <textarea name="btn_desc" class="tdinputa"><?php echo $btnobj->btn_description; ?></textarea>
                    <span class="lblhlp" >Enter a description for this button</span>
                  </td>
              </table>
            </div>
          </div>
          <div class="stuffbox">
            <h3><label for="link_name">Button Content</label></h3>
            <div class="inside">
              <table cellpadding="0">
                <tr>
                  <td class="tdlabel">Button Text</td>
                  <td>
                    <input type="text" name="btn_text" id="btn_text" value="<?php echo $btnobj->btn_text; ?>" class="tdinputa" />
                    <span class="lblhlp" >Button text that will appear on the button</span>
                  </td>
                </tr>
                <tr>
                  <td class="tdlabel">Target URL</td>
                  <td>
                    <input type="text" name="btn_url" id="btn_url" value="<?php echo $btnobj->btn_url; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enter the URL where the button will be displayed on.</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Data Price</td>
                  <td>
                    <input type="text" name="btn_price" id="btn_price" value="<?php echo $btnobj->btn_price; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enter the price worth of the item for which the button is created.</span>
                  </td>
                </tr>
			   </table>
			</div>
		</div>
			<a class="button-primary" onclick="javascript:custom_buttons_save()">Save</a>
        </form>
    </div>
    <?php
}
?>