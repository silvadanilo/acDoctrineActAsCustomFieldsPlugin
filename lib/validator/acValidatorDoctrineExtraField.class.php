<?php

class acValidatorDoctrineExtraField extends sfValidatorBase
{
  protected function doClean($value)
  {
    $ret_value = array();

    $label_validator = new sfValidatorString(array('max_length' => 255, 'required' => true));
    
    $value['label'] = $label_validator->clean($value['label']);

    $ret_value[$value['label']] = array("type"=>$value["type"],"value"=>$value["value"]);

    return $ret_value;
  }
}

?>
