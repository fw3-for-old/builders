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
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\Rename;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\DropColumn;

/**
 * Drop Column
 */
class DropColumnTest extends AbstractTest
{
    const CLASS_PATH        = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\alter_tables\\DropColumn";

    public function testFactory()
    {
        $table      = Table::factory('test_table1');

        $dropColumn = DropColumn::factory($table, 'test_column1');

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $dropColumn;
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $expected   = $table;
        $actual     = $dropColumn->table();
        $this->assertSame($expected, $actual);
    }

    public function testBuilde()
    {
        //----------------------------------------------
        $dropColumn = DropColumn::factory('test_table1', 'test_column1');

        $expected   = 'ALTER TABLE `test_table1` DROP COLUMN `test_column1`';
        $actual     = $dropColumn->build();
        $this->assertSame($expected, $actual);
    }
}
