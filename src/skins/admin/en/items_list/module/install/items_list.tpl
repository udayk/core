{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules list
 *
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.litecommerce.com/
 * @since     1.0.0
 *}

{* :TODO: divide into parts *}

<div class="top-controls">

  <div class="form-panel addons-search-panel">

    <form name="search_form" method="GET" action="admin.php">

      <input FOREACH="getURLParams(),name,value" type="hidden" name="{name}" value="{value}" />

      <widget class="\XLite\View\FormField\Input\Text" fieldOnly=true fieldName="substring" value="{getParam(#substring#)}" defaultValue="{t(#Enter keywords#)}" />

      <widget class="\XLite\View\Button\Submit" style="addon-search" label="{t(#Search#)}" />

    </form>

  </div>

  {* :TODO: Use the same widget as in Manage addons. (or move it to separated widget ?) *}
  {* <div class="tags">
    <div class="tags-title">{t(#Tags#)}</div>
  </div> *}

  <div class="action-buttons">
    <widget class="\XLite\View\Button\Addon\EnterLicenseKey" IF="hasResults()" />
  </div>

</div>

<div class="clear"></div>

<widget template="{getBody()}" />
