<?php

/**
 * ExtraFields template
 *
 * Add ExtraFields to your model
 *
 * @package acDoctrineActAsExtraFieldsPlugin
 * @subpackage template
 * @author 
 * @author 
 **/
class Doctrine_Template_ExtraFields extends Doctrine_Template
{
  /**
   * Array of ExtraFields options
   */
  protected $_options = array();

  /**
   * Add the listener
   **/
  public function setTableDefinition()
  {
    $this->hasColumn('extra_fields', 'array'); //Todo: is better array or object?
    $this->addListener(new Doctrine_Template_Listener_ExtraFields($this->_options));
  }

  public function setUp()
  {

  }

  public function getExtraField($field)
  {
    $invoker = $this->getInvoker();
    if(isset($invoker->extra_fields[$field]))
        return $invoker->extra_fields[$field]['value'];
    else
        throw new Doctrine_Record_UnknownPropertyException();
  }

  public function setExtraField($field,$value)
  {
    $invoker = $this->getInvoker();
    $extra_fields = $invoker->extra_fields;
    $extra_fields[$field] = $value;
    $invoker->extra_fields = $extra_fields;
  }
}
