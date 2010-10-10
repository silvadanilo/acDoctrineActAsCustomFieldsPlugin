<?php

/**
 * CustomFields template
 *
 * Add CustomFields to your model
 *
 * @package acDoctrineActAsCustomFieldsPlugin
 * @subpackage template
 * @author      Danilo Silva <danilo@anycode.it>
 **/
class Doctrine_Template_CustomFields extends Doctrine_Template
{
  /**
   * Array of CustomFields options
   */
  protected $_options = array();

  /**
   * Add the listener
   **/
  public function setTableDefinition()
  {
    $this->hasColumn('custom_fields', 'array'); //Todo: is better array or object?
    $this->addListener(new Doctrine_Template_Listener_CustomFields($this->_options));
  }

  public function getCustomField($field)
  {
    $invoker = $this->getInvoker();

    if( !($_ac_custom_fields = $invoker->option("_ac_custom_fields")) )
    {
      $_ac_custom_fields = $this->customFieldsCompile($invoker);
    }

    if(isset($_ac_custom_fields[$field]))
        return $_ac_custom_fields[$field]['value'];
    else
        throw new Doctrine_Record_UnknownPropertyException();
  }

  protected function customFieldsCompile($invoker)
  {
    if(isset($invoker->custom_fields))
    {
      foreach($invoker->custom_fields as $cf)
      {
        $_ac_custom_fields[$cf['label']] = $cf;
      }

      $invoker->option("_ac_custom_fields", $_ac_custom_fields);
      return $_ac_custom_fields;
    }
  }

  public function setCustomField($label,$value,$type="text")
  {
    $invoker = $this->getInvoker();
    $custom_fields = $invoker->custom_fields;
    $custom_fields[] = array("label"=>$label,"value"=>$value,"type"=>$type);
    $invoker->custom_fields = $custom_fields;

    // if isset _ac_custom_fields option then add new custom fields to it
    if(($_ac_custom_fields = $invoker->option("_ac_custom_fields")) )
    {
      $_ac_custom_fields[$label] = array("label"=>$label,"value"=>$value,"type"=>$type);
      $invoker->option("_ac_custom_fields", $_ac_custom_fields);
    }

  }
}
