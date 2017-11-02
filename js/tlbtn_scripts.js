function custom_buttons_save(){
  var btn_name = $('#btn_name').val();
  var btn_text = $('#btn_text').val();
  var btn_price = $('#btn_price').val();
  if(btn_name==''){
	  alert('Please enter the Button Name');
	  $('#btn_name').focus();
	}
  else if(btn_text==''){
	  alert('Please enter the Button Text');
	  $('#btn_text').focus();
  }
  else if(btn_price==''){
	  alert('Please enter the Price');
	  $('#btn_price').focus();
  }
  else{
	  $('#buttons_form').submit();
  }
}

$(document).ready(function(){
    $('#myTable').DataTable();
});