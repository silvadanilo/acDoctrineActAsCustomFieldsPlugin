<?php

/**
 * CustomFields Widget.
 *
 * @package     acDoctrineActAsCustomFieldsPlugin
 * @subpackage  widget
 * @author      Danilo Silva <danilo@anycode.it>
 */
class acWidgetFormDoctrineCustomFields extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('acWidgetFormDoctrineCustomField', 'acWidgetFormDoctrineCustomField');
    $class = $this->getOption('acWidgetFormDoctrineCustomField');
    $this->addOption('types', call_user_func(array($class,"getTypes")));
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $to_return = '<div id="ac_custom_fields_widget"><p>';

    $type_widget = new sfWidgetFormSelect(array('choices' => $this->getOption('types')));
    $to_return .= $type_widget->render('ac_custom_fields_type', '', array());

    $to_return .= '
      <button onclick="addCustomFieldsRow(\''.$name.'\'); return false;">
        <img src="/sf/sf_admin/images/add.png" style="vertical-align:text-top;"/>&nbsp;Aggiungi
      </button>&nbsp;
      <img id="ac_custom_field_ajax_loader_image" src="/acDoctrineActAsCustomFieldsPlugin/images/ajax-loader.gif" style="display:none;" /></p>';

    $empty_value = array(
        ''=>array(
          'type'=>'',
          'value'=>''
        )
    );

    if(!$value)
    {
      $value = $empty_value;
    }

    $class = $this->getOption('acWidgetFormDoctrineCustomField');
    $i = 0;
    foreach($value as $key => $custom_field)
    {
      $acWidgetFormDoctrineCustomField = new $class();
      $to_return   .= $acWidgetFormDoctrineCustomField->render($name.'['.$i++.']', array_merge(array('label'=>$key),$custom_field), $attributes);
    }

    $to_return .= '</div><script type="text/javascript">var dynamicAddUrl = "'.url_for('acDoctrineActAsCustomFields/dynamicAdd').'";</script>';

    return $to_return;
  }

  public function getJavaScripts()
  {
    return array('/acDoctrineActAsCustomFieldsPlugin/js/acWidgetFormDoctrineCustomFields.js');
  }

  public function  getStylesheets() {
    return array('/acDoctrineActAsCustomFieldsPlugin/css/acWidgetFormDoctrineCustomFields.css'=>'screen');
  }
}

?>