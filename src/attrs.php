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
 * @since     1.0.15
 */

require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'top.inc.php');

\XLite\Core\Database::getRepo('\XLite\Model\ProductClass')->clearAll();
\XLite\Core\Database::getRepo('\XLite\Model\Attribute\Group')->clearAll();
\XLite\Core\Database::getRepo('\XLite\Model\Attribute')->clearAll();

$classes    = array();
$attributes = array();
$products   = \XLite\Core\Database::getRepo('\XLite\Model\Product')->findAll();

for ($i = 1; $i < 10; $i++) {
    $class = new \XLite\Model\ProductClass();
    $class->setName('Product class ' . $i);
    \XLite\Core\Database::getRepo('\XLite\Model\ProductClass')->insert($class);

    if (rand(0, 3)) {
        foreach (array_rand($products, rand(3, count($products))) as $index) {
            $products[$index]->addClasses($class);
        }
    }

    $classes[] = $class;
}

for ($i = 1; $i < 3; $i++) {
    $group = new \XLite\Model\Attribute\Group();
    $group->setPos($i);
    $group->setTitle('Group ' . $i);
    \XLite\Core\Database::getRepo('\XLite\Model\Attribute\Group')->insert($group);

    for ($j = 1; $j < 3; $j++) {
        foreach (array('Number', 'Text', 'Boolean', 'Selector') as $type) {
            $class = '\XLite\Model\Attribute\Type\\' . $type;
            $attribute = new $class();
            $attribute->setName('ATTR_' . $j . '_' . $i . '_' . $type);
            $attribute->setPos($i * $j);
            $attribute->setTitle('[Group ' . $i . '] Attribute ' . $j . '(' . $type . ')');
            $attribute->setGroup($group);

            if ('Selector' === $type) {
                $limit = rand(2, 5);

                for ($k = 0; $k < $limit; $k++) {
                    $choice = new \XLite\Model\Attribute\Choice();
                    $choice->setAttribute($attribute);
                    $choice->setTitle($attribute->getTitle() . ', choice ' . $k);

                    $attribute->addChoices($choice);
                }
            }

            \XLite\Core\Database::getRepo('\XLite\Model\Attribute')->insert($attribute);
            $attributes[] = $attribute;
        }
    }
}

foreach ($classes as $class) {
    foreach (rand(0, 1) ? (array) array_rand($attributes, rand(1, 9)) : array() as $index) {
        $class->addAttributes($attributes[$index]);
    }
}

XLite\Core\Database::getRepo('\XLite\Model\ProductClass')->flushChanges();
