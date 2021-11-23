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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\create_definition;

use fw3_for_old\builders\sql\ddl\mysql5_6\create_definition\ColumnFormat;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * ColumnFormat
 */
class ColumnFormatTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\create_definition\\ColumnFormat";
    protected static $NONE_ERROR    = array();

    public function testColumnFormat()
    {
        $columnFormat   = ColumnFormat::factory();

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $columnFormat;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($columnFormat->exists());

        $expected   = '';
        $actual     = $columnFormat->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $columnFormat->fixed();
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($columnFormat->exists());

        $expected   = 'COLUMN_FORMAT FIXED';
        $actual     = $columnFormat->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $columnFormat->dynamic();
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($columnFormat->exists());

        $expected   = 'COLUMN_FORMAT DYNAMIC';
        $actual     = $columnFormat->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $columnFormat->defaultFormat();
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($columnFormat->exists());

        $expected   = 'COLUMN_FORMAT DEFAULT';
        $actual     = $columnFormat->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnFormat->fixed();
        $this->assertTrue($columnFormat->exists());

        $expected   = self::CLASS_PATH;
        $actual     = $columnFormat->unsetFormat();
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($columnFormat->exists());

        $expected   = '';
        $actual     = $columnFormat->build();
        $this->assertSame($expected, $actual);
    }
}
