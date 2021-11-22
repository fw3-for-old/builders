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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\sub_types;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\AbstractDataType;
use fw3_for_old\strings\converter\Convert;

/**
 * データ型：サブタイプ：固定小数点型用桁情報
 */
class FixedPointDigit extends AbstractDataType
{
    //==============================================
    // consts
    //==============================================
    /**
     * @var string  型名
     */
    const TYPE  = 'fixed_point_digit';

    //==============================================
    // properties
    //==============================================
    /**
     * @var null|int    桁数
     */
    protected $length = null;

    /**
     * @var null|int    桁数の内、小数点以下の桁数
     */
    protected $decimals = null;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     */
    protected function __construct()
    {
    }

    /**
     * factory
     *
     * @param   int|FixedPointDigit|null    $length     桁数
     * @param   int|FixedPointDigit|null    $decimals   桁数の内、小数点以下の桁数
     * @return  static  このインスタンス
     */
    public static function factory($length = null, $decimals = null)
    {
        $instance   = new static();
        if ($length !== null) {
            $instance->setDigit($length, $decimals);
        }
        return $instance;
    }

    /**
     * 桁を設定・取得します。
     *
     * @param   int|FixedPointDigit $length     桁数
     * @param   int|FixedPointDigit $decimals   桁数の内、小数点以下の桁数
     * @return  static|int  このインスタンスまたは桁
     */
    public function setDigit($length, $decimals = null)
    {
        if ($length instanceof FixedPointDigit) {
            $length = $length->getDecimal();
        }

        if (false === filter_var($length, \FILTER_VALIDATE_INT)) {
            $this->addError(static::TYPE, sprintf('桁数には数値のみを指定してください。length:%s', Convert::toDebugString($length, 2)));
            return $this;
        }

        if ($length < 1) {
            $this->addError(static::TYPE, sprintf('桁数は1以上を指定してください。length:%s', Convert::toDebugString($length, 2)));
            return $this;
        }

        if ($decimals !== null) {
            if ($decimals instanceof FixedPointDigit) {
                $decimals = $decimals->getDecimal();
            }

            if (false === filter_var($decimals, \FILTER_VALIDATE_INT)) {
                $this->addError(static::TYPE, sprintf('小数点以下の桁数には数値のみを指定してください。decimals:%s', Convert::toDebugString($decimals, 2)));
                return $this;
            }

            if ($decimals < 0) {
                $this->addError(static::TYPE, sprintf('小数点以下の桁数は0以上を指定してください。decimals:%s', Convert::toDebugString($decimals, 2)));
                return $this;
            }

            if ($decimals >= $length) {
                $this->addError(static::TYPE, sprintf('小数点以下の桁数は桁数 - 1に収まるようにしてください。length:%s, decimals:%s', Convert::toDebugString($decimals, 2), Convert::toDebugString($decimals, 2)));
                return $this;
            }
        }

        $this->length   = $length;
        $this->decimals = $decimals;

        return $this;
    }

    /**
     * 桁数を返します。
     *
     * @return  null|int    桁数
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * 桁数の内、小数点以下の桁数を返します。
     *
     * @return  null|int    桁数の内、小数点以下の桁数
     */
    public function getDecimals()
    {
        return $this->decimals;
    }

    /**
     * 有効な情報を保持できているかを返します。
     *
     * @return  bool    有効な情報を保持できているか
     */
    public function enabled()
    {
        return is_int($this->length) && (is_int($this->decimals) || $this->decimals === null);
    }
}