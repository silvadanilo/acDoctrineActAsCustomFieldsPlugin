<?php

/**
 * CustomField Validator.
 *
 * @package     acDoctrineActAsCustomFieldsPlugin
 * @subpackage  validator
 * @author      Danilo Silva <danilo@anycode.it>
 */


/*******************************************************
 * CLASSE NON PIU UTILIZZATA
 ******************************************************/
class acValidatorDoctrineCustomField extends sfValidatorBase
{
  protected function doClean($value)
  {
    $ret_value = array();

    // Validate the label name, whit sfValidatorString
    $label_validator = new sfValidatorString(array('max_length' => 255, 'required' => true));
    $value['label'] = $label_validator->clean($value['label']);

    // Validate the type
    $type_validator = new sfValidatorChoice(array('choices'=>$this->getTypes(),'required' => false));
    $value['type'] = $type_validator->clean($value['type']);

    // Validate the value
    $value_validator = $this->getValidatorFromType($value['type']);
    $value['value'] = $value_validator->clean($value['value']);

    $ret_value[$value['label']] = array("type"=>$value["type"],"value"=>$value["value"]);

    return $ret_value;
  }

  public static function getTypes()
  {
    return array("text","textarea","date");
  }

  private function getValidatorFromType($type)
  {
    switch($type)
    {
      case "date":
        return new sfValidatorDateTime(array(), array());
      break;
      case "textarea":
        return new sfValidatorString(array('required'=>true));
      break;
      case "text":
      default:
        return new sfValidatorString(array('max_length' => 255, 'required' => true));
      break;
    }
  }
}

?>
