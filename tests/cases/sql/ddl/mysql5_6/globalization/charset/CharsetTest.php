<?php
/**    _______       _______
 *    / ____/ |     / /__  /
 *   / /_   | | /| / / /_ <
 *  / __/   | |/ |/ /___/ /
 * /_/      |__/|__//____/
 *
 * Flywheel3: the inertia php framework for old php versions
 *
 * @category    Flywheel3
 * @package     strings
 * @author      akira wakaba <wakabadou@gmail.com>
 * @copyright   Copyright (c) @2020  Wakabadou (http://www.wakabadou.net/) / Project ICKX (https://ickx.jp/). All rights reserved.
 * @license     http://opensource.org/licenses/MIT The MIT License.
 *              This software is released under the MIT License.
 * @varsion     1.0.0
 */

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\globalization\charset;

use fw3_for_old\builders\sql\ddl\mysql5_6\globalization\charset\Charset;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\strings\converter\Convert;

/**
 * 文字セット
 */
class CharsetTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\globalization\\charset\\Charset";

    public function testFactory()
    {
        //----------------------------------------------
        $charset  = Charset::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $charset;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Charset::DEFAULT_CHARSET;
        $actual     = $charset->charset();
        $this->assertSame($expected, $actual);
        $this->assertFalse($charset->hasErrors());
        $this->assertFalse($charset->hasError('charset'));
        $this->assertSame(array(), $charset->getErrors());
        $this->assertSame(array(), $charset->getError('charset'));

        $expected   = Charset::DEFAULT_CHARSET;
        $actual     = $charset->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $charset  = Charset::factory(null);

        $expected   = self::CLASS_PATH;
        $actual     = $charset;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Charset::DEFAULT_CHARSET;
        $actual     = $charset->charset();
        $this->assertSame($expected, $actual);
        $this->assertFalse($charset->hasErrors());
        $this->assertFalse($charset->hasError('charset'));
        $this->assertSame(array(), $charset->getErrors());
        $this->assertSame(array(), $charset->getError('charset'));

        $expected   = Charset::DEFAULT_CHARSET;
        $actual     = $charset->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $charset  = Charset::factory(Charset::CP932);

        $expected   = self::CLASS_PATH;
        $actual     = $charset;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Charset::CP932;
        $actual     = $charset->charset();
        $this->assertSame($expected, $actual);
        $this->assertFalse($charset->hasErrors());
        $this->assertFalse($charset->hasError('charset'));
        $this->assertSame(array(), $charset->getErrors());
        $this->assertSame(array(), $charset->getError('charset'));

        $expected   = Charset::CP932;
        $actual     = $charset->build();
        $this->assertSame($expected, $actual);
    }

    public function testCharset()
    {
        //----------------------------------------------
        $charset  = Charset::factory()->charset(Charset::CP932);

        $expected   = self::CLASS_PATH;
        $actual     = $charset;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Charset::CP932;
        $actual     = $charset->charset();
        $this->assertSame($expected, $actual);
        $this->assertFalse($charset->hasErrors());
        $this->assertFalse($charset->hasError('charset'));
        $this->assertSame(array(), $charset->getErrors());
        $this->assertSame(array(), $charset->getError('charset'));

        $expected   = Charset::CP932;
        $actual     = $charset->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $charset        = Charset::factory();
        $charset_name   = 'aaaaaaaa';
        $message        = sprintf('未知の文字セットを与えられました。charset:%s', Convert::toDebugString($charset_name, 2));

        $expected   = self::CLASS_PATH;
        $actual     = $charset->charset($charset_name);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($charset->hasErrors());
        $this->assertTrue($charset->hasError('charset'));
        $this->assertSame(array('charset' => array($message)), $charset->getErrors());
        $this->assertSame(array($message), $charset->getError('charset'));

        //----------------------------------------------
        $charset        = Charset::factory();
        $charset_name   = null;
        $message        = sprintf('未知の文字セットを与えられました。charset:%s', Convert::toDebugString($charset_name, 2));

        $expected   = self::CLASS_PATH;
        $actual     = $charset->charset($charset_name);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($charset->hasErrors());
        $this->assertTrue($charset->hasError('charset'));
        $this->assertSame(array('charset' => array($message)), $charset->getErrors());
        $this->assertSame(array($message), $charset->getError('charset'));
    }
}
