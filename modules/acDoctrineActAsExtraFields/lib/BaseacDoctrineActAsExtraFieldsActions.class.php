<?php

/**
 * Base actions for the acDoctrineActAsExtraFieldsPlugin acDoctrineActAsExtraFields module.
 * 
 * @package     acDoctrineActAsExtraFieldsPlugin
 * @subpackage  acDoctrineActAsExtraFields
 * @author      Anycode
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BaseacDoctrineActAsExtraFieldsActions extends sfActions
{
  public function executeDynamicAdd(sfWebRequest $request)
  {
    $this->name = $request->getParameter("name");
    $this->type = $request->getParameter("type");
    $this->widget = new acWidgetFormDoctrineExtraField();
  }
}
