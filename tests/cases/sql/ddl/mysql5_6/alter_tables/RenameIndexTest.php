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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\alter_tables;

use fw3_for_old\builders\sql\ddl\mysql5_6\Table;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\RenameIndex;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * Rename Index
 */
class RenameIndexTest extends AbstractTest
{
    const CLASS_PATH        = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\RenameIndex";

    public function testFactory()
    {
        $table      = Table::factory('test_table1');

        $renameIndex = RenameIndex::factory($table, 'test_index1', 'test_index2');

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $renameIndex;
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $expected   = $table;
        $actual     = $renameIndex->table();
        $this->assertSame($expected, $actual);
    }

    public function testBuilde()
    {
        $table      = Table::factory('test_table1');

        //----------------------------------------------
        $renameIndex = RenameIndex::factory($table, 'test_index1', 'test_index2');

        $expected   = 'ALTER TABLE `test_table1` RENAME INDEX `test_index1` TO `test_index2`';
        $actual     = $renameIndex->build();
        $this->assertSame($expected, $actual);
    }
}
