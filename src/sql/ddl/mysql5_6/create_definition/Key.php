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
 * key
 */
class Key extends AbstractDdlBuilder
{
    /**
     * @var string  キータイプ：UNIQUE
     */
    const TYPE_UNIQUE   = 'unique';

    /**
     * @var string  キータイプ：PRIMARY
     */
    const TYPE_PRIMARY  = 'primary';

    /**
     * @var null|string キータイプ
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
     * このキーをUNIQUEにします。
     *
     * @return  static  このインスタンス
     */
    public function unique()
    {
        $this->type = self::TYPE_UNIQUE;
        return $this;
    }

    /**
     * このキーをPRIMARYにします。
     *
     * @return  static  このインスタンス
     */
    public function primary()
    {
        $this->type = self::TYPE_PRIMARY;
        return $this;
    }

    /**
     * このキーを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetKey()
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
     * キーを文字列表現にして返します。
     *
     * @return  string  keyの文字列表現
     */
    public function build()
    {
        $this->validBuildable();

        switch ($this->type) {
            case self::TYPE_PRIMARY:
                return 'PRIMARY KEY';
            case self::TYPE_UNIQUE:
                return 'UNIQUE KEY';
        }

        return '';
    }
}
