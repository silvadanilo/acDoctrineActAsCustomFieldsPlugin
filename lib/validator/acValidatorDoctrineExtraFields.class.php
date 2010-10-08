<?php

class acValidatorDoctrineExtraFields extends sfValidatorBase
{
  protected function doClean($value)
  {
    $ret_value = array();
    foreach($value as $field)
    {
      // If label and value is empty skip
      if(!$field['label'] && !$field['value'])
        continue;

      $acValidatorDoctrineExtraField = new acValidatorDoctrineExtraField();

      $field_value = $acValidatorDoctrineExtraField->doClean($field);
      $ret_value = array_merge($ret_value,$field_value);
    }

    return $ret_value;
  }
}

?>
