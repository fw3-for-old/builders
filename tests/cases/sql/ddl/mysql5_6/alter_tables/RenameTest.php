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

/**
 * Rename
 */
class RenameTest extends AbstractTest
{
    const CLASS_PATH        = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\Rename";
    const TABLE_CLASS_PATH  = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Table";

    public function testFactory()
    {
        $table      = Table::factory('test_table1');
        $newTable   = Table::factory('test_table2');

        $rename = Rename::factory($table, $newTable);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $rename;
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $expected   = $table;
        $actual     = $rename->table();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = $newTable;
        $actual     = $rename->newTable();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table      = 'test_table1';
        $newTable   = 'test_table2';

        $rename = Rename::factory($table, $newTable);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $rename;
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $expected   = self::TABLE_CLASS_PATH;
        $actual     = $rename->table();
        $this->assertInstanceOf($expected, $actual);

        $expected   = $table;
        $actual     = $rename->table()->getName();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = self::TABLE_CLASS_PATH;
        $actual     = $rename->newTable();
        $this->assertInstanceOf($expected, $actual);

        $expected   = $newTable;
        $actual     = $rename->newTable()->getName();
        $this->assertSame($expected, $actual);
    }

    public function testBuild()
    {
        $table      = 'test_table1';
        $newTable   = 'test_table2';

        $rename = Rename::factory($table, $newTable);

        //----------------------------------------------
        $expected   = sprintf('ALTER TABLE `%s` RENAME TO `%s`;', $table, $newTable);
        $actual     = $rename->build();
        $this->assertSame($expected, $actual);
    }

    public function testClone()
    {
        $table      = 'test_table1';
        $newTable   = 'test_table2';

        $rename     = Rename::factory($table, $newTable);
        $withRename = $rename->with();

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $withRename;
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $expected   = $rename;
        $actual     = $withRename;
        $this->assertNotSame($expected, $actual);

        //----------------------------------------------
        $expected   = $rename->table();
        $actual     = $withRename->table();
        $this->assertNotSame($expected, $actual);

        $expected   = $rename->table()->getName();
        $actual     = $withRename->table()->getName();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = $rename->newTable();
        $actual     = $withRename->newTable();
        $this->assertNotSame($expected, $actual);

        $expected   = $rename->newTable()->getName();
        $actual     = $withRename->newTable()->getName();
        $this->assertSame($expected, $actual);
    }
}
