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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\AbstractDataType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\Lengthable;
use fw3_for_old\builders\sql\ddl\mysql5_6\exceptions\UnbuildableException;
use fw3_for_old\strings\converter\Convert;

/**
 * データ型：bit型
 */
class BitType extends AbstractDataType implements Lengthable
{
    //==============================================
    // consts
    //==============================================
    /**
     * @var string  型名
     */
    const TYPE  = 'bit';

    /**
     * @var int     ストレージサイズ：最小
     */
    const STORAGE_SIZE_MIN  = 1;

    /**
     * @var int     ストレージサイズ：最大
     */
    const STORAGE_SIZE_MAX  = 64;

    //==============================================
    // properties
    //==============================================
    /**
     * @var null|int    ビット長
     */
    protected $length   = null;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   int     $length ビット長
     */
    protected function __construct($length = null)
    {
        $this->length($length);
    }

    /**
     * factory
     *
     * @param   int     $length ビット長
     * @return  static  このインスタンス
     */
    public static function factory($length = null)
    {
        return new static($length);
    }

    //==============================================
    // methods
    //==============================================
    /**
     * ビット長を設定・取得します。
     *
     * @param   int|null    $length ビット長
     * @return  static|int  このインスタンスまたはビット長
     */
    public function length($length = null)
    {
        if ($length === null && func_num_args() === 0) {
            return $this->length;
        }

        if ($length !== null) {
            if (false === filter_var($length, \FILTER_VALIDATE_INT)) {
                $this->addError(static::TYPE, new UnbuildableException(sprintf('ストレージサイズには数値のみを指定してください。length:%s', Convert::toDebugString($length, 2))));
                return $this;
            }

            if ($length < self::STORAGE_SIZE_MIN) {
                $this->addError(static::TYPE, new UnbuildableException(sprintf('ストレージサイズには%s以上を指定してください。length:%s', self::STORAGE_SIZE_MIN, Convert::toDebugString($length, 2))));
                return $this;
            }

            if (self::STORAGE_SIZE_MAX < $length) {
                $this->addError(static::TYPE, new UnbuildableException(sprintf('ストレージサイズには%s以下を指定してください。length:%s', self::STORAGE_SIZE_MAX, Convert::toDebugString($length, 2))));
                return $this;
            }
        }

        $this->length   = $length;
        return $this;
    }

    /**
     * builder
     */
    public function build()
    {
        $this->validBuildable();

        return isset($this->length) ? sprintf('bit(%d)', $this->length) : 'bit';
    }
}
