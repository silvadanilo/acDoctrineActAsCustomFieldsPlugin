<?php

class acValidatorDoctrineCustomFields extends sfValidatorBase
{
  protected function doClean($value)
  {
    $ret_value = array();
    foreach($value as $field)
    {
      // If label and value is empty skip
      if(!$field['label'] && !$field['value'])
        continue;

      $acValidatorDoctrineCustomField = new acValidatorDoctrineCustomField();

      $field_value = $acValidatorDoctrineCustomField->doClean($field);
      $ret_value = array_merge($ret_value,$field_value);
    }

    return $ret_value;
  }
}

?>
