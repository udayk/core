{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product block
 *
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.litecommerce.com/
 * @since     1.0.0
 *}
<ul class="products products-sidebar products-sidebar-big-thumbnails product-block">
  <li class="product-cell product hproduct item first last">
    {displayViewListContent(#productBlock.info#,_ARRAY_(#product#^getProduct()))}
  </li>
</ul>
