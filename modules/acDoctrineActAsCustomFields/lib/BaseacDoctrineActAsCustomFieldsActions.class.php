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
    $this->name = $request->getParameter("name");
    $this->type = $request->getParameter("type");
    $this->widget = new acWidgetFormDoctrineCustomField();
  }
}
