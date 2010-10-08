<?php

class acWidgetFormDoctrineExtraField extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
    
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $span_name = "extra_field_row_" . $this->generateId($name);
    $to_return = '<p id="'.$span_name.'" class="extra_field_row"><span>Nome : Valore &nbsp;</span>';

    if(!$value)
    {
      $value = array(
        'id' => '',
        'label' => '',
        'type'  => $this->getOption('default_type'),
        'value' => ''
      );
    }

    // Label widget
    $label_widget  = new sfWidgetFormInputText();
    $to_return    .= $label_widget->render($name.'[label]', $value['label'], array_merge(array('class'=>'ac_widget_extra_field_label'),$attributes));

    // Value widget
    $value_widget  = $this->getWidgetFromType($value['type']);
    $to_return   .= "&nbsp;:&nbsp;".$value_widget->render($name.'[value]', $value['value'], array_merge(array('class'=>'ac_widget_extra_field_value ac_widget_extra_field_type_'.$value['type']),$attributes));

    // Type widget
    $type_widget = new sfWidgetFormInputHidden();
    $to_return  .= $type_widget->render($name.'[type]', $value['type'], array_merge(array('class'=>'ac_widget_extra_field_type'),$attributes));

    $to_return .= '&nbsp;<button onclick="$(\'#'.$span_name.'\').remove(); return false;"><img src="/sf/sf_admin/images/delete.png">&nbsp;Elimina</button></p>';

    return $to_return;
  }

  private function getWidgetFromType($type)
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
      break;
    }
  }

  public static function getTypes()
  {
    return array(
        "text" => "text",
        "textarea" => "textarea",
        "date" => "date"
    );
  }
}

?>
