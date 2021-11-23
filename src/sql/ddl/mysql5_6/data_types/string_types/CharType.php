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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types\abstracts\AbstractCharacterType;

/**
 * データ型：char型
 */
class CharType extends AbstractCharacterType
{
    //==============================================
    // consts
    //==============================================
    /**
     * @var string  型名
     */
    const TYPE  = 'char';

    /**
     * @var int     最大桁数
     */
    const MAX_LENGTH    = 255;
}
