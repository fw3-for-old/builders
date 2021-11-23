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
use fw3_for_old\builders\sql\ddl\mysql5_6\create_definition\ColumnDefinition;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\Digitable;
use fw3_for_old\strings\converter\Convert;

/**
 * COLUM Builder
 */
class Column extends AbstractDdlBuilder
{
    //==============================================
    // consts
    //==============================================
    /**
     * @var int     カラム名の最大文字列長
     */
    const NAME_MAX_LENGTH   = 64;

    //==============================================
    // properties
    //==============================================
    /**
     * @var Table   このインデックスが所属するテーブル
     */
    protected $table;

    /**
     * @var string  カラム名
     */
    protected $name;

    /**
     * @var ColumnDefinition    カラム定義
     */
    protected $columnDefinition;

    //==============================================
    // methods
    //==============================================
    /**
     * constructor
     *
     * @param   string  $name   カラム名
     */
    protected function __construct($name)
    {
        $this->name($name);
        $this->columnDefinition = ColumnDefinition::factory();
    }

    /**
     * factory
     *
     * @param   string  $name   カラム名
     * @return  static  このインスタンス
     */
    public static function factory($name)
    {
        return new static($name);
    }

    /**
     * このインスタンスが所属するテーブルを設定・取得します。
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

    /**
     * カラム名を取得・設定します。
     *
     * @param   $name   string|null カラム名
     * @return  string|static       カラム名またはこのインスタンス
     */
    public function name($name = null)
    {
        if ($name === null && func_num_args() === 0) {
            return $this->name;
        }

        if ($name === '') {
            throw new \Exception('カラム名が空です。');
        }

        if (($length = mb_strlen($name)) > self::NAME_MAX_LENGTH) {
            throw new \Exception(sprintf('カラム名の最大文字列長を超過しました。name:%s, max_length:%d, length:%s', Convert::toDebugString($name, 2), self::NAME_MAX_LENGTH, $length));
        }

        $this->name = $name;
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
        func_num_args() === 0 ? $this->columnDefinition->bit() : $this->columnDefinition->bit($length);
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
        func_num_args() === 0 ? $this->columnDefinition->tinyint() : $this->columnDefinition->tinyint($unsigned);
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
        func_num_args() === 0 ? $this->columnDefinition->smallint() : $this->columnDefinition->smallint($unsigned);
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
        func_num_args() === 0 ? $this->columnDefinition->mediumint() : $this->columnDefinition->mediumint($unsigned);
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
        func_num_args() === 0 ? $this->columnDefinition->bigint() : $this->columnDefinition->bigint($unsigned);
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
        func_num_args() === 0 ? $this->columnDefinition->int() : $this->columnDefinition->int($unsigned);
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
                $this->columnDefinition->real();
                break;
            case 1:
                $this->columnDefinition->real($length);
                break;
            case 2:
                $this->columnDefinition->real($length, $decimals);
                break;
            case 3:
                $this->columnDefinition->real($length, $decimals, $unsigned);
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
                $this->columnDefinition->double();
                break;
            case 1:
                $this->columnDefinition->double($length);
                break;
            case 2:
                $this->columnDefinition->double($length, $decimals);
                break;
            case 3:
                $this->columnDefinition->double($length, $decimals, $unsigned);
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
                $this->columnDefinition->float();
                break;
            case 1:
                $this->columnDefinition->float($length);
                break;
            case 2:
                $this->columnDefinition->float($length, $decimals);
                break;
            case 3:
                $this->columnDefinition->float($length, $decimals, $unsigned);
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
                $this->columnDefinition->decimal();
                break;
            case 1:
                $this->columnDefinition->decimal($length);
                break;
            case 2:
                $this->columnDefinition->decimal($length, $decimals);
                break;
            case 3:
                $this->columnDefinition->decimal($length, $decimals, $unsigned);
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
                $this->columnDefinition->numeric();
                break;
            case 1:
                $this->columnDefinition->numeric($length);
                break;
            case 2:
                $this->columnDefinition->numeric($length, $decimals);
                break;
            case 3:
                $this->columnDefinition->numeric($length, $decimals, $unsigned);
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
        $this->columnDefinition->date();
        return $this;
    }

    /**
     * このカラムをtime型とします。
     *
     * @return  static  このインスタンス
     */
    public function time()
    {
        $this->columnDefinition->time();
        return $this;
    }

    /**
     * このカラムをtimestamp型とします。
     *
     * @return  static  このインスタンス
     */
    public function timestamp()
    {
        $this->columnDefinition->timestamp();
        return $this;
    }

    /**
     * このカラムをdatetime型とします。
     *
     * @return  static  このインスタンス
     */
    public function datetime()
    {
        $this->columnDefinition->datetime();
        return $this;
    }

    /**
     * このカラムをyear型とします。
     *
     * @return  static  このインスタンス
     */
    public function year()
    {
        $this->columnDefinition->year();
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
        func_num_args() === 0 ? $this->columnDefinition->char() : $this->columnDefinition->char($length);
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
        func_num_args() === 0 ? $this->columnDefinition->varchar() : $this->columnDefinition->varchar($length);
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
        func_num_args() === 0 ? $this->columnDefinition->text() : $this->columnDefinition->text($binary);
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
        func_num_args() === 0 ? $this->columnDefinition->mediumtext() : $this->columnDefinition->mediumtext($binary);
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
        func_num_args() === 0 ? $this->columnDefinition->longtext() : $this->columnDefinition->longtext($binary);
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
        $this->columnDefinition->unsigned();
        return $this;
    }

    /**
     * このカラムを符号ありとします。
     *
     * @return  static  このインスタンス
     */
    public function signed()
    {
        $this->columnDefinition->signed();
        return $this;
    }

    /**
     * このカラムをバイナリとします。
     *
     * @return  static  このインスタンス
     */
    public function binary()
    {
        $this->columnDefinition->binary();
        return $this;
    }

    /**
     * このカラムを非バイナリとします。
     *
     * @return  static  このインスタンス
     */
    public function nonBinary()
    {
        $this->columnDefinition->nonBinary();
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
                $this->columnDefinition->setDigit($length);
                break;
            case 2:
                $this->columnDefinition->setDigit($length, $decimals);
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
        $this->columnDefinition->notNull();
        return $this;
    }

    /**
     * NULL制約を付けます。
     *
     * @return  static  このインスタンス
     */
    public function nullConstrain()
    {
        $this->columnDefinition->nullConstrain();
        return $this;
    }

    /**
     * NULL制約を解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetNullConstrain()
    {
        $this->columnDefinition->unsetNullConstrain();
        return $this;
    }

    /**
     * AUTO INCREMENTを設定します。
     *
     * @return  static  このインスタンス
     */
    public function autoIncrement()
    {
        $this->columnDefinition->autoIncrement();
        return $this;
    }

    /**
     * AUTO INCREMENTをクリアします。
     *
     * @return  static  このインスタンス
     */
    public function unsetAutoIncrement()
    {
        $this->columnDefinition->unsetAutoIncrement();
        return $this;
    }

    /**
     * キーをUNIQUEにします。
     *
     * @return  static  このインスタンス
     */
    public function unique()
    {
        $this->columnDefinition->unique();
        return $this;
    }

    /**
     * キーをPRIMARYにします。
     *
     * @return  static  このインスタンス
     */
    public function primary()
    {
        $this->columnDefinition->primary();
        return $this;
    }

    /**
     * キーをunsetします。
     *
     * @return  static  このインスタンス
     */
    public function unsetKey()
    {
        $this->columnDefinition->unsetKey();
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
        $this->columnDefinition->defaultValue($default_value);
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
        $this->columnDefinition->comment($comment, $map);
        return $this;
    }


    /**
     * カラムフォーマットをUNIQUEにします。
     *
     * @return  static  このインスタンス
     */
    public function fixed()
    {
        $this->columnDefinition->fixed();
        return $this;
    }

    /**
     * カラムフォーマットをDYNAMICにします。
     *
     * @return  static  このインスタンス
     */
    public function dynamic()
    {
        $this->columnDefinition->dynamic();
        return $this;
    }

    /**
     * カラムフォーマットをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultColumnFormat()
    {
        $this->columnDefinition->defaultFormat();
        return $this;
    }

    /**
     * カラムフォーマットを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetColumnFormat()
    {
        $this->columnDefinition->unsetFormat();
        return $this;
    }

    /**
     * ストレージをDISKにします。
     *
     * @return  static  このインスタンス
     */
    public function disk()
    {
        $this->columnDefinition->disk();
        return $this;
    }

    /**
     * ストレージをMEMORYにします。
     *
     * @return  static  このインスタンス
     */
    public function memory()
    {
        $this->columnDefinition->memory();
        return $this;
    }

    /**
     * ストレージをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultStorage()
    {
        $this->columnDefinition->defaultFormat();
        return $this;
    }

    /**
     * ストレージを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetStorage()
    {
        $this->columnDefinition->unsetFormat();
        return $this;
    }

    //----------------------------------------------
    // builder
    //----------------------------------------------
    /**
     * Columnを文字列表現にして返します。
     */
    public function build()
    {
        return implode(' ', $this->getState());
    }

    /**
     * 現在の状態を返します。
     *
     * @return  array   現在の状態
     */
    public function getState()
    {
        $column_definition  = $this->columnDefinition->getState();

        return array(
            'name'              => sprintf('`%s`', $this->name),
            'date_type'         => $column_definition['data_type'],
            'not_null'          => $column_definition['not_null'],
            'default'           => $column_definition['default'],
            'auto_increment'    => $column_definition['auto_increment'],
            'key'               => $column_definition['key'],
            'comment'           => $column_definition['comment'],
            'column_format'     => $column_definition['column_format'],
            'storage'           => $column_definition['storage'],
        );
    }

    /**
     * __clone
     */
    public function __clone()
    {
        $this->columnDefinition = clone $this->columnDefinition;
    }

    /**
     * 所属先を新しいテーブルに差し替えて新しいインスタンスとして返します。
     *
     * @param   static  新しいインスタンス
     */
    public function withTable($table)
    {
        return $this->with()->table($table);
    }
}
