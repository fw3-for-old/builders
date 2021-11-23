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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\data_types\numeric_types;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\BitType;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\strings\converter\Convert;

/**
 * bit型
 */
class BitTypeTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\BitType";
    const ERROR_NAME    = BitType::TYPE;
    protected static $NONE_ERROR    = array();

    public function testFactory()
    {
        //----------------------------------------------
        $expected   = 'bit';
        $actual     = BitType::TYPE;
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $dataType   = BitType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $length     = 1;

        $dataType   = BitType::factory($length);

        $expected   = self::CLASS_PATH;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);
    }

    public function testLength()
    {
        //----------------------------------------------
        $dataType   = BitType::factory();

        $expected   = null;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $length     = 1;

        $dataType   = BitType::factory($length);

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $length     = 10;

        $dataType   = BitType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = 10;

        $dataType   = BitType::factory(1);

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = null;

        $dataType   = BitType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length         = 'a';

        $error_message  = sprintf('ストレージサイズには数値のみを指定してください。length:%s', Convert::toDebugString($length, 2));
        $dataType   = BitType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($dataType->hasErrors());
        $this->assertTrue($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => array($error_message)), $dataType->getErrors());
        $this->assertSame(array($error_message), $dataType->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length         = 0;

        $error_message  = sprintf('ストレージサイズには%s以上を指定してください。length:%s', 1, Convert::toDebugString($length, 2));
        $dataType   = BitType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($dataType->hasErrors());
        $this->assertTrue($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => array($error_message)), $dataType->getErrors());
        $this->assertSame(array($error_message), $dataType->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length         = 65;

        $error_message  = sprintf('ストレージサイズには%s以下を指定してください。length:%s', 64, Convert::toDebugString($length, 2));
        $dataType   = BitType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($dataType->hasErrors());
        $this->assertTrue($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => array($error_message)), $dataType->getErrors());
        $this->assertSame(array($error_message), $dataType->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);
    }

    public function testBuild()
    {
        //----------------------------------------------
        $dataType   = BitType::factory();

        $expected   = 'bit';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $length     = 32;

        $dataType   = BitType::factory($length);

        $expected   = sprintf('bit(%d)', $length);
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));
    }
}
