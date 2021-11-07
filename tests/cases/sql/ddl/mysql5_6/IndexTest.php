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

use fw3_for_old\builders\sql\ddl\mysql5_6\Index;
use fw3_for_old\builders\sql\ddl\mysql5_6\Table;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * INDEX Builder
 */
class IndexTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Index";

    public function testFactory()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $index  = Index::factory($table);

        $expected   = self::CLASS_PATH;
        $actual     = $index;
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table, 'index_name');

        $expected   = self::CLASS_PATH;
        $actual     = $index;
        $this->assertInstanceOf($expected, $actual);
    }

    public function testName()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $name   = 'test_index';

        $index  = Index::factory($table);

        $expected   = self::CLASS_PATH;
        $actual     = $index->name($name);
        $this->assertInstanceOf($expected, $actual);

        $expected   = $name;
        $actual     = $index->name();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $name   = '1234567890123456789012345678901234567890123456789012345678901234';

        $column = Index::factory('test_column');

        $expected   = self::CLASS_PATH;
        $actual     = $column->name($name);
        $this->assertInstanceOf($expected, $actual);

        $expected   = $name;
        $actual     = $column->name();
        $this->assertSame($expected, $actual);
    }

    public function testNameException1()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $name   = '';

        $column = Index::factory($table, 'test_index');

        $message    = 'インデックス名が空です。';

        $this->assertException("\\Exception");
        $this->assertExceptionMessage($message);

        $column->name($name);
    }

    public function testPrimaryKey()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $index  = Index::factory($table);
        $this->assertFalse($index->isPrimaryKey());

        //----------------------------------------------
        $index  = Index::factory($table);
        $index->primaryKey();
        $this->assertTrue($index->isPrimaryKey());
    }

    public function testMultiKey()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $index  = Index::factory($table);
        $this->assertFalse($index->isMulti());

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->column('test_column_1');

        $this->assertFalse($index->isMulti());

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->column('test_column_1');
        $index->column('test_column_2');

        $this->assertTrue($index->isMulti());
    }

    public function testColumn()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $index  = Index::factory($table);

        $expected   = self::CLASS_PATH;
        $actual     = $index->column('test_column_1');

        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table);

        $name   = 'test_column_1';

        $index->column($name);

        $state  = $index->getState();

        $expected   = sprintf('(`%s`)', $name);
        $actual     = $state['column'];

        $this->assertSame($expected, $actual);

        $expected   = sprintf('idx_%s_%s', $name, $table->getName());
        $actual     = $state['name'];

        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table);

        $name1  = 'test_column_1';
        $index->column($name1);

        $name2  = 'test_column_2';
        $index->column($name2);

        $state  = $index->getState();

        $expected   = sprintf('(`%s`, `%s`)', $name1, $name2);
        $actual     = $state['column'];

        $this->assertSame($expected, $actual);

        $expected   = sprintf('idx_%s_%s_%s', $name1, $name2, $table->getName());
        $actual     = $state['name'];

        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table);

        $name1  = 'test_column_1';
        $index->column($name1);

        $name2  = 'test_column_2';
        $index->column($name2);

        $state  = $index->getState(1);

        $expected   = sprintf('(`%s`, `%s`)', $name1, $name2);
        $actual     = $state['column'];

        $this->assertSame($expected, $actual);

        $expected   = sprintf('idx_mul01_%s', $table->getName());
        $actual     = $state['name'];

        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table);

        $name1  = 'test_column_1';
        $index->column($name1, 10, Index::ORDER_ASC);

        $name2  = 'test_column_2';
        $index->column($name2, 20, Index::ORDER_DESC);

        $state  = $index->getState();

        $expected   = sprintf('(`%s` (%s) %s, `%s` (%s) %s)', $name1, 10, Index::ORDER_ASC, $name2, 20, Index::ORDER_DESC);
        $actual     = $state['column'];

        $this->assertSame($expected, $actual);
    }

    public function testUnique()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->column('test_column_1');

        $state  = $index->getState();

        $expected   = 'INDEX';
        $actual     = $state['type'];

        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->column('test_column_1');

        $expected   = self::CLASS_PATH;
        $actual     = $index->unique();

        $this->assertInstanceOf($expected, $actual);

        $state  = $index->getState();

        $expected   = 'UNIQUE INDEX';
        $actual     = $state['type'];

        $this->assertSame($expected, $actual);
    }

    public function testFulltext()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->column('test_column_1');

        $expected   = self::CLASS_PATH;
        $actual     = $index->fulltext();

        $this->assertInstanceOf($expected, $actual);

        $state  = $index->getState();

        $expected   = 'FULLTEXT INDEX';
        $actual     = $state['type'];

        $this->assertSame($expected, $actual);
    }

    public function testGetState()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->primaryKey();

        $name   = 'test_column_1';
        $index->column($name);

        $expected   = array(
            'type'      => 'PRIMARY KEY',
            'name'      => null,
            'column'    => sprintf('(`%s`)', $name),
            'comment'   => '',
        );
        $actual     = $index->getState();

        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->primaryKey();

        $name   = 'test_column_1';
        $index->column($name);

        $comment    = 'コメント';
        $index->comment($comment);

        $expected   = array(
            'type'      => 'PRIMARY KEY',
            'name'      => null,
            'column'    => sprintf('(`%s`)', $name),
            'comment'   => sprintf('COMMENT \'%s\'', $comment),
        );
        $actual     = $index->getState();

        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->primaryKey();

        $name   = 'test_column_1';
        $index->column($name);

        $comment    = 'コメント';
        $index->comment($comment);

        $expected   = array(
            'type'      => 'PRIMARY KEY',
            'name'      => null,
            'column'    => sprintf('(`%s`)', $name),
            'comment'   => sprintf('COMMENT \'%s\'', $comment),
        );
        $actual     = $index->getState();

        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->unique();

        $name   = 'test_column_1';
        $index->column($name);

        $comment    = 'コメント';
        $index->comment($comment);

        $expected   = array(
            'type'      => 'UNIQUE INDEX',
            'name'      => sprintf('idx_%s_%s', $name, $table->getName()),
            'column'    => sprintf('(`%s`)', $name),
            'comment'   => sprintf('COMMENT \'%s\'', $comment),
        );
        $actual     = $index->getState();

        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $index  = Index::factory($table);

        $index->fulltext();

        $name   = 'test_column_1';
        $index->column($name);

        $comment    = 'コメント';
        $index->comment($comment);

        $expected   = array(
            'type'      => 'FULLTEXT INDEX',
            'name'      => sprintf('idx_%s_%s', $name, $table->getName()),
            'column'    => sprintf('(`%s`)', $name),
            'comment'   => sprintf('COMMENT \'%s\'', $comment),
        );
        $actual     = $index->getState();

        $this->assertSame($expected, $actual);
    }

    public function testBuild()
    {
        $table  = Table::factory('test_table');

        //----------------------------------------------
        $index  = Index::factory($table);

        $name   = 'test_column_1';

        $index->column($name);

        $expected   = sprintf('INDEX idx_test_column_1_test_table (`%s`)', $name);
        $actual     = $index->build();

        $this->assertSame($expected, $actual);
    }
}
