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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6;

use fw3_for_old\builders\sql\ddl\mysql5_6\AlterTable;
use fw3_for_old\builders\sql\ddl\mysql5_6\Table;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * ALTER Table Builder
 */
class AlterTableTest extends AbstractTest
{
    public function testRename()
    {
        $table      = Table::factory('test_table1');
        $newTable   = Table::factory('test_table2');

        //----------------------------------------------
        $expected   = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\Rename";
        $actual     = AlterTable::rename($table, $newTable);
        $this->assertInstanceOf($expected, $actual);
    }

    public function testAddColumn()
    {
        $table      = Table::factory('test_table1');

        //----------------------------------------------
        $expected   = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\AddColumn";
        $actual     = AlterTable::addColumn($table, 'test_column1');
        $this->assertInstanceOf($expected, $actual);
    }

    public function testDropColumn()
    {
        $table      = Table::factory('test_table1');

        //----------------------------------------------
        $expected   = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\DropColumn";
        $actual     = AlterTable::dropColumn($table, 'test_column1');
        $this->assertInstanceOf($expected, $actual);
    }

    public function testRenameColumn()
    {
        $table      = Table::factory('test_table1');

        //----------------------------------------------
        $expected   = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\RenameColumn";
        $actual     = AlterTable::renameColumn($table, 'test_column1', 'test_column2');
        $this->assertInstanceOf($expected, $actual);
    }

    public function testModifyColumn()
    {
        $table      = Table::factory('test_table1');

        //----------------------------------------------
        $expected   = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\ModifyColumn";
        $actual     = AlterTable::modifyColumn($table, 'test_column1');
        $this->assertInstanceOf($expected, $actual);
    }

    public function testChangeColumn()
    {
        $table      = Table::factory('test_table1');

        //----------------------------------------------
        $expected   = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\ChangeColumn";
        $actual     = AlterTable::changeColumn($table, 'test_column1', 'test_column2');
        $this->assertInstanceOf($expected, $actual);
    }

    public function testRenameIndexColumn()
    {
        $table      = Table::factory('test_table1');

        //----------------------------------------------
        $expected   = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\RenameIndex";
        $actual     = AlterTable::renameIndex($table, 'test_index1', 'test_index2');
        $this->assertInstanceOf($expected, $actual);
    }
}
