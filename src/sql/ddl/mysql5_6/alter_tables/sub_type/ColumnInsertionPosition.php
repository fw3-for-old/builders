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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\alter_tables\sub_type;

use fw3_for_old\builders\sql\ddl\mysql5_6\Column;
use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;
use fw3_for_old\strings\converter\Convert;

/**
 * カラム挿入位置
 *
 * [FIRST | AFTER col_name]
 */
class ColumnInsertionPosition extends AbstractDdlBuilder
{
    /**
     * @var string  挿入位置：先頭
     */
    const POSITION_FIRST    = 'FIRST';

    /**
     * @var string  挿入位置：指定したカラムの後ろ
     */
    const POSITION_AFTER    = 'AFTER';

    /**
     * @var array   挿入位置マップ
     */
    protected static $POSITION_MAP  = array(
        self::POSITION_FIRST    => self::POSITION_FIRST,
        self::POSITION_AFTER    => self::POSITION_AFTER,
    );

    /**
     * @var string|null 挿入位置
     */
    protected $position = null;

    /**
     * @var Column  基準とするカラム
     */
    protected $column   = null;

    /**
     * constructor
     *
     * @param   string  $position   挿入位置
     */
    protected function __construct($position, $column)
    {
        $position === null ?: $this->position($position);
        $column === null ?: $this->column($column);
    }

    /**
     * factory
     *
     * @param   string          $position   挿入位置
     * @param   Column|string   $column     基準とするカラム
     * @return  static  このインスタンス
     */
    public static function factory($position = null, $column = null)
    {
        return new static($position, $column);
    }

    /**
     * 挿入位置を取得・設定します。
     *
     * @param   null|string $position   挿入位置
     * @return  static|string|null  挿入位置またはこのインスタンス
     */
    public function position($position = null)
    {
        if ($position === null && func_num_args() === 0) {
            return $this->position;
        }

        if ($position !== null && !isset(self::$POSITION_MAP[$position])) {
            $this->addError('column_insertion_position', sprintf('未知の挿入位置を指定されました。position:%s', Convert::toDebugString($position, 2)));
            return $this;
        }

        $this->position = $position;

        return $this;
    }

    /**
     * テーブルの先頭に挿入します。
     *
     * @return  static  このインスタンス
     */
    public function first()
    {
        $this->position(self::POSITION_FIRST);
        return $this;
    }

    /**
     * 基準とするカラムの後ろに挿入します。
     *
     * @param   string|Column   $column 基準とするカラム
     * @return  static  このインスタンス
     */
    public function after($column)
    {
        $this->position(self::POSITION_AFTER);
        $this->column($column);
        return $this;
    }

    /**
     * 基準とするカラムを取得・設定します。
     *
     * @param   null|string|Column  $column 基準とするカラム
     * @return  static|Column|null  基準とするカラムまたはこのインスタンス
     */
    public function column($column = null)
    {
        if ($column === null && func_num_args() === 0) {
            return $this->column;
        }

        if (!($column instanceof Column)) {
            $column = Column::factory($column);
            if ($column->hasErrors()) {
                $this->mergeErrors($column, 'column_insertion_position');
                return $this;
            }
        }

        $this->column   = $column;

        return $this;
    }

    /**
     * builder
     *
     * @return  string  build結果
     */
    public function build()
    {
        if ($this->hasErrors()) {
            throw new UnableBuildException();
        }

        if ($this->position === null || $this->position === self::POSITION_AFTER) {
            if ($this->column === null) {
                return '';
            }

            return sprintf('AFTER `%s`', $this->column->name());
        }

        return 'FIRST';
    }

    /**
     * build対象があるかどうかを返します。
     *
     * @return  bool    build対象があるかどうか
     */
    public function exists()
    {
        return $this->position === self::POSITION_FIRST || $this->column !== null;
    }
}
