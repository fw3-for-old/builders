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

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\SmallintType;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * smallint型
 */
class SmallintTypeTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\SmallintType";
    const ERROR_NAME    = SmallintType::TYPE;
    protected static $NONE_ERROR    = array();

    public function testFactory()
    {
        //----------------------------------------------
        $expected   = 'smallint';
        $actual     = SmallintType::TYPE;
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $dataType   = SmallintType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));
    }

    public function testUnsigned()
    {
        //----------------------------------------------
        $dataType   = SmallintType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->unsigned();
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        //----------------------------------------------
        $unsigned   = true;

        $dataType   = SmallintType::factory($unsigned);

        $expected   = self::CLASS_PATH;
        $actual     = $dataType->signed();
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));
    }

    public function testBuild()
    {
        //----------------------------------------------
        $dataType   = SmallintType::factory();

        $expected   = 'smallint';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        //----------------------------------------------
        $unsigned   = true;

        $dataType   = SmallintType::factory($unsigned);

        $expected   = 'smallint unsigned';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        //----------------------------------------------
        $dataType   = SmallintType::factory()->signed();

        $expected   = 'smallint';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        //----------------------------------------------
        $dataType   = SmallintType::factory()->unsigned();

        $expected   = 'smallint unsigned';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));

        //----------------------------------------------
        $unsigned   = true;

        $dataType   = SmallintType::factory($unsigned)->signed();

        $expected   = 'smallint';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));
    }
}
