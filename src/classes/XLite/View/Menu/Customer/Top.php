<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * LiteCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to licensing@litecommerce.com so we can send you a copy immediately.
 *
 * PHP version 5.3.0
 *
 * @category  LiteCommerce
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.litecommerce.com/
 * @see       ____file_see____
 * @since     1.0.0
 */

namespace XLite\View\Menu\Customer;

/**
 * Main menu
 *
 * @see   ____class_see____
 * @since 1.0.0
 *
 * @ListChild (list="layout.main", weight="250")
 */
class Top extends \XLite\View\Menu\AMenu
{
    /**
     * Return widget default template
     *
     * @return string
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function getDefaultTemplate()
    {
        return 'top_menu.tpl';
    }

    /**
     * Define menu items
     *
     * @return array
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function defineItems()
    {
        $menu = array();

        $menu[] = array(
            'target' => \XLite::TARGET_DEFAULT,
            'url'    => $this->buildURL(''),
            'label'  => static::t('Home'),
        );

        $menu[] = array(
            'target' => 'cart',
            'url'    => $this->buildURL('cart'),
            'label'  => static::t('Shopping bag'),
        );

        if (\XLite\Core\Auth::getInstance()->isLogged()) {
            $menu[] = array(
                'target' => 'profile',
                'url'    => $this->buildURL('profile'),
                'label'  => static::t('My account'),
            );

        } else {
            $menu[] = array(
                'target' => 'profile',
                'url'    => $this->buildURL('profile', '', array('mode' => 'register')),
                'label'  => static::t('Register'),
            );
        }


        return $menu;
    }
}
