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
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('acValidatorDoctrineCustomField', 'acValidatorDoctrineCustomField');
    $class = $this->getOption('acValidatorDoctrineCustomField');
  }

  protected function doClean($value)
  {
    $errors = array();
    $ret_value = array();
    foreach($value as $field)
    {
      // If label is empty skip
      if(!$field['label'])
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
