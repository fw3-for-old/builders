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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\alter_tables\sub_type;

use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\sub_type\ColumnInsertionPosition;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * ALTER Table Builder
 */
class ColumnInsertionPositionTest extends AbstractTest
{
    const CLASS_PATH        = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\sub_type\\ColumnInsertionPosition";
    const TABLE_CLASS_PATH  = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Table";
    const COLUMN_CLASS_PATH = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Column";

    public function testFactory()
    {
        $columnInsertionPosition    = ColumnInsertionPosition::factory();

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $columnInsertionPosition;
        $this->assertInstanceOf($expected, $actual);
    }

    public function testBuild()
    {
        //----------------------------------------------
        $columnInsertionPosition    = ColumnInsertionPosition::factory();

        $expected   = '';
        $actual     = $columnInsertionPosition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnInsertionPosition    = ColumnInsertionPosition::factory();

        $columnInsertionPosition->first();

        $expected   = 'FIRST';
        $actual     = $columnInsertionPosition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnInsertionPosition    = ColumnInsertionPosition::factory();

        $columnInsertionPosition->after('test_column');

        $expected   = 'AFTER `test_column`';
        $actual     = $columnInsertionPosition->build();
        $this->assertSame($expected, $actual);
    }
}
