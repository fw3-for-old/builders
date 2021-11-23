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
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\sub_type\ColumnInsertionPosition;
use fw3_for_old\builders\sql\ddl\mysql5_6\create_definition\ColumnDefinition;
use fw3_for_old\strings\converter\Convert;

/**
 * ALTER TABLE tbl_name DROP COLUMN col_name
 */
class DropColumn extends AbstractDdlBuilder
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
        $this->column   = Column::factory($column)->table($this->table);
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
        // ALTER TABLE tbl_name DROP COLUMN col_name

        $state  = $this->getState();

        $ddl    = array(
            'ALTER TABLE',
            $state['table_name'],
            'DROP COLUMN',
            $state['column_name'],
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
        $this->validBuildable();

        return array(
            'table_name'    => sprintf('`%s`', $this->table->getName()),
            'column_name'   => sprintf('`%s`', $this->column->name()),
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
