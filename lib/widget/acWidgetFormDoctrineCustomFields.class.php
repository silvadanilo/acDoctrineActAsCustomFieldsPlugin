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
//    $this->addOption('acWidgetFormDoctrineCustomField', 'acWidgetFormDoctrineCustomField');
//    $class = $this->getOption('acWidgetFormDoctrineCustomField');
//    $this->addOption('types', call_user_func(array($class,"getTypes")));

    $this->addRequiredOption('form');

    $form = $options['form'];
    $customFields = $form->getObject()->custom_fields;
    if(!$customFields)
      $customFields = array();

    $customFields[''] = array('value'=>'','type'=>'text');

    $customFieldsSubForm = new sfForm();
    $customFieldsSubForm->getWidgetSchema()->setFormFormatterName("acCustomFields");
    $i = 0;
    foreach($customFields as $label => $value)
    {
      $acCFForm = new acCustomFieldForm();
      $customFieldsSubForm->embedForm($i, $acCFForm);
      $i++;
    }
    $form->embedForm('custom_fields', $customFieldsSubForm);
    $options['form'] = $form;
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    echo $name; exit;

//    if($this->parent)
//    {
//      $form = $this->getOption("form");
//      return $this->parent->renderField('custom_fields', $form['custom_fields']->getValue(), array(), $errors);
//    }
//    else
//    {
//      return $this->widget->render($this->name, $this->value, $attributes, $this->error);
//    }
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