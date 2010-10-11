<?php

/**
 * CustomFields Plugin Configuration.
 *
 * @package     acDoctrineActAsCustomFieldsPlugin
 * @subpackage  configuration
 * @author      Danilo Silva <danilo@anycode.it>
 */
class acDoctrineActAsCustomFieldsPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect('form.post_configure', array( $this, 'formPostConfigure' ));
  }

  public static function formPostConfigure(sfEvent $event)
  {
    $form = $event->getSubject();
    self::embedAcCustomFieldsForm($form,$form);
  }

  public static function embedAcCustomFieldsForm($form,$original_form,$path=array())
  {
    if($form instanceof sfFormObject)
    {
      $object = $form->getObject();

      if($object->getTable()->hasTemplate('CustomFields'))
      {
        $ac_custom_fields_form = new acCustomFieldsForm();

        $customFields = $object->custom_fields;
        if(!$customFields)
          $customFields = array(''=>array('value'=>'','type'=>'text'));

        $i = 0;
        foreach($customFields as $label => $value)
        {
          $acCFForm = new acCustomFieldForm(array(),array('type'=>$value['type']));
          $ac_custom_fields_form->embedForm($i, $acCFForm);
          $i++;
        }

        $ac_custom_fields_form->setOption('_ac_custom_fields_n',$i);
        $form->embedForm('custom_fields', $ac_custom_fields_form);
        $original_form->setOption('_ac_custom_fields',$path);
      }
    }

    $request = sfContext::getInstance()->getRequest();
    if($request->isMethod('put') || $request->isMethod('post'))
    {
      if($request->hasParameter($form->getName()))
      {
        self::bo($form,$request->getParameter($form->getName()));
      }
    }
  }

  public static function bo($form, $values)
  {
    $embeddedForms = $form->getEmbeddedForms();
    if(isset($embeddedForms['custom_fields']))
    {
      $ac_custom_fields_form = $embeddedForms['custom_fields'];
      foreach($values['custom_fields'] as $custom_field_key => $value)
      {
        if(substr($custom_field_key,0,5) === "defr_")
        {
          $acCFForm = new acCustomFieldForm(array('label'=>$value['label'],'type'=>$value['type'],'value'=>$value['value']),array('type'=>$value['type']));
          $ac_custom_fields_form->embedForm($custom_field_key, $acCFForm);
        }
      }

      $form->embedForm('custom_fields',$ac_custom_fields_form);
      return $form;
    }
    else
    {
      foreach($embeddedForms as $key => $embeddedForm)
      {
        $ret_form = self::bo($embeddedForm,$values[$key]);
        if($ret_form)
        {
          $form->embedForm($key,$ret_form);
          return $form;
        }
        else
          return false;
      }

      return false;
    }
  }
}