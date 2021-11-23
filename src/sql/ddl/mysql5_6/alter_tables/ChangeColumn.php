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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables;

use fw3_for_old\builders\sql\ddl\mysql5_6\Column;
use fw3_for_old\builders\sql\ddl\mysql5_6\Table;
use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\Digitable;

/**
 * ALTER TABLE tbl_name CHANGE COLUMN old_col_name new_col_name column_definition
 */
class ChangeColumn extends AbstractDdlBuilder
{
    //==============================================
    // properties
    //==============================================
    /**
     * @var Table   テーブル
     */
    protected $table;

    /**
     * @var Column  カラム
     */
    protected $column;

    /**
     * @var Column  新しいカラム名
     */
    protected $newColumn;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   string|Table    $table  テーブル
     * @param   string|Column   $old_column 変更前のカラム名
     * @param   string|Column   $new_column 変更後のカラム名
     */
    protected function __construct($table, $old_column, $new_column)
    {
        $this->table($table);
        $this->column       = Column::factory($old_column)->table($this->table);
        $this->newColumn    = Column::factory($new_column)->table($this->table);
    }

    /**
     * factory
     *
     * @param   string|Table    $table  テーブル
     * @param   string|Column   $old_column 変更前のカラム名
     * @param   string|Column   $new_column 変更後のカラム名
     */
    public static function factory($table, $old_column, $new_column)
    {
        return new static($table, $old_column, $new_column);
    }

    //==============================================
    // methods
    //==============================================
    /**
     * テーブルを設定・取得します。
     *
     * @param   null|Table  $table  テーブル
     * @return  Table|static    テーブルまたはこのインスタンス
     */
    public function table($table = null)
    {
        if ($table === null && func_num_args() === 0) {
            return $this->table;
        }

        if (!($table instanceof Table)) {
            $table  = Table::factory($table);
        }

        $this->table    = $table;
        return $this;
    }

    //----------------------------------------------
    // 型指定
    //----------------------------------------------
    /**
     * このカラムをbit型とします。
     *
     * @param   int     $length bit長さ
     * @return  static  このインスタンス
     */
    public function bit($length = null)
    {
        func_num_args() === 0 ? $this->newColumn->bit() : $this->newColumn->bit($length);
        return $this;
    }

    /**
     * このカラムをtinyint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function tinyint($unsigned = null)
    {
        func_num_args() === 0 ? $this->newColumn->tinyint() : $this->newColumn->tinyint($unsigned);
        return $this;
    }

    /**
     * このカラムをsmallint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function smallint($unsigned = null)
    {
        func_num_args() === 0 ? $this->newColumn->smallint() : $this->newColumn->smallint($unsigned);
        return $this;
    }

    /**
     * このカラムをmediumint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function mediumint($unsigned = null)
    {
        func_num_args() === 0 ? $this->newColumn->mediumint() : $this->newColumn->mediumint($unsigned);
        return $this;
    }

    /**
     * このカラムをbigint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function bigint($unsigned = null)
    {
        func_num_args() === 0 ? $this->newColumn->bigint() : $this->newColumn->bigint($unsigned);
        return $this;
    }

    /**
     * このカラムをint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function int($unsigned = null)
    {
        func_num_args() === 0 ? $this->newColumn->int() : $this->newColumn->int($unsigned);
        return $this;
    }

    /**
     * このカラムをreal型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function real($length = null, $decimals = null, $unsigned = null)
    {
        switch (func_num_args()) {
            case 0:
                $this->newColumn->real();
                break;
            case 1:
                $this->newColumn->real($length);
                break;
            case 2:
                $this->newColumn->real($length, $decimals);
                break;
            case 3:
                $this->newColumn->real($length, $decimals, $unsigned);
                break;
        }

        return $this;
    }

    /**
     * このカラムをdouble型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function double($length = null, $decimals = null, $unsigned = null)
    {
        switch (func_num_args()) {
            case 0:
                $this->newColumn->double();
                break;
            case 1:
                $this->newColumn->double($length);
                break;
            case 2:
                $this->newColumn->double($length, $decimals);
                break;
            case 3:
                $this->newColumn->double($length, $decimals, $unsigned);
                break;
        }

        return $this;
    }

    /**
     * このカラムをfloat型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function float($length = null, $decimals = null, $unsigned = null)
    {
        switch (func_num_args()) {
            case 0:
                $this->newColumn->float();
                break;
            case 1:
                $this->newColumn->float($length);
                break;
            case 2:
                $this->newColumn->float($length, $decimals);
                break;
            case 3:
                $this->newColumn->float($length, $decimals, $unsigned);
                break;
        }

        return $this;
    }

    /**
     * このカラムをdecimal型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function decimal($length = null, $decimals = null, $unsigned = null)
    {
        switch (func_num_args()) {
            case 0:
                $this->newColumn->decimal();
                break;
            case 1:
                $this->newColumn->decimal($length);
                break;
            case 2:
                $this->newColumn->decimal($length, $decimals);
                break;
            case 3:
                $this->newColumn->decimal($length, $decimals, $unsigned);
                break;
        }

        return $this;
    }

    /**
     * このカラムをnumeric型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     */
    public function numeric($length = null, $decimals = null, $unsigned = null)
    {
        switch (func_num_args()) {
            case 0:
                $this->newColumn->numeric();
                break;
            case 1:
                $this->newColumn->numeric($length);
                break;
            case 2:
                $this->newColumn->numeric($length, $decimals);
                break;
            case 3:
                $this->newColumn->numeric($length, $decimals, $unsigned);
                break;
        }

        return $this;
    }

    /**
     * このカラムをdate型とします。
     *
     * @return  static  このインスタンス
     */
    public function date()
    {
        $this->newColumn->date();
        return $this;
    }

    /**
     * このカラムをtime型とします。
     *
     * @return  static  このインスタンス
     */
    public function time()
    {
        $this->newColumn->time();
        return $this;
    }

    /**
     * このカラムをtimestamp型とします。
     *
     * @return  static  このインスタンス
     */
    public function timestamp()
    {
        $this->newColumn->timestamp();
        return $this;
    }

    /**
     * このカラムをdatetime型とします。
     *
     * @return  static  このインスタンス
     */
    public function datetime()
    {
        $this->newColumn->datetime();
        return $this;
    }

    /**
     * このカラムをyear型とします。
     *
     * @return  static  このインスタンス
     */
    public function year()
    {
        $this->newColumn->year();
        return $this;
    }

    /**
     * このカラムをchar型とします。
     *
     * @param   int     $length 文字列長
     * @return  static  このインスタンス
     */
    public function char($length = null)
    {
        func_num_args() === 0 ? $this->newColumn->char() : $this->newColumn->char($length);
        return $this;
    }

    /**
     * このカラムをvarchar型とします。
     *
     * @param   int     $length 文字列長
     * @return  static  このインスタンス
     */
    public function varchar($length = null)
    {
        func_num_args() === 0 ? $this->newColumn->varchar() : $this->newColumn->varchar($length);
        return $this;
    }

    /**
     * このカラムをtext型とします。
     *
     * @param   bool    $binary 文字列モード
     * @return  static  このインスタンス
     */
    public function text($binary = false)
    {
        func_num_args() === 0 ? $this->newColumn->text() : $this->newColumn->text($binary);
        return $this;
    }

    /**
     * このカラムをmediumtext型とします。
     *
     * @param   bool    $binary 文字列モード
     * @return  static  このインスタンス
     */
    public function mediumtext($binary = false)
    {
        func_num_args() === 0 ? $this->newColumn->mediumtext() : $this->newColumn->mediumtext($binary);
        return $this;
    }

    /**
     * このカラムをlongtext型とします。
     *
     * @param   bool    $binary 文字列モード
     * @return  static  このインスタンス
     */
    public function longtext($binary = false)
    {
        func_num_args() === 0 ? $this->newColumn->longtext() : $this->newColumn->longtext($binary);
        return $this;
    }

    //----------------------------------------------
    // 属性
    //----------------------------------------------
    /**
     * このカラムを符号なしとします。
     *
     * @return  static  このインスタンス
     */
    public function unsigned()
    {
        $this->newColumn->unsigned();
        return $this;
    }

    /**
     * このカラムを符号ありとします。
     *
     * @return  static  このインスタンス
     */
    public function signed()
    {
        $this->newColumn->signed();
        return $this;
    }

    /**
     * このカラムをバイナリとします。
     *
     * @return  static  このインスタンス
     */
    public function binary()
    {
        $this->newColumn->binary();
        return $this;
    }

    /**
     * このカラムを非バイナリとします。
     *
     * @return  static  このインスタンス
     */
    public function nonBinary()
    {
        $this->newColumn->nonBinary();
        return $this;
    }

    /**
     * このカラムに桁を設定します。
     *
     * @param   int|Digitable   $length     桁数
     * @param   int|Digitable   $decimals   桁数の内、小数点以下の桁数
     * @return  static  このインスタンス
     */
    public function setDigit($length, $decimals = null)
    {
        switch (func_num_args()) {
            case 1:
                $this->newColumn->setDigit($length);
                break;
            case 2:
                $this->newColumn->setDigit($length, $decimals);
                break;
        }

        return $this;
    }

    /**
     * このカラムをNOT NULLとします。
     *
     * @return  static  このインスタンス
     */
    public function notNull()
    {
        $this->newColumn->notNull();
        return $this;
    }

    /**
     * NULL制約を付けます。
     *
     * @return  static  このインスタンス
     */
    public function nullConstrain()
    {
        $this->newColumn->nullConstrain();
        return $this;
    }

    /**
     * NULL制約を解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetNullConstrain()
    {
        $this->newColumn->unsetNullConstrain();
        return $this;
    }

    /**
     * AUTO INCREMENTを設定します。
     *
     * @return  static  このインスタンス
     */
    public function autoIncrement()
    {
        $this->newColumn->autoIncrement();
        return $this;
    }

    /**
     * AUTO INCREMENTをクリアします。
     *
     * @return  static  このインスタンス
     */
    public function unsetAutoIncrement()
    {
        $this->newColumn->unsetAutoIncrement();
        return $this;
    }

    /**
     * キーをUNIQUEにします。
     *
     * @return  static  このインスタンス
     */
    public function unique()
    {
        $this->newColumn->unique();
        return $this;
    }

    /**
     * キーをPRIMARYにします。
     *
     * @return  static  このインスタンス
     */
    public function primary()
    {
        $this->newColumn->primary();
        return $this;
    }

    /**
     * キーをunsetします。
     *
     * @return  static  このインスタンス
     */
    public function unsetKey()
    {
        $this->newColumn->unsetKey();
        return $this;
    }

    /**
     * デフォルト値を設定します。
     *
     * @param   string|int|float    $default_value  デフォルト値
     * @return  static  このインスタンス
     */
    public function defaultValue($default_value)
    {
        $this->newColumn->defaultValue($default_value);
        return $this;
    }

    /**
     * コメントを設定します。
     *
     * @param   string  $comment    コメント
     * @param   array   $map        定義値マップ
     * @return  static  このインスタンス
     */
    public function comment($comment, $map = array())
    {
        $this->newColumn->comment($comment, $map);
        return $this;
    }


    /**
     * カラムフォーマットをUNIQUEにします。
     *
     * @return  static  このインスタンス
     */
    public function fixed()
    {
        $this->newColumn->fixed();
        return $this;
    }

    /**
     * カラムフォーマットをDYNAMICにします。
     *
     * @return  static  このインスタンス
     */
    public function dynamic()
    {
        $this->newColumn->dynamic();
        return $this;
    }

    /**
     * カラムフォーマットをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultColumnFormat()
    {
        $this->newColumn->defaultFormat();
        return $this;
    }

    /**
     * カラムフォーマットを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetColumnFormat()
    {
        $this->newColumn->unsetFormat();
        return $this;
    }

    /**
     * ストレージをDISKにします。
     *
     * @return  static  このインスタンス
     */
    public function disk()
    {
        $this->newColumn->disk();
        return $this;
    }

    /**
     * ストレージをMEMORYにします。
     *
     * @return  static  このインスタンス
     */
    public function memory()
    {
        $this->newColumn->memory();
        return $this;
    }

    /**
     * ストレージをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultStorage()
    {
        $this->newColumn->defaultFormat();
        return $this;
    }

    /**
     * ストレージを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetStorage()
    {
        $this->newColumn->unsetFormat();
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
        // build
        //----------------------------------------------
        // ALTER TABLE tbl_name CHANGE COLUMN old_col_name new_col_name column_definition
        $state  = $this->getState();

        $ddl    = array(
            'ALTER TABLE',
            $state['table_name'],
            'CHANGE COLUMN',
            $state['old_column'],
            $state['new_column'],
        );

        return implode(' ', $ddl);
    }

    /**
     * 現在の状態を返します。
     *
     * @return  array   現在の状態
     */
    public function getState()
    {
        return array(
            'table_name'    => sprintf('`%s`', $this->table->getName()),
            'old_column'    => sprintf('`%s`', $this->column->name()),
            'new_column'    => $this->newColumn->build(),
        );
    }

    /**
     * __clone
     */
    public function __clone()
    {
        $this->table        = clone $this->table;
        $this->column       = $this->column->withTable($this->table);
        $this->newColumn    = $this->newColumn->withTable($this->table);
    }
}
