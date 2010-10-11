<?php

/**
 * Base actions for the acDoctrineActAsCustomFieldsPlugin acDoctrineActAsCustomFields module.
 * 
 * @package     acDoctrineActAsCustomFieldsPlugin
 * @subpackage  acDoctrineActAsCustomFields
 * @author      Danilo Silva <danilo@anycode.it>
 * @version     
 */
abstract class BaseacDoctrineActAsCustomFieldsActions extends sfActions
{
  public function executeDynamicAdd(sfWebRequest $request)
  {
    $name = $request->getParameter('name');
    $type = $request->getParameter('type','text');
    
    $formFields = new acCustomFieldsForm();
    $formField = new acCustomFieldForm(array(),array('type'=>$type));
    $formFields->embedForm($name,$formField);

    return $this->renderText($formFields->getWidgetSchema()->getFormFormatter()->formatRow($name,$formFields[$name]));
  }
}
