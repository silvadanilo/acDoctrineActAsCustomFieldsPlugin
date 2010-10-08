
var dynamic_custom_field_row = 0;

function addCustomFieldsRow(name)
{
  $('#ac_custom_field_ajax_loader_image').show();

  $.get(
    dynamicAddUrl,
    'name='+name+'[defr_'+(dynamic_custom_field_row++)+']&type='+$('#ac_custom_fields_type').val(),
    function(data){
      $('#ac_custom_fields_widget').append(data);
      $('#ac_custom_field_ajax_loader_image').hide();
    }
  );
    
}