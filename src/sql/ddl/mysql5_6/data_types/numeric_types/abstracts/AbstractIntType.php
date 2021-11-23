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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\abstracts;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\AbstractDataType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\Unsignedable;

/**
 * 抽象データ型：整数型
 */
abstract class AbstractIntType extends AbstractDataType implements Unsignedable
{
    //==============================================
    // properties
    //==============================================
    /**
     * @var bool    符号無しとするかどうか
     */
    protected $unsigned = false;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   bool    $unsigned   符号無しとするかどうか
     */
    protected function __construct($unsigned = null)
    {
        is_bool($unsigned) && $unsigned ? $this->unsigned() : $this->signed();
    }

    /**
     * factory
     *
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public static function factory($unsigned = null)
    {
        return new static($unsigned);
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
     * builder
     */
    public function build()
    {
        return $this->unsigned ? sprintf('%s unsigned', static::TYPE) : static::TYPE;
    }
}
