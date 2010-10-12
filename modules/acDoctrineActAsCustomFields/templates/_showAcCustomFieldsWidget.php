<?php use_javascript('/acDoctrineActAsCustomFieldsPlugin/js/acWidgetFormDoctrineCustomFields.js'); ?>
<?php use_stylesheet('/acDoctrineActAsCustomFieldsPlugin/css/acWidgetFormDoctrineCustomFields.css'); ?>

<div id="ac_custom_fields_widget">
  <p>
    <?php echo $widget_type->getRawValue()->render('ac_custom_fields_type_'.$form['custom_fields']->renderId()); ?>
    <button onclick="addCustomFieldsRow('<?php echo $form['custom_fields']->renderName('custom_fields'); ?>','<?php echo $form['custom_fields']->renderId(); ?>'); return false;">
      <img src="/sf/sf_admin/images/add.png" style="vertical-align:text-top;"/>&nbsp;Aggiungi
    </button>&nbsp;
    <img id="ac_custom_field_ajax_loader_image" src="/acDoctrineActAsCustomFieldsPlugin/images/ajax-loader.gif" style="display:none;" />
  </p>
  <table id="table_<?php echo $form['custom_fields']->renderId(); ?>">
    <thead>
      <tr>
        <th>Name</th>
        <th>Tipo</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $form['custom_fields']; ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">var dynamicAddUrl="<?php echo url_for('acDoctrineActAsCustomFields/dynamicAdd'); ?>" </script>