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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\data_types\datetime_types;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\datetime_types\DateType;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * date型
 */
class DateTypeTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\DateType";
    const ERROR_NAME    = DateType::TYPE;
    protected static $NONE_ERROR    = array();

    public function testFactory()
    {
        //----------------------------------------------
        $expected   = 'date';
        $actual     = DateType::TYPE;
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $dataType   = DateType::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));
    }

    public function testBuild()
    {
        //----------------------------------------------
        $dataType   = DateType::factory();

        $expected   = 'date';
        $actual     = $dataType->build();
        $this->assertSame($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError(self::ERROR_NAME));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage(self::ERROR_NAME));
    }
}
