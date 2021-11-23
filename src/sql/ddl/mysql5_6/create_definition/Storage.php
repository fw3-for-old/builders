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
 * Storage
 */
class Storage extends AbstractDdlBuilder
{
    /**
     * @var string  ストレージタイプ：FIXED
     */
    const TYPE_DISK     = 'DISK';

    /**
     * @var string  ストレージタイプ：DYNAMIC
     */
    const TYPE_MEMORY   = 'MEMORY';

    /**
     * @var string  ストレージタイプ：DEFAULT
     */
    const TYPE_DEFAULT  = 'DEFAULT';

    /**
     * @var null|string ストレージタイプ
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
     * このストレージをDISKにします。
     *
     * @return  static  このインスタンス
     */
    public function disk()
    {
        $this->type = self::TYPE_DISK;
        return $this;
    }

    /**
     * このストレージをMEMORYにします。
     *
     * @return  static  このインスタンス
     */
    public function memory()
    {
        $this->type = self::TYPE_MEMORY;
        return $this;
    }

    /**
     * このストレージをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultFormat()
    {
        $this->type = self::TYPE_DEFAULT;
        return $this;
    }

    /**
     * このストレージを解除します。
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
     * ストレージを文字列表現にして返します。
     *
     * @return  string  keyの文字列表現
     */
    public function build()
    {
        $this->validBuildable();

        switch ($this->type) {
            case self::TYPE_DISK:
                return 'STORAGE DISK';
            case self::TYPE_MEMORY:
                return 'STORAGE MEMORY';
            case self::TYPE_DEFAULT:
                return 'STORAGE DEFAULT';
        }

        return '';
    }
}
