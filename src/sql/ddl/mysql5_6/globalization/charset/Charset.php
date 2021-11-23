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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\globalization\charset;

use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;
use fw3_for_old\builders\sql\ddl\mysql5_6\exceptions\UnbuildableException;
use fw3_for_old\strings\converter\Convert;

/**
 * 文字セット
 */
class Charset extends AbstractDdlBuilder
{
    //==============================================
    // consts
    //==============================================
    // 文字セット
    //----------------------------------------------
    /**
     * @var string  文字セット：cp1252 West European
     */
    const LATIN1    = 'latin1';

    /**
     * @var string  文字セット：Binary pseudo charset
     */
    const BINARY    = 'binary';

    /**
     * @var string  文字セット：SJIS for Windows Japanese
     */
    const CP932 = 'cp932';

    /**
     * @var string  文字セット：alias:SJIS for Windows Japanese
     */
    const SJIS_WIN  = self::CP932;

    /**
     * @var string  文字セット：UJIS for Windows Japanese
     */
    const EUC_JPMS  = 'eucjpms';

    /**
     * @var string  文字セット：alias:UJIS for Windows Japanese
     */
    const EUC_JP_WIN    = self::EUC_JPMS;

    /**
     * @var string  文字セット：UTF-8 Unicode
     */
    const UTF8MB4   = 'utf8mb4';

    /**
     * @var string  デフォルトの文字セット
     */
    const DEFAULT_CHARSET   = self::UTF8MB4;

    /**
     * @var array   文字セットマップ
     */
    public static $MAP  = array(
        self::LATIN1        => self::LATIN1,
        self::BINARY        => self::BINARY,
        self::CP932         => self::CP932,
        self::SJIS_WIN      => self::SJIS_WIN,
        self::EUC_JPMS      => self::EUC_JPMS,
        self::EUC_JP_WIN    => self::EUC_JP_WIN,
        self::UTF8MB4       => self::UTF8MB4,
    );

    //==============================================
    // properties
    //==============================================
    /**
     * @var string  文字セット
     */
    protected $charset;

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
     * @param   ?string $charset    文字セット
     * @return  static  このインスタンス
     */
    public static function factory($charset = null)
    {
        $instance   = new static();
        $instance->charset($charset === null ? Charset::DEFAULT_CHARSET : $charset);
        return $instance;
    }

    /**
     * 文字セットを設定・取得します。
     *
     * @param   string|null $charset    文字セット
     * @return  static|string   このインスタンスまたは文字セット
     */
    public function charset($charset = null)
    {
        if ($charset === null && func_num_args() === 0) {
            return $this->charset;
        }

        if (is_object($charset) && is_subclass_of($charset, get_called_class())) {
            $charset   = $charset->charset();
        }

        if (!isset(self::$MAP[$charset])) {
            $this->addError('charset', new UnbuildableException(sprintf('未知の文字セットを与えられました。charset:%s', Convert::toDebugString($charset, 2))));
            return $this;
        }

        $this->charset  = $charset;
        return $this;
    }

    /**
     * 文字セットを構築し返します。
     *
     * @return  string  文字セット
     */
    public function build()
    {
        $this->validBuildable();

        return $this->charset;
    }
}
