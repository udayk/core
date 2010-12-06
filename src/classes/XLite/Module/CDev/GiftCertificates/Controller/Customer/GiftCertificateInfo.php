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
 * @category   LiteCommerce
 * @package    XLite
 * @subpackage Controller
 * @author     Creative Development LLC <info@cdev.ru> 
 * @copyright  Copyright (c) 2010 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version    SVN: $Id$
 * @link       http://www.litecommerce.com/
 * @see        ____file_see____
 * @since      3.0.0
 */

namespace XLite\Module\CDev\GiftCertificates\Controller\Customer;

/**
 * Gift certificate info
 * 
 * @package XLite
 * @see     ____class_see____
 * @since   3.0.0
 */
class GiftCertificateInfo extends \XLite\Controller\AController
{
    /**
     * Controller parameters
     * 
     * @var    array
     * @access public
     * @see    ____var_see____
     * @since  3.0.0
     */
    public $params = array('target', 'gcid');

    /**
     * Gift certificate \XLite\Module\CDev\GiftCertificates\Model\GiftCertificate 
     * 
     * @var    mixed
     * @access protected
     * @see    ____var_see____
     * @since  3.0.0
     */
    protected $gc = null;

    /**
     * Get gift certificate
     * 
     * @return \XLite\Module\CDev\GiftCertificates\Model\GiftCertificate
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function getGC()
    {
        if (is_null($this->gc)) {
            $this->gc = new \XLite\Module\CDev\GiftCertificates\Model\GiftCertificate(
                \XLite\Core\Request::getInstance()->gcid
            );
        }

        return $this->gc;
    }
}