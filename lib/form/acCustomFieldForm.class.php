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
class acCustomFieldForm extends sfFormSymfony
{
  public function setup()
  {
    $this->setWidgets(array(
      'label'        => new sfWidgetFormInputText(),
      'type'         => new sfWidgetFormInputText(),
      'value'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'label'        => new sfValidatorString(array('max_length' => 255)),
      'type'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'value'        => new sfValidatorPass(),
    ));

    $this->widgetSchema->setNameFormat('ac_custom_fields[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->widgetSchema->setFormFormatterName('acCustomField');

    parent::setup();
  }

  public function getModelName()
  {
    return 'acCustomField';
  }

}