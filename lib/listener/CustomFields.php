<?php

/**
 * 
 *
 * @package acDoctrineActAsCustomFieldsPlugin
 * @subpackage listener
 * @author 
 **/
class Doctrine_Template_Listener_CustomFields extends Doctrine_Record_Listener
{

  protected $_options;

  public function __construct(array $options)
  {
    $this->_options = $options;
  }

//  public function setCustomFields()
//  {
//
//  }
}