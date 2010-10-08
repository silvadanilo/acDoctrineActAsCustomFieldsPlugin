
var dynamic_extra_field_row = 0;

function addExtraFieldsRow(name)
{
  $('#ac_extra_field_ajax_loader_image').show();

  $.get(
    "/admin_dev.php/acDoctrineActAsExtraFields/dynamicAdd",
    'name='+name+'[defr_'+(dynamic_extra_field_row++)+']&type='+$('#ac_extra_fields_type').val(),
    function(data){
      $('#ac_extra_fields_widget').append(data);
      $('#ac_extra_field_ajax_loader_image').hide();
    }
  );
    
}