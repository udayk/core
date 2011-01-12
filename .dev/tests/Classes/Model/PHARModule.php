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
 * @package    Tests
 * @subpackage Classes
 * @author     Creative Development LLC <info@cdev.ru> 
 * @copyright  Copyright (c) 2010 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version    SVN: $Id$
 * @link       http://www.litecommerce.com/
 * @see        ____file_see____
 * @since      3.0.0
 */

class XLite_Tests_Model_PHARModule extends XLite_Tests_TestCase
{

    private function getFile($file)
    {
        return dirname(__FILE__) . LC_DS . 'phars' . LC_DS . $file;
    }


    public function testBadConstruct()
    {
        @copy($this->getFile('bad.phar'), LC_LOCAL_REPOSITORY . 'bad.phar');

        try {

            $phar = new \XLite\Model\PHARModule('bad.phar');

        } catch (Exception $e) {

            $message = $e->getMessage();
        }

        $this->assertEquals(
            $message,
            'internal corruption of phar "' . LC_LOCAL_REPOSITORY . 'bad.phar' . '" (truncated entry)',
            'must be corrupted PHAR'
        );

        @unlink(LC_LOCAL_REPOSITORY . 'bad.phar');
    }

    public function testGoodConstruct()
    {
        @copy($this->getFile('good.phar'), LC_LOCAL_REPOSITORY . 'good.phar');

        $message = '';

        try {

            $phar = new \XLite\Model\PHARModule('good.phar');

        } catch (Exception $e) {

            $message = $e->getMessage();
        }

        $this->assertEquals('', $message, 'There must be no exceptions in the "Good" module');
        $this->assertTrue(is_object($phar) && !is_null($phar), 'PHAR object was not constructed');

        $phar->cleanUp();

        @unlink(LC_LOCAL_REPOSITORY . 'good.phar');
    }

    public function testCheck()
    {
        // NO ini file checking
        @copy($this->getFile('no_ini.phar'), LC_LOCAL_REPOSITORY . 'no_ini.phar');
        $phar = new \XLite\Model\PHARModule('no_ini.phar');
        $status = $phar->check();

        $this->assertEquals($status, 'wrong_structure', 'Wrong status for no INI file');

        $phar->cleanUp();
        @unlink(LC_LOCAL_REPOSITORY . 'no_ini.phar');

        // NO catalogs checking
        @copy($this->getFile('no_dir.phar'), LC_LOCAL_REPOSITORY . 'no_dir.phar');
        $phar = new \XLite\Model\PHARModule('no_dir.phar');
        $status = $phar->check();

        $this->assertEquals($status, 'wrong_structure', 'Wrong status for no DIR file');

        $phar->cleanUp();
        @unlink(LC_LOCAL_REPOSITORY . 'no_dir.phar');

        // Corrupted INI checking
        @copy($this->getFile('corrupted_ini.phar'), LC_LOCAL_REPOSITORY . 'corrupted_ini.phar');
        $phar = new \XLite\Model\PHARModule('corrupted_ini.phar');
        $status = $phar->check();

        $this->assertEquals($status, 'ini_corrupted', 'Wrong status for corrupted INI file');

        $phar->cleanUp();
        @unlink(LC_LOCAL_REPOSITORY . 'corrupted_ini.phar');

        // Wrong INI checking
        @copy($this->getFile('wrong_ini.phar'), LC_LOCAL_REPOSITORY . 'wrong_ini.phar');
        $phar = new \XLite\Model\PHARModule('wrong_ini.phar');
        $status = $phar->check();

        $this->assertEquals($status, 'wrong_specification', 'Wrong status for wrong INI file');

        $phar->cleanUp();
        @unlink(LC_LOCAL_REPOSITORY . 'wrong_ini.phar');

        // Already installed module checking
        @copy($this->getFile('already.phar'), LC_LOCAL_REPOSITORY . 'already.phar');
        $phar = new \XLite\Model\PHARModule('already.phar');
        $status = $phar->check();

        $this->assertEquals($status, 'wrong_install', 'Wrong status for already installed module');

        $phar->cleanUp();
        @unlink(LC_LOCAL_REPOSITORY . 'already.phar');

    }

    public function testDeploy()
    {
    }

    public function testCleanUp()
    {
    }

}
