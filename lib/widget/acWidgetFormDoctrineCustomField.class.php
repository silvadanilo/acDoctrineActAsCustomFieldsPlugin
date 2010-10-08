<?php

/**
 * CustomField Widget.
 *
 * @package     acDoctrineActAsCustomFieldsPlugin
 * @subpackage  widget
 * @author      Danilo Silva <danilo@anycode.it>
 */
class acWidgetFormDoctrineCustomField extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('default_type','text');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $span_name = "custom_field_row_" . $this->generateId($name);
    $to_return = '<p id="'.$span_name.'" class="custom_field_row"><span>Nome : Valore &nbsp;</span>';

    if(!$value)
    {
      $value = array(
        'id' => '',
        'label' => '',
        'type'  => $this->getOption('default_type'),
        'value' => ''
      );
    }

    if(!isset($value['type']) || !$value['type'])
      $value['type'] = "text";

    // Label widget
    $label_attributes = $attributes;
    $label_attributes["class"] = (isset($label_attributes["class"])?$label_attributes["class"] . " ":"")."ac_widget_custom_field_label";
    $label_widget  = new sfWidgetFormInputText();
    $to_return    .= $label_widget->render($name.'[label]', $value['label'], $label_attributes);

    // Value widget
    $value_attributes = $attributes;
    $value_attributes["class"] = (isset($value_attributes["class"])?$value_attributes["class"] . " ":"")."ac_widget_custom_field_value ac_widget_custom_field_type_".$value['type'];
    $value_widget  = $this->getWidgetFromType($value['type']);
    $to_return   .= "&nbsp;:&nbsp;".$value_widget->render($name.'[value]', $value['value'], $value_attributes);

    // Type widget
    $type_widget = new sfWidgetFormInputHidden();
    $to_return  .= $type_widget->render($name.'[type]', $value['type'], array_merge(array('class'=>'ac_widget_custom_field_type'),$attributes));

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
