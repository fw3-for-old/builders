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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\create_definition;

use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;

/**
 * ColumnFormat
 */
class ColumnFormat extends AbstractDdlBuilder
{
    /**
     * @var string  カラムフォーマットタイプ：FIXED
     */
    const TYPE_FIXED    = 'FIXED';

    /**
     * @var string  カラムフォーマットタイプ：DYNAMIC
     */
    const TYPE_DYNAMIC  = 'DYNAMIC';

    /**
     * @var string  カラムフォーマットタイプ：DEFAULT
     */
    const TYPE_DEFAULT  = 'DEFAULT';

    /**
     * @var null|string カラムフォーマットタイプ
     */
    protected $type = null;

    /**
     * constructor
     */
    protected function __construct()
    {
    }

    /**
     * factory
     */
    public static function factory()
    {
        return new static();
    }

    /**
     * このカラムフォーマットをFIXEDにします。
     *
     * @return  static  このインスタンス
     */
    public function fixed()
    {
        $this->type = self::TYPE_FIXED;
        return $this;
    }

    /**
     * このカラムフォーマットをDYNAMICにします。
     *
     * @return  static  このインスタンス
     */
    public function dynamic()
    {
        $this->type = self::TYPE_DYNAMIC;
        return $this;
    }

    /**
     * このカラムフォーマットをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultFormat()
    {
        $this->type = self::TYPE_DEFAULT;
        return $this;
    }

    /**
     * このカラムフォーマットを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetFormat()
    {
        $this->type = null;
        return $this;
    }

    /**
     * 有効な値が設定されているかどうかを返します。
     *
     * @return  bool    有効な値が設定されているかどうか
     */
    public function exists()
    {
        return $this->type !== null;
    }

    /**
     * カラムフォーマットを文字列表現にして返します。
     *
     * @return  string  カラムフォーマットの文字列表現
     */
    public function build()
    {
        $this->validBuildable();

        switch ($this->type) {
            case self::TYPE_FIXED:
                return 'COLUMN_FORMAT FIXED';
            case self::TYPE_DYNAMIC:
                return 'COLUMN_FORMAT DYNAMIC';
            case self::TYPE_DEFAULT:
                return 'COLUMN_FORMAT DEFAULT';
        }

        return '';
    }
}
