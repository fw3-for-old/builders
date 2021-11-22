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

use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\AddColumn;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\ChangeColumn;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\DropColumn;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\ModifyColumn;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\Rename;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\RenameColumn;
use fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\RenameIndex;

/**
 * AlterTable façade
 */
abstract class AlterTable
{
    /**
     * テーブル名の変更ビルダを返します。
     *
     * @param   string|Table    $new_table  変更前のテーブル名
     * @param   string|Table    $old_table  変更後のテーブル名
     * @return  Rename  テーブル名の変更ビルダ
     */
    public static function rename($old_table, $new_table)
    {
        return Rename::factory($old_table, $new_table);
    }

    /**
     * カラム追加ビルダを返します。
     *
     * @param   string|Table    $table  テーブル
     * @param   string|Column   $column カラム
     * @return  AddColumn   カラム追加ビルダ
     */
    public static function addColumn($table, $column)
    {
        return AddColumn::factory($table, $column);
    }

    /**
     * カラム除去ビルダを返します。
     *
     * @param   string|Table    $table  テーブル
     * @param   string|Column   $column カラム
     * @return  DropColumn  カラム除去ビルダ
     */
    public static function dropColumn($table, $column)
    {
        return DropColumn::factory($table, $column);
    }

    /**
     * カラム名の変更ビルダを返します。
     *
     * @param   string|Table    $table      テーブル
     * @param   string|Column   $old_column 変更前のカラム名
     * @param   string|Column   $new_column 変更後のカラム名
     * @return  RenameColumn    カラム名の変更ビルダ
     */
    public static function renameColumn($table, $old_column, $new_column)
    {
        return RenameColumn::factory($table, $old_column, $new_column);
    }

    /**
     * カラム定義変更ビルダを返します。
     *
     * @param   string|Table    $table  テーブル
     * @param   string|Column   $column カラム
     * @return  ModifyColumn    カラム定義変更ビルダ
     */
    public static function modifyColumn($table, $column)
    {
        return ModifyColumn::factory($table, $column);
    }

    /**
     * カラム名と定義変更ビルダを返します。
     *
     * @param   string|Table    $table  テーブル
     * @param   string|Column   $old_column 変更前のカラム名
     * @param   string|Column   $new_column 変更後のカラム名
     * @return  ChangeColumn    カラム名と定義変更ビルダ
     */
    public static function changeColumn($table, $old_column, $new_column)
    {
        return ChangeColumn::factory($table, $old_column, $new_column);
    }

    /**
     * インデックス名の変更ビルダを返します。
     *
     * @param   string|Table    $table      テーブル
     * @param   string|Index    $old_index  変更前のインデックス名
     * @param   string|Index    $new_index  変更後のインデックス名
     * @return  RenameIndex インデックス名の変更ビルダ
     */
    public static function renameIndex($table, $index, $new_index)
    {
        return RenameIndex::factory($table, $index, $new_index);
    }
}
