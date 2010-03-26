{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shopping cart
 *  
 * @author    Creative Development LLC <info@cdev.ru> 
 * @copyright Copyright (c) 2010 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version   SVN: $Id$
 * @link      http://www.litecommerce.com/
 * @since     3.0.0
 *}
<div id="shopping-cart">

  <table class="selected-products">
    <tbody>
      <tr class="selected-product" FOREACH="cart.getItems(),cart_id,item">
        <widget template="shopping_cart/item.tpl" IF="item.isUseStandardTemplate()" />
        <widget module="GiftCertificates" template="modules/GiftCertificates/item.tpl" IF="item.gcid" />
      </tr>
    </tbody>
  </table>

  <div class="cart-totals">
    <widget template="shopping_cart/totals.tpl">
  </div>

  <div class="cart-buttons">
    <widget class="XLite_View_Button_Regular" label="Clear cart" action="clear" />
    <widget class="XLite_View_Button_Link" label="Continue shopping" location="{session.continueURL}" />
  </div>

  <div class="shipping-estimator">
    <widget template="shopping_cart/delivery.tpl">
  </div>

</div>
