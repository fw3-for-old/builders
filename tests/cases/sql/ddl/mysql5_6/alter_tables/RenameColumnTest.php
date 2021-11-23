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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\alter_tables;

use fw3_for_old\builders\sql\ddl\mysql5_6\Table;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\DropColumn;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\RenameColumn;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * Rename Column
 */
class RenameColumnTest extends AbstractTest
{
    const CLASS_PATH        = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\RenameColumn";

    public function testFactory()
    {
        $table      = Table::factory('test_table1');

        $renameColumn = RenameColumn::factory($table, 'test_column1', 'test_column2');

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $renameColumn;
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $expected   = $table;
        $actual     = $renameColumn->table();
        $this->assertSame($expected, $actual);
    }

    public function testBuilde()
    {
        $table      = Table::factory('test_table1');

        //----------------------------------------------
        $renameColumn = RenameColumn::factory($table, 'test_column1', 'test_column2');

        $expected   = 'ALTER TABLE `test_table1` RENAME COLUMN `test_column1` TO `test_column2`';
        $actual     = $renameColumn->build();
        $this->assertSame($expected, $actual);
    }
}
