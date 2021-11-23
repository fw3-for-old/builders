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

use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;
use fw3_for_old\builders\sql\ddl\mysql5_6\globalization\charset\Charset;
use fw3_for_old\builders\sql\ddl\mysql5_6\globalization\collation\Collation;
use fw3_for_old\builders\sql\ddl\mysql5_6\storage_engine\StorageEngine;
use fw3_for_old\strings\converter\Convert;
use fw3_for_old\strings\tabular\Tabular;

/**
 * CREATE TABLE Builder
 */
class Table extends AbstractDdlBuilder
{
    //==============================================
    // properties
    //==============================================
    /**
     * @var string  テーブル名
     */
    protected $name;

    /**
     * @var StorageEngine   ストレージエンジン
     */
    protected $engine;

    /**
     * @var Charset デフォルト文字セット
     */
    protected $defaultCharset;

    /**
     * @var Column[]    カラムビルダマップ
     */
    protected $columnMap    = array();

    /**
     * @var Index[] インデックスリスト
     */
    protected $indexes          = array();

    /**
     * @var Collation|array|null    照合順序
     */
    protected $collation        = null;

    /**
     * @var string  コメント
     */
    protected $comment          = null;

    //==============================================
    // methods
    //==============================================
    /**
     * constructor
     *
     * @param   string  $name   テーブル名
     */
    protected function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * factory
     *
     * @param   string  $name   テーブル名
     * @return  static  このインスタンス
     */
    public static function factory($name)
    {
        return new static($name);
    }

    /**
     * テーブル名を返します。
     *
     * @return  string  テーブル名
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * ストレージエンジンを設定します。
     *
     * @param   string|StorageEngine    $engine ストレージエンジン
     * @return  static  このインスタンス
     */
    public function engine($engine)
    {
        $engine = StorageEngine::factory($engine);
        if ($engine->hasErrors()) {
            $this->mergeErrors($engine);
            return $this;
        }

        $this->engine   = $engine;
        return $this;
    }

    /**
     * ストレージエンジンとしてInnoDBを使用します。
     *
     * @return  static  このインスタンス
     */
    public function innoDb()
    {
        return $this->engine(StorageEngine::INNO_DB);
    }

    /**
     * ストレージエンジンとしてMyIsamを使用します。
     *
     * @return  static  このインスタンス
     */
    public function myIsam()
    {
        return $this->engine(StorageEngine::MY_ISAM);
    }

    /**
     * ストレージエンジンとしてMEMORYを使用します。
     *
     * @return  static  このインスタンス
     */
    public function memory()
    {
        return $this->engine(StorageEngine::MEMORY);
    }

    /**
     * ストレージエンジンとしてCSVを使用します。
     *
     * @return  static  このインスタンス
     */
    public function csv()
    {
        return $this->engine(StorageEngine::CSV);
    }

    /**
     * ストレージエンジンとしてARCHIVEを使用します。
     *
     * @return  static  このインスタンス
     */
    public function archive()
    {
        return $this->engine(StorageEngine::ARCHIVE);
    }

    /**
     * ストレージエンジンとしてBLACKHOLEを使用します。
     *
     * @return  static  このインスタンス
     */
    public function blackhole()
    {
        return $this->engine(StorageEngine::BLACKHOLE);
    }

    /**
     * ストレージエンジンとしてMERGEを使用します。
     *
     * @return  static  このインスタンス
     */
    public function merge()
    {
        return $this->engine(StorageEngine::MERGE);
    }

    /**
     * ストレージエンジンとしてFEDERATEDを使用します。
     *
     * @return  static  このインスタンス
     */
    public function federated()
    {
        return $this->engine(StorageEngine::FEDERATED);
    }

    /**
     * ストレージエンジンとしてEXAMPLEを使用します。
     *
     * @return  static  このインスタンス
     */
    public function example()
    {
        return $this->engine(StorageEngine::EXAMPLE);
    }

    /**
     * デフォルト文字セットを設定します。
     *
     * @param   string|Charset  $default_charset    文字セット
     * @return  static  このインスタンス
     */
    public function defaultCharset($default_charset)
    {
        $default_charset    = Charset::factory($default_charset);
        if ($default_charset->hasErrors()) {
            $this->mergeErrors($default_charset);
            return $this;
        }

        $this->defaultCharset   = $default_charset;
        return $this;
    }

    /**
     * デフォルト文字セットとしてlatin1を使用します。
     *
     * @return  static  このインスタンス
     */
    public function latin1()
    {
        return $this->defaultCharset(Charset::LATIN1);
    }

    /**
     * デフォルト文字セットとしてbinaryを使用します。
     *
     * @return  static  このインスタンス
     */
    public function binary()
    {
        return $this->defaultCharset(Charset::BINARY);
    }

    /**
     * デフォルト文字セットとしてcp932を使用します。
     *
     * @return  static  このインスタンス
     */
    public function sjisWin()
    {
        return $this->defaultCharset(Charset::CP932);
    }

    /**
     * デフォルト文字セットとしてeuc-jpを使用します。
     *
     * @return  static  このインスタンス
     */
    public function eucJpWin()
    {
        return $this->defaultCharset(Charset::EUC_JPMS);
    }

    /**
     * デフォルト文字セットとしてutf8mb4を使用します。
     *
     * @return  static  このインスタンス
     */
    public function utf8mb4()
    {
        return $this->defaultCharset(Charset::UTF8MB4);
    }

    /**
     * 照合順序を設定します。
     *
     * @param   Collation|array|string  $collation  照合順序
     * @return  static  このインスタンス
     */
    public function collation($collation)
    {
        if (!($collation instanceof Collation)) {
            $collation = Collation::factory($collation);
            if ($collation->hasErrors()) {
                $this->mergeErrors($collation);
                return $this;
            }
        }

        $this->collation    = $collation;
        return $this;
    }

    /**
     * コメントを設定します。
     *
     * @param   string  $comment    コメント
     * @return  static  このインスタンス
     */
    public function comment($comment)
    {
        if (($length = mb_strlen($comment)) > 1024) {
            $this->addError('comment', sprintf('最大文字列長以上のコメントを指定されました。length:%d', Convert::toDebugString($length, 2)));
            return $this;
        }

        $this->comment  = $comment;
        return $this;
    }

    /**
     * カラムビルダを返します。
     *
     * @param   string  $column_name    カラム名
     * @return  Column  カラムビルダ
     */
    public function column($column_name)
    {
        return Column::factory($column_name);
    }

    /**
     * カラムビルダを生成し、テーブルに追加してから返します。
     *
     * @param   string  $column_name    カラム名
     * @return  Column  カラムビルダ
     */
    public function addColumn($column_name)
    {
        $column = $this->column($column_name);
        $this->add($column);
        return $column;
    }

    /**
     * カラムビルダを取得します。
     *
     * @param   string  $name   カラム名
     * @return  Column  カラムビルダ
     */
    public function getColumn($name)
    {
        return isset($this->columnMap[$name]) ? $this->columnMap[$name] : null;
    }

    /**
     * カラムビルダマップを取得します。
     *
     * @return  array   カラムビルダマップ
     */
    public function getColumnMap()
    {
        return $this->columnMap;
    }

    /**
     * インデックスビルダリストを取得します。
     *
     * @return  array   インデックスビルダリスト
     */
    public function getIndices()
    {
        return $this->indexes;
    }

    /**
     * プライマリキーを設定します。
     *
     * @param   array   $columnMap    プライマリキーとするカラム
     * @return  Index   インデックスビルダ
     */
    public function primaryKey($columnMap = array())
    {
        $index = Index::factory($this, null)->primaryKey();
        foreach ((array) $columnMap as $column) {
            $index->column($column);
        }

        $this->add($index);

        return $index;
    }

    /**
     * インデックスビルダを返します。
     *
     * @param   array   $columnMap    インデックス対象とするカラム
     * @param   string  $index_name インデックス名
     * @return  Index   インデックスビルダ
     */
    public function index($columnMap = array(), $index_name = null)
    {
        $index = Index::factory($this, $index_name);
        foreach ((array) $columnMap as $column) {
            $index->column($column);
        }
        return $index;
    }

    /**
     * インデックスビルダを構築し、TableBuilderに追加してから返します。
     *
     * @param   array   $columnMap    カラム
     * @param   string  $index_name インデックス名
     * @return  Index   インデックスビルダ
     */
    public function addIndex($columnMap = array(), $index_name = null)
    {
        $index  = $this->index($columnMap, $index_name);
        $this->add($index);
        return $index;
    }

    /**
     * カラムやインデックスを纏めて追加します。
     *
     * @param   array   $items  カラムやインデックス
     * @return  static  このインスタンス
     */
    public function add($items)
    {
        if ($items instanceof \Closure) {
            $items  = $items($this);

            if (!is_array($items)) {
                return $this;
            }
        }

        if (!is_array($items)) {
            $items  = func_num_args() === 1 ? array($items) :  func_get_args();
        }

        foreach ($items as $item) {
            if ($item instanceof Column || is_subclass_of($item, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Column")) {
                $this->columnMap[$item->name()]    = $item->table($this);
                continue;
            }

            if ($item instanceof Index || is_subclass_of($item, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Index")) {
                $this->indexes[]    = $item->table($this);
                continue;
            }
        }

        return $this;
    }

    //----------------------------------------------
    // builder
    //----------------------------------------------
    /**
     * このテーブルを文字列表現にして返します。
     *
     * @return  string  このテーブルの文字列表現
     */
    public function build()
    {
        //----------------------------------------------
        // base
        //----------------------------------------------
        $ddl    = array(
            sprintf('CREATE TABLE `%s`', $this->name),
        );

        //----------------------------------------------
        // column part
        //----------------------------------------------
        if (!empty($this->columnMap)) {
            $columnTabel    = Tabular::disposableFactory()->tabWidth(2)->nullColumnSkip(true);
            foreach ($this->columnMap as $column) {
                $columnTabel->addRow($column->getState());
            }

            $primary_key    = array();
            $indexTabel = Tabular::disposableFactory()->tabWidth(2);
            $idx_count = 0;

            foreach ($this->indexes as $index) {
                if ($index->isPrimaryKey()) {
                    if (empty($primary_key)) {
                        $primary_key    = array($index->build());
                    }
                    continue;
                }

                $indexTabel->addRow($index->getState($index->isMulti() ? ++$idx_count : null));
            }

            $ddl[]  = sprintf('(%s  %s%s)', "\n", implode(sprintf(',%s  ', "\n"), array_map('trim', array_merge($columnTabel->build(), $primary_key, $indexTabel->build()))), "\n");
        }

        //----------------------------------------------
        // storage engine
        //----------------------------------------------
        if ($this->engine instanceof StorageEngine) {
            $ddl[]  = $this->engine->build();
        }

        //----------------------------------------------
        // character set
        //----------------------------------------------
        if ($this->defaultCharset instanceof Charset) {
            $ddl[]  = sprintf('DEFAULT CHARACTER SET=%s', $this->defaultCharset->build());
        }

        //----------------------------------------------
        // collate
        //----------------------------------------------
        if ($this->collation instanceof Collation) {
            $ddl[]  = $this->collation->build();
        }

        //----------------------------------------------
        // comment
        //----------------------------------------------
        if ($this->comment !== null) {
            $ddl[]  = sprintf('COMMENT \'%s\'', $this->comment);
        }

        //----------------------------------------------
        // build
        //----------------------------------------------
        return implode(' ', $ddl) . ';';
    }

    /**
     * __clone
     */
    public function __clone()
    {
        if (is_object($this->engine)) {
            $this->engine           = clone $this->engine;
        }

        if (is_object($this->defaultCharset)) {
            $this->defaultCharset   = clone $this->defaultCharset;
        }

        foreach ($this->columnMap as $name => $column) {
            if (is_object($column)) {
                $this->columnMap[$name] = clone $column;
            }
        }

        foreach ($this->indexes as $idx => $index) {
            if (is_object($index)) {
                $this->indexes[$idx]   = clone $index;
            }
        }

        if (is_object($this->collation)) {
            $this->collation    = clone $this->collation;
        }
    }
}
