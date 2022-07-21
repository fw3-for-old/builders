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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\data_types\string_types;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types\CharType;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\strings\converter\Convert;

/**
 * char型
 */
class CharTypeTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\CharType";
    const ERROR_NAME    = CharType::TYPE;
    protected static $NONE_ERROR    = array();

    public function testFactory()
    {
        //----------------------------------------------
        $expected   = 'char';
        $actual     = CharType::TYPE;
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $dataType   = CharType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        //----------------------------------------------
        $length     = 1;

        $dataType   = CharType::factory($length);

        $expected   = self::CLASS_PATH;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);
    }

    public function testLength()
    {
        //----------------------------------------------
        $dataType   = CharType::factory();

        $expected   = null;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        //----------------------------------------------
        $length     = 1;

        $dataType   = CharType::factory($length);

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        //----------------------------------------------
        $length     = 10;

        $dataType   = CharType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = 10;

        $dataType   = CharType::factory(1);

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length     = null;

        $dataType   = CharType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        $expected   = $length;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $length         = 'a';

        $error_message  = sprintf('文字列長には数値のみを指定してください。length:%s', Convert::toDebugString($length, 2));
        $dataType   = CharType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->length($length);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($dataType->hasErrors());
        $this->assertTrue($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(array(self::ERROR_NAME => array($error_message)), $dataType->getErrorsMessage());
        $this->assertSame(array($error_message), $dataType->getErrorMessage(self::ERROR_NAME));

        $expected   = null;
        $actual     = $dataType->length();
        $this->assertSame($expected, $actual);
    }

    public function testBuild()
    {
        //----------------------------------------------
        $dataType   = CharType::factory();

        $expected   = 'char';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        //----------------------------------------------
        $length     = 32;

        $dataType   = CharType::factory($length);

        $expected   = sprintf('char(%d)', $length);
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));
    }
}
