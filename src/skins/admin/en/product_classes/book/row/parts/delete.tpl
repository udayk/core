{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * "Delete class" icon
 *  
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.litecommerce.com/
 * @since     1.0.14
 *
 * @ListChild (list="productClasses.book.row", weight="300")
 *}

<div IF="!isNew()" class="delete product-class">
  <input type="hidden" name="{getNamePostedData(#toDelete#)}" value="{#0#}" />
</div>
