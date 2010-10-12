<?php

/**
 * Base actions for the acDoctrineActAsCustomFieldsPlugin acDoctrineActAsCustomFields module.
 * 
 * @package     acDoctrineActAsCustomFieldsPlugin
 * @subpackage  acDoctrineActAsCustomFields
 * @author      Danilo Silva <danilo@anycode.it>
 * @version     
 */
abstract class BaseacDoctrineActAsCustomFieldsComponents extends sfComponents
{
  public function executeShowAcCustomFieldsWidget(sfWebRequest $request)
  {
    if(!isset($this->types))
      $this->types = array('text'=>'text','textarea'=>'textarea','date'=>'date');
    $this->widget_type = new sfWidgetFormChoice(array('choices'=>$this->types));
  }
}
