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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types\abstracts;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\AbstractDataType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\Lengthable;
use fw3_for_old\builders\sql\ddl\mysql5_6\exceptions\UnbuildableException;
use fw3_for_old\strings\converter\Convert;

/**
 * 抽象データ型：文字列型
 */
abstract class AbstractCharacterType extends AbstractDataType implements Lengthable
{
    //==============================================
    // consts
    //==============================================
    /**
     * @var int     最小桁数
     */
    const MIN_LENGTH    = 0;

    //==============================================
    // properties
    //==============================================
    /**
     * @var int     最大文字列長
     */
    protected $length   = null;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   int     $length 最大文字列長
     */
    protected function __construct($length = null)
    {
        $this->length($length);
    }

    /**
     * factory
     *
     * @param   int     $length 最大文字列長
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
                $this->addError(static::TYPE, new UnbuildableException(sprintf('文字列長には数値のみを指定してください。length:%s', Convert::toDebugString($length, 2))));
                return $this;
            }

            if ($length < self::MIN_LENGTH) {
                $this->addError(static::TYPE, new UnbuildableException(sprintf('文字列長は%d以上を指定してください。length:%s', self::MIN_LENGTH, Convert::toDebugString($length, 2))));
                return $this;
            }

            if ($length > static::MAX_LENGTH) {
                $this->addError(static::TYPE, new UnbuildableException(sprintf('文字列長は%d以下を指定してください。length:%s', static::MAX_LENGTH, Convert::toDebugString($length, 2))));
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

        return $this->length !== null ? sprintf('%s(%s)', static::TYPE, $this->length) : static::TYPE;
    }
}
