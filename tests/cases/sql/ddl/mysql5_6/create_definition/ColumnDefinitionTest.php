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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\create_definition;

use fw3_for_old\builders\sql\ddl\mysql5_6\create_definition\ColumnDefinition;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * ColumnDefinition
 */
class ColumnDefinitionTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\create_definition\\ColumnDefinition";
    protected static $NONE_ERROR    = array();

    protected function getStateFomat($data)
    {
        $format = array(
            'data_type'         => null,
            'not_null'          => null,
            'default'           => null,
            'auto_increment'    => null,
            'key'               => null,
            'comment'           => null,
            'column_format'     => null,
            'storage'           => null,
        );

        foreach ($data as $key => $value) {
            $format[$key]   = $value;
        }

        return $format;
    }

    public function testFactory()
    {
        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $columnDefinition;
        $this->assertInstanceOf($expected, $actual);
    }

    public function testDataType()
    {
        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->bit();

        $expected   = $this->getStateFomat(array('data_type' => 'bit'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'bit';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        $expected   = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\BitType";
        $actual     = $columnDefinition->getDataType();
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->bit()->length(32);

        $expected   = $this->getStateFomat(array('data_type' => 'bit(32)'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'bit(32)';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->int();

        $expected   = $this->getStateFomat(array('data_type' => 'int'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'int';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->int()->unsigned();

        $expected   = $this->getStateFomat(array('data_type' => 'int unsigned'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'int unsigned';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->tinyint();

        $expected   = $this->getStateFomat(array('data_type' => 'tinyint'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'tinyint';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->smallint();

        $expected   = $this->getStateFomat(array('data_type' => 'smallint'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'smallint';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->mediumint();

        $expected   = $this->getStateFomat(array('data_type' => 'mediumint'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'mediumint';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->bigint();

        $expected   = $this->getStateFomat(array('data_type' => 'bigint'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'bigint';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->real();

        $expected   = $this->getStateFomat(array('data_type' => 'real'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'real';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->real()->setDigit(10, 5)->unsigned();

        $expected   = $this->getStateFomat(array('data_type' => 'real(10, 5) unsigned'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'real(10, 5) unsigned';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->double();

        $expected   = $this->getStateFomat(array('data_type' => 'double'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'double';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->float();

        $expected   = $this->getStateFomat(array('data_type' => 'float'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'float';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->decimal();

        $expected   = $this->getStateFomat(array('data_type' => 'decimal'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'decimal';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->decimal()->setDigit(10, 5)->unsigned();

        $expected   = $this->getStateFomat(array('data_type' => 'decimal(10, 5) unsigned'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'decimal(10, 5) unsigned';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->numeric();

        $expected   = $this->getStateFomat(array('data_type' => 'numeric'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'numeric';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->date();

        $expected   = $this->getStateFomat(array('data_type' => 'date'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'date';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->time();

        $expected   = $this->getStateFomat(array('data_type' => 'time'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'time';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->timestamp();

        $expected   = $this->getStateFomat(array('data_type' => 'timestamp'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'timestamp';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->datetime();

        $expected   = $this->getStateFomat(array('data_type' => 'datetime'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'datetime';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->year();

        $expected   = $this->getStateFomat(array('data_type' => 'year'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'year';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->char();

        $expected   = $this->getStateFomat(array('data_type' => 'char'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'char';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->char()->length(32);

        $expected   = $this->getStateFomat(array('data_type' => 'char(32)'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'char(32)';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->varchar();

        $expected   = $this->getStateFomat(array('data_type' => 'varchar'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'varchar';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->text();

        $expected   = $this->getStateFomat(array('data_type' => 'text'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'text';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->text()->binary();

        $expected   = $this->getStateFomat(array('data_type' => 'text binary'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'text binary';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->mediumtext();

        $expected   = $this->getStateFomat(array('data_type' => 'mediumtext'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'mediumtext';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->longtext();

        $expected   = $this->getStateFomat(array('data_type' => 'longtext'));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'longtext';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);
    }

    public function testBuild()
    {
        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->real()
        ->setDigit(10, 5)
        ->unsigned()
        ->notNull()
        ->defaultValue(1.1)
        ->autoIncrement()
        ->unique()
        ->comment('コメント')
        ->fixed()
        ->memory();

        $expected   = $this->getStateFomat(array(
            'data_type'         => 'real(10, 5) unsigned',
            'not_null'          => 'NOT NULL',
            'default'           => 'DEFAULT \'1.1\'',
            'auto_increment'    => 'AUTO_INCREMENT',
            'key'               => 'UNIQUE KEY',
            'comment'           => 'COMMENT \'コメント\'',
            'column_format'     => 'COLUMN_FORMAT FIXED',
            'storage'           => 'STORAGE MEMORY',
        ));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'real(10, 5) unsigned NOT NULL DEFAULT \'1.1\' AUTO_INCREMENT UNIQUE KEY COMMENT \'コメント\' COLUMN_FORMAT FIXED STORAGE MEMORY';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $columnDefinition   = ColumnDefinition::factory();

        $columnDefinition->real()
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

        $expected   = $this->getStateFomat(array(
            'data_type'         => 'real(10, 5) unsigned',
            'not_null'          => 'NOT NULL',
            'default'           => 'DEFAULT \'1.1\'',
            'auto_increment'    => 'AUTO_INCREMENT',
            'key'               => 'UNIQUE KEY',
            'comment'           => 'COMMENT \'コメント const:{"1":"def1","2":"def2"}\'',
            'column_format'     => 'COLUMN_FORMAT FIXED',
            'storage'           => 'STORAGE MEMORY',
        ));
        $actual     = $columnDefinition->getState();
        $this->assertSame($expected, $actual);

        $expected   = 'real(10, 5) unsigned NOT NULL DEFAULT \'1.1\' AUTO_INCREMENT UNIQUE KEY COMMENT \'コメント const:{"1":"def1","2":"def2"}\' COLUMN_FORMAT FIXED STORAGE MEMORY';
        $actual     = $columnDefinition->build();
        $this->assertSame($expected, $actual);
    }
}
