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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\data_types\datetime_types\abstracts;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\AbstractDataType;

/**
 * 抽象データ型：日付・時間型
 */
abstract class AbstractDatetimeType extends AbstractDataType
{
    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     */
    protected function __construct($unsigned = null)
    {
    }

    /**
     * factory
     *
     * @return  static  このインスタンス
     */
    public static function factory()
    {
        return new static();
    }

    //==============================================
    // methods
    //==============================================
    /**
     * builder
     */
    public function build()
    {
        return static::TYPE;
    }
}
