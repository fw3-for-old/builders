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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\data_types;

use fw3_for_old\builders\sql\ddl\mysql5_6\data_types\DataType;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * データ型
 */
class DataTypeTest extends AbstractTest
{
    protected static $NONE_ERROR    = array();

    public function testTinyint()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\TinyintType";

        //----------------------------------------------
        $dataType   = DataType::tinyint();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::tinyint(true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testSmallint()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\SmallintType";

        //----------------------------------------------
        $dataType   = DataType::smallint();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::smallint(true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testMediumint()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\MediumintType";

        //----------------------------------------------
        $dataType   = DataType::mediumint();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::mediumint(true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testBigint()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\BigintType";

        //----------------------------------------------
        $dataType   = DataType::bigint();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::bigint(true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testInt()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\IntType";

        //----------------------------------------------
        $dataType   = DataType::int();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::int(true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testBit()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\BitType";

        //----------------------------------------------
        $dataType   = DataType::bit();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::bit(4);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testReal()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\RealType";

        //----------------------------------------------
        $dataType   = DataType::real();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::real(10);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::real(10, 5);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::real(10, 5, true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testDouble()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\DoubleType";

        //----------------------------------------------
        $dataType   = DataType::double();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::double(10);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::double(10, 5);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::double(10, 5, true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testFloat()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\numeric_types\\FloatType";

        //----------------------------------------------
        $dataType   = DataType::float();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::float(10);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::float(10, 5);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::float(10, 5, true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testDate()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\DateType";

        //----------------------------------------------
        $dataType   = DataType::date();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testTime()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\TimeType";

        //----------------------------------------------
        $dataType   = DataType::time();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testTimestamp()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\TimestampType";

        //----------------------------------------------
        $dataType   = DataType::timestamp();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testDatetime()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\DatetimeType";

        //----------------------------------------------
        $dataType   = DataType::datetime();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testYear()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\datetime_types\\YearType";

        //----------------------------------------------
        $dataType   = DataType::year();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testChar()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\CharType";

        //----------------------------------------------
        $dataType   = DataType::char();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::char(4);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testVarchar()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\VarcharType";

        //----------------------------------------------
        $dataType   = DataType::varchar();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::varchar(4);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testText()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\TextType";

        //----------------------------------------------
        $dataType   = DataType::text();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::text(true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testMediumtext()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\MediumtextType";

        //----------------------------------------------
        $dataType   = DataType::mediumtext();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::mediumtext(true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testLongtext()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\string_types\\LongtextType";

        //----------------------------------------------
        $dataType   = DataType::longtext();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));

        //----------------------------------------------
        $dataType   = DataType::longtext(true);

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }

    public function testJson()
    {
        $data_type_class    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\data_types\\json_data_types\\JsonType";

        //----------------------------------------------
        $dataType   = DataType::json();

        $expected   = $data_type_class;
        $actual     = $dataType;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($dataType->hasErrors());
        $this->assertFalse($dataType->hasError($data_type_class::TYPE));
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorsMessage());
        $this->assertSame(self::$NONE_ERROR, $dataType->getErrorMessage($data_type_class::TYPE));
    }
}
