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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\data_types;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\abstracts\AbstractDataType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\datetime_types\DateType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\datetime_types\DatetimeType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\datetime_types\TimeType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\datetime_types\TimestampType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\datetime_types\YearType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\BigintType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\BitType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\DecimalType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\DoubleType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\FloatType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\IntType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\MediumintType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\NumericType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\RealType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\SmallintType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\numeric_types\TinyintType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types\CharType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types\LongtextType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types\MediumtextType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types\TextType;
use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\string_types\VarcharType;

/**
 * データ型façade
 */
abstract class DataType
{
    //==============================================
    // consts
    //==============================================
    // 日付と時間型
    //----------------------------------------------
    /**
     * @var string  型：日付と時間型：datetime
     */
    const TYPE_DATETIME     = DatetimeType::TYPE;

    /**
     * @var string  型：日付と時間型：date
     */
    const TYPE_DATE         = DateType::TYPE;

    /**
     * @var string  型：日付と時間型：timestamp
     */
    const TYPE_TIMESTAMP    = TimestampType::TYPE;

    /**
     * @var string  型：日付と時間型：time
     */
    const TYPE_TIME         = TimeType::TYPE;

    /**
     * @var string  型：日付と時間型：year
     */
    const TYPE_YEAR         = YearType::TYPE;

    //----------------------------------------------
    // 数値型
    //----------------------------------------------
    /**
     * @var string  型：数値型：bigint
     */
    const TYPE_BIGINT       = BigintType::TYPE;

    /**
     * @var string  型：数値型：bit
     */
    const TYPE_BIT          = BitType::TYPE;

    /**
     * @var string  型：数値型：decimal
     */
    const TYPE_DECIMAL      = DecimalType::TYPE;

    /**
     * @var string  型：数値型：double
     */
    const TYPE_DOUBLE       = DoubleType::TYPE;

    /**
     * @var string  型：数値型：float
     */
    const TYPE_FLOAT        = FloatType::TYPE;

    /**
     * @var string  型：数値型：int
     */
    const TYPE_INT          = IntType::TYPE;

    /**
     * @var string  型：数値型：mediumint
     */
    const TYPE_MEDIUMINT    = MediumintType::TYPE;

    /**
     * @var string  型：数値型：numeric
     */
    const TYPE_NUMERIC      = NumericType::TYPE;

    /**
     * @var string  型：数値型：real
     */
    const TYPE_REAL         = RealType::TYPE;

    /**
     * @var string  型：数値型：smallint
     */
    const TYPE_SMALLINT     = SmallintType::TYPE;

    /**
     * @var string  型：数値型：tinyint
     */
    const TYPE_TINYINT      = TinyintType::TYPE;

    //----------------------------------------------
    // 文字列型
    //----------------------------------------------
    /**
     * @var string  型：文字列型：char
     */
    const TYPE_CHAR = CharType::TYPE;

    /**
     * @var string  型：文字列型：longtext
     */
    const TYPE_LONGTEXT     = LongtextType::TYPE;

    /**
     * @var string  型：文字列型：mediumtext
     */
    const TYPE_MEDIUMTEXT   = MediumtextType::TYPE;

    /**
     * @var string  型：文字列型：text
     */
    const TYPE_TEXT         = TextType::TYPE;

    /**
     * @var string  型：文字列型：varchar
     */
    const TYPE_VARCHAR      = VarcharType::TYPE;

    //----------------------------------------------
    // マップ
    //----------------------------------------------
    /**
     * @var array   型クラスマップ
     */
    protected static $TYPE_CLASS_MAP   = array(
        // 日付と時間型
        DatetimeType::TYPE      => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\DatetimeType",
        DateType::TYPE          => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\DateType",
        TimestampType::TYPE     => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\TimestampType",
        TimeType::TYPE          => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\TimeType",
        YearType::TYPE          => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\YearType",
        // 数値型
        BigintType::TYPE        => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\BigintType",
        BitType::TYPE           => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\BitType",
        DecimalType::TYPE       => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\DecimalType",
        DoubleType::TYPE        => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\DoubleType",
        FloatType::TYPE         => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\FloatType",
        IntType::TYPE           => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\IntType",
        MediumintType::TYPE     => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\MediumintType",
        NumericType::TYPE       => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\NumericType",
        RealType::TYPE          => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\RealType",
        SmallintType::TYPE      => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\SmallintType",
        TinyintType::TYPE       => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\TinyintType",
        // 文字列型
        CharType::TYPE          => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\CharType",
        LongtextType::TYPE      => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\LongtextType",
        MediumtextType::TYPE    => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\MediumtextType",
        TextType::TYPE          => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\TextType",
        VarcharType::TYPE       => "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\VarcharType",
    );

    //==============================================
    // factory
    //==============================================
    /**
     * factory
     *
     * @param   string|AbstractDataType $dataType   データ型
     * @return  AbstractDataType    データ型
     */
    protected static function factory($dataType, $args = array())
    {
        if (is_object($dataType) && is_subclass_of($dataType, "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\abstracts\\AbstractDataType")) {
            $dataType   = $dataType::TYPE;
        }

        $data_type_class    = static::$TYPE_CLASS_MAP[$dataType];
        $factory            = array($data_type_class, 'factory');
        return call_user_func_array($factory, $args);
    }

    /**
     * bit型を返します。
     *
     * @param   int     $length bit長さ
     * @return  BitType bit型
     */
    public static function bit($length = null)
    {
        return static::factory(self::TYPE_BIT, array($length));
    }

    /**
     * tinyint型を返します。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  TinyintType tinyint型
     */
    public static function tinyint($unsigned = null)
    {
        return static::factory(self::TYPE_TINYINT, array($unsigned));
    }

    /**
     * smallint型を返します。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  SmallintType    smallint型
     */
    public static function smallint($unsigned = null)
    {
        return static::factory(self::TYPE_SMALLINT, array($unsigned));
    }

    /**
     * mediumint型を返します。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  MediumintType   mediumint型
     */
    public static function mediumint($unsigned = null)
    {
        return static::factory(self::TYPE_MEDIUMINT, array($unsigned));
    }

    /**
     * bigint型を返します。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  BigintType  bigint型
     */
    public static function bigint($unsigned = null)
    {
        return static::factory(self::TYPE_BIGINT, array($unsigned));
    }

    /**
     * int型を返します。
     *
     * @param   null|bool   $unsigned   符号無しとするかどうか
     * @return  IntType bigint型
     */
    public static function int($unsigned = null)
    {
        return static::factory(self::TYPE_INT, array($unsigned));
    }

    /**
     * real型を返します。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  RealType    real型
     */
    public static function real($length = null, $decimals = null, $unsigned = null)
    {
        return static::factory(self::TYPE_REAL, array($length, $decimals, $unsigned));
    }

    /**
     * double型を返します。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  DoubleType  double型
     */
    public static function double($length = null, $decimals = null, $unsigned = null)
    {
        return static::factory(self::TYPE_DOUBLE, array($length, $decimals, $unsigned));
    }

    /**
     * float型を返します。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  FloatType   float型
     */
    public static function float($length = null, $decimals = null, $unsigned = null)
    {
        return static::factory(self::TYPE_FLOAT, array($length, $decimals, $unsigned));
    }

    /**
     * decimal型を返します。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  DecimalType decimal型
     */
    public static function decimal($length = null, $decimals = null, $unsigned = null)
    {
        return static::factory(self::TYPE_DECIMAL, array($length, $decimals, $unsigned));
    }

    /**
     * numeric型を返します。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @param   bool    $unsigned   符号無しとするかどうか
     * @return  NumericType numeric型
     */
    public static function numeric($length = null, $decimals = null, $unsigned = null)
    {
        return static::factory(self::TYPE_NUMERIC, array($length, $decimals, $unsigned));
    }

    /**
     * date型を返します。
     *
     * @return  DataType    date型
     */
    public static function date()
    {
        return static::factory(self::TYPE_DATE);
    }

    /**
     * time型を返します。
     *
     * @return  TimeType    time型
     */
    public static function time()
    {
        return static::factory(self::TYPE_TIME);
    }

    /**
     * timestamp型を返します。
     *
     * @return  TimestampType   timestamp型
     */
    public static function timestamp()
    {
        return static::factory(self::TYPE_TIMESTAMP);
    }

    /**
     * datetime型を返します。
     *
     * @return  DatetimeType    datetime型
     */
    public static function datetime()
    {
        return static::factory(self::TYPE_DATETIME);
    }

    /**
     * year型を返します。
     *
     * @return  YearType    year型
     */
    public static function year()
    {
        return static::factory(self::TYPE_YEAR);
    }

    /**
     * char型を返します。
     *
     * @param   int     $length 文字列長
     * @return  CharType    char型
     */
    public static function char($length = null)
    {
        return static::factory(self::TYPE_CHAR, array($length));
    }

    /**
     * varchar型を返します。
     *
     * @param   int     $length 文字列長
     * @return  VarCharType varchar型
     */
    public static function varchar($length = null)
    {
        return static::factory(self::TYPE_VARCHAR, array($length));
    }

    /**
     * text型を返します。
     *
     * @param   bool    $binary 文字列モード
     * @return  TextType    text型
     */
    public static function text($binary = false)
    {
        return static::factory(self::TYPE_TEXT, array($binary));
    }

    /**
     * mediumtext型を返します。
     *
     * @param   bool    $binary 文字列モード
     * @return  MediumtextType  mediumtext型
     */
    public static function mediumtext($binary = false)
    {
        return static::factory(self::TYPE_MEDIUMTEXT, array($binary));
    }

    /**
     * longtext型を返します。
     *
     * @param   bool    $binary 文字列モード
     * @return  LongtextType    longtext型
     */
    public static function longtext($binary = false)
    {
        return static::factory(self::TYPE_LONGTEXT, array($binary));
    }
}
