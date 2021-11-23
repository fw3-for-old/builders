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

use fw3_for_old\builders\sql\ddl\mysql5_6\Table;
use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;

/**
 * ALTER TABLE tbl_name RENAME [TO|AS] new_tbl_name
 */
class Rename extends AbstractDdlBuilder
{
    //==============================================
    // properties
    //==============================================
    /**
     * @var Table  現在のテーブル
     */
    protected $table;

    /**
     * @var Table  新しいテーブル
     */
    protected $newTable;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   string|Table    $new_table  変更前のテーブル名
     * @param   string|Table    $old_table  変更後のテーブル名
     */
    protected function __construct($old_table, $new_table)
    {
        $this->table($old_table);
        $this->newTable($new_table);
    }

    /**
     * factory
     *
     * @param   string|Table    $new_table  変更前のテーブル名
     * @param   string|Table    $old_table  変更後のテーブル名
     * @return  static  このインスタンス
     */
    public static function factory($old_table, $new_table)
    {
        return new static($old_table, $new_table);
    }

    //==============================================
    // methods
    //==============================================
    /**
     * 現在のテーブルを設定・取得します。
     *
     * @param   null|Table  $table  現在のテーブル
     * @return  Table|static    現在のテーブルまたはこのインスタンス
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
     * 新しいテーブルを設定・取得します。
     *
     * @param   null|Table  $table  新しいテーブル
     * @return  Table|static    新しいテーブルまたはこのインスタンス
     */
    public function newTable($table = null)
    {
        if ($table === null && func_num_args() === 0) {
            return $this->newTable;
        }

        if (!($table instanceof Table)) {
            $table  = Table::factory($table);
        }

        $this->newTable = $table;
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
        return sprintf('ALTER TABLE `%s` RENAME TO `%s`;', $this->table->getName(), $this->newTable->getName());
    }

    /**
     * __clone
     */
    public function __clone()
    {
        $this->table    = clone $this->table;
        $this->newTable = clone $this->newTable;
    }
}
