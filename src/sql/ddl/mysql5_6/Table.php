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
     * @var Column[]    column
     */
    protected $columns          = array();

    /**
     * @var Index[] index
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
     * カラムインスタンスを返します。
     *
     * @param   string  $column_name    カラム名
     * @return  Column  カラムビルダ
     */
    public function column($column_name)
    {
        return Column::factory($column_name);
    }

    /**
     * プライマリキーを設定します。
     *
     * @param   array   $columns    プライマリキーとするカラム
     * @return  Index   インデックスビルダ
     */
    public function primaryKey($columns = array())
    {
        $index = Index::factory($this, null)->primaryKey();
        foreach ((array) $columns as $column) {
            $index->column($column);
        }

        $this->add($index);

        return $index;
    }

    /**
     * インデックスを追加します。
     *
     * @param   array   $columns    インデックス対象とするカラム
     * @param   string  $index_name インデックス名
     * @return  Index   インデックスビルダ
     */
    public function index($columns = array(), $index_name = null)
    {
        $index = Index::factory($this, $index_name);
        foreach ((array) $columns as $column) {
            $index->column($column);
        }
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
                $this->columns[]    = $item;
                continue;
            }

            if ($item instanceof Index || is_subclass_of($item, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\Index")) {
                $this->indexes[]    = $item;
                continue;
            }
        }

        return $this;
    }

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
        if (!empty($this->columns)) {
            $columnTabel    = Tabular::disposableFactory()->tabWidth(2);
            foreach ($this->columns as $column) {
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
}
