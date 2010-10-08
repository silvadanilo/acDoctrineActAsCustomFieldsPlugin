<?php

/**
 * CustomFields Validator.
 *
 * @package     acDoctrineActAsCustomFieldsPlugin
 * @subpackage  validator
 * @author      Danilo Silva <danilo@anycode.it>
 */
class acValidatorDoctrineCustomFields extends sfValidatorBase
{
  protected function doClean($value)
  {
    $errors = array();
    $ret_value = array();
    foreach($value as $field)
    {
      // If label and value is empty skip
      if(!$field['label'] && !$field['value'])
        continue;

      $acValidatorDoctrineCustomField = new acValidatorDoctrineCustomField();

      try{
        $field_value = $acValidatorDoctrineCustomField->doClean($field);
        $ret_value = array_merge($ret_value,$field_value);
      }
      catch(sfValidatorError $e)
      {
        $errors[] = $e;
      }
    }

    if(!empty($errors))
    {
      throw new sfValidatorErrorSchema($this, $errors);
    }

    return $ret_value;
  }
}

?>
