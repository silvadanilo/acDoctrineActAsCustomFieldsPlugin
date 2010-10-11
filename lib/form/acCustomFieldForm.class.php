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
    $type = $this->getOption('type','text');

    $this->setWidgets(array(
      'label'        => new sfWidgetFormInputText(),
      'type'         => new sfWidgetFormInputText(),
      'value'        => $this->getValueWidget($type),
    ));

    $this->setValidators(array(
      'label'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'value'        => $this->getValueValidator($type),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkLabelAndValue')))
    );

    $this->setDefault('type', $type);

    $this->widgetSchema->setNameFormat('ac_custom_fields[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->widgetSchema->setFormFormatterName('acCustomField');

    parent::setup();
  }

  public function checkLabelAndValue($validator,$values)
  {
    if($values['value'] && !$values['label'])
    {
      throw new sfValidatorError($validator, 'Label is required.');
    }

    return $values;
  }

  private function getValueWidget($type)
  {
    switch($type)
    {
      case "date":
        return new sfWidgetFormDateTime();
      break;
      case "textarea":
        return new sfWidgetFormTextarea();
      break;
      case "text":
      default:
        return new sfWidgetFormInputText();
    }
  }

  private function getValueValidator($type)
  {
    return new sfValidatorString(array('required' => false));
  }
}