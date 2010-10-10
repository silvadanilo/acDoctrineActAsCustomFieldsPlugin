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
    $rowFormat       = "<tr colspan='3'>%error%%field%%help%%hidden_fields%</tr>\n",
    $errorRowFormat  = "<tr><td colspan=\"2\">\n%errors%</td></tr>\n",
    $helpFormat      = '<br />%help%',
    $decoratorFormat = '
      <div id="ac_custom_fields_widget">
        <p>
          <button onclick="addCustomFieldsRow(\'%name%\'); return false;">
            <img src="/sf/sf_admin/images/add.png" style="vertical-align:text-top;"/>&nbsp;Aggiungi
          </button>&nbsp;
          <img id="ac_custom_field_ajax_loader_image" src="/acDoctrineActAsCustomFieldsPlugin/images/ajax-loader.gif" style="display:none;" />
        </p>
        <table><thead><tr><th>Name</th><th>Value</th><th>Tipo</th></tr></thead><tbody>%content%</tbody></table>
      </div>
      <script type="text/javascript">var dynamicAddUrl="%dynamicAddUrl%" </script>';

  public function getDecoratorFormat()
  {
    echo $this->getWidgetSchema()->getNameFormat();exit;
    return strtr($this->decoratorFormat,array(
        "%dynamicAddUrl%" => '/admin.php/acDoctrineActAsCustomFields/dynamicAdd',
        "%name%" => ""
    ));
  }
}
