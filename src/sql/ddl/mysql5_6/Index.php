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
use fw3_for_old\strings\converter\Convert;

/**
 * INDEX Builder
 */
class Index extends AbstractDdlBuilder
{
    //==============================================
    // consts
    //==============================================
    /**
     * @var int     インデックス名の最大文字列長
     */
    const NAME_MAX_LENGTH   = 64;

    /**
     * @var string  インデックスの並び順：昇順
     */
    const ORDER_ASC     = 'ASC';

    /**
     * @var string  インデックスの並び順：降順
     */
    const ORDER_DESC    = 'DESC';

    /**
     * @var int     インデックスコメントの最大文字列長
     */
    const COMMENT_MAX_LENGTH    = 1024;

    //==============================================
    // properties
    //==============================================
    /**
     * @var Table   このインデックスが所属するテーブル
     */
    protected $table;

    /**
     * @var ?string インデックス名
     *              プライマリキーの場合は常にnull
     */
    protected $name;

    /**
     * @var bool    このインデックスがプライマリキーかどうか
     */
    protected $primaryKey   = false;

    /**
     * @var string  インデックスタイプ
     */
    protected $type         = null;

    /**
     * @var array   インデックスの対象とするカラム
     */
    protected $columns          = array();

    /**
     * @var string  コメント
     */
    protected $comment          = null;

    //==============================================
    // methods
    //==============================================
    /***
     * constructor
     *
     * @param   Table   $table  このインデックスが所属するテーブル
     * @param   string  $name   インデックス名
     */
    protected function __construct($table, $name = null)
    {
        $this->table($table);
        $this->name($name);
    }

    /**
     * factory
     *
     * @param   Table   $table  このインデックスが所属するテーブル
     * @param   string  $name   インデックス名
     * @return  static  このインスタンス
     */
    public static function factory($table, $name = null)
    {
        return new static($table, $name);
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
     * インデックス名を取得・設定します。
     *
     * @param   $name   string|null インデックス名
     * @return  string|static       インデックス名またはこのインスタンス
     */
    public function name($name = null)
    {
        if ($name === null && func_num_args() === 0) {
            return $this->name;
        }

        if ($name === '') {
            throw new \Exception('インデックス名が空です。');
        }

        if (($length = mb_strlen($name)) > self::NAME_MAX_LENGTH) {
            throw new \Exception(sprintf('インデックス名の最大文字列長を超過しました。name:%s, max_length:%d, length:%s', Convert::toDebugString($name, 2), self::NAME_MAX_LENGTH, $length));
        }

        $this->name = $name;
        return $this;
    }

    /**
     * このインデックスがプライマリキーかどうかを返します。
     *
     * @return  bool    このインデックスがプライマリキーかどうか
     */
    public function isPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * このインデックスがマルチキーかどうかを返します。
     *
     * @return  bool    このインデックスがマルチキーかどうか
     */
    public function isMulti()
    {
        return count($this->columns) > 1;
    }

    /**
     * このインデックスが対象とするカラムを追加します。
     *
     * @param   Column|string   $column_name    カラム名
     * @param   int|null        $length         インデックスサイズ
     * @param   bool|null       $order          インデックスオーダー
     * @return  static  このインスタンス
     */
    public function column($column_name, $length = null, $order = null)
    {
        $this->columns[]    = array($column_name, $length, $order);
        return $this;
    }

    /**
     * このインデックスをプライマリキーとします。
     *
     * @return  static  このインスタンス
     */
    public function primaryKey()
    {
        $this->primaryKey   = true;
        return $this;
    }

    /**
     * このインデックスをユニークとします。
     *
     * @return  static  このインスタンス
     */
    public function unique()
    {
        $this->type = 'UNIQUE';
        return $this;
    }

    /**
     * このインデックスをフルテキストとします。
     *
     * @return  static  このインスタンス
     */
    public function fulltext()
    {
        $this->type = 'FULLTEXT';
        return $this;
    }

    /**
     * このインデックスにコメントを設定します。
     *
     * @param   string  $comment    コメント
     * @return  static  このインスタンス
     */
    public function comment($comment)
    {
        if (($length = mb_strlen($comment)) > self::COMMENT_MAX_LENGTH) {
            throw new \Exception(sprintf('インデックスコメントの最大文字列長を超過しました。comment:%s, max_length:%d, length:%s', Convert::toDebugString($comment, 2), self::COMMENT_MAX_LENGTH, $length));
        }

        $this->comment  = $comment;
        return $this;
    }

    //----------------------------------------------
    // builder
    //----------------------------------------------
    /**
     * このインデックスを文字列表現にして返します。
     *
     * @return  string  このインデックスの文字列表現
     */
    public function build()
    {
        $state = $this->getState(null);
        return implode(' ', array_filter($state));
    }

    /**
     * 現在の状態を返します。
     *
     * @return  array   現在の状態
     */
    public function getState($idx_count = null)
    {
        if (empty($this->columns)) {
            throw new \Exception('カラムが指定されていません。');
        }

        $is_multi   = $this->isMulti();

        $index_col_names    = array();
        foreach ($this->columns as $column) {
            $index_col_name = array(
                sprintf('`%s`', $column[0])
            );

            if (isset($column[1])) {
                $index_col_name[]   = sprintf('(%d)', $column[1]);
            }

            if (isset($column[2])) {
                $index_col_name[]   = $column[2] === self::ORDER_DESC ? self::ORDER_DESC : self::ORDER_ASC;
            }

            $index_col_names[]  = implode(' ', $index_col_name);
        }
        $index_col_names    = implode(', ', $index_col_names);

        if ($this->primaryKey) {
            return array(
                'type'      => 'PRIMARY KEY',
                'name'      => null,
                'column'    => sprintf('(%s)', $index_col_names),
                'comment'   => $this->comment !== null ? sprintf('COMMENT \'%s\'', $this->comment) : '',
            );
        }

        switch ($this->type) {
            case 'UNIQUE':
                $type   = 'UNIQUE ';
                break;
            case 'FULLTEXT':
                $type   = 'FULLTEXT ';
                break;
            default:
                $type   = '';
                break;
        }

        $name   = $this->name;
        if ($name === null) {
            if ($is_multi) {
                if ($idx_count !== null) {
                    $column_name    = sprintf('mul%02s', $idx_count);
                } else {
                    $column_name_list   = array();
                    foreach ($this->columns as $column) {   // === array_column($this->columns, 0, 0)
                        $column_name    = $column[0];
                        $column_name_list[$column_name] = $column_name;
                    }

                    $column_name    = implode('_', $column_name_list);
                }

                $name   = sprintf('idx_%s_%s', $column_name, $this->table->getName());
            } else {
                $column_name    = $this->columns[0][0];
                $name   = sprintf('idx_%s_%s', $column_name, $this->table->getName());
            }
        }

        return array(
            'type'      => sprintf('%sINDEX', $type),
            'name'      => $name,
            'column'    => sprintf('(%s)', $index_col_names),
            'comment'   => $this->comment !== null ? sprintf('COMMENT \'%s\'', $this->comment) : '',
        );
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
