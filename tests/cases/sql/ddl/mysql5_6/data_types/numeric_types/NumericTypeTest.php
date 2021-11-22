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

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\NumericType;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\strings\converter\Convert;

/**
 * numeric型
 */
class NumericTypeTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\NumericType";
    const ERROR_NAME    = NumericType::TYPE;
    protected static $NONE_ERROR    = array();

    public function testFactory()
    {
        //----------------------------------------------
        $expected   = 'numeric';
        $actual     = NumericType::TYPE;
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);
    }

    public function _testUnsigned()
    {
        //----------------------------------------------
        $dataType   = NumericType::factory();

        $expected   = false;
        $actual     = $dataType->unsigned();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $unsigned   = true;

        $dataType   = NumericType::factory($unsigned);

        $expected   = $unsigned;
        $actual     = $dataType->unsigned();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $unsigned   = true;

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->unsigned($unsigned);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = $unsigned;
        $actual     = $dataType->unsigned();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $unsigned   = false;

        $dataType   = NumericType::factory(true);

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->unsigned($unsigned);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = $unsigned;
        $actual     = $dataType->unsigned();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $unsigned   = null;

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->unsigned($unsigned);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = false;
        $actual     = $dataType->unsigned();
        $this->assertSame($expected, $actual);
    }

    public function testSetDigit()
    {
        //----------------------------------------------
        $length     = 10;

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->setDigit($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = 10;
        $decimals   = 5;

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->setDigit($length, $decimals);

        $expected   = $length;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = $decimals;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->setDigit($length, null);

        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = 10;
        $decimals   = 5;

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->setDigit($length, $decimals);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = $decimals;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = -10;
        $decimals   = 5;

        $error_message  = array(sprintf('桁数は1以上を指定してください。length:%s', Convert::toDebugString($length, 2)));

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->setDigit($length, $decimals);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($dataType->hasErrors());
        $this->assertTrue($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $dataType->getErrors());
        $this->assertSame($error_message, $dataType->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = 'a';
        $decimals   = 5;

        $error_message  = array(sprintf('桁数には数値のみを指定してください。length:%s', Convert::toDebugString($length, 2)));

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->setDigit($length, $decimals);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($dataType->hasErrors());
        $this->assertTrue($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $dataType->getErrors());
        $this->assertSame($error_message, $dataType->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = 10;
        $decimals   = -5;

        $error_message  = array(sprintf('小数点以下の桁数は0以上を指定してください。decimals:%s', Convert::toDebugString($decimals, 2)));

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->setDigit($length, $decimals);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($dataType->hasErrors());
        $this->assertTrue($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $dataType->getErrors());
        $this->assertSame($error_message, $dataType->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = 10;
        $decimals   = 'a';

        $error_message  = array(sprintf('小数点以下の桁数には数値のみを指定してください。decimals:%s', Convert::toDebugString($decimals, 2)));

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->setDigit($length, $decimals);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($dataType->hasErrors());
        $this->assertTrue($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $dataType->getErrors());
        $this->assertSame($error_message, $dataType->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = 1;
        $decimals   = 1;

        $error_message  = array(sprintf('小数点以下の桁数は桁数 - 1に収まるようにしてください。length:%s, decimals:%s', Convert::toDebugString($length, 2), Convert::toDebugString($decimals, 2)));

        $dataType   = NumericType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->setDigit($length, $decimals);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($dataType->hasErrors());
        $this->assertTrue($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => $error_message), $dataType->getErrors());
        $this->assertSame($error_message, $dataType->getError(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->getLength();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $dataType->getDecimals();
        $this->assertSame($expected, $actual);
    }

    public function testBuild()
    {
        $length     = 10;
        $decimals   = 5;
        $unsigned   = true;

        //----------------------------------------------
        $dataType   = NumericType::factory();

        $expected   = 'numeric';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $dataType   = NumericType::factory($length);

        $expected   = 'numeric(10)';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $dataType   = NumericType::factory($length, $decimals);

        $expected   = 'numeric(10, 5)';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $dataType   = NumericType::factory($length, $decimals, $unsigned);

        $expected   = 'numeric(10, 5) unsigned';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $dataType   = NumericType::factory()->unsigned();

        $expected   = 'numeric unsigned';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $dataType   = NumericType::factory()->unsigned()->signed();

        $expected   = 'numeric';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $dataType   = NumericType::factory()->setDigit($length, $decimals);

        $expected   = 'numeric(10, 5)';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));

        //----------------------------------------------
        $dataType   = NumericType::factory()->setDigit($length, $decimals)->unsigned();

        $expected   = 'numeric(10, 5) unsigned';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrors());
        $this->assertSame(self::$NONE_ERROR, $dataType->getError(self::ERROR_NAME));
    }
}
