<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * 
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormSchemaFormatterList.class.php 5995 2007-11-13 15:50:03Z fabien $
 */
class sfWidgetFormSchemaFormatterAcCustomFields extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<tr id=\"%tr_id%\">%error%%field%%help%%hidden_fields%<td><button onclick=\"$('#%tr_id%').remove(); return false;\"><img src=\"/sf/sf_admin/images/delete.png\">&nbsp;Elimina</button></td></tr>\n",
    $errorRowFormat  = "<tr><td colspan=\"2\">\n%errors%</td></tr>\n",
    $helpFormat      = '<br />%help%',
    $decoratorFormat = '%content%';
//    $decoratorFormat = '
//      <div id="ac_custom_fields_widget">
//        <p>
//          %widget_type%
//          <button onclick="addCustomFieldsRow(\'%name%\',\'%id%\'); return false;">
//            <img src="/sf/sf_admin/images/add.png" style="vertical-align:text-top;"/>&nbsp;Aggiungi
//          </button>&nbsp;
//          <img id="ac_custom_field_ajax_loader_image" src="/acDoctrineActAsCustomFieldsPlugin/images/ajax-loader.gif" style="display:none;" />
//        </p>
//        <table id="table_%id%"><thead><tr><th>Name</th><th>Value</th><th>Tipo</th><th>&nbsp;</th></tr></thead><tbody>%content%</tbody></table>
//      </div>
//      <script type="text/javascript">var dynamicAddUrl="%dynamicAddUrl%" </script>';

//  public function getDecoratorFormat()
//  {
//    return strtr($this->decoratorFormat,array(
//        "%dynamicAddUrl%" => sfContext::getInstance()->getController()->genUrl('acDoctrineActAsCustomFields/dynamicAdd'),
//    ));
//  }

  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    return strtr(parent::formatRow($label,$field,$errors,$help,$hiddenFields),array(
        "%tr_id%"=>"ac_custom_field_tr_".$this->widgetSchema->generateId($this->widgetSchema->generateName($label)),
    ));
  }
}
