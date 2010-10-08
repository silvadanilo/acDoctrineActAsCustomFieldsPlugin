<?php

class acWidgetFormDoctrineExtraFields extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('acWidgetFormDoctrineExtraField', 'acWidgetFormDoctrineExtraField');
    $class = $this->getOption('acWidgetFormDoctrineExtraField');
    $this->addOption('types', call_user_func(array($class,"getTypes")));
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $to_return = '<div id="ac_extra_fields_widget"><p>';

    $type_widget = new sfWidgetFormSelect(array('choices' => $this->getOption('types')));
    $to_return .= $type_widget->render('ac_extra_fields_type', '', array());

    $to_return .= '
      <button onclick="addExtraFieldsRow(\''.$name.'\'); return false;">
        <img src="/sf/sf_admin/images/add.png" style="vertical-align:text-top;"/>&nbsp;Aggiungi
      </button>&nbsp;
      <img id="ac_extra_field_ajax_loader_image" src="/acDoctrineActAsExtraFieldsPlugin/images/ajax-loader.gif" style="display:none;" /></p>';

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

    $class = $this->getOption('acWidgetFormDoctrineExtraField');
    $i = 0;
    foreach($value as $key => $extra_field)
    {
      $acWidgetFormDoctrineExtraField = new $class();
      $to_return   .= $acWidgetFormDoctrineExtraField->render($name.'['.$i++.']', array_merge(array('label'=>$key),$extra_field), $attributes);
    }

    $to_return .= '</div>';

    return $to_return;
  }

  public function getJavaScripts()
  {
    return array('/acDoctrineActAsExtraFieldsPlugin/js/acWidgetFormDoctrineExtraFields.js');
  }

  public function  getStylesheets() {
    return array('/acDoctrineActAsExtraFieldsPlugin/css/acWidgetFormDoctrineExtraFields.css'=>'screen');
  }
}

?>