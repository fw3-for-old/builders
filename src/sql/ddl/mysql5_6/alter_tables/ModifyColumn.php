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
 * ALTER TABLE tbl_name MODIFY COLUMN col_name column_definition
 */
class ModifyColumn extends AbstractDdlBuilder
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

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   string|Table    $table  テーブル
     * @param   string|Column   $column カラム
     */
    protected function __construct($table, $column)
    {
        $this->table($table);
        $this->column               = Column::factory($column)->table($this->table);
    }

    /**
     * factory
     *
     * @param   string|Table    $table  テーブル
     * @param   string|Column   $column カラム
     * @return  static  このインスタンス
     */
    public static function factory($table, $column)
    {
        return new static($table, $column);
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
        func_num_args() === 0 ? $this->column->bit() : $this->column->bit($length);
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
        func_num_args() === 0 ? $this->column->tinyint() : $this->column->tinyint($unsigned);
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
        func_num_args() === 0 ? $this->column->smallint() : $this->column->smallint($unsigned);
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
        func_num_args() === 0 ? $this->column->mediumint() : $this->column->mediumint($unsigned);
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
        func_num_args() === 0 ? $this->column->bigint() : $this->column->bigint($unsigned);
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
        func_num_args() === 0 ? $this->column->int() : $this->column->int($unsigned);
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
                $this->column->real();
                break;
            case 1:
                $this->column->real($length);
                break;
            case 2:
                $this->column->real($length, $decimals);
                break;
            case 3:
                $this->column->real($length, $decimals, $unsigned);
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
                $this->column->double();
                break;
            case 1:
                $this->column->double($length);
                break;
            case 2:
                $this->column->double($length, $decimals);
                break;
            case 3:
                $this->column->double($length, $decimals, $unsigned);
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
                $this->column->float();
                break;
            case 1:
                $this->column->float($length);
                break;
            case 2:
                $this->column->float($length, $decimals);
                break;
            case 3:
                $this->column->float($length, $decimals, $unsigned);
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
                $this->column->decimal();
                break;
            case 1:
                $this->column->decimal($length);
                break;
            case 2:
                $this->column->decimal($length, $decimals);
                break;
            case 3:
                $this->column->decimal($length, $decimals, $unsigned);
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
                $this->column->numeric();
                break;
            case 1:
                $this->column->numeric($length);
                break;
            case 2:
                $this->column->numeric($length, $decimals);
                break;
            case 3:
                $this->column->numeric($length, $decimals, $unsigned);
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
        $this->column->date();
        return $this;
    }

    /**
     * このカラムをtime型とします。
     *
     * @return  static  このインスタンス
     */
    public function time()
    {
        $this->column->time();
        return $this;
    }

    /**
     * このカラムをtimestamp型とします。
     *
     * @return  static  このインスタンス
     */
    public function timestamp()
    {
        $this->column->timestamp();
        return $this;
    }

    /**
     * このカラムをdatetime型とします。
     *
     * @return  static  このインスタンス
     */
    public function datetime()
    {
        $this->column->datetime();
        return $this;
    }

    /**
     * このカラムをyear型とします。
     *
     * @return  static  このインスタンス
     */
    public function year()
    {
        $this->column->year();
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
        func_num_args() === 0 ? $this->column->char() : $this->column->char($length);
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
        func_num_args() === 0 ? $this->column->varchar() : $this->column->varchar($length);
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
        func_num_args() === 0 ? $this->column->text() : $this->column->text($binary);
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
        func_num_args() === 0 ? $this->column->mediumtext() : $this->column->mediumtext($binary);
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
        func_num_args() === 0 ? $this->column->longtext() : $this->column->longtext($binary);
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
        $this->column->unsigned();
        return $this;
    }

    /**
     * このカラムを符号ありとします。
     *
     * @return  static  このインスタンス
     */
    public function signed()
    {
        $this->column->signed();
        return $this;
    }

    /**
     * このカラムをバイナリとします。
     *
     * @return  static  このインスタンス
     */
    public function binary()
    {
        $this->column->binary();
        return $this;
    }

    /**
     * このカラムを非バイナリとします。
     *
     * @return  static  このインスタンス
     */
    public function nonBinary()
    {
        $this->column->nonBinary();
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
                $this->column->setDigit($length);
                break;
            case 2:
                $this->column->setDigit($length, $decimals);
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
        $this->column->notNull();
        return $this;
    }

    /**
     * NULL制約を付けます。
     *
     * @return  static  このインスタンス
     */
    public function nullConstrain()
    {
        $this->column->nullConstrain();
        return $this;
    }

    /**
     * NULL制約を解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetNullConstrain()
    {
        $this->column->unsetNullConstrain();
        return $this;
    }

    /**
     * AUTO INCREMENTを設定します。
     *
     * @return  static  このインスタンス
     */
    public function autoIncrement()
    {
        $this->column->autoIncrement();
        return $this;
    }

    /**
     * AUTO INCREMENTをクリアします。
     *
     * @return  static  このインスタンス
     */
    public function unsetAutoIncrement()
    {
        $this->column->unsetAutoIncrement();
        return $this;
    }

    /**
     * キーをUNIQUEにします。
     *
     * @return  static  このインスタンス
     */
    public function unique()
    {
        $this->column->unique();
        return $this;
    }

    /**
     * キーをPRIMARYにします。
     *
     * @return  static  このインスタンス
     */
    public function primary()
    {
        $this->column->primary();
        return $this;
    }

    /**
     * キーをunsetします。
     *
     * @return  static  このインスタンス
     */
    public function unsetKey()
    {
        $this->column->unsetKey();
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
        $this->column->defaultValue($default_value);
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
        $this->column->comment($comment, $map);
        return $this;
    }


    /**
     * カラムフォーマットをUNIQUEにします。
     *
     * @return  static  このインスタンス
     */
    public function fixed()
    {
        $this->column->fixed();
        return $this;
    }

    /**
     * カラムフォーマットをDYNAMICにします。
     *
     * @return  static  このインスタンス
     */
    public function dynamic()
    {
        $this->column->dynamic();
        return $this;
    }

    /**
     * カラムフォーマットをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultColumnFormat()
    {
        $this->column->defaultFormat();
        return $this;
    }

    /**
     * カラムフォーマットを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetColumnFormat()
    {
        $this->column->unsetFormat();
        return $this;
    }

    /**
     * ストレージをDISKにします。
     *
     * @return  static  このインスタンス
     */
    public function disk()
    {
        $this->column->disk();
        return $this;
    }

    /**
     * ストレージをMEMORYにします。
     *
     * @return  static  このインスタンス
     */
    public function memory()
    {
        $this->column->memory();
        return $this;
    }

    /**
     * ストレージをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultStorage()
    {
        $this->column->defaultFormat();
        return $this;
    }

    /**
     * ストレージを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetStorage()
    {
        $this->column->unsetFormat();
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
        // ALTER TABLE tbl_name MODIFY COLUMN col_name column_definition

        $state  = $this->getState();

        $ddl    = array(
            'ALTER TABLE',
            $state['table_name'],
            'MODIFY COLUMN',
            $state['column'],
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
            'column'        => $this->column->build(),
        );
    }

    /**
     * __clone
     */
    public function __clone()
    {
        $this->table    = clone $this->table;
        $this->column   = $this->column->withTable($this->table);
    }
}
