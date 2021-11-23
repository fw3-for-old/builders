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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6;

use fw3_for_old\builders\sql\ddl\mysql5_6\Column;
use fw3_for_old\builders\sql\ddl\mysql5_6\Table;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\strings\converter\Convert;

/**
 * COLUM Builder
 */
class ColumnTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Column";

    public function testFactory()
    {
        //----------------------------------------------
        $name   = 'test_column';

        $column = Column::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $column;
        $this->assertInstanceOf($expected, $actual);


        $expected   = $name;
        $actual     = $column->name();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = null;
        $actual     = $column->table();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory('test_table');

        $expected   = self::CLASS_PATH;
        $actual     = $column->table($table);
        $this->assertInstanceOf($expected, $actual);

        $expected   = $table;
        $actual     = $column->table();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = $column;
        $actual     = $column->with();
        $this->assertNotSame($expected, $actual);
    }

    public function testName()
    {
        //----------------------------------------------
        $name   = 'test_column_2';

        $column = Column::factory('test_column');

        $expected   = self::CLASS_PATH;
        $actual     = $column->name($name);
        $this->assertInstanceOf($expected, $actual);

        $expected   = $name;
        $actual     = $column->name();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $name   = '1234567890123456789012345678901234567890123456789012345678901234';

        $column = Column::factory('test_column');

        $expected   = self::CLASS_PATH;
        $actual     = $column->name($name);
        $this->assertInstanceOf($expected, $actual);

        $expected   = $name;
        $actual     = $column->name();
        $this->assertSame($expected, $actual);
    }

    public function testNameException1()
    {
        //----------------------------------------------
        $name   = '';

        $column = Column::factory('test_column');

        $message    = 'カラム名が空です。';

        $this->assertException("\\Exception");
        $this->assertExceptionMessage($message);

        $column->name($name);
    }

    public function testNameException2()
    {
        //----------------------------------------------
        $name   = '12345678901234567890123456789012345678901234567890123456789012345';

        $column = Column::factory('test_column');

        $message    = sprintf('カラム名の最大文字列長を超過しました。name:%s, max_length:%d, length:%s', Convert::toDebugString($name, 2), Column::NAME_MAX_LENGTH, mb_strlen($name));

        $this->assertException("\\Exception");
        $this->assertExceptionMessage($message);

        $column->name($name);
    }

    public function testType()
    {
        $class_path = self::CLASS_PATH;

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->bit());

        $state  = $column->getState();

        $expected   = 'bit';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->bit(10));

        $state  = $column->getState();

        $expected   = 'bit(10)';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->tinyint());

        $state  = $column->getState();

        $expected   = 'tinyint';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->tinyint());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'tinyint unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->smallint());

        $state  = $column->getState();

        $expected   = 'smallint';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->smallint());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'smallint unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->mediumint());

        $state  = $column->getState();

        $expected   = 'mediumint';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->mediumint());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'mediumint unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->bigint());

        $state  = $column->getState();

        $expected   = 'bigint';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->bigint());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'bigint unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->int());

        $state  = $column->getState();

        $expected   = 'int';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->int());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'int unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->real());

        $state  = $column->getState();

        $expected   = 'real';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->real());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'real unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->real(10, 2));

        $state  = $column->getState();

        $expected   = 'real(10, 2)';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->real(10, 2));

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'real(10, 2) unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->double());

        $state  = $column->getState();

        $expected   = 'double';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->double());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'double unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->double(10, 2));

        $state  = $column->getState();

        $expected   = 'double(10, 2)';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->double(10, 2));

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'double(10, 2) unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->float());

        $state  = $column->getState();

        $expected   = 'float';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->float());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'float unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->float(10, 2));

        $state  = $column->getState();

        $expected   = 'float(10, 2)';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->float(10, 2));

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'float(10, 2) unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->decimal());

        $state  = $column->getState();

        $expected   = 'decimal';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->decimal());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'decimal unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->decimal(10, 2));

        $state  = $column->getState();

        $expected   = 'decimal(10, 2)';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->decimal(10, 2));

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'decimal(10, 2) unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->numeric());

        $state  = $column->getState();

        $expected   = 'numeric';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->numeric());

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'numeric unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->numeric(10, 2));

        $state  = $column->getState();

        $expected   = 'numeric(10, 2)';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->numeric(10, 2));

        $column->unsigned();

        $state  = $column->getState();

        $expected   = 'numeric(10, 2) unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->date());

        $state  = $column->getState();

        $expected   = 'date';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->time());

        $state  = $column->getState();

        $expected   = 'time';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->timestamp());

        $state  = $column->getState();

        $expected   = 'timestamp';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->datetime());

        $state  = $column->getState();

        $expected   = 'datetime';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->year());

        $state  = $column->getState();

        $expected   = 'year';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->char(10));

        $state  = $column->getState();

        $expected   = 'char(10)';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->varchar(10));

        $state  = $column->getState();

        $expected   = 'varchar(10)';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->text());

        $state  = $column->getState();

        $expected   = 'text';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->text());

        $column->binary();

        $state  = $column->getState();

        $expected   = 'text binary';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->mediumtext());

        $state  = $column->getState();

        $expected   = 'mediumtext';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->mediumtext());

        $column->binary();

        $state  = $column->getState();

        $expected   = 'mediumtext binary';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->longtext());

        $state  = $column->getState();

        $expected   = 'longtext';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->longtext());

        $column->binary();

        $state  = $column->getState();

        $expected   = 'longtext binary';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);
    }

    public function testUnsigned()
    {
        $class_path = self::CLASS_PATH;

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->unsigned());

        $column->tinyint();

        $state  = $column->getState();

        $expected   = 'tinyint unsigned';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);
    }

    public function testBinary()
    {
        $class_path = self::CLASS_PATH;

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->binary());

        $column->text();

        $state  = $column->getState();

        $expected   = 'text binary';
        $actual     = $state['date_type'];
        $this->assertSame($expected, $actual);
    }

    public function testNotNull()
    {
        $class_path = self::CLASS_PATH;

        //----------------------------------------------
        $column = Column::factory('test_column');

        $column->text();

        $state  = $column->getState();

        $expected   = null;
        $actual     = $state['not_null'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->notNull());

        $column->text();

        $state  = $column->getState();

        $expected   = 'NOT NULL';
        $actual     = $state['not_null'];
        $this->assertSame($expected, $actual);
    }

    public function testAutoIncremen()
    {
        $class_path = self::CLASS_PATH;

        //----------------------------------------------
        $column = Column::factory('test_column');

        $column->text();

        $state  = $column->getState();

        $expected   = null;
        $actual     = $state['auto_increment'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->autoIncrement());

        $column->text();

        $state  = $column->getState();

        $expected   = 'AUTO_INCREMENT';
        $actual     = $state['auto_increment'];
        $this->assertSame($expected, $actual);
    }

    public function testDefaultValue()
    {
        $class_path = self::CLASS_PATH;

        //----------------------------------------------
        $column = Column::factory('test_column');

        $column->int();

        $state  = $column->getState();

        $expected   = null;
        $actual     = $state['default'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $value  = 10;

        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->defaultValue($value));

        $column->int();

        $state  = $column->getState();

        $expected   = sprintf('DEFAULT \'%s\'', $value);
        $actual     = $state['default'];
        $this->assertSame($expected, $actual);
    }

    public function testComment()
    {
        $class_path = self::CLASS_PATH;

        //----------------------------------------------
        $column = Column::factory('test_column');

        $column->int();

        $state  = $column->getState();

        $expected   = null;
        $actual     = $state['comment'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $comment    = 'コメント';

        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->comment($comment));

        $column->int();

        $state  = $column->getState();

        $expected   = sprintf('COMMENT \'%s\'', $comment);
        $actual     = $state['comment'];
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $comment    = 'コメント';
        $map        = array(
            'type_a'  => 1,
            'type_b'  => 2,
            'type_c'  => 3,
        );

        $column = Column::factory('test_column');
        $this->assertInstanceOf($class_path, $column->comment($comment, $map));

        $column->int();

        $state  = $column->getState();

        if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
            $json_options   = constant("\\JSON_UNESCAPED_SLASHES") | constant("\\JSON_UNESCAPED_UNICODE");
        } else {
            $json_options   = 0;
        }

        $expected   = sprintf('COMMENT \'%s\'', sprintf('%s const:%s', $comment, json_encode($map, $json_options)));
        $actual     = $state['comment'];
        $this->assertSame($expected, $actual);
    }
}
