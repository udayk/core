{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Sort widget
 *  
 * @author    Creative Development LLC <info@cdev.ru> 
 * @copyright Copyright (c) 2010 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version   SVN: $Id$
 * @link      http://www.litecommerce.com/
 * @since     3.0.0
 *}
<widget class="XLite_View_Form_Sort" name="sort_form" params="{getFormParams()}" />

<span>Sort by</span>
<select name="sortCriterion">
  <option FOREACH="getParam(#sortCriterions#),key,name" value="{key}" selected="{isSortCriterionSelected(key)}">{name}</option>
</select>
<a href="{getSortOrderUrl()}" class="{getSortOrderLinkClassName()}">{if:isSortOrderAsc()}&darr;{else:}&uarr;{end:}</a>

<widget name="sort_form" end />
