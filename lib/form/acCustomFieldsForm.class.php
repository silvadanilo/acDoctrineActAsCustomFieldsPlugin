<?php

/**
 * acCustomFields form base class.
 *
 * @method acCustomFields getObject() Returns the current form's model object
 *
 * @package    Anycode
 * @subpackage form
 * @author     Danilo Silva <danilo@anycode.it>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
class acCustomFieldsForm extends sfForm
{
  public function setup()
  {
    $this->validatorSchema = new acValidatorDoctrineCustomFieldsSchema();

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->widgetSchema->setFormFormatterName('acCustomFields');

    $this->validatorSchema->setOption('allow_extra_fields', true);
    $this->validatorSchema->setOption('filter_extra_fields', false);

    parent::setup();
  }
}