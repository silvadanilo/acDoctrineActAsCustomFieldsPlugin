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

  public function setUp()
  {

  }

  public function getCustomField($field)
  {
    $invoker = $this->getInvoker();
    if(isset($invoker->custom_fields[$field]))
        return $invoker->custom_fields[$field]['value'];
    else
        throw new Doctrine_Record_UnknownPropertyException();
  }

  public function setCustomField($field,$value)
  {
    $invoker = $this->getInvoker();
    $custom_fields = $invoker->custom_fields;
    $custom_fields[$field] = $value;
    $invoker->custom_fields = $custom_fields;
  }
}
