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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\abstracts;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\AbstractDataType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\Digitable;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\Unsignedable;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\sub_types\FloatingPointDigit;

/**
 * 抽象データ型：浮動小数点型
 */
abstract class AbstractFloatingPointType extends AbstractDataType implements Unsignedable, Digitable
{
    //==============================================
    // properties
    //==============================================
    /**
     * @var bool    符号無しとするかどうか
     */
    protected $unsigned = false;

    /**
     * @var FloatingPointDigit  小数点型用桁情報
     */
    protected $digit;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   int|FloatingPointDigit|null $length     桁数
     * @param   int|FloatingPointDigit|null $decimals   桁数の内、小数点以下の桁数
     * @param   bool                        $unsigned   符号無しとするかどうか
     */
    protected function __construct($length = null, $decimals = null, $unsigned = null)
    {
        $this->digit = FloatingPointDigit::factory();
        if ($length !== null && $decimals !== null) {
            $this->setDigit($length, $decimals);
        }

        is_bool($unsigned) && $unsigned ? $this->unsigned() : $this->signed();
    }

    /**
     * factory
     *
     * @param   int|FloatingPointDigit|null $length     桁数
     * @param   int|FloatingPointDigit|null $decimals   桁数の内、小数点以下の桁数
     * @param   bool                        $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public static function factory($length = null, $decimals = null, $unsigned = null)
    {
        return new static($length, $decimals, $unsigned);
    }

    //==============================================
    // methods
    //==============================================
    /**
     * 符号無しとします。
     *
     * @return  static  このインスタンス
     */
    public function unsigned()
    {
        $this->unsigned = true;
        return $this;
    }

    /**
     * 符号ありとします。
     *
     * @return  static  このインスタンス
     */
    public function signed()
    {
        $this->unsigned = false;
        return $this;
    }

    /**
     * 小数点型用桁情報を設定します。
     *
     * @param   int|FloatingPointDigit  $length     桁数
     * @param   int|FloatingPointDigit  $decimals   桁数の内、小数点以下の桁数
     * @return  static  このインスタンス
     */
    public function setDigit($length, $decimals)
    {
        $this->digit->setDigit($length, $decimals);
        if ($this->digit->hasErrors()) {
            $this->mergeErrors($this->digit, static::TYPE);
            return $this;
        }

        return $this;
    }

    /**
     * 桁数を返します。
     *
     * @return  null|int    桁数
     */
    public function getLength()
    {
        return $this->digit->getLength();
    }

    /**
     * 桁数の内、小数点以下の桁数を返します。
     *
     * @return  null|int    桁数の内、小数点以下の桁数
     */
    public function getDecimals()
    {
        return $this->digit->getDecimals();
    }

    /**
     * builder
     */
    public function build()
    {
        $format = $this->digit->enabled() ? sprintf('(%d, %d)', $this->digit->getLength(), $this->digit->getDecimals()) : '';
        return sprintf($this->unsigned ? '%s%s unsigned' : '%s%s', static::TYPE, $format);
    }

    /**
     * clone
     */
    public function __clone()
    {
        if (is_object($this->digit)) {
            $this->digit = clone $this->digit;
        }
    }
}
