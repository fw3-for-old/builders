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
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\Rename;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\ModifyColumn;

/**
 * Modify Column
 */
class ModifyColumnTest extends AbstractTest
{
    const CLASS_PATH        = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\ModifyColumn";
    const COLUMN_CLASS_PATH = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Column";

    public function testFactory()
    {
        $table      = Table::factory('test_table1');

        $modifyColumn = ModifyColumn::factory($table, 'test_column1');

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $modifyColumn;
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $expected   = $table;
        $actual     = $modifyColumn->table();
        $this->assertSame($expected, $actual);
    }

    public function testBuilde()
    {
        //----------------------------------------------
        $modifyColumn = ModifyColumn::factory('test_table1', 'test_column1');

        $modifyColumn->real()
        ->setDigit(10, 5)
        ->unsigned()
        ->notNull()
        ->defaultValue(1.1)
        ->autoIncrement()
        ->unique()
        ->comment('コメント', array(
            '1' => 'def1',
            '2' => 'def2',
        ))
        ->fixed()
        ->memory();

        $expected   = 'ALTER TABLE `test_table1` MODIFY COLUMN `test_column1` real(10, 5) unsigned NOT NULL DEFAULT \'1.1\' AUTO_INCREMENT UNIQUE KEY COMMENT \'コメント const:{"1":"def1","2":"def2"}\' COLUMN_FORMAT FIXED STORAGE MEMORY';
        $actual     = $modifyColumn->build();
        $this->assertSame($expected, $actual);
    }
}
