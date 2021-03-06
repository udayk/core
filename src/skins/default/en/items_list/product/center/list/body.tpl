{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list (list variant)
 *
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.litecommerce.com/
 * @since     1.0.0
 *}

{displayViewListContent(#itemsList.product.cart#)}

<div class="products">

  <ul class="products-list" IF="getPageData()">
    <li FOREACH="getPageData(),product" class="product-cell">

      <table class="{getProductCellClass(product)}">
        <tr>
          <td class="product-photo">
            <div class="product-photo">
              {displayInheritedViewListContent(#photo#,_ARRAY_(#product#^product))}
              <div IF="product.hasImage()">
                {displayInheritedViewListContent(#quicklook#,_ARRAY_(#product#^product))}
              </div>
            </div>
          </td>
          <td class="product-info">
            <div class="product-info">
              {displayInheritedViewListContent(#info#,_ARRAY_(#product#^product))}
              <div IF="!product.hasImage()">
                {displayInheritedViewListContent(#quicklook#,_ARRAY_(#product#^product))}
              </div>
            </div>
          </td>
        </tr>
      </table>

    </li>
  </ul>

</div>
