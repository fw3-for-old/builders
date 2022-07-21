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

namespace fw3_for_old\builders\sql\ddl\mysql5_6;

use fw3_for_old\builders\sql\ddl\mysql5_6\globalization\charset\Charset;
use fw3_for_old\builders\sql\ddl\mysql5_6\globalization\collation\Collation;
use fw3_for_old\builders\sql\ddl\mysql5_6\storage_engine\StorageEngine;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\strings\converter\Convert;

/**
 * CREATE TABLE Builder
 */
class TableTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Table";

    const COLUMN_CLASS_PATH = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Column";

    const INDEX_CLASS_PATH  = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Index";

    public function testFactory()
    {
        //----------------------------------------------
        $name   = 'test_table';

        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table;
        $this->assertInstanceOf($expected, $actual);

        $expected   = $name;
        $actual     = $table->getName();
        $this->assertSame($expected, $actual);
    }

    public function testClone()
    {
        $name           = 'test_table';
        $column_name    = 'test_column';

        $table  = Table::factory($name);

        $table->add(function ($table) use ($column_name) {
            $table->addColumn($column_name);
            $table->addIndex($column_name);
        });

        $withTable  = $table->with();

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $withTable;
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $expected   = $name;
        $actual     = $withTable->getName();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = $table;
        $actual     = $table;
        $this->assertSame($expected, $actual);

        $expected   = $table->getColumn($column_name);
        $actual     = $table->getColumn($column_name);
        $this->assertSame($expected, $actual);

        $expected   = $table->getColumnMap();
        $actual     = $table->getColumnMap();
        $this->assertSame($expected, $actual);

        $expected   = $table->getIndices();
        $actual     = $table->getIndices();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = $withTable;
        $actual     = $withTable;
        $this->assertSame($expected, $actual);

        $expected   = $withTable->getColumn($column_name);
        $actual     = $withTable->getColumn($column_name);
        $this->assertSame($expected, $actual);

        $expected   = $withTable->getColumnMap();
        $actual     = $withTable->getColumnMap();
        $this->assertSame($expected, $actual);

        $expected   = $withTable->getIndices();
        $actual     = $withTable->getIndices();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = $table;
        $actual     = $withTable;
        $this->assertNotSame($expected, $actual);

        $expected   = $table->getColumn($column_name);
        $actual     = $withTable->getColumn($column_name);
        $this->assertNotSame($expected, $actual);

        $expected   = $table->getColumnMap();
        $actual     = $withTable->getColumnMap();
        $this->assertNotSame($expected, $actual);

        $expected   = $table->getIndices();
        $actual     = $withTable->getIndices();
        $this->assertNotSame($expected, $actual);
    }

    public function testEngine()
    {
        $name   = 'test_table';

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = sprintf('CREATE TABLE `%s`;', $name);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->innoDb();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` ENGINE=%s;', $name, StorageEngine::INNO_DB);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->myIsam();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` ENGINE=%s;', $name, StorageEngine::MY_ISAM);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->memory();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` ENGINE=%s;', $name, StorageEngine::MEMORY);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->csv();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` ENGINE=%s;', $name, StorageEngine::CSV);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->archive();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` ENGINE=%s;', $name, StorageEngine::ARCHIVE);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->blackhole();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` ENGINE=%s;', $name, StorageEngine::BLACKHOLE);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->merge();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` ENGINE=%s;', $name, StorageEngine::MERGE);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->federated();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` ENGINE=%s;', $name, StorageEngine::FEDERATED);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->example();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` ENGINE=%s;', $name, StorageEngine::EXAMPLE);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $engine = StorageEngine::DEFAULT_ENGINE;

        $expected   = self::CLASS_PATH;
        $actual     = $table->engine($engine);
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($table->hasErrors());
        $this->assertFalse($table->hasError('engine'));
        $this->assertSame(array(), $table->getErrorsMessage());
        $this->assertSame(array(), $table->getErrorMessage('engine'));

        //----------------------------------------------
        $table  = Table::factory($name);

        $engine = 'aaaa';

        $expected   = self::CLASS_PATH;
        $actual     = $table->engine($engine);
        $this->assertInstanceOf($expected, $actual);

        $message    = sprintf('未知のストレージエンジン名を与えられました。engine:%s', Convert::toDebugString($engine, 2));

        $this->assertTrue($table->hasErrors());
        $this->assertTrue($table->hasError('engine'));
        $this->assertSame(array('engine' => array($message)), $table->getErrorsMessage());
        $this->assertSame(array($message), $table->getErrorMessage('engine'));
    }

    public function testDefaultCharset()
    {
        $name   = 'test_table';

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->latin1();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` DEFAULT CHARACTER SET=%s;', $name, Charset::LATIN1);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->binary();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` DEFAULT CHARACTER SET=%s;', $name, Charset::BINARY);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->sjisWin();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` DEFAULT CHARACTER SET=%s;', $name, Charset::CP932);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->eucJpWin();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` DEFAULT CHARACTER SET=%s;', $name, Charset::EUC_JPMS);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->utf8mb4();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` DEFAULT CHARACTER SET=%s;', $name, Charset::UTF8MB4);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $charset    = Charset::BINARY;

        $expected   = self::CLASS_PATH;
        $actual     = $table->defaultCharset($charset);
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($table->hasErrors());
        $this->assertFalse($table->hasError('charset'));
        $this->assertSame(array(), $table->getErrorsMessage());
        $this->assertSame(array(), $table->getErrorMessage('charset'));

        $expected   = sprintf('CREATE TABLE `%s` DEFAULT CHARACTER SET=%s;', $name, $charset);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $charset    = 'aaaa';

        $expected   = self::CLASS_PATH;
        $actual     = $table->defaultCharset($charset);
        $this->assertInstanceOf($expected, $actual);

        $message    = sprintf('未知の文字セットを与えられました。charset:%s', Convert::toDebugString($charset, 2));

        $this->assertTrue($table->hasErrors());
        $this->assertTrue($table->hasError('charset'));
        $this->assertSame(array('charset' => array($message)), $table->getErrorsMessage());
        $this->assertSame(array($message), $table->getErrorMessage('charset'));
    }

    public function testCollation()
    {
        $name   = 'test_table';

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->collation(sprintf('%s_%s_%s', Charset::CP932, Collation::LANG_JAPANESE, Collation::SUFFIX_CASE_SENSITIVE));
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($table->hasErrors());
        $this->assertFalse($table->hasError('collation'));
        $this->assertSame(array(), $table->getErrorsMessage());
        $this->assertSame(array(), $table->getErrorMessage('collation'));

        $expected   = sprintf('CREATE TABLE `%s` DEFAULT COLLATE=%s_%s_%s;', $name, Charset::CP932, Collation::LANG_JAPANESE, Collation::SUFFIX_CASE_SENSITIVE);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::CLASS_PATH;
        $actual     = $table->collation(Collation::factory()->sjisWin()->general()->ci());
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($table->hasErrors());
        $this->assertFalse($table->hasError('collation'));
        $this->assertSame(array(), $table->getErrorsMessage());
        $this->assertSame(array(), $table->getErrorMessage('collation'));

        $expected   = sprintf('CREATE TABLE `%s` DEFAULT COLLATE=%s_%s_%s;', $name, Charset::CP932, Collation::DEFAULT_LANG, Collation::SUFFIX_CASE_INSENSITIVE);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);
    }

    public function testComment()
    {
        $name   = 'test_table';

        //----------------------------------------------
        $table  = Table::factory($name);

        $comment    = 'コメント';

        $expected   = self::CLASS_PATH;
        $actual     = $table->comment($comment);
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('CREATE TABLE `%s` COMMENT \'%s\';', $name, $comment);
        $actual     = $table->build();
        $this->assertSame($expected, $actual);
    }

    public function testColumn()
    {
        $name   = 'test_table';

        //----------------------------------------------
        $table  = Table::factory($name);

        $column_name    = 'test_column';

        $expected   = self::COLUMN_CLASS_PATH;
        $actual     = $table->column($column_name);
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $column_name    = 'test_column';

        $column = $table->addColumn($column_name);

        $expected   = self::COLUMN_CLASS_PATH;
        $actual     = $column;
        $this->assertInstanceOf($expected, $actual);

        $expected   = $column;
        $actual     = $table->getColumn($column_name);
        $this->assertInstanceOf($expected, $actual);
    }

    public function testIndex()
    {
        $name   = 'test_table';

        //----------------------------------------------
        $table  = Table::factory($name);

        $expected   = self::INDEX_CLASS_PATH;
        $actual     = $table->index();
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $index  = $table->addIndex('test_column_1');

        $expected   = self::INDEX_CLASS_PATH;
        $actual     = $index;
        $this->assertInstanceOf($expected, $actual);
    }

    public function testAdd()
    {
        $name   = 'test_table';

        //----------------------------------------------
        $table  = Table::factory($name);

        $column_name_1  = 'test_column_1';

        $expected   = self::CLASS_PATH;
        $actual     = $table->add($table->column($column_name_1));
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $column_name_1  = 'test_column_1';
        $column_name_2  = 'test_column_2';
        $index_name_1   = 'test_index_1';

        $table->add(
            $table->column($column_name_1)->int(),
            $table->column($column_name_2)->int(),
            $table->index($index_name_1)
        );

        $expected   = <<<EOL
CREATE TABLE `test_table` (
  `test_column_1` int,
  `test_column_2` int,
  INDEX idx_test_index_1_test_table (`test_index_1`)
);
EOL;
        $actual     = $table->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $column_name_1  = 'test_column_1';
        $column_name_2  = 'test_column_2';
        $index_name_1   = 'test_index_1';

        $table->add(array(
            $table->column($column_name_1)->int(),
            $table->column($column_name_2)->int(),
            $table->index($index_name_1)
        ));

        $expected   = <<<EOL
CREATE TABLE `test_table` (
  `test_column_1` int,
  `test_column_2` int,
  INDEX idx_test_index_1_test_table (`test_index_1`)
);
EOL;
        $actual     = $table->build();
        $this->assertSame($expected, $actual);
    }

    public function testPrimaryKey()
    {
        $name   = 'test_table';

        //----------------------------------------------
        $table  = Table::factory($name);

        $column_name_1  = 'test_column_1';

        $expected   = self::INDEX_CLASS_PATH;
        $actual     = $table->primaryKey($column_name_1);
        $this->assertInstanceOf($expected, $actual);

        //----------------------------------------------
        $table  = Table::factory($name);

        $column_name_1  = 'test_column_1';
        $column_name_2  = 'test_column_2';
        $index_name_1   = 'test_index_1';

        $table->add(
            $table->column($column_name_1)->int(),
            $table->column($column_name_2)->int(),
            $table->index($index_name_1)
        );

        $table->primaryKey($column_name_2);

        $expected   = <<<EOL
CREATE TABLE `test_table` (
  `test_column_1` int,
  `test_column_2` int,
  PRIMARY KEY (`test_column_2`),
  INDEX idx_test_index_1_test_table (`test_index_1`)
);
EOL;
        $actual     = $table->build();
        $this->assertSame($expected, $actual);
    }

    public function testBuild()
    {
        //----------------------------------------------
        $table  = Table::factory('test_table');

        $table->add(
            $table->column('primary_id')->int()->unsigned()->notNull()->autoIncrement()->comment('プライマリID'),
            $table->column('secondary_id')->int()->unsigned()->notNull()->comment('セカンダリID'),
            $table->column('name')->varchar(50)->defaultValue(null)->comment('名前'),
            $table->column('sex')->tinyint()->defaultValue(0)->comment('性別', array(
                'unknown'   => array(0, '未選択'),
                'male'      => array(1, '男性'),
                'female'    => array(2, '女性'),
                'other'     => array(3, 'その他'),
            )),
            $table->column('mail_address')->varchar(191)->notNull()->comment('連絡先メールアドレス'),
            $table->column('star')->int()->defaultValue(0)->comment('いいねの数'),
            $table->column('remarks')->text()->comment('備考'),
            $table->index(array('secondary_id', 'name')),
            $table->index('mail_address')->unique()
        );

        $table->primaryKey('primary_id');

        $table->innoDb();

        $table->utf8mb4();

        $table->collation(Collation::factory()->utf8mb4()->japanese()->ci());

        $table->comment('簡易DDLビルダーサンプル');

        if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
            $expected   = <<<EOL
CREATE TABLE `test_table` (
  `primary_id`    int unsigned  NOT NULL                AUTO_INCREMENT  COMMENT 'プライマリID',
  `secondary_id`  int unsigned  NOT NULL                                COMMENT 'セカンダリID',
  `name`          varchar(50)             DEFAULT null                  COMMENT '名前',
  `sex`           tinyint                 DEFAULT '0'                   COMMENT '性別 const:{"unknown":[0,"未選択"],"male":[1,"男性"],"female":[2,"女性"],"other":[3,"その他"]}',
  `mail_address`  varchar(191)  NOT NULL                                COMMENT '連絡先メールアドレス',
  `star`          int                     DEFAULT '0'                   COMMENT 'いいねの数',
  `remarks`       text                                                  COMMENT '備考',
  PRIMARY KEY (`primary_id`),
  INDEX         idx_mul01_test_table        (`secondary_id`, `name`),
  UNIQUE INDEX  idx_mail_address_test_table (`mail_address`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 DEFAULT COLLATE=utf8mb4_japanese_ci COMMENT '簡易DDLビルダーサンプル';
EOL;
        } else {
            $expected   = <<<EOL
CREATE TABLE `test_table` (
  `primary_id`    int unsigned  NOT NULL                AUTO_INCREMENT  COMMENT 'プライマリID',
  `secondary_id`  int unsigned  NOT NULL                                COMMENT 'セカンダリID',
  `name`          varchar(50)             DEFAULT null                  COMMENT '名前',
  `sex`           tinyint                 DEFAULT '0'                   COMMENT '性別 const:{"unknown":[0,"\u672a\u9078\u629e"],"male":[1,"\u7537\u6027"],"female":[2,"\u5973\u6027"],"other":[3,"\u305d\u306e\u4ed6"]}',
  `mail_address`  varchar(191)  NOT NULL                                COMMENT '連絡先メールアドレス',
  `star`          int                     DEFAULT '0'                   COMMENT 'いいねの数',
  `remarks`       text                                                  COMMENT '備考',
  PRIMARY KEY (`primary_id`),
  INDEX         idx_mul01_test_table        (`secondary_id`, `name`),
  UNIQUE INDEX  idx_mail_address_test_table (`mail_address`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 DEFAULT COLLATE=utf8mb4_japanese_ci COMMENT '簡易DDLビルダーサンプル';
EOL;
        }

        $actual     = $table->build();
        $this->assertSame($expected, $actual);
    }
}
