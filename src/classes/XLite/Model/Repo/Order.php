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
 * @subpackage Model
 * @author     Creative Development LLC <info@cdev.ru> 
 * @copyright  Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version    GIT: $Id$
 * @link       http://www.litecommerce.com/
 * @see        ____file_see____
 * @since      3.0.0
 */

namespace XLite\Model\Repo;

/**
 * Order repository
 * 
 * @package XLite
 * @see     ____class_see____
 * @since   3.0.0
 */
class Order extends \XLite\Model\Repo\ARepo
{
    /**
     * Cart TTL (in seconds) 
     */
    const ORDER_TTL = 86400;

    /**
     * Allowable search params 
     */

    const P_ORDER_ID   = 'orderId';
    const P_PROFILE_ID = 'profileId';
    const P_PROFILE    = 'profile';
    const P_EMAIL      = 'email';
    const P_STATUS     = 'status';
    const P_DATE       = 'date';
    const P_ORDER_BY   = 'orderBy';
    const P_LIMIT      = 'limit';


    /**
     * currentSearchCnd 
     * 
     * @var    \XLite\Core\CommonCell
     * @access protected
     * @see    ____var_see____
     * @since  3.0.0
     */
    protected $currentSearchCnd = null;

    /**
     * Return list of handling search params 
     * 
     * @return array
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getHandlingSearchParams()
    {
        return array(
            self::P_ORDER_ID,
            self::P_PROFILE_ID,
            self::P_PROFILE,
            self::P_EMAIL,
            self::P_STATUS,
            self::P_DATE,
            self::P_ORDER_BY,
            self::P_LIMIT,
        );
    }

    /**
     * Check if param can be used for search
     * 
     * @param string $param Name of param to check
     *  
     * @return boolean 
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function isSearchParamHasHandler($param)
    {
        return in_array($param, $this->getHandlingSearchParams());
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param integer                    $value        Condition data
     *
     * @return void
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function prepareCndOrderId(\Doctrine\ORM\QueryBuilder $queryBuilder, $value)
    {
        if (!empty($value)) {
            $queryBuilder
                ->andWhere('o.order_id = :order_id')
                ->setParameter('order_id', $value);
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param \XLite\Model\Profile       $value        Profile
     *
     * @return void
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function prepareCndProfile(\Doctrine\ORM\QueryBuilder $queryBuilder, \XLite\Model\Profile $value)
    {
        if (!empty($value)) {
            $queryBuilder
                ->andWhere('o.orig_profile = :orig_profile')
                ->setParameter('orig_profile', $value);
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param integer                    $value        Condition data
     *
     * @return void
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function prepareCndProfileId(\Doctrine\ORM\QueryBuilder $queryBuilder, $value)
    {
        if (!empty($value)) {
            $value = \XLite\Core\Database::getRepo('XLite\Model\Profile')->find($value);
            $queryBuilder
                ->andWhere('o.orig_profile = :orig_profile')
                ->setParameter('orig_profile', $value);
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param string                     $value        Condition data
     *
     * @return void
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function prepareCndEmail(\Doctrine\ORM\QueryBuilder $queryBuilder, $value)
    {
        if (!empty($value)) {
            $queryBuilder
                ->innerJoin('o.profile', 'p')
                ->andWhere('p.login = :email')
                ->setParameter('email', $value);
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param string                     $value        Condition data
     *
     * @return void
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function prepareCndStatus(\Doctrine\ORM\QueryBuilder $queryBuilder, $value)
    {
        if (
            !empty($value)
            && !is_null(\XLite\Model\Order::getAllowedStatuses($value))
        ) {
            $queryBuilder
                ->andWhere('o.status = :status')
                ->setParameter('status', $value);

        } else {
            // TODO - add throw exception
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param array                      $value        Condition data
     *
     * @return void
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function prepareCndDate(\Doctrine\ORM\QueryBuilder $queryBuilder, array $value = null)
    {
        if (2 == count($value)) {
            list($start, $end) = $value;

            $queryBuilder
                ->andWhere('o.date >= :start')
                ->andWhere('o.date <= :end')
                ->setParameter('start', $start)
                ->setParameter('end', $end);
        }
    }

    /**
     * Return order TTL
     * 
     * @return integer 
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getOrderTTL()
    {
        return self::ORDER_TTL;
    }

    /**     
     * Define query for findAllExipredTemporaryOrders() method
     * 
     * @return \Doctrine\ORM\QueryBuilder
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function defineAllExpiredTemporaryOrdersQuery()
    {
        return $this->createQueryBuilder(null, false)
            ->andWhere('o.status = :tempStatus AND o.date < :time')
            ->setParameter('tempStatus', \XLite\Model\Order::STATUS_TEMPORARY)
            ->setParameter('time', time() - $this->getOrderTTL());
    }

    /**
     * Find all expired temporary orders 
     * 
     * @return \Doctrine\Common\Collection\ArrayCollection
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function findAllExipredTemporaryOrders()
    {
        return $this->defineAllExpiredTemporaryOrdersQuery()->getResult();
    }

    /**
     * Create a new QueryBuilder instance that is prepopulated for this entity name
     *
     * @param string  $alias      Table alias OPTIONAL
     * @param boolean $placedOnly Use only orders or orders + carts OPTIONAL
     *
     * @return \Doctrine\ORM\QueryBuilder
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function createQueryBuilder($alias = null, $placedOnly = true)
    {
        $result = parent::createQueryBuilder($alias);

        if ($placedOnly) {
            $result
                ->andWhere('o.status != :tempStatus')
                ->setParameter('tempStatus', \XLite\Model\Order::STATUS_TEMPORARY);
        }

        return $result;
    }

    /**
     * Orders collect garbage 
     * 
     * @return void
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function collectGarbage()
    {
        $list = $this->findAllExipredTemporaryOrders();
        if (count($list)) {
            foreach ($list as $order) {
                \XLite\Core\Database::getEM()->remove($order);
            }

            \XLite\Core\Database::getEM()->flush();
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param array                      $value        Condition data
     *
     * @return void
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function prepareCndOrderBy(\Doctrine\ORM\QueryBuilder $queryBuilder, array $value)
    {
        list($sort, $order) = $value;

        $queryBuilder
            ->addOrderBy($sort, $order);
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param array                      $value        Condition data
     *
     * @return void
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function prepareCndLimit(\Doctrine\ORM\QueryBuilder $queryBuilder, array $value)
    {
        array_unshift($value, $queryBuilder);
        call_user_func_array(array($this, 'assignFrame'), $value);
    }

    /**
     * Call corresponded method to handle a serch condition
     * 
     * @param mixed                      $value        Condition data
     * @param string                     $key          Condition name
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     *  
     * @return void
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function callSearchConditionHandler($value, $key, \Doctrine\ORM\QueryBuilder $queryBuilder)
    {
        if ($this->isSearchParamHasHandler($key)) {
            $methodName = 'prepareCnd' . ucfirst($key);
            // $methodName is assembled from 'prepareCnd' + key
            $this->$methodName($queryBuilder, $value);

        } else {
            // TODO - add logging here
        }
    }


    /**
     * Common search
     * 
     * @param \XLite\Core\CommonCell $cnd       Search condition
     * @param boolean                $countOnly Return items list or only its size OPTIONAL
     *  
     * @return \Doctrine\ORM\PersistentCollection|integer
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function search(\XLite\Core\CommonCell $cnd, $countOnly = false)
    {
        $queryBuilder = $this->createQueryBuilder();
        $this->currentSearchCnd = $cnd;

        foreach ($this->currentSearchCnd as $key => $value) {
            if (self::P_LIMIT != $key || !$countOnly) {
                $this->callSearchConditionHandler($value, $key, $queryBuilder);
            }
        }

        if ($countOnly) {
            $queryBuilder->select('COUNT(o.order_id)');
            $result = intval($queryBuilder->getSingleScalarResult());

        } else {
            $result = $queryBuilder->getResult();
        }

        return $result;
    }
}
