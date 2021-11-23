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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\storage_engine;

use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;
use fw3_for_old\strings\converter\Convert;

/**
 * ストレージエンジン
 */
class StorageEngine extends AbstractDdlBuilder
{
    //==============================================
    // consts
    //==============================================
    // ストレージエンジン
    //----------------------------------------------
    /**
     * @var string  ストレージエンジン：InnoDB
     */
    const INNO_DB   = 'InnoDB';

    /**
     * @var string  ストレージエンジン：MyISAM
     */
    const MY_ISAM   = 'MyISAM';

    /**
     * @var string  ストレージエンジン：MEMORY
     */
    const MEMORY    = 'MEMORY';

    /**
     * @var string  ストレージエンジン：CSV
     */
    const CSV       = 'CSV';

    /**
     * @var string  ストレージエンジン：ARCHIVE
     */
    const ARCHIVE   = 'ARCHIVE';

    /**
     * @var string  ストレージエンジン：BLACKHOLE
     */
    const BLACKHOLE = 'BLACKHOLE';

    /**
     * @var string  ストレージエンジン：MERGE
     */
    const MERGE     = 'MERGE';

    /**
     * @var string  ストレージエンジン：FEDERATED
     */
    const FEDERATED = 'FEDERATED';

    /**
     * @var string  ストレージエンジン：EXAMPLE
     */
    const EXAMPLE   = 'EXAMPLE';

    /**
     * @var string  デフォルトのストレージエンジン
     */
    const DEFAULT_ENGINE    = self::INNO_DB;

    /**
     * @var array   ストレージエンジンマップ
     */
    public static $MAP  = array(
        self::INNO_DB   => self::INNO_DB,
        self::MY_ISAM   => self::MY_ISAM,
        self::MEMORY    => self::MEMORY,
        self::CSV       => self::CSV,
        self::ARCHIVE   => self::ARCHIVE,
        self::BLACKHOLE => self::BLACKHOLE,
        self::MERGE     => self::MERGE,
        self::FEDERATED => self::FEDERATED,
        self::EXAMPLE   => self::EXAMPLE,
    );

    //==============================================
    // properties
    //==============================================
    /**
     * @var ?string ストレージエンジン
     */
    protected $engine   = null;

    //==============================================
    // methods
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
     * @param   ?string $engine ストレージエンジン名
     * @return  static  このインスタンス
     */
    public static function factory($engine = null)
    {
        $instance   = new static();
        $instance->engine($engine === null ? self::DEFAULT_ENGINE : $engine);
        return $instance;
    }

    /**
     * ストレージエンジン名を設定・取得します。
     *
     * @param   static|string|null  $engine ストレージエンジン名
     * @return  static  このインスタンスまたはストレージエンジン名
     */
    public function engine($engine = null)
    {
        if ($engine === null && func_num_args() === 0) {
            return $this->engine;
        }

        if (is_object($engine) && is_subclass_of($engine, get_called_class())) {
            $engine   = $engine->engine();
        }

        if (!isset(self::$MAP[$engine])) {
            $this->addError('engine', sprintf('未知のストレージエンジン名を与えられました。engine:%s', Convert::toDebugString($engine, 2)));
            return $this;
        }

        $this->engine   = $engine;
        return $this;
    }

    /**
     * ストレージエンジンを構築し返します。
     *
     * @return  string  ストレージエンジン
     */
    public function build()
    {
        return sprintf('ENGINE=%s', $this->engine);
    }
}
