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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables;

use fw3_for_old\builders\sql\ddl\mysql5_6\Column;
use fw3_for_old\builders\sql\ddl\mysql5_6\Table;
use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\sub_type\ColumnInsertionPosition;
use fw3_for_old\builders\sql\ddl\mysql5_6\create_definition\ColumnDefinition;
use fw3_for_old\strings\converter\Convert;

/**
 * ALTER TABLE tbl_name RENAME COLUMN old_col_name TO new_col_name
 */
class RenameColumn extends AbstractDdlBuilder
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
     * @var Column  新しいカラム
     */
    protected $newColumn;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   string|Table    $table      テーブル
     * @param   string|Column   $column     カラム
     * @param   string|Column   $newColumn  変更後のカラム
     */
    protected function __construct($table, $column, $newColumn)
    {
        $this->table($table);
        $this->column       = Column::factory($column)->table($this->table);
        $this->newColumn    = Column::factory($newColumn)->table($this->table);
    }

    /**
     * factory
     *
     * @param   string|Table    $table      テーブル
     * @param   string|Column   $column     カラム
     * @param   string|Column   $newColumn  変更後のカラム
     * @return  static  このインスタンス
     */
    public static function factory($table, $column, $newColumn)
    {
        return new static($table, $column, $newColumn);
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
        // ALTER TABLE tbl_name RENAME COLUMN old_col_name TO new_col_name
        $state  = $this->getState();

        $ddl    = array(
            'ALTER TABLE',
            $state['table_name'],
            'RENAME COLUMN',
            $state['column_name'],
            'TO',
            $state['new_column_name'],
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
            'table_name'        => sprintf('`%s`', $this->table->getName()),
            'column_name'       => sprintf('`%s`', $this->column->name()),
            'new_column_name'   => sprintf('`%s`', $this->newColumn->name()),
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
