<?php

/**
 * CustomFields Widget.
 *
 * @package     acDoctrineActAsCustomFieldsPlugin
 * @subpackage  widget
 * @author      Danilo Silva <danilo@anycode.it>
 */

/*******************************************************
 * CLASSE NON PIU UTILIZZATA
 ******************************************************/
class acWidgetFormDoctrineCustomFields extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('types',array('text'=>'text','textarea'=>'textarea','date'=>'date'));
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $form = $attributes['form'];
    unset($attributes['form']);

    $widget_type = new sfWidgetFormChoice(array('choices'=>$this->getOption('types')));

    return strtr(
      $form['custom_fields']->getParent()->getWidget()->renderField($form['custom_fields']->getName(), $form['custom_fields']->getValue(), $attributes, $errors),
      array(
          '%name%' => $form['custom_fields']->renderName(),
          '%id%' => $this->generateId($name),
          '%widget_type%' => $widget_type->render('ac_custom_fields_type_'.$this->generateId($name))
      ));
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