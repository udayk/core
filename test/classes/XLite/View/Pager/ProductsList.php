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
 * @subpackage ____sub_package____
 * @author     Creative Development LLC <info@cdev.ru> 
 * @copyright  Copyright (c) 2010 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version    SVN: $Id$
 * @link       http://www.litecommerce.com/
 * @see        ____file_see____
 * @since      3.0.0
 */

/**
 * Pager 
 * 
 * @package XLite
 * @see     ____class_see____
 * @since   3.0.0
 */
class XLite_View_Pager_ProductsList extends XLite_View_Pager
{
    /**
     * Page short names
     */

    const PAGE_FIRST    = 'first';
    const PAGE_PREVIOUS = 'previous';
    const PAGE_NEXT     = 'next';
    const PAGE_LAST     = 'last';

    /**
     * pagesPerFrame 
     * 
     * @var    int
     * @access protected
     * @since  3.0.0
     */
    protected $pagesPerFrame = 5;

    /**
     * Define widget parameters
     *
     * @return void
     * @access protected
     * @since  1.0.0
     */
    protected function defineWidgetParams()
    {
        parent::defineWidgetParams();

        $this->requestParams[] = self::PARAM_ITEMS_PER_PAGE;
    }

    /**
     * Build page URL by page ID
     *
     * @param int $pageId page ID
     *
     * @return string
     * @access protected
     * @since  3.0.0
     */
    protected function buildUrlByPageId($pageId)
    {
        return parent::buildUrlByPageId($this->getPageIdByNotation($pageId));
    }

    /**
     * getFrameStartPage
     *
     * @return int
     * @access protected
     * @since  3.0.0
     */
    protected function getFrameStartPage()
    {
        $pageId = $this->getPageId() - ceil($this->pagesPerFrame / 2);

        return (0 > $pageId) ? 0 : $pageId;
    }

    /**
     * definePageURLs
     *
     * @return void
     * @access protected
     * @since  3.0.0
     */
    protected function definePageURLs()
    {
        parent::definePageURLs();

        $this->pageURLs = array_slice($this->pageURLs, $this->getFrameStartPage(), $this->pagesPerFrame, true);
    }

    /**
     * isFurthermostPage 
     * 
     * @param string $type link type (first / previous / next / last)
     *  
     * @return bool
     * @access protected
     * @since  3.0.0
     */
    protected function isFurthermostPage($type)
    {
        $pageId = $this->getPageId();

        return (0 >= $pageId && in_array($type, array(self::PAGE_FIRST, self::PAGE_PREVIOUS)))
            || ($this->getPagesCount() - 1 <= $pageId && in_array($type, array(self::PAGE_LAST, self::PAGE_NEXT)));
    }

    /**
     * getPageIndexNotations 
     * 
     * @param mixed $index page notation
     *  
     * @return int
     * @access protected
     * @since  3.0.0
     */
    protected function getPageIdByNotation($index)
    {
        $result = array(
            self::PAGE_FIRST    => 0,
            self::PAGE_PREVIOUS => max(0, $this->getPageId() - 1),
            self::PAGE_LAST     => $this->getPagesCount() - 1,
            self::PAGE_NEXT     => min($this->getPagesCount() - 1, $this->getPageId() + 1),
        );

        return isset($result[$index]) ? $result[$index] : $index;
    }

    /**
     * getLinkClassName 
     * 
     * @param mixed $index page notation
     *  
     * @return int
     * @access protected
     * @since  3.0.0
     */
    protected function getLinkClassName($index)
    {
        return $this->getPageIdByNotation($index);
    }

    /**
     * Get border link class name
     *
     * @param string $type link type (first / previous / next / last)
     *
     * @return string
     * @access protected
     * @since  3.0.0
     */
    protected function getBorderLinkClassName($type)
    {
        return $type . ' ' . ($this->isFurthermostPage($type) ? $type . '-disabled disabled' : '');
    }

    /**
     * getPageClassName 
     * 
     * @param int $pageId current page ID
     *  
     * @return string
     * @access protected
     * @since  3.0.0
     */
    protected function getPageClassName($pageId)
    {
        return 'page-item page-' . $pageId . ' ' . ($this->isCurrentPage($pageId) ? 'selected' : '');
    }

    /**
     * Get page begin record number
     *
     * @return int
     * @access protected
     * @since  3.0.0
     */
    protected function getBeginRecordNumber()
    {
        return $this->getPageId() * $this->getItemsPerPage() + 1;
    }

    /**
     * Get page end record number
     *
     * @return int
     * @access protected
     * @since  3.0.0
     */
    protected function getEndRecordNumber()
    {
        return min($this->getBeginRecordNumber() + $this->getItemsPerPage() - 1, $this->getItemsTotal());
    }

    /**
     * Get items-per-page range as javascript object definition
     * TODO - currently this function is not used
     *
     * @return string
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getItemsPerPageRange()
    {
        return '{ min: ' . self::ITEMS_PER_PAGE_MIN . ', max: ' . self::ITEMS_PER_PAGE_MAX . ' }';
    }
}

