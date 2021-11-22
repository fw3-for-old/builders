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

use fw3_for_old\builders\sql\ddl\mysql5_6\Index;
use fw3_for_old\builders\sql\ddl\mysql5_6\Table;
use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;

/**
 * ALTER TABLE tbl_name RENAME INDEX old_index_name TO new_index_name
 */
class RenameIndex extends AbstractDdlBuilder
{
    //==============================================
    // properties
    //==============================================
    /**
     * @var Table   テーブル
     */
    protected $table;

    /**
     * @var Index   インデックス
     */
    protected $index;

    /**
     * @var Index   新しいインデックス
     */
    protected $newIndex;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   string|Table    $table      テーブル
     * @param   string|Index    $old_index  変更前のインデックス名
     * @param   string|Index    $new_index  変更後のインデックス名
     */
    protected function __construct($table, $index, $new_index)
    {
        $this->table($table);
        $this->index    = Index::factory($table, $index);
        $this->newIndex = Index::factory($table, $new_index);
    }

    /**
     * factory
     *
     * @param   string|Table    $table      テーブル
     * @param   string|Index    $old_index  変更前のインデックス名
     * @param   string|Index    $new_index  変更後のインデックス名
     * @return  static  このインスタンス
     */
    public static function factory($table, $index, $new_index)
    {
        return new static($table, $index, $new_index);
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
        // ALTER TABLE tbl_name RENAME INDEX old_index_name TO new_index_name
        $state  = $this->getState();

        $ddl    = array(
            'ALTER TABLE',
            $state['table_name'],
            'RENAME INDEX',
            $state['index_name'],
            'TO',
            $state['new_index_name'],
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
            'index_name'        => sprintf('`%s`', $this->index->name()),
            'new_index_name'    => sprintf('`%s`', $this->newIndex->name()),
        );
    }

    /**
     * __clone
     */
    public function __clone()
    {
        $this->table    = clone $this->table;
        $this->index    = $this->index->withTable($this->table);
        $this->newIndex = $this->newIndex->withTable($this->table);
    }
}
