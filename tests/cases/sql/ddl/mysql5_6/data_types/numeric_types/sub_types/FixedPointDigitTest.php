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
 * @package     builders
 * @author      akira wakaba <wakabadou@gmail.com>
 * @copyright   Copyright (c) @2020  Wakabadou (http://www.wakabadou.net/) / Project ICKX (https://ickx.jp/). All rights reserved.
 * @license     http://opensource.org/licenses/MIT The MIT License.
 *              This software is released under the MIT License.
 * @varsion     1.0.0
 */

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\data_types\numeric_types;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\sub_types\FixedPointDigit;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\strings\converter\Convert;

/**
 * サブタイプ：固定小数点型用桁情報
 */
class FixedPointDigitTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\sub_types\\FixedPointDigit";
    const ERROR_NAME    = FixedPointDigit::TYPE;
    protected static $NONE_ERROR    = array();

    public function testFactory()
    {
        //----------------------------------------------
        $expected   = 'fixed_point_digit';
        $actual     = FixedPointDigit::TYPE;
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $decimalPointDigit    = FixedPointDigit::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $decimalPointDigit;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($decimalPointDigit->hasErrors());
        $this->assertFalse($decimalPointDigit->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $decimalPointDigit->getErrors());
        $this->assertSame(self::$NONE_ERROR, $decimalPointDigit->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $decimalPointDigit->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $decimalPointDigit->getDecimals();
        $this->assertSame($expected, $actual);

        $actual     = $decimalPointDigit->enabled();
        $this->assertFalse($actual);

        //----------------------------------------------
        $length     = 10;
        $decimals   = 5;

        $decimalPointDigit    = FixedPointDigit::factory($length, $decimals);

        $expected   = self::CLASS_PATH;
        $actual     = $decimalPointDigit;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($decimalPointDigit->hasErrors());
        $this->assertFalse($decimalPointDigit->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $decimalPointDigit->getErrors());
        $this->assertSame(self::$NONE_ERROR, $decimalPointDigit->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $decimalPointDigit->getLength();
        $this->assertSame($expected, $actual);

        $expected   = $decimals;
        $actual     = $decimalPointDigit->getDecimals();
        $this->assertSame($expected, $actual);

        $actual     = $decimalPointDigit->enabled();
        $this->assertTrue($actual);

        //----------------------------------------------
        $length     = 10;

        $decimalPointDigit    = FixedPointDigit::factory($length);

        $expected   = self::CLASS_PATH;
        $actual     = $decimalPointDigit;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($decimalPointDigit->hasErrors());
        $this->assertFalse($decimalPointDigit->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $decimalPointDigit->getErrors());
        $this->assertSame(self::$NONE_ERROR, $decimalPointDigit->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $decimalPointDigit->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $decimalPointDigit->getDecimals();
        $this->assertSame($expected, $actual);

        $actual     = $decimalPointDigit->enabled();
        $this->assertTrue($actual);
    }

    public function testSetDigit()
    {
        //----------------------------------------------
        $length     = 10;
        $decimals   = 5;

        $decimalPointDigit    = FixedPointDigit::factory()->setDigit($length, $decimals);

        $expected   = self::CLASS_PATH;
        $actual     = $decimalPointDigit;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($decimalPointDigit->hasErrors());
        $this->assertFalse($decimalPointDigit->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $decimalPointDigit->getErrors());
        $this->assertSame(self::$NONE_ERROR, $decimalPointDigit->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $decimalPointDigit->getLength();
        $this->assertSame($expected, $actual);

        $expected   = $decimals;
        $actual     = $decimalPointDigit->getDecimals();
        $this->assertSame($expected, $actual);

        $actual     = $decimalPointDigit->enabled();
        $this->assertTrue($actual);

        //----------------------------------------------
        $length     = -10;
        $decimals   = 5;

        $error_message  = array(sprintf('桁数は1以上を指定してください。length:%s', Convert::toDebugString($length, 2)));

        $decimalPointDigit    = FixedPointDigit::factory()->setDigit($length, $decimals);

        $expected   = self::CLASS_PATH;
        $actual     = $decimalPointDigit;
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($decimalPointDigit->hasErrors());
        $this->assertTrue($decimalPointDigit->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $decimalPointDigit->getErrors());
        $this->assertSame($error_message, $decimalPointDigit->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $decimalPointDigit->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $decimalPointDigit->getDecimals();
        $this->assertSame($expected, $actual);

        $actual     = $decimalPointDigit->enabled();
        $this->assertFalse($actual);

        //----------------------------------------------
        $length     = 'a';
        $decimals   = 5;

        $error_message  = array(sprintf('桁数には数値のみを指定してください。length:%s', Convert::toDebugString($length, 2)));

        $decimalPointDigit    = FixedPointDigit::factory()->setDigit($length, $decimals);

        $expected   = self::CLASS_PATH;
        $actual     = $decimalPointDigit;
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($decimalPointDigit->hasErrors());
        $this->assertTrue($decimalPointDigit->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $decimalPointDigit->getErrors());
        $this->assertSame($error_message, $decimalPointDigit->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $decimalPointDigit->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $decimalPointDigit->getDecimals();
        $this->assertSame($expected, $actual);

        $actual     = $decimalPointDigit->enabled();
        $this->assertFalse($actual);

        //----------------------------------------------
        $length     = 10;
        $decimals   = -5;

        $error_message  = array(sprintf('小数点以下の桁数は0以上を指定してください。decimals:%s', Convert::toDebugString($decimals, 2)));

        $decimalPointDigit    = FixedPointDigit::factory()->setDigit($length, $decimals);

        $expected   = self::CLASS_PATH;
        $actual     = $decimalPointDigit;
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($decimalPointDigit->hasErrors());
        $this->assertTrue($decimalPointDigit->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $decimalPointDigit->getErrors());
        $this->assertSame($error_message, $decimalPointDigit->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $decimalPointDigit->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $decimalPointDigit->getDecimals();
        $this->assertSame($expected, $actual);

        $actual     = $decimalPointDigit->enabled();
        $this->assertFalse($actual);

        //----------------------------------------------
        $length     = 10;
        $decimals   = 'a';

        $error_message  = array(sprintf('小数点以下の桁数には数値のみを指定してください。decimals:%s', Convert::toDebugString($decimals, 2)));

        $decimalPointDigit    = FixedPointDigit::factory()->setDigit($length, $decimals);

        $expected   = self::CLASS_PATH;
        $actual     = $decimalPointDigit;
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($decimalPointDigit->hasErrors());
        $this->assertTrue($decimalPointDigit->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $decimalPointDigit->getErrors());
        $this->assertSame($error_message, $decimalPointDigit->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $decimalPointDigit->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $decimalPointDigit->getDecimals();
        $this->assertSame($expected, $actual);

        $actual     = $decimalPointDigit->enabled();
        $this->assertFalse($actual);

        //----------------------------------------------
        $length     = 1;
        $decimals   = 1;

        $error_message  = array(sprintf('小数点以下の桁数は桁数 - 1に収まるようにしてください。length:%s, decimals:%s', Convert::toDebugString($length, 2), Convert::toDebugString($decimals, 2)));

        $decimalPointDigit    = FixedPointDigit::factory()->setDigit($length, $decimals);

        $expected   = self::CLASS_PATH;
        $actual     = $decimalPointDigit;
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($decimalPointDigit->hasErrors());
        $this->assertTrue($decimalPointDigit->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $decimalPointDigit->getErrors());
        $this->assertSame($error_message, $decimalPointDigit->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $decimalPointDigit->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $decimalPointDigit->getDecimals();
        $this->assertSame($expected, $actual);

        $actual     = $decimalPointDigit->enabled();
        $this->assertFalse($actual);
    }
}
