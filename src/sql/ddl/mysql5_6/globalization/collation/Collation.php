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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\globalization\collation;

use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;
use fw3_for_old\builders\sql\ddl\mysql5_6\exceptions\UnbuildableException;
use fw3_for_old\builders\sql\ddl\mysql5_6\globalization\charset\Charset;
use fw3_for_old\strings\converter\Convert;

/**
 * 照合順序
 */
class Collation extends AbstractDdlBuilder
{
    //==============================================
    // consts
    //==============================================
    // 言語名
    //----------------------------------------------
    /**
     * @var string  言語名：全般
     */
    const LANG_GENERAL  = 'general';

    /**
     * @var string  言語名：日本語
     */
    const LANG_JAPANESE = 'japanese';

    /**
     * @var string  デフォルトの言語名
     */
    const DEFAULT_LANG  = self::LANG_GENERAL;

    /**
     * @var array   言語名マップ
     */
    public static $LANG_MAP = array(
        self::LANG_GENERAL  => self::LANG_GENERAL,
        self::LANG_JAPANESE => self::LANG_JAPANESE,
    );

    //----------------------------------------------
    // 接尾辞
    //----------------------------------------------
    /**
     * @var string  接尾辞：アクセントで区別しない
     */
    const SUFFIX_ACCENT_INSENSITIVE = 'ai';

    /**
     * @var string  接尾辞：アクセントで区別する
     */
    const SUFFIX_ACCENT_SENSITIVE   = 'as';

    /**
     * @var string  接尾辞：大文字小文字を区別しない
     */
    const SUFFIX_CASE_INSENSITIVE   = 'ci';

    /**
     * @var string  接尾辞：大文字小文字を区別する
     */
    const SUFFIX_CASE_SENSITIVE     = 'cs';

    /**
     * @var string  接尾辞：バイナリコード順で取り扱う
     */
    const SUFFIX_BINARY             = 'bin';

    /**
     * @var string  デフォルトの接尾辞
     */
    const DEFAULT_SUFFIX    = self::SUFFIX_CASE_INSENSITIVE;

    /**
     * @var array   接尾辞マップ
     */
    public static $SUFFIX_MAP   = array(
        self::SUFFIX_ACCENT_INSENSITIVE => self::SUFFIX_ACCENT_INSENSITIVE,
        self::SUFFIX_ACCENT_SENSITIVE   => self::SUFFIX_ACCENT_SENSITIVE,
        self::SUFFIX_CASE_INSENSITIVE   => self::SUFFIX_CASE_INSENSITIVE,
        self::SUFFIX_CASE_SENSITIVE     => self::SUFFIX_CASE_SENSITIVE,
        self::SUFFIX_BINARY             => self::SUFFIX_BINARY,
    );

    //==============================================
    // properties
    //==============================================
    /**
     * @var Charset 文字セット
     */
    protected $charset;

    /**
     * @var ?string 言語名
     */
    protected $lang;

    /**
     * @var string  接尾辞
     */
    protected $suffix;

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
     * @param   ?string|array   $charset    文字セット または 照合順序指定配列
     * @param   ?string $suffix 言語名
     * @param   ?string $lang   接尾辞
     * @return  static  このインスタンス
     */
    public static function factory($charset = null, $suffix = null, $lang = null)
    {
        if (is_array($charset)) {
            $lang       = isset($charset['lang']) || array_key_exists('lang', $charset) ? $charset['lang'] : (isset($charset[2]) || array_key_exists(2, $charset) ? $charset[2] : self::DEFAULT_LANG);
            $suffix     = isset($charset['suffix']) ? $charset['suffix'] : (isset($charset[1]) ? $charset[1] : null);
            $charset    = isset($charset['charset']) ? $charset['charset'] : (isset($charset[0]) ? $charset[0] : null);
        } elseif (is_string($charset) && func_num_args() === 1) {
            $charset    = explode('_', $charset, 3);
            if (!isset($charset[2])) {
                $suffix     = isset($charset[1]) ? $charset[1] : null;
                $charset    = isset($charset[0]) ? $charset[0] : null;
            } else {
                $suffix     = isset($charset[2]) ? $charset[2] : null;
                $lang       = isset($charset[1]) ? $charset[1] : self::DEFAULT_LANG;
                $charset    = isset($charset[0]) ? $charset[0] : null;
            }
        } elseif (func_num_args() < 3) {
            $lang       = self::DEFAULT_LANG;
        }

        $instance   = new static();
        $instance->charset($charset === null ? Charset::DEFAULT_CHARSET : $charset);
        $instance->suffix($suffix === null ? self::DEFAULT_SUFFIX : $suffix);
        $instance->lang($lang);
        return $instance;
    }

    /**
     * 文字セットを設定・取得します。
     *
     * @param   Charset|string|null $charset    文字セット
     * @return  Charset|string  このインスタンスまたは文字セット
     */
    public function charset($charset = null)
    {
        if ($charset === null && func_num_args() === 0) {
            return $this->charset;
        }

        if (!($charset instanceof Charset)) {
            $charset    = Charset::factory($charset);
        }

        if ($charset->hasErrors()) {
            $this->mergeErrors($charset);
            return $this;
        }

        $this->charset  = $charset;
        return $this;
    }

    /**
     * 文字セットとしてlatin1を使用します。
     *
     * @return  static  このインスタンス
     */
    public function latin1()
    {
        return $this->charset(Charset::LATIN1);
    }

    /**
     * 文字セットとしてbinaryを使用します。
     *
     * @return  static  このインスタンス
     */
    public function binary()
    {
        return $this->charset(Charset::BINARY);
    }

    /**
     * 文字セットとしてcp932を使用します。
     *
     * @return  static  このインスタンス
     */
    public function sjisWin()
    {
        return $this->charset(Charset::CP932);
    }

    /**
     * 文字セットとしてeuc-jpを使用します。
     *
     * @return  static  このインスタンス
     */
    public function eucJpWin()
    {
        return $this->charset(Charset::EUC_JPMS);
    }

    /**
     * 文字セットとしてutf8mb4を使用します。
     *
     * @return  static  このインスタンス
     */
    public function utf8mb4()
    {
        return $this->charset(Charset::UTF8MB4);
    }

    /**
     * 言語名を設定・取得します。
     *
     * @param   string|null $lang   言語名
     * @return  static|string|null  このインスタンスまたは言語名
     */
    public function lang($lang = null)
    {
        if ($lang === null) {
            if (func_num_args() === 0) {
                return $this->lang;
            }

            $this->lang = $lang;
            return $this;
        }

        if (!isset(self::$LANG_MAP[$lang])) {
            $this->addError('lang', new UnbuildableException(sprintf('未知の言語名を与えられました。lang:%s', Convert::toDebugString($lang, 2))));
            return $this;
        }

        $this->lang = $lang;
        return $this;
    }

    /**
     * 言語としてgeneralを使用します。
     *
     * @return  static  このインスタンス
     */
    public function general()
    {
        return $this->lang(self::LANG_GENERAL);
    }

    /**
     * 言語としてjapaneseを使用します。
     *
     * @return  static  このインスタンス
     */
    public function japanese()
    {
        return $this->lang(self::LANG_JAPANESE);
    }

    /**
     * 接尾辞を設定・取得します。
     *
     * @param   string|null $suffix 接尾辞
     * @return  static|string   このインスタンスまたは接尾辞
     */
    public function suffix($suffix = null)
    {
        if ($suffix === null && func_num_args() === 0) {
            return $this->suffix;
        }

        if (!isset(self::$SUFFIX_MAP[$suffix])) {
            $this->addError('suffix', new UnbuildableException(sprintf('未知のsuffixを与えられました。suffix:%s', Convert::toDebugString($suffix, 2))));
            return $this;
        }

        $this->suffix   = $suffix;
        return $this;
    }

    /**
     * 接尾辞として`アクセントで区別しない`を使用します。
     *
     * @return  static  このインスタンス
     */
    public function accentInsensitive()
    {
        return $this->suffix(self::SUFFIX_ACCENT_INSENSITIVE);
    }

    /**
     * 接尾辞として`アクセントで区別する`を使用します。
     *
     * @return  static  このインスタンス
     */
    public function accentSensitive()
    {
        return $this->suffix(self::SUFFIX_ACCENT_SENSITIVE);
    }

    /**
     * 接尾辞として`大文字小文字を区別しない`を使用します。
     *
     * @return  static  このインスタンス
     */
    public function caseInsensitive()
    {
        return $this->suffix(self::SUFFIX_CASE_INSENSITIVE);
    }

    /**
     * 接尾辞として`大文字小文字を区別しない`を使用します。
     *
     * @return  static  このインスタンス
     */
    public function ci()
    {
        return $this->suffix(self::SUFFIX_CASE_INSENSITIVE);
    }

    /**
     * 接尾辞として`大文字小文字を区別する`を使用します。
     *
     * @return  static  このインスタンス
     */
    public function caseSensitive()
    {
        return $this->suffix(self::SUFFIX_CASE_SENSITIVE);
    }

    /**
     * 接尾辞として`大文字小文字を区別する`を使用します。
     *
     * @return  static  このインスタンス
     */
    public function cs()
    {
        return $this->suffix(self::SUFFIX_CASE_SENSITIVE);
    }

    /**
     * 接尾辞として`バイナリコード順で取り扱う`を使用します。
     *
     * @return  static  このインスタンス
     */
    public function bin()
    {
        return $this->suffix(self::SUFFIX_BINARY);
    }

    /**
     * 照合順序を構築し返します。
     *
     * @return  string  照合順序
     */
    public function build()
    {
        $this->validBuildable();

        if ($this->charset === Charset::BINARY && $this->suffix !== self::SUFFIX_BINARY) {
            throw new \Exception(sprintf('使用できない文字セットと照合順序接尾辞です。charset:%s, suffix:%s', Convert::toDebugString($this->charset, 2), Convert::toDebugString($this->suffix, 2)));
        }

        $charset    = $this->charset->build();

        if ($this->lang === null) {
            $collation  = sprintf('%s_%s', $charset, $this->suffix);
        } else {
            $collation  = sprintf('%s_%s_%s', $charset, $this->lang, $this->suffix);
        }

        return sprintf('DEFAULT COLLATE=%s', $collation);
    }

    /**
     * __clone
     */
    public function __clone()
    {
        if (is_object($this->charset)) {
            $this->charset  = clone $this->charset;
        }
    }
}
