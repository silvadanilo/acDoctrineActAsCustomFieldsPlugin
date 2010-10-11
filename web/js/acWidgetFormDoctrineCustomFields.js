
var dynamic_custom_field_row = 0;

function addCustomFieldsRow(name,id)
{
  $('#ac_custom_field_ajax_loader_image').show();

  $.get(
    dynamicAddUrl,
    'name='+name+'[defr_'+(dynamic_custom_field_row++)+']&type='+$('#ac_custom_fields_type_'+id).val(),
    function(data){
      $('#table_'+id+'>tbody').append(data);
      $('#ac_custom_field_ajax_loader_image').hide();
    }
  );
    
}