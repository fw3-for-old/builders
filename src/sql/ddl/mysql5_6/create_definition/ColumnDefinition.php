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
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\DataType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\AbstractDataType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\Digitable;
use fw3_for_old\strings\converter\Convert;

/**
 * カラム定義
 */
class ColumnDefinition extends AbstractDdlBuilder
{
    //==============================================
    // consts
    //==============================================
    /**
     * @var int     カラムコメントの最大文字列長
     */
    const COMMENT_MAX_LENGTH    = 1024;

    //==============================================
    // properties
    //==============================================
    /**
     * @var AbstractDataType    データ型
     */
    protected $dataType = null;

    /**
     * @var null|int    長さ
     */
    protected $length   = null;

    /**
     * @var bool        unsigned
     */
    protected $unsigned = false;

    /**
     * @var int         decimals
     */
    protected $decimals   = null;

    /**
     * @var bool        binary
     */
    protected $binary   = false;

    /**
     * @var null|bool   NOT NULL制約
     */
    protected $notNull  = null;

    /**
     * @var array   デフォルト値
     *              "値が無い"を表現するために配列として定義
     */
    protected $defaultValue     = array();

    /**
     * @var bool    AUTO_INCREMENT
     */
    protected $autoIncrement    = false;

    /**
     * @var Key INDEXキー
     */
    protected $key;

    /**
     * @var null|string コメント
     */
    protected $comment  = null;

    /**
     * @var ColumnFormat    カラムフォーマット
     */
    protected $columnFormat;

    /**
     * @var Storage ストレージ
     */
    protected $storage;

    /**
     * @var array   コメント定義値マップ
     */
    protected $map      = array();

    //==============================================
    // factorys
    //==============================================
    /**
     * constructor
     */
    protected function __construct()
    {
        $this->key          = Key::factory();
        $this->columnFormat = ColumnFormat::factory();
        $this->storage      = Storage::factory();
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
     * このカラムをbit型とします。
     *
     * @param   int     $length bit長さ
     * @return  static  このインスタンス
     */
    public function bit($length = null)
    {
        $this->dataType = DataType::bit(func_num_args() === 0 ? $this->length : $length);
        return $this;
    }

    /**
     * このカラムをtinyint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function tinyint($unsigned = null)
    {
        $this->dataType = DataType::tinyint(func_num_args() === 0 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをsmallint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function smallint($unsigned = null)
    {
        $this->dataType = DataType::smallint(func_num_args() === 0 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをmediumint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function mediumint($unsigned = null)
    {
        $this->dataType = DataType::mediumint(func_num_args() === 0 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをbigint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function bigint($unsigned = null)
    {
        $this->dataType = DataType::bigint(func_num_args() === 0 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをint型とします。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function int($unsigned = null)
    {
        $this->dataType = DataType::int(func_num_args() === 0 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをreal型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function real($length = null, $decimals = null, $unsigned = null)
    {
        $func_num_args = func_num_args();
        $this->dataType = DataType::real($func_num_args === 0 ? $this->length : $length, $func_num_args < 2 ? $this->decimals : $decimals, $func_num_args < 3 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをdouble型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function double($length = null, $decimals = null, $unsigned = null)
    {
        $func_num_args = func_num_args();
        $this->dataType = DataType::double($func_num_args === 0 ? $this->length : $length, $func_num_args < 2 ? $this->decimals : $decimals, $func_num_args < 3 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをfloat型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function float($length = null, $decimals = null, $unsigned = null)
    {
        $func_num_args = func_num_args();
        $this->dataType = DataType::float($func_num_args === 0 ? $this->length : $length, $func_num_args < 2 ? $this->decimals : $decimals, $func_num_args < 3 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをdecimal型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  static  このインスタンス
     */
    public function decimal($length = null, $decimals = null, $unsigned = null)
    {
        $func_num_args = func_num_args();
        $this->dataType = DataType::decimal($func_num_args === 0 ? $this->length : $length, $func_num_args < 2 ? $this->decimals : $decimals, $func_num_args < 3 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをnumeric型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     */
    public function numeric($length = null, $decimals = null, $unsigned = null)
    {
        $func_num_args = func_num_args();
        $this->dataType = DataType::numeric($func_num_args === 0 ? $this->length : $length, $func_num_args < 2 ? $this->decimals : $decimals, $func_num_args < 3 ? $this->unsigned : $unsigned);
        return $this;
    }

    /**
     * このカラムをdate型とします。
     *
     * @return  static  このインスタンス
     */
    public function date()
    {
        $this->dataType = DataType::date();
        return $this;
    }

    /**
     * このカラムをtime型とします。
     *
     * @return  static  このインスタンス
     */
    public function time()
    {
        $this->dataType = DataType::time();
        return $this;
    }

    /**
     * このカラムをtimestamp型とします。
     *
     * @return  static  このインスタンス
     */
    public function timestamp()
    {
        $this->dataType = DataType::timestamp();
        return $this;
    }

    /**
     * このカラムをdatetime型とします。
     *
     * @return  static  このインスタンス
     */
    public function datetime()
    {
        $this->dataType = DataType::datetime();
        return $this;
    }

    /**
     * このカラムをyear型とします。
     *
     * @return  static  このインスタンス
     */
    public function year()
    {
        $this->dataType = DataType::year();
        return $this;
    }

    /**
     * このカラムをchar型とします。
     *
     * @param   int     $length 文字列長
     * @return  static  このインスタンス
     */
    public function char($length = null)
    {
        $this->dataType = DataType::char(func_num_args() === 0 ? $this->length: $length);
        return $this;
    }

    /**
     * このカラムをvarchar型とします。
     *
     * @param   int     $length 文字列長
     * @return  static  このインスタンス
     */
    public function varchar($length = null)
    {
        $this->dataType = DataType::varchar(func_num_args() === 0 ? $this->length: $length);
        return $this;
    }

    /**
     * このカラムをtext型とします。
     *
     * @param   bool    $binary 文字列モード
     * @return  static  このインスタンス
     */
    public function text($binary = false)
    {
        $this->dataType = DataType::text(func_num_args() === 0 ? $this->binary : $binary);
        return $this;
    }

    /**
     * このカラムをmediumtext型とします。
     *
     * @param   bool    $binary 文字列モード
     * @return  static  このインスタンス
     */
    public function mediumtext($binary = false)
    {
        $this->dataType = DataType::mediumtext(func_num_args() === 0 ? $this->binary : $binary);
        return $this;
    }

    /**
     * このカラムをlongtext型とします。
     *
     * @param   bool    $binary 文字列モード
     * @return  static  このインスタンス
     */
    public function longtext($binary = false)
    {
        $this->dataType = DataType::longtext(func_num_args() === 0 ? $this->binary : $binary);
        return $this;
    }

    /**
     * このカラムに長さを設定します。
     *
     * @return  static  このインスタンス
     */
    public function length($length)
    {
        $this->length   = $length;
        if (is_object($this->dataType) && is_subclass_of($this->dataType, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\abstracts\\Lengthable")) {
            $this->dataType->length(func_num_args() === 0 ? $this->length: $length);
        }

        return $this;
    }

    /**
     * このカラムをunsignedにします。
     *
     * @return  static  このインスタンス
     */
    public function unsigned()
    {
        $this->unsigned = true;
        if (is_object($this->dataType) && is_subclass_of($this->dataType, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\abstracts\\Unsignedable")) {
            $this->dataType->unsigned();
        }

        return $this;
    }

    /**
     * このカラムをsignedにします。
     *
     * @return  static  このインスタンス
     */
    public function signed()
    {
        $this->unsigned = false;
        if (is_object($this->dataType) && is_subclass_of($this->dataType, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\abstracts\\Unsignedable")) {
            $this->dataType->signed();
        }

        return $this;
    }

    /**
     * このカラムをbinaryにします。
     *
     * @return  static  このインスタンス
     */
    public function binary()
    {
        $this->binary = true;
        if (is_object($this->dataType) && is_subclass_of($this->dataType, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\abstracts\\Binaryable")) {
            $this->dataType->binary();
            $this->binary = true;
        }

        return $this;
    }

    /**
     * このカラムをnon binaryにします。
     *
     * @return  static  このインスタンス
     */
    public function nonBinary()
    {
        $this->binary = false;
        if (is_object($this->dataType) && is_subclass_of($this->dataType, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\abstracts\\Binaryable")) {
            $this->dataType->nonBinary();
        }

        return $this;
    }

    /**
     * このカラムに桁を設定します。
     *
     * @param   int|Digitable   $length     桁数
     * @param   int|Digitable   $decimals   桁数の内、小数点以下の桁数
     * @return  static  このインスタンス
     */
    public function setDigit($length, $decimals = null)
    {
        $this->length   = $length;
        $this->decimals = $decimals;
        if (is_object($this->dataType) && is_subclass_of($this->dataType, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\abstracts\\Digitable")) {
            $this->dataType->setDigit($length, $decimals);
        }

        return $this;
    }

    /**
     * データタイプを返します。
     *
     * @return  AbstractDataType|null   データタイプ
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * NOT NULL制約を付けます。
     *
     * @return  static  このインスタンス
     */
    public function notNull()
    {
        $this->notNull  = true;
        return $this;
    }

    /**
     * NULL制約を付けます。
     *
     * @return  static  このインスタンス
     */
    public function nullConstrain()
    {
        $this->notNull  = false;
        return $this;
    }

    /**
     * NULL制約を解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetNullConstrain()
    {
        $this->notNull  = null;
        return $this;
    }

    /**
     * デフォルト値を設定・取得します。
     *
     * @param   mixed|null  $default_value  デフォルト値
     * @param   static|mixed    このインスタンスまたはデフォルト値
     */
    public function defaultValue($default_value)
    {
        $this->defaultValue = array($default_value);
        return $this;
    }

    /**
     * デフォルト値をクリアします。
     *
     * @return  static  このインスタンス
     */
    public function unsetDefaultValue()
    {
        $this->defaultValue  = array();
        return $this;
    }

    /**
     * AUTO INCREMENTを設定します。
     *
     * @return  static  このインスタンス
     */
    public function autoIncrement()
    {
        $this->autoIncrement    = true;
        return $this;
    }

    /**
     * AUTO INCREMENTをクリアします。
     *
     * @return  static  このインスタンス
     */
    public function unsetAutoIncrement()
    {
        $this->autoIncrement    = false;
        return $this;
    }

    /**
     * キーをUNIQUEにします。
     *
     * @return  static  このインスタンス
     */
    public function unique()
    {
        $this->key->unique();
        return $this;
    }

    /**
     * キーをPRIMARYにします。
     *
     * @return  static  このインスタンス
     */
    public function primary()
    {
        $this->key->primary();
        return $this;
    }

    /**
     * キーをunsetします。
     *
     * @return  static  このインスタンス
     */
    public function unsetKey()
    {
        $this->key->unset();
        return $this;
    }

    /**
     * コメントを設定します。
     *
     * @param   string  $comment    コメント
     * @param   array   $map        定義値マップ
     * @return  static  このインスタンス
     */
    public function comment($comment, $map = array())
    {
        if (($length = mb_strlen($comment)) > self::COMMENT_MAX_LENGTH) {
            throw new \Exception(sprintf('カラムコメントの最大文字列長を超過しました。comment:%s, max_length:%d, length:%s', Convert::toDebugString($comment, 2), self::COMMENT_MAX_LENGTH, $length));
        }

        $this->comment  = $comment;
        $this->map      = $map;

        return $this;
    }

    /**
     * このカラムフォーマットをUNIQUEにします。
     *
     * @return  static  このインスタンス
     */
    public function fixed()
    {
        $this->columnFormat->fixed();
        return $this;
    }

    /**
     * このカラムフォーマットをDYNAMICにします。
     *
     * @return  static  このインスタンス
     */
    public function dynamic()
    {
        $this->columnFormat->dynamic();
        return $this;
    }

    /**
     * このカラムフォーマットをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultColumnFormat()
    {
        $this->columnFormat->defaultFormat();
        return $this;
    }

    /**
     * このカラムフォーマットを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetColumnFormat()
    {
        $this->columnFormat->unsetFormat();
        return $this;
    }

    /**
     * このストレージをDISKにします。
     *
     * @return  static  このインスタンス
     */
    public function disk()
    {
        $this->storage->disk();
        return $this;
    }

    /**
     * このストレージをMEMORYにします。
     *
     * @return  static  このインスタンス
     */
    public function memory()
    {
        $this->storage->memory();
        return $this;
    }

    /**
     * このストレージをDEFAULTにします。
     *
     * @return  static  このインスタンス
     */
    public function defaultStorage()
    {
        $this->storage->defaultFormat();
        return $this;
    }

    /**
     * このストレージを解除します。
     *
     * @return  static  このインスタンス
     */
    public function unsetStorage()
    {
        $this->storage->unsetFormat();
        return $this;
    }

    /**
     * 現在の状態を返します。
     *
     * @return  array   現在の状態
     */
    public function getState()
    {
        if ($this->dataType === null) {
            throw new \Exception('型が指定されていません。');
        }

        $comment    = $this->comment;
        if ($comment !== null) {
            if (!empty($this->map)) {
                if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
                    $json_options   = constant("\\JSON_UNESCAPED_SLASHES") | constant("\\JSON_UNESCAPED_UNICODE");
                } else {
                    $json_options   = 0;
                }

                $comment    = sprintf('%s const:%s', $this->comment, json_encode($this->map, $json_options));

                if (($length = mb_strlen($comment)) > self::COMMENT_MAX_LENGTH) {
                    throw new \Exception(sprintf('カラムコメントの最大文字列長を超過しました。comment:%s, max_length:%d, length:%s', Convert::toDebugString($comment, 2), self::COMMENT_MAX_LENGTH, $length));
                }
            }
        }

        return array(
            'data_type'         => $this->dataType->build(),
            'not_null'          => is_bool($this->notNull) ? ($this->notNull ? 'NOT NULL' : 'NULL') : null,
            'default'           => isset($this->defaultValue[0]) || array_key_exists(0, $this->defaultValue) ? sprintf('DEFAULT %s', $this->defaultValue[0] === null ? 'null' : Convert::toDebugString((string) $this->defaultValue[0])) : null,
            'auto_increment'    => $this->autoIncrement ? 'AUTO_INCREMENT' : null,
            'key'               => $this->key->exists() ? $this->key->build() : null,
            'comment'           => $comment === null ? null : sprintf('COMMENT \'%s\'', str_replace('\'', '\\\'', $comment)),
            'column_format'     => $this->columnFormat->exists() ? $this->columnFormat->build() : null,
            'storage'           => $this->storage->exists() ? $this->storage->build() : null,
        );
    }

    /**
     * このカラム定義を文字列表現にして返します。
     *
     * @return  string  カラム定義の文字列表現
     */
    public function build()
    {
        return implode(' ', array_filter($this->getState()));
    }

    /**
     * __clone
     */
    public function __clone()
    {
        !is_object($this->dataType)     ?: $this->dataType      = clone $this->dataType;
        !is_object($this->key)          ?: $this->key           = clone $this->key;
        !is_object($this->columnFormat) ?: $this->columnFormat  = clone $this->columnFormat;
        !is_object($this->storage)      ?: $this->storage       = clone $this->storage;
    }
}
