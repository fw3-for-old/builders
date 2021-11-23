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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types\abstracts;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\AbstractDataType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\Binaryable;

/**
 * 抽象データ型：テキスト型
 */
abstract class AbstractTextType extends AbstractDataType implements Binaryable
{
    //==============================================
    // properties
    //==============================================
    /**
     * @var bool    文字列モード
     */
    protected $binary;

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     *
     * @param   bool    $binary 文字列モード
     */
    protected function __construct($binary)
    {
        is_bool($binary) && $binary ? $this->binary() : $this->nonBinary();
    }

    /**
     * factory
     *
     * @param   bool    $binary 文字列モード
     * @return  static  このインスタンス
     */
    public static function factory($binary = false)
    {
        return new static($binary);
    }

    //==============================================
    // methods
    //==============================================
    /**
     * バイナリ文字列として扱います。
     *
     * @return  static  このインスタンス
     */
    public function binary()
    {
        $this->binary = true;
        return $this;
    }

    /**
     * 非バイナリ文字列（文字の文字列）。
     *
     * @return  static  このインスタンス
     */
    public function nonBinary()
    {
        $this->binary = false;
        return $this;
    }

    /**
     * builder
     */
    public function build()
    {
        return $this->binary ? sprintf('%s binary', static::TYPE) : static::TYPE;
    }
}
